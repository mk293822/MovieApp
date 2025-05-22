<?php

namespace App\Models;

use App\Enums\ApprovingEnum;
use App\Enums\PermissionEnums;
use App\Enums\RoleEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $liked_movies
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserDetailsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereLikedMovies($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereUserId($value)
 * @mixin \Eloquent
 */
class UserDetails extends Model
{
    /** @use HasFactory<\Database\Factories\UserDetailsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'avatar',
        'is_banned',
        'approved_by',
        'approve',
    ];

    protected $casts = [
        'role' => RoleEnums::class,
        'approve' => ApprovingEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
