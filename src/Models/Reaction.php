<?php

namespace Yuges\Reactable\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * 
 * @property int $reactor_id
 * @property string $reactor_type
 * @property int $reactable_id
 * @property string $reactable_type
 * @property ?string $parent_id
 * 
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 */
class Reaction extends Model
{
    use
        HasUlids,
        HasFactory;

    protected $table = 'reactions';

    protected $guarded = ['id'];

    public function reactor(): BelongsTo
    {
        return $this->morphTo();
    }

    public function reactable(): MorphTo
    {
        return $this->morphTo();
    }
}
