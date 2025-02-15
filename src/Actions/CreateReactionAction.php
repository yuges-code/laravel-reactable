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
use Yuges\Reactable\Enums\ReactionType as ReactionTypeEnum;

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

    public function execute(string $type, Reactor $reactor = null): Reaction
    {
        $reactor ??= $this->getDefaultReactor();

        $this->validateReactor($reactor);

        if (! $reactor instanceof Model) {
            throw new Exception('Reactor is not eloquent model');
        }

        $type = $this->getReactionType($type);

        if (! $type) {
            throw new Exception('Type of reaction not found');
        }

        $attributes = [
            'reactor_id' => $reactor?->getKey() ?? null,
            'reactor_type' => $reactor?->getMorphClass() ?? null,
            'reaction_type_id' => $type->getKey(),
        ];

        return $this->reactable->reactions()->create($attributes);
    }

    public function getReactionType(string|ReactionType|ReactionTypeEnum $type): ?ReactionType
    {
        $builder = ReactionType::query();

        match (true) {
            is_int($type) => $builder->where('id', '=', $type),
            is_string($type) => $builder->where('name', '=', strtolower($type)),
            $type instanceof ReactionType => $builder
                ->where('id', '=', $type->id)
                ->orWhere('name', '=', strtolower($type->name)),
            $type instanceof ReactionTypeEnum => $builder
                ->where('id', '=', $type->value)
                ->where('name', '=', strtolower($type->name)),
        };

        return $builder->first();
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
