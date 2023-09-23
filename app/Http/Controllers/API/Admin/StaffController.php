<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\StaffRepositoryInterface;

class StaffController extends Controller
{
    protected $staffRepository;

    public function __construct(StaffRepositoryInterface $staffRepository) {
        $this->staffRepository      = $staffRepository;

    }
    public function index($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {
        if (auth('api')->user()){
            return response()->json([
                'staffs' => $this->staffRepository->getStaffs($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
            ], 200);
        }
    }
    public function staffs($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'staffs' => $this->staffRepository->Staffs($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
            ], 200);
        }
    }
    public function store($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'staff' => $this->staffRepository->Staffs($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
            ], 200);
        }
    }
    public function update($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'staff' => $this->staffRepository->Staffs($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
            ], 200);
        }
    }
    public function destroy($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'staff' => $this->staffRepository->Staffs($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
            ], 200);
        }
    }

}


