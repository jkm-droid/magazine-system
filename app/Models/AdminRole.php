<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;

    protected $table = "admin_roles";

    protected $fillable = [
        'admin_id',
        'role_id'
    ];


    /**
     * Get the admins that owns the admin_roles.
     */
    public function admins(){
        return $this->belongsToMany(Admin::class);
    }

    /**
     * Get the roles that owns the admin_roles.
     */
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
