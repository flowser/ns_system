<?php

namespace App\Http\Controllers\API\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Institution\InstitutionRepositoryInterface;

class InstitutionController extends Controller
{
    protected $institutionRepository;

    public function __construct(InstitutionRepositoryInterface $institutionRepository) {
        $this->institutionRepository      = $institutionRepository;

    }
    public function index($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {
        if (auth('api')->user()){
            return response()->json([
                'institutions' => $this->institutionRepository->getInstitutions($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
            ], 200);
        }
    }
    public function show($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {
        if (auth('api')->user()){
            return response()->json([
                'institution' => $this->institutionRepository->getInstitution($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
            ], 200);
        }
    }

    public function store(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {
        if (auth('api')->user()){
            $this->validate($request, [
                'institution_name'   =>'required',
                'first_name'         =>'required',
                'last_name'          =>'required',
                'email'              =>'required',
                'phone'              =>'required',
                'password'           =>'required',
                'roles'              =>'required',
                // 'instlevels'         =>'required',
                'institution_email'  =>'required',
                'phone2'             =>'required',
                'address'            =>'required',
                'postalcode_id'      =>'required',
                'code'               =>'required',
                'country_id'         =>'required',
                'county_id'          =>'required',
                'constituency_id'    =>'required',
                'ward_id'            =>'required',
            ]);

            return response()->json([
                'institution'     => $this->institutionRepository->registerInstitution($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid),
            ], 200);
        }
    }
    public function update(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {

        if (auth('api')->user()){
            $this->validate($request, [
                'institution_name'   =>'required  ',
                'institution_email'  =>'required',
                // 'instlevels'         =>'required',
                'phone2'             =>'required',
                'postalcode_id'      =>'required',
                'country_id'         =>'required',
                'county_id'          =>'required',
                'constituency_id'    =>'required',
                'ward_id'            =>'required',
            ]);
            return response()->json([
                'institution'     => $this->institutionRepository->updateInstitution($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function destroy(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {

        if (auth('api')->user()){           
            return response()->json([
                'institution'     => $this->institutionRepository->deleteInstitution($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function createInstitutionStaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id){
        if (auth('api')->user()){
                $this->validate($request, [
                    'first_name'         =>'required',
                    'last_name'          =>'required',
                    'email'              =>'required',
                    'phone'              =>'required',
                    'password'           =>'required',
                    'roles'              =>'required',
                ]);
            return response()->json([
                'institution'     => $this->institutionRepository->createInstitutionStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function updateInstitutionStaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id){
        if (auth('api')->user()){
            $this->validate($request, [
                'first_name'         =>'required',
                'last_name'          =>'required',
                'email'              =>'required',
                'phone'              =>'required',
                // 'password'           =>'required',
                'roles'              =>'required',
            ]);
        return response()->json([
            'institution'     => $this->institutionRepository->updateInstitutionStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
        ], 200);
    }
    }
    public function deleteInstitutionStaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id){
        if (auth('api')->user()){
            return response()->json([
                'institution'     => $this->institutionRepository->deleteInstitutionStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
























    public function SelfactivateInstitutionSuperadmin(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            $this->validate($request, [
                'id'                 =>'required',
                'status'             =>'required',
                'institution_id'     =>'required',
            ]);
            return response()->json([
                'institution' =>$this->institutionRepository->SelfactivateInstsuperadmin($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function SelfdeactivateInstitutionSuperadmin(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
                $this->validate($request, [
                    'id'                 =>'required',
                    'status'             =>'required',
                    'institution_id'     =>'required',
                ]);
                return response()->json([
                    'institution' => $this->institutionRepository->SelfdeactivateInstsuperadmin($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
                ], 200);
        }
    }
    public function SelfdeleteInstitutionSuperadmin(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
                $this->validate($request, [
                    'id'                 =>'required',
                    'institution_id'     =>'required',
                ]);
            return response()->json([
                'institution' => $this->institutionRepository->SelfdestroyInstsuperadmin($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }

}
