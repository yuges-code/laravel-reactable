<?php

namespace Yuges\Reactable\Traits;

use BackedEnum;
use Yuges\Reactable\Config\Config;

trait HasReactionTypeInterface
{
    public function icon(): BackedEnum
    {
        return Config::getReactionIconEnumClass()::{$this->name};
    }

    public function weight(): BackedEnum
    {
        return Config::getReactionWeightEnumClass()::{$this->name};
    }
}
