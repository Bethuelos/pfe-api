<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AutorizationtontoSubDivideController extends Controller
{
    // Autorization registration
    public function register(Request $request, $no_request)
    {
        DB::table('autorizationtontosubdivide')->insert([
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
            "area_tosubdivide_g" => $request->input('area_tosubdivide_g'),
            "north_g" => $request->input('north_g'),
            "south_g" => $request->input('south_g'),
            "east_g" => $request->input('east_g'),
            "west_g" => $request->input('west_g'),
            "is_servitudey_g" => $request->input('is_servitudey_g'),
            "numberoflots_l" => $request->input('numberoflots_l'),
            "planned_eqipment_l" => $request->input('planned_eqipment_l'),
            "is_blocksboundary_l" => $request->input('is_blocksboundary_l'),
            "is_lotsboundary_l" => $request->input('is_lotsboundary_l'),
            "is_trackopening_l" => $request->input('is_trackopening_l'),
            "is_crossing_canalbuilding_l" => $request->input('is_crossing_canalbuilding_l'),
            "is_variouscanal_building_l" => $request->input('is_variouscanal_building_l'),
            "is_owner_procuration_r" => $request->input('is_owner_procuration_r'),
            "is_certificate_ownership_r" => $request->input('is_certificate_ownership_r'),
            "is_planningcertificate_r" => $request->input('is_planningcertificate_r'),
            "is_situation_plan_r" => $request->input('is_situation_plan_r'),
            "is_explanatory_report_r" => $request->input('is_explanatory_report_r'),
            "is_commitment_complete_r" => $request->input('is_commitment_complete_r'),
            "is_commitment_follow_r" => $request->input('is_commitment_follow_r'),
            "is_statusproject_r" => $request->input('is_statusproject_r'),
            "is_residential_subdivision_p" => $request->input('is_residential_subdivision_p'),
            "is_commercial_subdivision_p" => $request->input('is_commercial_subdivision_p'),
            "is_industrial_subdivision_p" => $request->input('is_industrial_subdivision_p'),
            "is_mixed_siubdivision_p" => $request->input('is_mixed_siubdivision_p'),
            "more_information_p" => $request->input('more_information_p'),
            "request_no_request" => $no_request,
            "notification_s" => $request->input('notification_s'),
            "sessionviewed_s" => $request->input('sessionviewed_s'),
            "folderfollow_s" => $request->input('folderfollow_s'),
            "taxes_participations_s" => $request->input('taxes_participations_s'),
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
            "area_tosubdivide_unit_g" => $request->input('area_tosubdivide_unit_g'),
        ]);

        return response()->json([
            'message' => 'registration successful'
        ]);

    }

    // Requests info
    public function retrieve()
    {
        $this->user = Auth::user();
        $PL = DB::table('autorizationtontosubdivide')
                ->join('request', 'autorizationtontosubdivide.request_no_request', '=', 'request.no_request')->where('request.user_id_user', '=', $this->user->id_user)
                ->select('autorizationtontosubdivide.*')
                ->get();

        if (sizeof($PL) > 0){
            return response()->json($PL);
        }
        return response()->json([
            'message' => 'doesn\'t exists'
        ]);
    }

    // Specific Autorization info
    public function retrieveSpecific($id)
    {
        $this->user = Auth::user();
        $result = DB::table('autorizationtontosubdivide')->where('id_autorizationtontosubdivide', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $PL = DB::table('autorizationtontosubdivide')
                ->join('request', 'autorizationtontosubdivide.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('autorizationtontosubdivide.*')
                ->first();
        if ($PL != Null){
            return response()->json($PL);
        }
        return response()->json([
            "message" => "no access"
        ]);
    }

    // Modify request
    public function modify(Request $request, $id)
    {
        $this->user = Auth::user();

        $result = DB::table('autorizationtontosubdivide')->where('id_autorizationtontosubdivide', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $PL = DB::table('autorizationtontosubdivide')
                ->join('request', 'autorizationtontosubdivide.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('autorizationtontosubdivide.*')
                ->first();
        if ($PL != Null){
            DB::table('autorizationtontosubdivide')
              ->where('id_autorizationtontosubdivide', $id)
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
                "area_tosubdivide_g" => $request->input('area_tosubdivide_g'),
                "north_g" => $request->input('north_g'),
                "south_g" => $request->input('south_g'),
                "east_g" => $request->input('east_g'),
                "west_g" => $request->input('west_g'),
                "is_servitudey_g" => $request->input('is_servitudey_g'),
                "numberoflots_l" => $request->input('numberoflots_l'),
                "planned_eqipment_l" => $request->input('planned_eqipment_l'),
                "is_blocksboundary_l" => $request->input('is_blocksboundary_l'),
                "is_lotsboundary_l" => $request->input('is_lotsboundary_l'),
                "is_trackopening_l" => $request->input('is_trackopening_l'),
                "is_crossing_canalbuilding_l" => $request->input('is_crossing_canalbuilding_l'),
                "is_variouscanal_building_l" => $request->input('is_variouscanal_building_l'),
                "is_owner_procuration_r" => $request->input('is_owner_procuration_r'),
                "is_certificate_ownership_r" => $request->input('is_certificate_ownership_r'),
                "is_planningcertificate_r" => $request->input('is_planningcertificate_r'),
                "is_situation_plan_r" => $request->input('is_situation_plan_r'),
                "is_explanatory_report_r" => $request->input('is_explanatory_report_r'),
                "is_commitment_complete_r" => $request->input('is_commitment_complete_r'),
                "is_commitment_follow_r" => $request->input('is_commitment_follow_r'),
                "is_statusproject_r" => $request->input('is_statusproject_r'),
                "is_residential_subdivision_p" => $request->input('is_residential_subdivision_p'),
                "is_commercial_subdivision_p" => $request->input('is_commercial_subdivision_p'),
                "is_industrial_subdivision_p" => $request->input('is_industrial_subdivision_p'),
                "is_mixed_siubdivision_p" => $request->input('is_mixed_siubdivision_p'),
                "more_information_p" => $request->input('more_information_p'),
                "notification_s" => $request->input('notification_s'),
                "sessionviewed_s" => $request->input('sessionviewed_s'),
                "folderfollow_s" => $request->input('folderfollow_s'),
                "taxes_participations_s" => $request->input('taxes_participations_s'),
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
                "area_tosubdivide_unit_g" => $request->input('area_tosubdivide_unit_g'),
              ]);

            return response()->json([
                'message' => 'modification success'
            ]);
        }
        return response()->json([
            "message" => "no access"
        ]);
    }

    // Delete Autorization
    public function delete($id)
    {
        $this->user = Auth::user();

        $result = DB::table('autorizationtontosubdivide')->where('id_autorizationtontosubdivide', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $PL = DB::table('autorizationtontosubdivide')
                ->join('request', 'autorizationtontosubdivide.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('autorizationtontosubdivide.*')
                ->first();
        if ($PL != Null){
            DB::table('autorizationtontosubdivide')->where('id_autorizationtontosubdivide', $id)->delete();
            return response()->json([
                'message' => 'deletion success'
            ]);
        }
        return response()->json([
            "message" => "no access"
        ]);
    }
}
