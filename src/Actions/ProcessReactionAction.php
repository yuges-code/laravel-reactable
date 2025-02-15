<?php

namespace Yuges\Reactable\Actions;

use Exception;
use Yuges\Reactable\Models\Reaction;
use Yuges\Reactable\Interfaces\Reactor;
use Yuges\Reactable\Models\ReactionType;
use Yuges\Reactable\Interfaces\Reactable;
use Yuges\Reactable\Enums\ReactionType as ReactionTypeEnum;

class ProcessReactionAction
{
    public function __construct(
        protected Reactable $reactable
    ) {
    }

    public static function create(Reactable $reactable): self
    {
        return new static($reactable);
    }

    public function execute(int|string|ReactionType|ReactionTypeEnum $type, Reactor $reactor = null): Reaction
    {
        $type = $this->getReactionType($type);

        if (! $type) {
            throw new Exception('Type of reaction not found');
        }

        $reaction = $this->reactable->reactions()->getQuery()->whereMorphedTo('reactor', $reactor)->first();

        dd($reaction);
    }

    public function getReactionType(int|string|ReactionType|ReactionTypeEnum $type): ?ReactionType
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
}
