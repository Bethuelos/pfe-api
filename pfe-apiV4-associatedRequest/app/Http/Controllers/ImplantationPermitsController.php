<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImplantationPermitsController extends Controller
{
     // Implantation Permits registration
     public function register(Request $request, $no_request)
     {
         DB::table('implantationpermit')->insert([
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
            "is_operationalsector_g" => $request->input('is_operationalsector_g'),
            "is_restructuringarea_g" => $request->input('is_restructuringarea_g'),
            "is_renovationarea_g" => $request->input('is_renovationarea_g'),
            "is_subdivide_stateowned_g" => $request->input('is_subdivide_stateowned_g'),
            "is_subdivide_communal_g" => $request->input('is_subdivide_communal_g'),
            "is_subdivide_private_g" => $request->input('is_subdivide_private_g'),
            "is_jointdevelopmentzone_g" => $request->input('is_jointdevelopmentzone_g'),
            "more_infromation_g" => $request->input('more_infromation_g'),
            "is_servitudey_g" => $request->input('is_servitudey_g'),
            "is_justificatif_r" => $request->input('is_justificatif_r'),
            "is_attestation_r" => $request->input('is_attestation_r'),
            "is_planningcertificate_r" => $request->input('is_planningcertificate_r'),
            "is_descriptivequote_r" => $request->input('is_descriptivequote_r'),
            "is_situation_plan_r" => $request->input('is_situation_plan_r'),
            "is_buildingplan_r" => $request->input('is_buildingplan_r'),
            "is_new_building_p" => $request->input('is_new_building_p'),
            "is_developement_work_p" => $request->input('is_developement_work_p'),
            "is_living_operation_p" => $request->input('is_living_operation_p'),
            "more_information_p" => $request->input('more_information_p'),
            "is_industrial_p" => $request->input('is_industrial_p'),
            "is_agricultural_p" => $request->input('is_agricultural_p'),
            "is_public_p" => $request->input('is_public_p'),
            "is_living_use_p" => $request->input('is_living_use_p'),
            "is_commercial_p" => $request->input('is_commercial_p'),
            "is_office_p" => $request->input('is_office_p'),
            "more_informationg_p" => $request->input('more_informationg_p'),
            "area_out_use_p" => $request->input('area_out_use_p'),
            "construction_company_p" => $request->input('construction_company_p'),
            "is_personal_funding_f" => $request->input('is_personal_funding_f'),
            "is_loan_financing_f" => $request->input('is_loan_financing_f'),
            "lender_f" => $request->input('lender_f'),
            "more_information_f" => $request->input('more_information_f'),
            "last_name_f" => $request->input('last_name_f'),
            "fist_name_f" => $request->input('fist_name_f'),
            "postal_code_f" => $request->input('postal_code_f'),
            "email_f" => $request->input('email_f'),
            "phone_number_f" => $request->input('phone_number_f'),
            "onac_id_f" => $request->input('onac_id_f'),
            "onuc_id_f" => $request->input('onuc_id_f'),
            "request_no_request" => $no_request,
            "notification_s" => $request->input('notification_s'),
            "sessionviewed_s" => $request->input('sessionviewed_s'),
            "folderfollow_s" => $request->input('folderfollow_s'),
            "taxes_participations_s" => $request->input('taxes_participations_s'),
            "address_o" => $request->input('last_name_o'),
            "address_o" => $request->input('fist_name_o'),
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
     public function retrieve()
     {
        $this->user = Auth::user();
        $PI = DB::table('implantationpermit')
                ->join('request', 'implantationpermit.request_no_request', '=', 'request.no_request')->where('request.user_id_user', '=', $this->user->id_user)
                ->select('implantationpermit.*', 'request.*')
                ->get();

        if (sizeof($PI) > 0){
            return response()->json($PI);
        }
        return response()->json([
            'message' => 'doesn\'t exists'
        ]);

     }

     // Specific Implantation Permits info
     public function retrieveSpecific($id)
     {
        $this->user = Auth::user();
        $result = DB::table('implantationpermit')->where('id_implantationpermit', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $PI = DB::table('implantationpermit')
                ->join('request', 'implantationpermit.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('implantationpermit.*')
                ->first();
        if ($PI != Null){
            return response()->json($PI);
        }
        return response()->json([
            "message" => "no access"
        ]);

     }

     // Modify request
     public function modify(Request $request, $id)
     {
        $this->user = Auth::user();

         $result = DB::table('implantationpermit')->where('id_implantationpermit', $id)->first();
         if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $PI = DB::table('implantationpermit')
                ->join('request', 'implantationpermit.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('implantationpermit.*')
                ->first();
        if ($PI != Null){
            DB::table('implantationpermit')
               ->where('id_implantationpermit', $id)
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
                "is_operationalsector_g" => $request->input('is_operationalsector_g'),
                "is_restructuringarea_g" => $request->input('is_restructuringarea_g'),
                "is_renovationarea_g" => $request->input('is_renovationarea_g'),
                "is_subdivide_stateowned_g" => $request->input('is_subdivide_stateowned_g'),
                "is_subdivide_communal_g" => $request->input('is_subdivide_communal_g'),
                "is_subdivide_private_g" => $request->input('is_subdivide_private_g'),
                "is_jointdevelopmentzone_g" => $request->input('is_jointdevelopmentzone_g'),
                "more_infromation_g" => $request->input('more_infromation_g'),
                "is_servitudey_g" => $request->input('is_servitudey_g'),
                "is_justificatif_r" => $request->input('is_justificatif_r'),
                "is_attestation_r" => $request->input('is_attestation_r'),
                "is_planningcertificate_r" => $request->input('is_planningcertificate_r'),
                "is_descriptivequote_r" => $request->input('is_descriptivequote_r'),
                "is_situation_plan_r" => $request->input('is_situation_plan_r'),
                "is_buildingplan_r" => $request->input('is_buildingplan_r'),
                "is_new_building_p" => $request->input('is_new_building_p'),
                "is_developement_work_p" => $request->input('is_developement_work_p'),
                "is_living_operation_p" => $request->input('is_living_operation_p'),
                "more_information_p" => $request->input('more_information_p'),
                "is_industrial_p" => $request->input('is_industrial_p'),
                "is_agricultural_p" => $request->input('is_agricultural_p'),
                "is_public_p" => $request->input('is_public_p'),
                "is_living_use_p" => $request->input('is_living_use_p'),
                "is_commercial_p" => $request->input('is_commercial_p'),
                "is_office_p" => $request->input('is_office_p'),
                "more_informationg_p" => $request->input('more_informationg_p'),
                "area_out_use_p" => $request->input('area_out_use_p'),
                "construction_company_p" => $request->input('construction_company_p'),
                "is_personal_funding_f" => $request->input('is_personal_funding_f'),
                "is_loan_financing_f" => $request->input('is_loan_financing_f'),
                "lender_f" => $request->input('lender_f'),
                "more_information_f" => $request->input('more_information_f'),
                "last_name_f" => $request->input('last_name_f'),
                "fist_name_f" => $request->input('fist_name_f'),
                "postal_code_f" => $request->input('postal_code_f'),
                "email_f" => $request->input('email_f'),
                "phone_number_f" => $request->input('phone_number_f'),
                "onac_id_f" => $request->input('onac_id_f'),
                "onuc_id_f" => $request->input('onuc_id_f'),
                "notification_s" => $request->input('notification_s'),
                "sessionviewed_s" => $request->input('sessionviewed_s'),
                "folderfollow_s" => $request->input('folderfollow_s'),
                "taxes_participations_s" => $request->input('taxes_participations_s'),
                "address_o" => $request->input('last_name_o'),
                "address_o" => $request->input('fist_name_o'),
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

     // Delete Implantation Permits
     public function delete($id)
     {
        $this->user = Auth::user();

         $result = DB::table('implantationpermit')->where('id_implantationpermit', $id)->first();
         if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $PI = DB::table('implantationpermit')
                ->join('request', 'implantationpermit.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('implantationpermit.*')
                ->first();
        if ($PI != Null){
            DB::table('implantationpermit')->where('id_implantationpermit', $id)->delete();
            return response()->json([
                'message' => 'deletion success'
            ]);
        }
        return response()->json([
            "message" => "no access"
        ]);

     }
}
