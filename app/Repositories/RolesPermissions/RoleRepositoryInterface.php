<?php

namespace App\Repositories\Admin;

use Illuminate\Http\Request;

interface RoleRepositoryInterface {
    public function getRoles($author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid);
    public function createRole(Request $request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id);
    public function updateRole(Request $request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id);

}








