<?php

namespace Yuges\Reactable\Config;

use Illuminate\Support\Collection;
use Yuges\Reactable\Models\Reaction;
use Yuges\Reactable\Interfaces\Reactor;
use Yuges\Reactable\Models\ReactionType;
use Yuges\Reactable\Interfaces\Reactable;
use Yuges\Reactable\Actions\CreateReactionAction;
use Illuminate\Support\Facades\Config as ConfigFacade;

class Config
{
    const string NAME = 'reactable';

    /** @return class-string<Reaction> */
    public static function getReactionClass(mixed $default = null): string
    {
        return self::get('models.reaction.default', $default);
    }

    /** @return class-string<ReactionType> */
    public static function getReactionTypeClass(mixed $default = null): string
    {
        return self::get('models.reaction.type', $default);
    }

    /** @return class-string<Reactor> */
    public static function getReactorDefaultClass(mixed $default = null): string
    {
        return self::get('models.reactor.default', $default);
    }

    /** @return Collection<int, class-string<Reactor>> */
    public static function getReactorAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.reactor.allowed', $default)
        );
    }

    public static function getCreateReactionAction(Reactable $reactable, mixed $default = null): CreateReactionAction
    {
        return self::getCreateReactionActionClass($default)::create($reactable);
    }

    /** @return class-string<CreateReactionAction> */
    public static function getCreateReactionActionClass(mixed $default = null): string
    {
        return self::get('actions.create', $default);
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return ConfigFacade::get(self::NAME . '.' . $key, $default);
    }
}
