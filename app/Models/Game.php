<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'logo',
        'vip_logo',
        'status_id',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    protected $appends = [
        'logo_url',
        'vip_logo_url',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function getLogoUrlAttribute()
    {
        $image = asset('/files/platform/user-dummy-img.jpg');
        if (!empty($this->logo) && file_exists('files/games/' . $this->logo)) {
            $image = asset('/files/games/' . $this->logo);
        }
        return $image;
    }

    public function getVipLogoUrlAttribute()
    {
        $image = asset('/files/platform/user-dummy-img.jpg');
        if (!empty($this->vip_logo) && file_exists('files/games/vip_games/' . $this->vip_logo)) {
            $image = asset('/files/games/vip_games/' . $this->vip_logo);
        }
        return $image;
    }
}
