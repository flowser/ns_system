<?php

namespace App\Http\Controllers\API\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Institution\AdministrationRepositoryInterface;

class AdministrationController extends Controller
{
    protected $administrationRepository;

    public function __construct(AdministrationRepositoryInterface $administrationRepository) {
        $this->administrationRepository      = $administrationRepository;

    }
    public function index($author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid)
    {
        if (auth('api')->user()){
            return response()->json([
                'administrations' => $this->administrationRepository->getallAdministrations($author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid)
            ], 200);
        }
    }
    public function active($author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid)
    {
        if (auth('api')->user()){
            return response()->json([
                'administrations' => $this->administrationRepository->getActiveAdministrations($author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid)
            ], 200);
        }
    }
    public function validation(Request $request){
        $lecturerstatus = $request->lecturerstatus;
        if($lecturerstatus === 'New'){
            return $this->newValidate($request);
        }elseif($lecturerstatus === 'Editing'){
            return $this->editingValidate($request);
        }elseif($lecturerstatus === 'Existing'){
            return $this->existingValidate($request);
        }
    }
    public function newValidate(Request $request){

        return $this->validate($request, [
             'first_name'          =>'required',
             'last_name'          =>'required',
             'email'              =>'required',
             'phone'              =>'required',
             'password'           =>'required',
             'roles'              =>'required',
             'institution_id'     =>'required',
        ]);
    }
    public function editingValidate(Request $request){
        return $this->validate($request, [
            'first_name'         =>'required',
            'last_name'          =>'required',
            'email'              =>'required',
            'phone'              =>'required',
            // 'password'           =>'required',
            'roles'              =>'required',
            'institution_id'     =>'required',
       ]);
    }
    public function existingValidate(Request $request){
        return $this->validate($request, [
            'lecturer_ids'       =>'required',
            'institution_id'     =>'required',
       ]);
    }

    public function store(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid)
    {
        if (auth('api')->user()){
            $this->validation($request);
            return response()->json([
                'administration'     => $this->administrationRepository->registerAdministration($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid),
            ], 200);
        }
    }
    public function update(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {

        if (auth('api')->user()){
            $this->validate($request, [
                'institution_id'     =>'required',
            ]);
            return response()->json([
                'administration'     => $this->administrationRepository->updateAdministration($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }
    public function activate(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validate($request, [
                'id'                 =>'required',
                'status'             =>'required',
                'institution_id'     =>'required',
            ]);
            return response()->json([
                'administrations' =>$this->administrationRepository->activateAdministration($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }
    public function deactivate(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validate($request, [
                'id'                 =>'required',
                'status'             =>'required',
                'institution_id'     =>'required',
            ]);
            return response()->json([
                'administrations' =>$this->administrationRepository->deactivateAdministration($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }

    //principal

    public function registerPrincipal(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validation($request);
                return response()->json([
                    'administrations'     => $this->administrationRepository->registerAdministrationPrincipal($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
                ], 200);
        }
    }
    public function updatePrincipal(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validation($request);
            return response()->json([
                'administrations' => $this->administrationRepository->updateAdministrationPrincipal($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }
    public function activatePrincipal(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validate($request, [
                'id'                 =>'required',
                'status'             =>'required',
                'institution_id'     =>'required',
            ]);
            return response()->json([
                'administrations' =>$this->administrationRepository->activatePrincipal($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }
    public function deletePrincipal(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
                $this->validate($request, [
                    'id'                 =>'required',
                    'institution_id'     =>'required',
                ]);
            return response()->json([
                'administrations' => $this->administrationRepository->destroyPrincipal($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }

    //admin deputy

    public function registerAdmindeputy(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validation($request);
                return response()->json([
                    'administrations'     => $this->administrationRepository->registerAdministrationAdmindeputy($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
                ], 200);
        }
    }
    public function updateAdmindeputy(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validation($request);
            return response()->json([
                'administrations' => $this->administrationRepository->updateAdministrationAdmindeputy($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }


    public function activateAdmindeputy(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validate($request, [
                'id'                 =>'required',
                'status'             =>'required',
                'institution_id'     =>'required',
            ]);
            return response()->json([
                'administrations' =>$this->administrationRepository->activateAdmindeputy($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }
    public function deleteAdmindeputy(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
                $this->validate($request, [
                    'id'                 =>'required',
                    'institution_id'     =>'required',
                ]);
            return response()->json([
                'administrations' => $this->administrationRepository->destroyAdmindeputy($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }


    // academic deputy`
    public function registerAcademicdeputy(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
                $this->validation($request);
                return response()->json([
                    'administrations'     => $this->administrationRepository->registerAdministrationAcademicdeputy($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
                ], 200);
        }
    }
    public function updateAcademicdeputy(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validation($request);
            return response()->json([
                'administrations' => $this->administrationRepository->updateAdministrationAcademicdeputy($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }
    public function activateAcademicdeputy(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validate($request, [
                'id'                 =>'required',
                'status'             =>'required',
                'institution_id'     =>'required',
            ]);
            return response()->json([
                'administrations' =>$this->administrationRepository->activateAcademicdeputy($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }
    public function deleteAcademicdeputy(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
                $this->validate($request, [
                    'id'                 =>'required',
                    'institution_id'     =>'required',
                ]);
            return response()->json([
                'administrations' => $this->administrationRepository->destroyAcademicdeputy($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }
    // academic registrar`
    public function registerRegistrar(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
                $this->validation($request);
                return response()->json([
                    'administrations'     => $this->administrationRepository->registerAdministrationRegistrar($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
                ], 200);
        }
    }
    public function updateRegistrar(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validation($request);
            return response()->json([
                'administrations' => $this->administrationRepository->updateAdministrationRegistrar($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }
    public function activateRegistrar(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
            $this->validate($request, [
                'id'                 =>'required',
                'status'             =>'required',
                'institution_id'     =>'required',
            ]);
            return response()->json([
                'administrations' =>$this->administrationRepository->activateRegistrar($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }
    public function deleteRegistrar(Request $request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        if (auth('api')->user()){
                $this->validate($request, [
                    'id'                 =>'required',
                    'institution_id'     =>'required',
                ]);
            return response()->json([
                'administrations' => $this->administrationRepository->destroyRegistrar($request, $author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id),
            ], 200);
        }
    }


}


