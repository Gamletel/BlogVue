<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     schema="Post",
 *     description="Модель поста",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Название поста"),
 *     @OA\Property(property="description", type="string", example="Краткое описание"),
 *     @OA\Property(property="text", type="string", example="Содержимое поста"),
 *     @OA\Property(property="user_id", type="integer", example=5),
 *     @OA\Property(property="icon", type="string", example="image.png"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2023-12-31T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-12-31T12:34:56Z")
 * )
 */
class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'text',
        'icon',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
