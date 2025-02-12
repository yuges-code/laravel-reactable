<?php

namespace Yuges\Reactable\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Reactor
{
    public function reactions(): MorphMany;
}
