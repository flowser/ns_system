<?php

namespace App\Repositories\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{

    public function getPermissions($author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {
        if($author === 'system' && $authorrole === 'system'){
            return Permission::with($this->relation())
                           ->get();
        }elseif($author === 'institution' && $authorrole === 'institution'){//admins/superadmin/principle
            return Permission::with($this->relation())
                           ->where('institution_id', $authinstitutionid)
                           ->get();
        }elseif($author === 'institution' && $authorrole === 'orrole'){//hod/dhod/lecturers
            return Permission::with($this->relation())
                           ->where('institution_id', $authinstitutionid)
                           ->get();
        }
    }

    public function updateOrCreatePermission(Request $request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $institution_id)
    {
        $permission = Permission::updateOrCreate(
            [
                'name'             => $request->permission_id[0],
                'institution_id'   => $institution_id,
            ],
            [
                'name'             => $request->permission_id[0],
                'institution_id'   => $institution_id,
            ],
        );

        $permission->load($this->relation());
        return $permission;
    }

    public function destroyPermission(Request $request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id){
        $permission = Permission::findOrFail($id);
        $permission->delete();
        $permission->load($this->relation());
        return $permission;
    }
    public function relation(){
        return [
            'institution',
        ];
    }
}








