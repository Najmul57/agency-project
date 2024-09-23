<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function allPermission()
    {
        $permission = Permission::latest()->get();
        return view('admin.permission.index', compact('permission'));
    } // end method

    public function addPermission()
    {
        return view('admin.permission.create');
    } // end method

    public function storePermission(Request $request)
    {
        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = [
            'message' => 'Permission Insert Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.permission')->with($notification);
    } // end method

    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit', compact('permission'));
    } // end method

    public function updatePermission(Request $request, $id)
    {
        Permission::findOrFail($id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = [
            'message' => 'Permission Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.permission')->with($notification);
    } // end method

    public function destroyPermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        $notification = [
            'message' => 'Permission Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.permission')->with($notification);
    } // end method

    ///////////// all roles ////////////

    public function allRoles()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    } // end method

    public function addRoles()
    {
        return view('admin.roles.create');
    } // end method

    public function storeRoles(Request $request)
{
    // Check if a role with the same name already exists
    $existingRole = Role::where('name', $request->name)->first();

    if ($existingRole) {
        $notification = [
            'message' => 'Role already exists!',
            'alert-type' => 'error',
        ];
        return redirect()->back()->with($notification);
    }

    // Create a new role
    $role = Role::create([
        'name' => $request->name,
    ]);

    $notification = [
        'message' => 'Role Insert Success!',
        'alert-type' => 'success',
    ];
    return redirect()->route('all.roles')->with($notification);
} // end method

    public function editRoles($id)
    {
        $roles = Role::findOrFail($id);
        return view('admin.roles.edit', compact('roles'));
    } // end method

    public function updateRoles(Request $request, $id)
    {
        $role = Role::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = [
            'message' => 'Role Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.roles')->with($notification);
    }

    public function destroyRoles($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        $notification = [
            'message' => 'Role Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.roles')->with($notification);
    } // end method

    // role permission
    public function addRolesPermission()
    {
        $role = Role::all();
        $permission = Permission::all();
        $permission_group = User::getPermissionGroup();
        return view('admin.roles.add_role_permission', compact('role', 'permission', 'permission_group'));
    } // end method

    // public function storeRolesPermission(Request $request)
    // {
    //     $data = [];
    //     $permissions = $request->permission;

    //     foreach ($permissions as $key => $item) {
    //         $data['role_id'] = $request->role_id;
    //         $data['permission_id'] = $item;

    //         DB::table('role_has_permissions')->insert($data);
    //     }
    //     $notification = [
    //         'message' => 'Role Permission Success!',
    //         'alert-type' => 'success',
    //     ];
    //     return redirect()->route('all.roles.permission')->with($notification);
    // } // end method

    public function storeRolesPermission(Request $request)
    {
        $permissions = $request->permission;
        $roleId = $request->role_id;
        $inserted = false;

        foreach ($permissions as $permissionId) {
            // Check if the permission already exists for the role
            $exists = DB::table('role_has_permissions')->where('role_id', $roleId)->where('permission_id', $permissionId)->exists();

            if (!$exists) {
                // Insert the new permission for the role
                DB::table('role_has_permissions')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permissionId,
                ]);
                $inserted = true;
            }
        }

        if ($inserted) {
            $notification = [
                'message' => 'Role Permission Success!',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Permission already added',
                'alert-type' => 'info',
            ];
        }

        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function allRolesPermission()
    {
        $roles = Role::all();
        return view('admin.roles.all_role_permission', compact('roles'));
    } // end method
    public function editRolesPermission($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::all();
        $permission_group = User::getPermissionGroup();

        return view('admin.roles.edit_role_permission', compact('role', 'permission', 'permission_group'));
    } // end method

    public function updateRolesPermission(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $notification = [
            'message' => 'Role Permission Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function deleteRolesPermission($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }
        $notification = [
            'message' => 'Role Permission Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.roles.permission')->with($notification);
    }
}
