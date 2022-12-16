<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LadderPostEnrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ladder_post_id',
        'user_id',
        'status',
        'request_time',
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ladder_post()
    {
        return $this->belongsTo(LadderPost::class, 'ladder_post_id', 'id');
    }
}
