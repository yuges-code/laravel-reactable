<?php

namespace Yuges\Reactable\Traits;

use Yuges\Reactable\Config\Config;
use Illuminate\Support\Facades\Auth;
use Yuges\Reactable\Models\Reaction;
use Yuges\Reactable\Interfaces\Reactor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property Collection<int, Reaction> $reactions
 */
trait HasReactions
{
    public function reactions(): MorphMany
    {
        return $this->morphMany(Config::getReactionClass(), 'reactable');
    }

    public function react(string $type, Reactor $reactor = null): Reaction
    {
        return Config::getCreateReactionAction($this)->execute($type, $reactor);
    }

    public function defaultReactor(): ?Reactor
    {
        /** @var ?Reactor */
        $reactor = Auth::user();

        return $reactor;
    }
}
