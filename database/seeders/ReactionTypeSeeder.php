<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Yuges\Reactable\Models\ReactionType;
use Yuges\Reactable\Enums\ReactionType as ReactionTypeEnum;

class ReactionTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (ReactionTypeEnum::cases() as $type) {
            $this->create($type);
        }
    }

    protected function create(ReactionTypeEnum $type): bool
    {
        if (ReactionType::query()->where('name', '=', strtolower($type->name))->getQuery()->exists()) {
            return false;
        }

        $model = new ReactionType();

        return $model
            ->guard(['*'])
            ->fill([
                'id' => $type->value,
                'name' => strtolower($type->name),
                'weight' => $type->weight(),
            ])
            ->save();
    }
}
