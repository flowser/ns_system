<?php

namespace App\Repositories\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Repositories\Admin\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    protected $roleRepository;

    public function __construct() {
        // $this->roletypeRepository                = $roletypeRepository;

    }
    public function getRoles($author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid){
        $role  = Role::where()->first();
        return $role;
    }

    public function createRole(Request $request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $instsuperadmin)
    {
        $role                         = new Role();
        $role->code                   = null;
        $role->status                 = true;
        $role->user_id                = $instsuperadmin->user_id;
        $role->roletype_id           = $this->roletypeRepository->updateOrCreateRoletype($request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $instsuperadmin->institution_id)->id;
        $role->managementcategory_id  = $this->managementcategoryRepository->updateOrCreateManagementcategory($request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $instsuperadmin->institution_id)->id;
        $role->institution_id         = $instsuperadmin->institution_id;
        $role->save();

        $departmentrole = $this->departmentroleRepository->createDepartmentrole($request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $role);
        $role->load($this->relation());
        return $role;
    }

    public function updateRole(Request $request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        $role                         = Role::with($this->relation())->find($id);
        $role->code                   = null;
        $role->status                 = true;
        // $role->user_id                = $instsuperadmin->user_id;
        // $role->roletype_id           = $this->roletypeRepository->updateOrCreateRoletype($request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $instsuperadmin->institution_id)->id;
        // $role->managementcategory_id  = $this->managementcategoryRepository->updateOrCreateManagementcategory($request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $instsuperadmin->institution_id)->id;
        // $role->institution_id         = $instsuperadmin->institution_id;
        $role->save();

        $departmentrole = $this->departmentroleRepository->createDepartmentrole($request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $role);
        $role->load($this->relation());
        return $role;
    }

    public function relation(){
        return [

            'user',
            'institution',
            'roletype',
        ];
    }
}







