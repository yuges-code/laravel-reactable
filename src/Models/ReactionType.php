<?php

namespace Yuges\Reactable\Models;

use Carbon\Carbon;
use Yuges\Reactable\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * 
 * @property string $name
 * @property int $weight
 * 
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 */
class ReactionType extends Model
{
    use
        HasTable,
        HasFactory;

    protected $table = 'reaction_types';

    protected $guarded = ['id'];
}
