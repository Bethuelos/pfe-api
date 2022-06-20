<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CertificatesOfConformityContoller extends Controller
{
    // Conformity Certificate registration
    public function register(Request $request, $no_request)
    {
        DB::table('certificateofconformity')->insert([
            "undersigned" => $request->input('undersigned'),
                "date_a" => $request->input('date_a'),
                "place_a" => $request->input('place_a'),
                "request_no_request_buildingpermit" => $request->input('request_no_request_buildingpermit'),
                "request_no_request" => $no_request,
                "notification_s" => $request->input('notification_s'),
                "sessionviewed_s" => $request->input('sessionviewed_s'),
                "folderfollow_s" => $request->input('folderfollow_s'),
                "taxes_participations_s" => $request->input('taxes_participations_s'),
                "cost_s" => $request->input('cost_s'),
                "object_s" => $request->input('object_s'),
                "commune_s" => $request->input('commune_s'),
                "object_more_s" => $request->input('object_more_s'),
        ]);

        return response()->json([
            'message' => 'registration successful'
        ]);

    }

    // Requests info
    public function retrieve()
    {
        $this->user = Auth::user();

        $CC = DB::table('certificateofconformity')
                ->join('request', 'certificateofconformity.request_no_request', '=', 'request.no_request')->where('request.user_id_user', '=', $this->user->id_user)
                ->select('certificateofconformity.*')
                ->get();

        if (sizeof($CC) > 0){
            return response()->json($CC);
        }
        return response()->json([
            'message' => 'doesn\'t exists'
        ]);
    }

    // Specific Conformity Certificate info
    public function retrieveSpecific($id)
    {
        $this->user = Auth::user();
        $result = DB::table('certificateofconformity')->where('id_certificateofconformity', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $CC = DB::table('certificateofconformity')
                ->join('request', 'certificateofconformity.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('certificateofconformity.*')
                ->first();
        if ($CC != Null){
            return response()->json($CC);
        }
        return response()->json([
            "message" => "no access"
        ]);
    }

    // Modify request
    public function modify(Request $request, $id)
    {
        $this->user = Auth::user();

        $result = DB::table('certificateofconformity')->where('id_certificateofconformity', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $CC = DB::table('certificateofconformity')
                ->join('request', 'certificateofconformity.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('certificateofconformity.*')
                ->first();
        if ($CC != Null){
            DB::table('certificateofconformity')
              ->where('id_certificateofconformity', $id)
              ->update([
                "undersigned" => $request->input('undersigned'),
                "date_a" => $request->input('date_a'),
                "place_a" => $request->input('place_a'),
                "request_no_request_buildingpermit" => $request->input('request_no_request_buildingpermit'),
                "notification_s" => $request->input('notification_s'),
                "sessionviewed_s" => $request->input('sessionviewed_s'),
                "folderfollow_s" => $request->input('folderfollow_s'),
                "taxes_participations_s" => $request->input('taxes_participations_s'),
                "cost_s" => $request->input('cost_s'),
                "object_s" => $request->input('object_s'),
                "commune_s" => $request->input('commune_s'),
                "object_more_s" => $request->input('object_more_s'),
              ]);

            return response()->json([
                'message' => 'modification success'
            ]);
        }
        return response()->json([
            "message" => "no access"
        ]);

    }

    // Delete Conformity Certificate
    public function delete($id)
    {
        $this->user = Auth::user();

        $result = DB::table('certificateofconformity')->where('id_certificateofconformity', $id)->first();
        if ($result == NULL){
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }

        $CC = DB::table('certificateofconformity')
                ->join('request', 'certificateofconformity.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                    ->where('request.no_request', '=', $result->request_no_request)
                ->select('certificateofconformity.*')
                ->first();
        if ($CC != Null){
            DB::table('certificateofconformity')->where('id_certificateofconformity', $id)->delete();
            return response()->json([
                'message' => 'deletion success'
            ]);
        }
        return response()->json([
            "message" => "no access"
        ]);

    }
}
