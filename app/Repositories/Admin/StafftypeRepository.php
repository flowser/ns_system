<?php

namespace App\Repositories\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Stafftype;

class StafftypeRepository implements StafftypeRepositoryInterface
{

    public function getStafftypes($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {
        if($author === 'system' && $authrole === 'system'){
            return Stafftype::with($this->relation())
                           ->get();
        }else{
            return Stafftype::with($this->relation())
                           ->where('institution_id', $authinstitutionid)
                           ->get();
        }
    }

    public function updateOrCreateStafftype(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {
        $stafftype = Stafftype::updateOrCreate(
            [
                'name'             => $request->stafftype_id[0],
                'institution_id'   => $authinstitutionid,
            ],
            [
                'name'             => $request->stafftype_id[0],
                'institution_id'   => $authinstitutionid,
            ],
        );

        $stafftype->load($this->relation());
        return $stafftype;
    }

    public function destroyStafftype(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id){
        $stafftype = Stafftype::findOrFail($id);
        $stafftype->delete();
        $stafftype->load($this->relation());
        return $stafftype;
    }
    public function relation(){
        return [
            'institution',
        ];
    }
}







