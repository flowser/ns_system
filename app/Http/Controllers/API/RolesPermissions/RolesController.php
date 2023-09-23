<?php

namespace App\Http\Controllers\API\RolesPermissions;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\RoleRepositoryInterface;

class RolesController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository) {
        $this->roleRepository      = $roleRepository;

    }

    public function index($author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {
        if (auth('api')->user()){
            $roles = Role::with('permissions')->get();
            return response()->json([
                'roles' => $this->rolesRepository->getRoles($author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid),
            ], 200);
        }
    }
    public function all()
    {
        $roles = Role::get();
        return response()->json([
            'roles' => $roles,
        ], 200);
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->givePermissionTo($request->permission);
        $role->save();
        return response()->json([
            'role' => $role
        ], 200);
    }
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        // dd($role);
        // dd($role->permissions()->pluck('name'));
        return response()->json([
            'role' => $role
        ], 200);
    }

    public function update(Request $request, $id)

    {
        // Validate name and permission fields
        $this->validate($request, [
            'name' => 'required|max:15|unique:roles,name,' . $id,
            'permission' => 'required',
        ]);
        // dd($role);
        $role = Role::with('permissions')->find($id);
        $role->name = $request->name;
        $role->syncPermissions($request->permission);
        $role->save();
        return response()->json([
            'role' => $role
        ], 200);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if ($role->name != 'Superadmin') {
            $role->delete();
            return response()->json([
                'role' => $role
            ], 200);
        } else {
            return ['message', 'The Role Can not be deleted'];
        }
    }
}
