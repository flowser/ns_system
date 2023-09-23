<?php

namespace App\Repositories\Admin;

use Illuminate\Http\Request;

interface PermissionRepositoryInterface {
    public function getPermissions($author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid);
    public function updateOrCreatePermission(Request $request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $institution_id);
    public function destroyPermission(Request $request, $author, $authorrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id);
}








