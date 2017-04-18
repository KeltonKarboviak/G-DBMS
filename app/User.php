<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'email';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name', 'role_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['full_name', 'proper_name'];

    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getProperNameAttribute() {
        return "{$this->last_name}, {$this->first_name}";
    }

    /**
     *
     */
    public function role() {
        return $this->hasOne(UserRole::class, 'id', 'role_id');
    }
}
