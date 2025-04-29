<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     schema="UserComment",
 *     description="Модель комментария",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="post_id", type="integer", example=1),
 *     @OA\Property(property="rating", type="integer", example="5"),
 *     @OA\Property(property="title", type="string", example="Заголовок"),
 *     @OA\Property(property="text", type="string", example="Текст комментария"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2023-12-31T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-12-31T12:34:56Z")
 * )
 */
class UserComment extends Model
{
    /** @use HasFactory<\Database\Factories\UserCommentFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'rating',
        'title',
        'text',
    ];

//    /**
//     * @return BelongsTo
//     */
//    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Post::class, 'post_id');
//    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
