<?php

namespace Yuges\Reactable\Traits;

use Yuges\Reactable\Config\Config;
use Illuminate\Support\Facades\Auth;
use Yuges\Reactable\Models\Reaction;
use Yuges\Reactable\Interfaces\Reactor;
use Yuges\Reactable\Models\ReactionType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Yuges\Reactable\Enums\ReactionType as ReactionTypeEnum;

/**
 * @property Collection<int, Reaction> $reactions
 */
trait HasReactions
{
    public function reactions(): MorphMany
    {
        return $this->morphMany(Config::getReactionClass(), 'reactable');
    }

    public function react(int|string|ReactionType|ReactionTypeEnum $type, Reactor $reactor = null): Reaction
    {
        return Config::getProcessReactionAction($this)->execute($type, $reactor);
        // return Config::getCreateReactionAction($this)->execute($type, $reactor);
    }

    public function defaultReactor(): ?Reactor
    {
        /** @var ?Reactor */
        $reactor = Auth::user();

        return $reactor;
    }
}
