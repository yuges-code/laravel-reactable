<?php

namespace Yuges\Reactable\Interfaces;

use BackedEnum;

interface ReactionType extends BackedEnum
{
    public function icon(): BackedEnum;

    public function weight(): BackedEnum;
}
