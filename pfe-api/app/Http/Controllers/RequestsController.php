<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\PlanningCertificatesController;
use App\Http\Controllers\BuildingPermitsController;
use App\Http\Controllers\ImplantationPermitsController;
use App\Http\Controllers\DemolitionPermitsController;
use App\Http\Controllers\CertificatesOfConformityContoller;
use App\Http\Controllers\AutorizationtontoSubDivideController;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Storage;
use App\Models\RequestsModel;

class RequestsController extends Controller
{
    private $PlanningCertificate;
    private $BuildingPermit;
    private $ImplantationPermit;
    private $DemolitionPermit;
    private $CertificateOfConformity;
    private $Autorization;
    private $File;
    private $user;

    function __construct(){
        $this->PlanningCertificate = new PlanningCertificatesController;
        $this->BuildingPermit = new BuildingPermitsController;
        $this->ImplantationPermit = new ImplantationPermitsController;
        $this->DemolitionPermit = new DemolitionPermitsController;
        $this->CertificateOfConformity = new CertificatesOfConformityContoller;
        $this->Autorization = new AutorizationtontoSubDivideController;
        $this->File = new FilesController();

        $this->user = Auth::user();
    }

    public function insertRequest(Request $request, $no_request, $type)
    {
        if ($type == "CU")
        {
            DB::table('request')->insert([
                "no_request" => $no_request,
                "requestcol" => $request->input('requestcol'),
                "type_planningcertificate" => 1,
                "progress" => 1,
                "pending" => 0,
                "completed" => 0,
                "user_id_user" => $this->user->id_user,
            ]);
        }
        elseif ($type == "PC")
        {
            DB::table('request')->insert([
                "no_request" => $no_request,
                "requestcol" => $request->input('requestcol'),
                "type_buildingpermit" => 1,
                "progress" => 1,
                "pending" => 0,
                "completed" => 0,
                "user_id_user" => $this->user->id_user,
            ]);
        }
        elseif ($type == "PI")
        {
            DB::table('request')->insert([
                "no_request" => $no_request,
                "requestcol" => $request->input('requestcol'),
                "type_implantationpermit" => 1,
                "progress" => 1,
                "pending" => 0,
                "completed" => 0,
                "user_id_user" => $this->user->id_user,
            ]);
        }
        elseif ($type == "PD")
        {
            DB::table('request')->insert([
                "no_request" => $no_request,
                "requestcol" => $request->input('requestcol'),
                "type_demolitionpermit" => 1,
                "progress" => 1,
                "pending" => 0,
                "completed" => 0,
                "user_id_user" => $this->user->id_user,
            ]);
        }
        elseif ($type == "CC")
        {
            DB::table('request')->insert([
                "no_request" => $no_request,
                "requestcol" => $request->input('requestcol'),
                "type_certificateofconformity" => 1,
                "progress" => 1,
                "pending" => 0,
                "completed" => 0,
                "user_id_user" => $this->user->id_user,
            ]);
        }
        elseif ($type == "PL")
        {
            DB::table('request')->insert([
                "no_request" => $no_request,
                "requestcol" => $request->input('requestcol'),
                "type_autorizationtontosubdivide" => 1,
                "progress" => 1,
                "pending" => 0,
                "completed" => 0,
                "user_id_user" => $this->user->id_user,
            ]);
        }

        // return response(['message' => 'ok']);

        // $no_request = DB::table('request')->max('no_request');

        if ($request->file()){
            $this->File = new FilesController();
            $this->File->upload($request, $type, $no_request);
        }
        return response([
            "message" => "no file"
        ]);

    }

    // Request registration
    public function register(Request $request, $type)
    {
        $this->user = Auth::user();

        $random_number = rand(1000, 10000000);

        if ($type == "CU"){
            $no_request ="CU-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->PlanningCertificate->register($request, $no_request);
        }
        elseif ($type == "PC"){
            $no_request ="PC-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->BuildingPermit->register($request, $no_request);

        }
        elseif ($type == "PI"){
            $no_request ="PI-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->ImplantationPermit->register($request, $no_request);

        }
        elseif ($type == "PD"){
            $no_request ="PD-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->DemolitionPermit->register($request, $no_request);

        }
        elseif ($type == "CC"){
            $no_request ="CC-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->CertificateOfConformity->register($request, $no_request);

        }
        elseif ($type == "PL"){
            $no_request ="PL-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->Autorization->register($request, $no_request);

        }
        else{
            return response()->json([
                'message' => "type not present"
            ]);
        }

    }

