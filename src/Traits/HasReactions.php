<?php

namespace Yuges\Reactable\Traits;

use Yuges\Reactable\Config\Config;
use Illuminate\Support\Facades\Auth;
use Yuges\Reactable\Models\Reaction;
use Yuges\Reactable\Interfaces\Reactor;
use Yuges\Reactable\Models\ReactionType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Yuges\Reactable\Interfaces\ReactionType as ReactionTypeEnum;

/**
 * @property Collection<int, Reaction> $reactions
 */
trait HasReactions
{
    public function reactions(): MorphMany
    {
        return $this->morphMany(Config::getReactionClass(), 'reactable');
    }

    public function latestReaction(): MorphOne
    {
        return $this->reactions()->one()->latestOfMany();
    }

    public function oldestReaction(): MorphOne
    {
        return $this->reactions()->one()->oldestOfMany();
    }

    public function react(int|string|ReactionType|ReactionTypeEnum $type, Reactor $reactor = null): Reaction
    {
        return Config::getCreateReactionAction($this)->execute($type, $reactor);
    }

    public function toggleReact(int|string|ReactionType|ReactionTypeEnum $type, Reactor $reactor = null): ?Reaction
    {
        return Config::getToggleReactionAction($this)->execute($type, $reactor);
    }

    public function getReactionType(int|string|ReactionType|ReactionTypeEnum $type): ?ReactionType
    {
        $collection = ReactionType::query()->get();

        $collection = match (true) {
            is_int($type) => $collection->where('id', '=', $type),
            is_string($type) => $collection->where('name', '=', strtolower($type)),
            $type instanceof ReactionType => $collection
                ->where('id', '=', $type->id)
                ->where('name', '=', strtolower($type->name)),
            $type instanceof ReactionTypeEnum => $collection
                ->where('id', '=', $type->value)
                ->where('name', '=', strtolower($type->name)),
        };

        return $collection->first();
    }

    public function defaultReactor(): ?Reactor
    {
        /** @var ?Reactor */
        $reactor = Auth::user();

        return $reactor;
    }
}
