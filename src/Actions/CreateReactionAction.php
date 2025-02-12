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

class CreateReactionAction
{
    public function __construct(
        protected Reactable $reactable
    ) {
    }

    public static function create(Reactable $reactable): self
    {
        return new static($reactable);
    }

    public function execute(int|ReactionType $type, Reactor $reactor = null): Reaction
    {
        $reactor ??= $this->getDefaultReactor();

        $this->validateReactor($reactor);

        if (! $reactor instanceof Model) {
            throw new Exception('Reactor is not eloquent model');
        }

        $attributes = [
            'reactor_id' => $reactor?->getKey() ?? null,
            'reactor_type' => $reactor?->getMorphClass() ?? null,
            'reaction_type_id' => $type?->getKey() ?? $type,
        ];

        return $this->reactable->reactions()->create($attributes);
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
