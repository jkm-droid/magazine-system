<?php

namespace App\Models;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    use HasPermissionsTrait;
    use Notifiable;

    protected $guard = "admin";

    protected $fillable = [
        'username',
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Get the articles owned by the user.
     */
    public function article(){
        return $this->hasMany(Article::class);
    }

    /**
     * Get the categories owned by the user.
     */
    public function category(){
        return $this->hasMany(Category::class);
    }

    /**
     * Get the roles owned by the user.
     */
    public function roles(){
        return $this->belongsToMany(Role::class,'admin_roles','admin_id','role_id' )
            ->withTimestamps();
    }

    /**
     * Get the permissions owned by the user.
     */
    public function permissions(){
        return $this->belongsToMany(Permission::class,'admin_permissions','admin_id','permission_id' )
            ->withTimestamps();
    }

}
