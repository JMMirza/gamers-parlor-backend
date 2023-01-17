<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'date_of_birth',
        'balance',
        'status_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'date:d M, Y H:i',
    ];
    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'avatar_url',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function team_members()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function user_credits()
    {
        return $this->hasMany(UserCredit::class);
    }

    public function user_subscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_members', 'user_id', 'team_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getAvatarUrlAttribute()
    {
        $image = asset('/images/avatar-1.jpg');
        if (!empty($this->avatar) && file_exists('images/' . $this->avatar)) {
            $image = asset('/images/' . $this->avatar);
        }
        // dd($image);

        return $image;
    }

    public function game_tags()
    {
        return $this->hasMany(UserGamerTag::class);
    }

    public function fcm_tokens()
    {
        return $this->hasMany(SystemNotification::class);
    }
}
