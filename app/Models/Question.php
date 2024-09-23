<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Question extends Model
{
    /**
     * @use HasFactory<QuestionFactory>
     */
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @var array<string> $dates
     */
    protected array $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'draft' => 'boolean',
    ];

    /**
     * @return HasMany<Vote>
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * @return BelongsTo<User, Question>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
