<?php

namespace App\Http\Controllers\API\Location;

use Illuminate\Http\Request;
use App\Models\Location\Postalcode;
use App\Http\Controllers\Controller;

class PostalcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($author, $authid, $authinstitution, $authinstitutionid)
    {
        $postalcodes = Postalcode::all();
        return response()->json([
            'postalcodes' => $postalcodes,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location\Postalcode  $postalcode
     * @return \Illuminate\Http\Response
     */
    public function show($author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        $postalcode = Postalcode::find($id);
        return response()->json([
            'postalcode' => $postalcode,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location\Postalcode  $postalcode
     * @return \Illuminate\Http\Response
     */
    public function edit($author, $deptauthor, $authid, $authinstitution, $authinstitutionid, $authdepartmentid, $id)
    {
        $postalcode = Postalcode::find($id);
        return response()->json([
            'postalcode' => $postalcode,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location\Postalcode  $postalcode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postalcode $postalcode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location\Postalcode  $postalcode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postalcode $postalcode)
    {
        //
    }
}
