<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
   public function index()
   {
      $users = User::all();
      return view('admin.users.index',compact('users'));
   }

   public function show(User $user )
   {
      $role = Role::all();
      $permissions = Permission::all();
      return view('admin.users.role',compact('user','roles','permissions'));

   }


   public function givenPermission(Request $request ,User $user)
    {
        if($user->hasPermissionTo($request->permission))
        {
          return back()->with('message',':Permission exists.');
        }

        $user->givePermissionTo($request->permission);
          return back()->with('message',':Permission added.');
    }

    public function revokePermission(User $user , Permission $permission)
    {
       if($user->hasPermissionTo($permission))
        {
           $user->revokePermissionTo($permission);
          return back()->with('message','Permission revoked.');
        }
         return back()->with('message','Permission not exists.');
    }

    public function destroy(User $user)
    {
        if($user->hasRole('admin'))
        {
          return back()->with('message','You are admin.');
        }
        $user->delete();
        return back()->with('message','User deleted.');
    }
}
