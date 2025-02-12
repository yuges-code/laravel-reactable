<?php

namespace Yuges\Reactable\Interfaces;

use Yuges\Reactable\Models\Reaction;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Reactable
{
    public function reactions(): MorphMany;

    public function react(string $text, Reactor $reactor = null): Reaction;

    public function defaultReactor(): ?Reactor;
}
