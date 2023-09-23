<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\StafftypeRepositoryInterface;

class StafftypeController extends Controller
{
    protected $stafftypeRepository;

    public function __construct(StafftypeRepositoryInterface $stafftypeRepository) {
        $this->stafftypeRepository      = $stafftypeRepository;

    }
    public function index($author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid)
    {
        if (auth('api')->user()){
            return response()->json([
                'stafftypes' => $this->stafftypeRepository->getstafftypes($author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid)
            ], 200);
        }
    }

    public function store(Request $request, $author, $authdepartment, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validate($request, [
                'id'                =>'required',
                'institution_id'    =>'required',
            ]);

            return response()->json([
                'stafftype'     => $this->stafftypeRepository->updateOrCreateStafftype($request, $author, $authdepartment, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $request->institution_id),
            ], 200);
        }
    }
    public function update(Request $request, $author, $authdepartment, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validate($request, [
                'id'                =>'required',
                'institution_id'    =>'required',
            ]);

            return response()->json([
                'stafftype'     => $this->stafftypeRepository->updateOrCreateStafftype($request, $author, $authdepartment, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $request->institution_id)
            ], 200);
        }
    }

    public function destroy(Request $request, $author, $authdepartment, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
                $this->validate($request, [
                    'id'                 =>'required',
                    'institution_id'     =>'required',
                ]);
            return response()->json([
                'stafftype' => $this->stafftypeRepository->destroyStafftype($request, $author, $authdepartment, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }



}


