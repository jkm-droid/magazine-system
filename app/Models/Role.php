<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function admins(){
        return $this->belongsToMany(Admin::class,'admin_roles','role_id','admin_id' )
            ->withTimestamps();
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permissions','role_id','permission_id' )
            ->withTimestamps();
    }
}
