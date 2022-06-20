<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanningCertificatesController extends Controller
{
    private $user;

    function __construct()
    {
        $this->user = Auth::user();
    }

    // Planning Certificates registration
    public function register(Request $request, $no_request)
    {
        DB::table('planningcertificate')->insert([
            "last_name" => $request->input('last_name'),
            "fist_name" => $request->input('fist_name'),
            "address" => $request->input('address'),
            "postal_code" => $request->input('postal_code'),
            "email" => $request->input('email'),
            "phone_number" => $request->input('phone_number'),
            "owner_name" => $request->input('owner_name'),
            "is_owner" => $request->input('is_owner'),
            "is_representative" => $request->input('is_representative'),
            "more_information" => $request->input('more_information'),
            "social_reason" => $request->input('social_reason'),
            "date_a" => $request->input('date_a'),
            "place_a" => $request->input('place_a'),
            "arrondissement_g" => $request->input('arrondissement_g'),
            "district_g" => $request->input('district_g'),
            "placesaid_g" => $request->input('placesaid_g'),
            "street_g" => $request->input('street_g'),
            "id_landtitle_g" => $request->input('id_landtitle_g'),
            "area_g" => $request->input('area_g'),
            "is_situation_plan_r" => $request->input('is_situation_plan_r'),
            "is_owner_procuration_r" => $request->input('is_owner_procuration_r'),
            "is_living_house_building_p" => $request->input('is_living_house_building_p'),
            "is_commercial_work_p" => $request->input('is_commercial_work_p'),
            "is_industrial_work_p" => $request->input('is_industrial_work_p'),
            "is_siubdivision_p" => $request->input('is_siubdivision_p'),
            "more_information_p" => $request->input('more_information_p'),
            "request_no_request" => $no_request,
            "notification_s" => $request->input('notification_s'),
            "sessionviewed_s" => $request->input('sessionviewed_s'),
            "folderfollow_s" => $request->input('folderfollow_s'),
            "taxes_participations_s" => $request->input('taxes_participations_s'),
            "is_PDU_s" => $request->input('is_PDU_s'),
            "is_POS_s" => $request->input('is_POS_s'),
            "is_PS_s" => $request->input('is_PS_s'),
            "is_PSU_s" => $request->input('is_PSU_s'),
            "is_RGU_s" => $request->input('is_RGU_s'),
            "landlocated_s" => $request->input('is_non_aedificandi_s'),
            "is_buildable_s" => $request->input('is_buildable_s'),
            "is_transferable_s" => $request->input('is_transferable_s'),
            "is_non_transferable_s" => $request->input('is_non_transferable_s'),
            "more_information_g_s" => $request->input('more_information_g_s'),
            "accessibility_ways_s" => $request->input('accessibility_ways_s'),
            "accessibiility_servitudes_s" => $request->input('accessibiility_servitudes_s'),
            "specifications_partof_s" => $request->input('specifications_partof_s'),
            "specifications_operations_s" => $request->input('specifications_operations_s'),
            "is_riskarea_s" => $request->input('is_riskarea_s'),
            "is_DPUground_s" => $request->input('is_DPUground_s'),
            "is_RAS_s" => $request->input('is_RAS_s'),
            "more_information_s" => $request->input('more_information_s'),
            "last_name_o" => $request->input('last_name_o'),
            "fist_name_o" => $request->input('fist_name_o'),
            "address_o" => $request->input('address_o'),
            "postal_code_o" => $request->input('postal_code_o'),
            "email_o" => $request->input('email_o'),
            "phone_number_o" => $request->input('phone_number_o'),
            "cost_s" => $request->input('cost_s'),
            "object_s" => $request->input('object_s'),
            "location_s" => $request->input('location_s'),
            "object_more_s" => $request->input('object_more_s'),
            "area_unit_g" => $request->input('area_unit_g'),
        ]);

        return response()->json([
            'message' => 'registration successful'
        ]);

    }

    // Requests info
    public function retrieve($no_request = "")
    {
        $this->user = Auth::user();
        // $result = DB::table('planningcertificate')->where('user_id_user', $this->user->id_user)->get();

        if ($no_request == ""){
            $CU = DB::table('planningcertificate')
                ->join('request', 'planningcertificate.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                ->select('planningcertificate.*')
                ->get();

            if (sizeof($CU) > 0){
                return response()->json($CU);
            }
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }
        else{

            $CU = DB::table('planningcertificate')
                ->join('request', 'planningcertificate.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('planningcertificate.request_no_request', '=', $no_request)
                ->select('planningcertificate.*')
                ->get();

            if (sizeof($CU) > 0){
                return response()->json($CU);
            }
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        

    }

    // Specific Planning Certificates info
    public function retrieveSpecific($id)
    {
        $this->user = Auth::user();

        $result = DB::table('planningcertificate')->where('id_planiningcertificate', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $CU = DB::table('planningcertificate')
                ->join('request', 'planningcertificate.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('planningcertificate.*')
                ->first();
        if ($CU != Null){
            return response()->json($CU);
        }
        return response()->json([
            "message" => "no access"
        ]);

    }

    // Modify request
    public function modify(Request $request, $id)
    {
        $this->user = Auth::user();

        $result = DB::table('planningcertificate')->where('id_planiningcertificate', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $CU = DB::table('planningcertificate')
                ->join('request', 'planningcertificate.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('planningcertificate.*')
                ->first();
        if ($CU != Null){
            DB::table('planningcertificate')
              ->where('id_planiningcertificate', $id)
              ->update([
                "last_name" => $request->input('last_name'),
                "fist_name" => $request->input('fist_name'),
                "address" => $request->input('address'),
                "postal_code" => $request->input('postal_code'),
                "email" => $request->input('email'),
                "phone_number" => $request->input('phone_number'),
                "owner_name" => $request->input('owner_name'),
                "is_owner" => $request->input('is_owner'),
                "is_representative" => $request->input('is_representative'),
                "more_information" => $request->input('more_information'),
                "social_reason" => $request->input('social_reason'),
                "date_a" => $request->input('date_a'),
                "place_a" => $request->input('place_a'),
                "arrondissement_g" => $request->input('arrondissement_g'),
                "district_g" => $request->input('district_g'),
                "placesaid_g" => $request->input('placesaid_g'),
                "street_g" => $request->input('street_g'),
                "id_landtitle_g" => $request->input('id_landtitle_g'),
                "area_g" => $request->input('area_g'),
                "is_situation_plan_r" => $request->input('is_situation_plan_r'),
                "is_owner_procuration_r" => $request->input('is_owner_procuration_r'),
                "is_living_house_building_p" => $request->input('is_living_house_building_p'),
                "is_commercial_work_p" => $request->input('is_commercial_work_p'),
                "is_industrial_work_p" => $request->input('is_industrial_work_p'),
                "is_siubdivision_p" => $request->input('is_siubdivision_p'),
                "more_information_p" => $request->input('more_information_p'),
                "notification_s" => $request->input('notification_s'),
                "sessionviewed_s" => $request->input('sessionviewed_s'),
                "folderfollow_s" => $request->input('folderfollow_s'),
                "taxes_participations_s" => $request->input('taxes_participations_s'),
                "is_PDU_s" => $request->input('is_PDU_s'),
                "is_POS_s" => $request->input('is_POS_s'),
                "is_PS_s" => $request->input('is_PS_s'),
                "is_PSU_s" => $request->input('is_PSU_s'),
                "is_RGU_s" => $request->input('is_RGU_s'),
                "landlocated_s" => $request->input('is_non_aedificandi_s'),
                "is_buildable_s" => $request->input('is_buildable_s'),
                "is_transferable_s" => $request->input('is_transferable_s'),
                "is_non_transferable_s" => $request->input('is_non_transferable_s'),
                "more_information_g_s" => $request->input('more_information_g_s'),
                "accessibility_ways_s" => $request->input('accessibility_ways_s'),
                "accessibiility_servitudes_s" => $request->input('accessibiility_servitudes_s'),
                "specifications_partof_s" => $request->input('specifications_partof_s'),
                "specifications_operations_s" => $request->input('specifications_operations_s'),
                "is_riskarea_s" => $request->input('is_riskarea_s'),
                "is_DPUground_s" => $request->input('is_DPUground_s'),
                "is_RAS_s" => $request->input('is_RAS_s'),
                "more_information_s" => $request->input('more_information_s'),
                "last_name_o" => $request->input('last_name_o'),
                "fist_name_o" => $request->input('fist_name_o'),
                "address_o" => $request->input('address_o'),
                "postal_code_o" => $request->input('postal_code_o'),
                "email_o" => $request->input('email_o'),
                "phone_number_o" => $request->input('phone_number_o'),
                "cost_s" => $request->input('cost_s'),
                "object_s" => $request->input('object_s'),
                "location_s" => $request->input('location_s'),
                "object_more_s" => $request->input('object_more_s'),
                "area_unit_g" => $request->input('area_unit_g'),
              ]);

            return response()->json([
                'message' => 'modification success'
            ]);
        }
        return response()->json([
            "message" => "no access"
        ]);


    }

    // Delete Planning Certificates
    public function delete($id)
    {
        $this->user = Auth::user();

        $result = DB::table('planningcertificate')->where('id_planiningcertificate', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $CU = DB::table('planningcertificate')
                ->join('request', 'planningcertificate.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('planningcertificate.*')
                ->first();
        if ($CU != Null){
            DB::table('planningcertificate')->where('id_planiningcertificate', $id)->delete();
            return response()->json([
                'message' => 'deletion success'
            ]);
        }
        return response()->json([
            "message" => "no access"
        ]);
    }
}
