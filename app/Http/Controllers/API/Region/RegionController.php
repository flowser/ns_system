<?php

namespace App\Http\Controllers\API\Region;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Region\RegionRepositoryInterface;

class RegionController extends Controller
{

    protected $regionRepository;

    public function __construct(RegionRepositoryInterface $regionRepository) {
        $this->regionRepository      = $regionRepository;

    }
    public function index($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
    {

        if (auth('api')->user()){
            return response()->json([
                'regions' => $this->regionRepository->getRegions($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid)
            ], 200);
        }
    }
    public function getregion($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        // dd($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id);
        if (auth('api')->user()){
            return response()->json([
                'region' => $this->regionRepository->getRegion($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
            ], 200);
        }
    }
    public function getregiondata($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        // dd($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id);
        if (auth('api')->user()){
            return response()->json([
                'region' => $this->regionRepository->getRegionData($author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
            ], 200);
        }
    }
    //location
    public function createcounty(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->createCounty($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function updatecounty(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->updateCounty($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function deletecounty(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->deleteCounty($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }

    // consituency
    public function createconstituency(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->createConstituency($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function updateconstituency(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->updateConstituency($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function deleteconstituency(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->deleteConstituency($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    // ward
    public function createward(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->createWard($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function updateward(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->updateWard($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function deleteward(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->deleteWard($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }

    // staff
    public function createregionstaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->createRegionStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function updateregionstaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->updateRegionStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function deleteregionstaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->deleteRegionStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    // regioncountystaff
    public function createregioncountystaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->createRegionCountyStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function updateregioncountystaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->updateRegionCountyStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function deleteregioncountystaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->deleteRegionCountyStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    // regionconstituencystaff
    public function createregionconstituencystaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->createRegionConstituencyStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function updateregionconstituencystaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->updateRegionConstituencyStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function deleteregionconstituencystaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->deleteRegionConstituencyStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    // regionwardstaff
    public function createregionwardstaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->createRegionWardStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function updateregionwardstaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->updateRegionWardStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function deleteregionwardstaff(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id)
    {
        if (auth('api')->user()){
            return response()->json([
                'region'     => $this->regionRepository->deleteRegionWardStaff($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
}
