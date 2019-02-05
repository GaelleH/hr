<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permissions\HasPermissionsTrait;

class User extends Authenticatable
{
    use Notifiable, HasPermissionsTrait;

    public function scopeSearch($query, $s) {
        return $query->where('name', 'like', '%' .$s. '%')
        ->orWhere('first_name', 'like', '%' .$s. '%');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function abscencesYears() {
        return $this->belongsToMany(abscencesYear::class);
    }

    public function functions() {
        return $this->belongsTo(UserFunction::class);
    }
}
