<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DemolitionPermitsController extends Controller
{
    // Demolition Permits registration
    public function register(Request $request, $no_request)
    {
        DB::table('demolitionpermit')->insert([
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
            "surfaceoutfloors_g" => $request->input('surfaceoutfloors_g'),
            "surfaceoutdemolition_g" => $request->input('surfaceoutdemolition_g'),
            "totalbuilding_g" => $request->input('totalbuilding_g'),
            "is_diilapided_g" => $request->input('is_diilapided_g'),
            "is_abandoned_g" => $request->input('is_abandoned_g'),
            "is_living_g" => $request->input('is_living_g'),
            "more_information_g" => $request->input('more_information_g'),
            "is_newbuilding_g" => $request->input('is_newbuilding_g'),
            "is_relhousing_g" => $request->input('is_relhousing_g'),
            "is_ruined_g" => $request->input('is_ruined_g'),
            "is_abandonedg_g" => $request->input('is_abandonedg_g'),
            "more_informationg_g" => $request->input('more_informationg_g'),
            "forstability_g" => $request->input('forstability_g'),
            "forneighborhood_g" => $request->input('forneighborhood_g'),
            "is_justificatif_r" => $request->input('is_justificatif_r'),
            "is_situationplan_r" => $request->input('is_situationplan_r'),
            "is_groundplan_r" => $request->input('is_groundplan_r'),
            "is_executionplan_r" => $request->input('is_executionplan_r'),
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
            "level_g" => $request->input('level_g'),
            "height_g" => $request->input('height_g'),
            "object_more_s" => $request->input('object_more_s'),
            "surfaceoutfloors_unit_g" => $request->input('surfaceoutfloors_unit_g'),
            "surfaceoutdemolition_unit_g" => $request->input('surfaceoutdemolition_unit_g'),
        ]);

        return response()->json([
            'message' => 'registration successful'
        ]);

    }

    // Requests info
    public function retrieve()
    {
        $this->user = Auth::user();
        $PD = DB::table('demolitionpermit')
                ->join('request', 'demolitionpermit.request_no_request', '=', 'request.no_request')->where('request.user_id_user', '=', $this->user->id_user)
                ->select('demolitionpermit.*')
                ->get();

        if (sizeof($PD) > 0){
            return response()->json($PD);
        }
        return response()->json([
            'message' => 'doesn\'t exists'
        ]);
    }

    // Specific Demolition Permits info
    public function retrieveSpecific($id)
    {
        $this->user = Auth::user();
        $result = DB::table('demolitionpermit')->where('id_demolitionpermit', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $PD = DB::table('demolitionpermit')
                ->join('request', 'demolitionpermit.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('demolitionpermit.*')
                ->first();
        if ($PD != Null){
            return response()->json($PD);
        }
        return response()->json([
            "message" => "no access"
        ]);
    }

    // Modify request
    public function modify(Request $request, $id)
    {
        $this->user = Auth::user();

        $result = DB::table('demolitionpermit')->where('id_demolitionpermit', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $PD = DB::table('demolitionpermit')
                ->join('request', 'demolitionpermit.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('demolitionpermit.*')
                ->first();
        if ($PD != Null){
            DB::table('demolitionpermit')
              ->where('id_demolitionpermit', $id)
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
                "surfaceoutfloors_g" => $request->input('surfaceoutfloors_g'),
                "surfaceoutdemolition_g" => $request->input('surfaceoutdemolition_g'),
                "totalbuilding_g" => $request->input('totalbuilding_g'),
                "is_diilapided_g" => $request->input('is_diilapided_g'),
                "is_abandoned_g" => $request->input('is_abandoned_g'),
                "is_living_g" => $request->input('is_living_g'),
                "more_information_g" => $request->input('more_information_g'),
                "is_newbuilding_g" => $request->input('is_newbuilding_g'),
                "is_relhousing_g" => $request->input('is_relhousing_g'),
                "is_ruined_g" => $request->input('is_ruined_g'),
                "is_abandonedg_g" => $request->input('is_abandonedg_g'),
                "more_informationg_g" => $request->input('more_informationg_g'),
                "forstability_g" => $request->input('forstability_g'),
                "forneighborhood_g" => $request->input('forneighborhood_g'),
                "is_justificatif_r" => $request->input('is_justificatif_r'),
                "is_situationplan_r" => $request->input('is_situationplan_r'),
                "is_groundplan_r" => $request->input('is_groundplan_r'),
                "is_executionplan_r" => $request->input('is_executionplan_r'),
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
                "level_g" => $request->input('level_g'),
                "height_g" => $request->input('height_g'),
                "object_more_s" => $request->input('object_more_s'),
                "surfaceoutfloors_unit_g" => $request->input('surfaceoutfloors_unit_g'),
                "surfaceoutdemolition_unit_g" => $request->input('surfaceoutdemolition_unit_g'),
              ]);

            return response()->json([
                'message' => 'modification success'
            ]);
        }


    }

    // Delete Demolition Permits
    public function delete($id)
    {
        $this->user = Auth::user();

        $result = DB::table('demolitionpermit')->where('id_demolitionpermit', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $PD = DB::table('demolitionpermit')
                ->join('request', 'demolitionpermit.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('demolitionpermit.*')
                ->first();
        if ($PD != Null){
            DB::table('demolitionpermit')->where('id_demolitionpermit', $id)->delete();
            return response()->json([
                'message' => 'deletion success'
            ]);
        }
        return response()->json([
            "message" => "no access"
        ]);
    }
}
