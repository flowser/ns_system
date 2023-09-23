<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Admin\StafftypeRepositoryInterface;


class StaffRepository implements StaffRepositoryInterface
{
    protected $userRepository;
    protected $staffRepository;

    public function __construct(
                                UserRepositoryInterface $userRepository,
                                StafftypeRepositoryInterface $stafftypeRepository,
                                ) {
        $this->userRepository                = $userRepository;
        $this->stafftypeRepository           = $stafftypeRepository;

    }
    public function getStaff($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid){
        $staff  = Staff::where('user_id',  Auth::user()->id)->first();
        return $staff;
    }
    public function getStaffs($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid){
        return Staff::with($this->relation())->where('institution_id',  $authinstitutionid)->get();
    }

    public function createStaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {
        $staff                         = new Staff();
        $staff->code                   = null;
        $staff->status                 = true;
        $staff->user_id                = $this->userRepository->createUser($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)->id;
        $staff->stafftype_id           = $this->stafftypeRepository->updateOrCreateStafftype($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)->id;
        $staff->institution_id         = $authinstitutionid;
        $staff->save();

        $staff->load($this->relation());
        return $staff;
    }
                 // createStaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
                 // updateStaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid);
    public function updateStaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {
        $staff                         = Staff::where('user_id', $request->user_id)->where('institution_id', $authinstitutionid)->first();
        $staff->code                   = null;
        $staff->status                 = true;
        $staff->user_id                = $this->userRepository->updateUser($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $request->user_id)->id;
        $staff->stafftype_id           = $this->stafftypeRepository->updateOrCreateStafftype($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)->id;
        $staff->institution_id         = $authinstitutionid;
        $staff->save();

        $staff->load($this->relation());
        return $staff;
    }

    public function relation(){
        return [

            'staffuser',
            'institution',
            'stafftype',
        ];
    }
}






