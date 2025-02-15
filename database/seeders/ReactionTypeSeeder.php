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

    protected function create(ReactionTypeEnum $type): ReactionType
    {
        return ReactionType::query()->updateOrCreate([
            'id' => $type->value,
            'name' => strtolower($type->name),
        ], [
            'icon' => $type->icon()->value,
            'weight' => $type->weight()->value,
        ]);
    }
}
