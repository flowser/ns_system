<?php

namespace App\Http\Controllers\API\RolesPermissions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        // latest()->paginate(10);
        $permissions = Permission::all();
        return response()->json([
            'permissions' => $permissions
        ], 200);
    }

    public function all()
    {
        $permissions = Permission::get();
        return response()->json([
            'permissions' => $permissions
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:20|unique:permissions'
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        // dd($request);
        return ['message' => 'Permission Created successfully'];
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        // dd($category);
        return response()->json([
            'permission' => $permission
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50|unique:permissions,name,' . $id

        ]);
        $permission = Permission::find($id);
        $permission->name = $request->name;

        if ($permission->name != 'View-backend') {
            $permission->save();
            return response()->json([
                'permission' => $permission
            ], 200);
        } else {
            return ['message', 'The Permision cannot be updated'];
        }
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        //delete the permission
        // dd($permission);
        if ($permission->name != 'View-backend') {
            $permission->delete();
            return response()->json([
                'permission' => $permission
            ], 200);
        } else {
            return ['message', 'The Permission Cannot be deleted'];
        }
    }
}
