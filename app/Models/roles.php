<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    //
    protected $guarded = [];
    public function users()
    {
        return $this->hasMany(User::class,'role');
    }

    public function permissions()
    {
        return $this->belongsToMany(permissions::class,'role_permissions','roles_id','permissions_id');
    }

    public function hasPermission($permissionId)
    {
        $permission = $this->permissions()->where('permissions.id',$permissionId)->first();
        if ($permission != '') {
            return 1;
        }
        return 0;
    }
}