    // Requests info
    public function retrieve($type, $id = "")
    {
        $this->user = Auth::user();

        if ($type == "Request"){

            if ($id != ""){
                $result = DB::table('request')->where('no_request', $id)->first();
                if ($result != Null){
                    if ($result->user_id_user != $this->user->id_user){
                        return response()->json([
                            "message" => "no access"
                        ]);
                    }
                    return response()->json([
                        'request' => $result,
                        // 'CU' => $this->PlanningCertificate->retrieve(),
                        // 'PC' => $this->BuildingPermit->retrieve(),
                        // 'PI' => $this->ImplantationPermit->retrieve(),
                        // 'PD' => $this->DemolitionPermit->retrieve(),
                        // 'CC' => $this->CertificateOfConformity->retrieve(),
                        // 'PL' => $this->Autorization->retrieve()
                    ]);
                }
                return response()->json([
                    'message' => 'doesn\'t exists'
                ]);
            }

            // $result = DB::table('request')->get();
            $result = DB::table('request')->where('user_id_user', $this->user->id_user)->get();

            if (sizeof($result) > 0){
                return response()->json([
                    'request' => $result,
                    // 'CU' => $this->PlanningCertificate->retrieve(),
                    // 'PC' => $this->BuildingPermit->retrieve(),
                    // 'PI' => $this->ImplantationPermit->retrieve(),
                    // 'PD' => $this->DemolitionPermit->retrieve(),
                    // 'CC' => $this->CertificateOfConformity->retrieve(),
                    // 'PL' => $this->Autorization->retrieve()
                ]);

            }
            return response()->json([
                'message' => 'doesn\'t exists'
            ]);
        }
        elseif ($type == "CU"){
            if ($id != ""){
                return $this->PlanningCertificate->retrieveSpecific($id);
            }
            return $this->PlanningCertificate->retrieve();
        }
        elseif ($type == "PC"){
            if ($id != ""){
                return $this->BuildingPermit->retrieveSpecific($id);
            }
            return $this->BuildingPermit->retrieve();
        }
        elseif ($type == "PI"){
            if ($id != ""){
                return $this->ImplantationPermit->retrieveSpecific($id);
            }
            return $this->ImplantationPermit->retrieve();
        }
        elseif ($type == "PD"){
            if ($id != ""){
                return $this->DemolitionPermit->retrieveSpecific($id);
            }
            return $this->DemolitionPermit->retrieve();
        }
        elseif ($type == "CC"){
            if ($id != ""){
                return $this->CertificateOfConformity->retrieveSpecific($id);
            }
            return $this->CertificateOfConformity->retrieve();
        }
        elseif ($type == "PL"){
            if ($id != ""){
                return $this->Autorization->retrieveSpecific($id);
            }
            return $this->Autorization->retrieve();
        }
        else{
            return response()->json([
                'message' => "type not present"
            ]);
        }

    }

    // Modify request
    public function modify(Request $request, $type, $id)
    {
        if ($type == "CU"){
            return $this->PlanningCertificate->modify($request, $id);
        }
        elseif ($type == "PC"){
            return $this->BuildingPermit->modify($request, $id);
        }
        elseif ($type == "PI"){
            return $this->ImplantationPermit->modify($request, $id);
        }
        elseif ($type == "PD"){
            return $this->DemolitionPermit->modify($request, $id);
        }
        elseif ($type == "CC"){
            return $this->CertificateOfConformity->modify($request, $id);
        }
        elseif ($type == "PL"){
            return $this->Autorization->modify($request, $id);
        }
        else{
            return response()->json([
                'message' => "type not present"
            ]);
        }

    }

    // Delete request
    public function delete($type, $id)
    {
        if ($type == "CU"){
            return $this->PlanningCertificate->delete( $id);
        }
        elseif ($type == "PC"){
            return $this->BuildingPermit->delete($id);
        }
        elseif ($type == "PI"){
            return $this->ImplantationPermit->delete($id);
        }
        elseif ($type == "PD"){
            return $this->DemolitionPermit->delete($id);
        }
        elseif ($type == "CC"){
            return $this->CertificateOfConformity->delete($id);
        }
        elseif ($type == "PL"){
            return $this->Autorization->delete($id);
        }
        else{
            return response()->json([
                'message' => "type not present"
            ]);
        }

    }

}
