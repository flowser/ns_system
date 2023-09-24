<?php

namespace App\Models\User;

use App\Traits\Uuids;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Uuids;
    use HasApiTokens, HasRoles, HasFactory, Notifiable;

    protected $guard_name = 'api';
    // protected $keyType = 'string';
    // protected $primaryKey = 'id';
    // protected $primaryKey = 'uuid';
    // public $incrementing = false;



    protected $fillable = [
            'first_name',
            'last_name',
            'phone',
            'email',
            'password',
            'password_changed_at',
            'confirmation_code',
            'email_verified_at',
            'timezone',
            'confirmed',
            'online',
            'active',
            'last_login_at',
            'last_login_ip',
    ];
        protected $hidden = ['password', 'remember_token','email_verified_at'];
        protected $dates = ['last_login_at', 'deleted_at'];
        protected $appends = ['full_name'];
        protected $casts = [
            // 'id' => 'string',
            'active'    => 'boolean',
            'confirmed' => 'boolean',
            'online'    => 'boolean',
            'email_verified_at' => 'datetime',
        ];

        public function getFullNameAttribute()
        {
            return $this->last_name ? $this->first_name . ' ' . $this->last_name : $this->first_name;
        }


        public function getNameAttribute()
        {
            return $this->full_name;
        }

}
