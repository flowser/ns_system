<?php

namespace App\Http\Controllers\API\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Models\Business\Businesssetting;

class BusinesssettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($authid, $authroleid)
    {
        if(auth()->guard('api')){
            $businesssettings = Businesssetting::get();
            return response()->json([
                'businesssettings' => $businesssettings,
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $authid, string $authroleid)
    {
        if(auth()->guard('api')){
            $this->validate($request, [
                'type'           =>'required',
                'value'          =>'required',
           ]);

            $businesssetting   = new Businesssetting();
            $businesssetting->type  = $request->type;
            $businesssetting->value = $request->value;
            $businesssetting->save();

            return response()->json([
                'businesssetting' => $businesssetting,
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $authid, string $authroleid, $id)
    {
        if(auth()->guard('api')){
            $this->validate($request, [
                'type'           =>'required',
                'value'          =>'required',
           ]);

            $businesssetting   = Businesssetting::find($id);
            $businesssetting->type  = $request->type;
            $businesssetting->value = $request->value;
            $businesssetting->save();

            return response()->json([
                'businesssetting' => $businesssetting,
            ], 200);
        }
    }
    public function bulkupdate(Request $request, string $authid, string $authroleid)
    {
        // dd($request);
        if(auth()->guard('api')){
            foreach ($request->types as $key => $formdata) {

                if($formdata['image'] === true){
                    $this->imageservice($request, $key, $formdata, $authid, $authroleid);
                }else{
                    $this->stringupdateservices($request, $key, $formdata, $authid, $authroleid);
                }
            }

            return $this->index($authid, $authroleid);
        }
    }

    public function stringupdateservices(Request $request, $key, $formdata, string $authid, string $authroleid){

            $businesssetting   = Businesssetting::where('type', $formdata['type'])->first();
            $businesssetting->type  = $formdata['type'];
            $businesssetting->value = $formdata['value'];
            $businesssetting->save();

            return $businesssetting;
    }
    public function imageservice(Request $request, $key, $formdata, string $authid, string $authroleid){

        $businesssetting   = Businesssetting::where('type', $formdata['type'])->first();
        if(!empty($formdata['value'])){
            if ($formdata['value'] != $businesssetting->value) {
                $Path = public_path() . "/assets/images/";
                $currentphoto = $Path . $businesssetting->value;
                if (file_exists($currentphoto)) {
                    @unlink($currentphoto);
                }
                $strpos = strpos($formdata['value'], ';');
                $sub = substr($formdata['value'], 0, $strpos);
                $ex = explode('/', $sub)[1];
                $name = $formdata['type'] .time() . "." . $ex;
                $img = Image::make($formdata['value']);
                $img->save($Path . '/' . $name);
            } else {
                $name = $businesssetting->value;
            }
            $businesssetting->value = $name;
        }
        $businesssetting->save();
        return $businesssetting;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
