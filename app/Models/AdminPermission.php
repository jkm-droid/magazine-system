<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    use HasFactory;
    protected $table = "admin_permissions";

    protected $fillable = [
        'admin_id',
        'permission_id'
    ];


    /**
     * Get the admins that owns the admin_permission.
     */
    public function admins(){
        return $this->belongsToMany(Admin::class);
    }

    /**
     * Get the permissions that owns the admin_permission.
     */
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
