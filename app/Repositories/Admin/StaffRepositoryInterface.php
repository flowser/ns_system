<?php

namespace App\Repositories\Admin;

use Illuminate\Http\Request;

interface StaffRepositoryInterface {
    public function getStaff($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid);
    public function getStaffs($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid);
    public function createStaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid);
    public function updateStaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid);

}







