<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LadderPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'game_id',
        'platform_id',
        'fee',
        'start_date',
        'host_id',
        'status',
        'terms_and_condition'
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id', 'id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id', 'id');
    }
}
