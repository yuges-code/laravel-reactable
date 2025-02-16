<?php

namespace Yuges\Reactable\Actions;

use Exception;
use Yuges\Reactable\Config\Config;
use Yuges\Reactable\Models\Reaction;
use Yuges\Reactable\Interfaces\Reactor;
use Illuminate\Database\Eloquent\Model;
use Yuges\Reactable\Models\ReactionType;
use Yuges\Reactable\Interfaces\Reactable;
use Yuges\Reactable\Exceptions\InvalidReactor;
use Yuges\Reactable\Interfaces\ReactionType as ReactionTypeEnum;

class ToggleReactionAction
{
    public function __construct(
        protected Reactable $reactable
    ) {
    }

    public static function create(Reactable $reactable): self
    {
        return new static($reactable);
    }

    public function execute(int|string|ReactionType|ReactionTypeEnum $type, Reactor $reactor = null): ?Reaction
    {
        $reactor ??= $this->getDefaultReactor();

        $this->validateReactor($reactor);

        if (! $reactor instanceof Model) {
            throw new Exception('Reactor is not eloquent model');
        }

        $type = $this->reactable->getReactionType($type);

        if (! $type) {
            throw new Exception('Type of reaction not found');
        }

        $reaction = $this->reactable->reactions()->getQuery()->whereMorphedTo('reactor', $reactor)->first();

        if ($reaction) {
            $reaction->delete();

            return null;
        }

        return Config::getCreateReactionAction($this->reactable)->execute($type, $reactor);

    }

    public function validateReactor(Reactor $reactor = null): void
    {
        if (! $reactor) {
            return;
        }

        $class = get_class($reactor);
        $allowed = Config::getReactorAllowedClasses()->push(Config::getReactorDefaultClass());

        if (! $allowed->contains($class)) {
            throw InvalidReactor::doesNotContainInAllowedConfig($class);
        }
    }

    public function getDefaultReactor(): ?Reactor
    {
        $reactor = $this->reactable->defaultReactor();

        if (! $reactor) {
            return null;
        }

        $class = get_class($reactor);

        if (Config::getReactorDefaultClass() !== $class) {
            throw InvalidReactor::doesNotContainInDefaultConfig($class);
        }

        return $reactor;
    }
}
