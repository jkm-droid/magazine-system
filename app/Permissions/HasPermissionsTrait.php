<?php

namespace App\Permissions;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

trait HasPermissionsTrait
{
    public function givePermissionsTo(... $permissions) {

        $permissions = $this->getAllPermissions($permissions);
//        dd($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function withdrawPermissionsTo( ... $permissions ) {

        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;

    }

    public function refreshPermissions( ... $permissions ) {

        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function hasPermissionTo($permission) {

        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    public function hasPermissionThroughRole($permission) {

        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole(... $roles) {
        
        foreach ($roles as $role) {
            for ($i = 0;$i < count($role);$i++){
//                dd($role[$i]);
//                dd($this->roles->contains('slug', $role[$i]));
                if ($this->roles->contains('slug', $role[$i])) {

                    return true;
                }
            }
        }

        return false;
    }

    public function roles() {

        return $this->belongsToMany(Role::class,'admin_roles','admin_id','role_id' );

    }
    public function permissions() {

        return $this->belongsToMany(Permission::class,'admin_permissions');

    }
    protected function hasPermission($permission) {

        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    protected function getAllPermissions(array $permissions) {

        return Permission::whereIn('slug',$permissions)->get();

    }

    /**
     * check user roles
     */
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }else
            return Redirect::back()->with('error','Unauthorized action!');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hassRole($role)
    {
        if ($this->roles()->where('slug', $role)->first()) {
            return true;
        }
        return false;
    }
}
