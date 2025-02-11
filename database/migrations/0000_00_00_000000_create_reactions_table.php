<?php

use Illuminate\Support\Facades\Schema;
use Yuges\Reactable\Models\ReactionType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct(
        protected string $table = 'reactions'
    ) {
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->nullableMorphs('reactor');
            $table->morphs('reactable');
            $table->foreignIdFor(ReactionType::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();

            $table->unique([
                'reactor_id',
                'reactor_type',
                'reactable_id',
                'reactable_type',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
