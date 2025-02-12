<?php

namespace Yuges\Reactable\Exceptions;

use Exception;

class InvalidReactor extends Exception
{
    public static function doesNotContainInAllowedConfig(string $class): self
    {
        return new static("Reactor class `{$class}` doesn't contain in allowed reactors config");
    }

    public static function doesNotContainInDefaultConfig(string $class): self
    {
        return new static("Reactor class `{$class}` doesn't contain in default reactor config");
    }
}
