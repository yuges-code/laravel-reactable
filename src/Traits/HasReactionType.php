<?php

namespace Yuges\Reactable\Traits;

use Yuges\Reactable\Config\Config;
use Yuges\Reactable\Models\ReactionType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Yuges\Reactable\Enums\ReactionType as ReactionTypeEnum;
use Yuges\Reactable\Interfaces\ReactionType as ReactionTypeInterface;

/**
 * @property int $reaction_type_id
 * @property ReactionTypeEnum $type
 * @property ReactionType $reactionType
 */
trait HasReactionType
{
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn () => Config::getReactionTypeEnumClass(ReactionTypeEnum::class)::from($this->reaction_type_id),
            set: fn (ReactionTypeInterface $enum) => [
                'reaction_type_id' => $enum->value,
            ],
        );
    }

    public function reactionType(): BelongsTo
    {
        return $this->belongsTo(Config::getReactionTypeClass(ReactionType::class));
    }
}
