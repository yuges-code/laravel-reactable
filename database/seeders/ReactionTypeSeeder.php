<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Yuges\Reactable\Config\Config;
use Yuges\Reactable\Models\ReactionType;
use Yuges\Reactable\Interfaces\ReactionType as ReactionTypeEnum;

class ReactionTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Config::getReactionTypeEnumClass()::cases() as $type) {
            $this->create($type);
        }
    }

    protected function create(ReactionTypeEnum $type): ReactionType
    {
        return Config::getReactionTypeClass(ReactionType::class)::query()->updateOrCreate([
            'id' => $type->value,
            'name' => strtolower($type->name),
        ], [
            'icon' => $type->icon()->value,
            'weight' => $type->weight()->value,
        ]);
    }
}
