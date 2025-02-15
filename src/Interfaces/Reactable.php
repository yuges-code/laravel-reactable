<?php

namespace Yuges\Reactable\Interfaces;

use Yuges\Reactable\Models\Reaction;
use Yuges\Reactable\Models\ReactionType;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Yuges\Reactable\Enums\ReactionType as ReactionTypeEnum;

interface Reactable
{
    public function reactions(): MorphMany;

    public function react(int|string|ReactionType|ReactionTypeEnum $text, Reactor $reactor = null): Reaction;

    public function defaultReactor(): ?Reactor;
}
