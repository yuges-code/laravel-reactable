<?php

use Yuges\Reactable\Config\Config;
use Illuminate\Support\Facades\Schema;
use Yuges\Reactable\Models\ReactionType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct(protected string $table = 'reaction_types')
    {
        $this->$table = Config::getReactionTypeClass(ReactionType::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->string('icon')->unique();
            $table->integer('weight');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
