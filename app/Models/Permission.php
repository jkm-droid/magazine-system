<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * Get the admins that belong to the permissions.
     */
    public function admins(){
        return $this->belongsToMany(Admin::class,'admin_permissions','permission_id','admin_id' )
            ->withTimestamps();
    }

    /**
     * Get the roles that belong to the permissions.
     */
    public function roles(){
        return $this->belongsToMany(Role::class,'role_permissions','permission_id','role_id' )
            ->withTimestamps();
    }
}
