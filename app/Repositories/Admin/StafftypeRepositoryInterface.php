<?php

namespace App\Repositories\Admin;

use Illuminate\Http\Request;

interface StafftypeRepositoryInterface {
    public function getStafftypes($author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authroleid);
    public function updateOrCreateStafftype(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid);
    public function destroyStafftype(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id);
}







