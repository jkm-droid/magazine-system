<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $table = "role_permissions";

    protected $fillable = [
        'role_id',
        'permission_id'
    ];


    /**
     * Get the roles that owns the role_permission.
     */
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get the permissions that owns the role_permission.
     */
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
