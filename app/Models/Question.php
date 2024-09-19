<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ['id'];

    /** @var array<string> $dates */
    protected array $dates = ['created_at', 'updated_at'];
}
