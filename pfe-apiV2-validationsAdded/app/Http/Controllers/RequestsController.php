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
use Illuminate\Support\Facades\Validator;

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
        // if ($request->file()){
        //     $validator = Validator::make($request->all(), [
        //         "requestcol" => 'max:45',
        //         "title" => 'required|max:255',
        //     ]);

        //     if ($validator->fails()){
        //         return response()->json([
        //             $validator->errors()
        //         ]);
        //     }
        // }
        // else{
        //     $validator = Validator::make($request->all(), [
        //         "requestcol" => 'max:45'
        //     ]);

        //     if ($validator->fails()){
        //         return response()->json([
        //             $validator->errors()
        //         ]);
        //     }
        // }

        $this->user = Auth::user();

        $random_number = rand(1000, 10000000);

        if ($type == "CU"){

            if ($request->file()){
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "title" => 'required|max:255',
                    "last_name" => 'max:45',
                    "fist_name" => 'max:45',
                    "address" => 'max:20',
                    "postal_code" => 'max:20',
                    "email" => 'max:30',
                    "phone_number" => 'max:30',
                    "owner_name" => 'max:45',
                    "is_owner" => 'integer|max:4',
                    "is_representative" => 'integer|max:4',
                    "more_information" => 'max:45',
                    "social_reason" => 'max:45',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "arrondissement_g" => 'max:45',
                    "district_g" => 'max:45',
                    "placesaid_g" => 'max:45',
                    "street_g" => 'max:45',
                    "id_landtitle_g" => 'max:45',
                    "area_g" => 'numeric',
                    "is_situation_plan_r" => 'integer|max:4',
                    "is_owner_procuration_r" => 'integer|max:4',
                    "is_living_house_building_p" => 'integer|max:4',
                    "is_commercial_work_p" => 'integer|max:4',
                    "is_industrial_work_p" => 'integer|max:4',
                    "is_siubdivision_p" => 'integer|max:4',
                    "more_information_p" => 'max:45',
                    "request_no_request" =>'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "is_PDU_s" => 'integer|max:4',
                    "is_POS_s" => 'integer|max:4',
                    "is_PS_s" => 'integer|max:4',
                    "is_PSU_s" => 'integer|max:4',
                    "is_RGU_s" => 'integer|max:4',
                    "landlocated_s" => 'max:45',
                    "is_non_aedificandi_s" => 'integer|max:4',
                    "is_buildable_s" => 'integer|max:4',
                    "is_transferable_s" => 'integer|max:4',
                    "is_non_transferable_s" => 'integer|max:4',
                    "more_information_g_s" => 'max:45',
                    "accessibility_ways_s" =>'max:1000',
                    "accessibiility_servitudes_s" => 'max:1000',
                    "specifications_partof_s" => 'max:255',
                    "specifications_operations_s" => 'max:45',
                    "is_riskarea_s" => 'integer|max:4',
                    "is_DPUground_s" => 'integer|max:4',
                    "is_RAS_s" => 'integer|max:4',
                    "more_information_s" => 'max:45',
                    "last_name_o" => 'max:45',
                    "fist_name_o" => 'max:45',
                    "address_o" => 'max:20',
                    "postal_code_o" => 'max:20',
                    "email_o" => 'max:30',
                    "phone_number_o" => 'max:30',
                    "cost_s" => 'numeric',
                    "object_s" => 'max:255',
                    "location_s" => 'max:1000',
                    "object_more_s" => 'max:255',
                    "area_unit_g" => 'max:15',
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }
            else{
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "last_name" => 'max:45',
                    "fist_name" => 'max:45',
                    "address" => 'max:20',
                    "postal_code" => 'max:20',
                    "email" => 'max:30',
                    "phone_number" => 'max:30',
                    "owner_name" => 'max:45',
                    "is_owner" => 'integer|max:4',
                    "is_representative" => 'integer|max:4',
                    "more_information" => 'max:45',
                    "social_reason" => 'max:45',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "arrondissement_g" => 'max:45',
                    "district_g" => 'max:45',
                    "placesaid_g" => 'max:45',
                    "street_g" => 'max:45',
                    "id_landtitle_g" => 'max:45',
                    "area_g" => 'numeric',
                    "is_situation_plan_r" => 'integer|max:4',
                    "is_owner_procuration_r" => 'integer|max:4',
                    "is_living_house_building_p" => 'integer|max:4',
                    "is_commercial_work_p" => 'integer|max:4',
                    "is_industrial_work_p" => 'integer|max:4',
                    "is_siubdivision_p" => 'integer|max:4',
                    "more_information_p" => 'max:45',
                    "request_no_request" =>'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "is_PDU_s" => 'integer|max:4',
                    "is_POS_s" => 'integer|max:4',
                    "is_PS_s" => 'integer|max:4',
                    "is_PSU_s" => 'integer|max:4',
                    "is_RGU_s" => 'integer|max:4',
                    "landlocated_s" => 'max:45',
                    "is_non_aedificandi_s" => 'integer|max:4',
                    "is_buildable_s" => 'integer|max:4',
                    "is_transferable_s" => 'integer|max:4',
                    "is_non_transferable_s" => 'integer|max:4',
                    "more_information_g_s" => 'max:45',
                    "accessibility_ways_s" =>'max:1000',
                    "accessibiility_servitudes_s" => 'max:1000',
                    "specifications_partof_s" => 'max:255',
                    "specifications_operations_s" => 'max:45',
                    "is_riskarea_s" => 'integer|max:4',
                    "is_DPUground_s" => 'integer|max:4',
                    "is_RAS_s" => 'integer|max:4',
                    "more_information_s" => 'max:45',
                    "last_name_o" => 'max:45',
                    "fist_name_o" => 'max:45',
                    "address_o" => 'max:20',
                    "postal_code_o" => 'max:20',
                    "email_o" => 'max:30',
                    "phone_number_o" => 'max:30',
                    "cost_s" => 'numeric',
                    "object_s" => 'max:255',
                    "location_s" => 'max:1000',
                    "object_more_s" => 'max:255',
                    "area_unit_g" => 'max:15',
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }

            $no_request ="CU-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->PlanningCertificate->register($request, $no_request);
        }
        elseif ($type == "PC"){

            if ($request->file()){
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "title" => 'required|max:255',
                    "requestcol" => 'max:45',
                    "last_name" => 'max:45',
                    "fist_name" => 'max:45',
                    "address" => 'max:20',
                    "postal_code" => 'max:20',
                    "email" => 'max:30',
                    "phone_number" => 'max:30',
                    "owner_name" => 'max:45',
                    "is_owner" => 'integer|max:4',
                    "is_representative" => 'integer|max:4',
                    "more_information" => 'max:45',
                    "social_reason" => 'max:45',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "arrondissement_g" => 'max:45',
                    "district_g" => 'max:45',
                    "placesaid_g" => 'max:45',
                    "street_g" => 'max:45',
                    "id_landtitle_g" => 'max:45',
                    "area_g" => 'numeric',
                    "is_operationalsector_g" => 'integer|max:4',
                    "is_restructuringarea_g" => 'integer|max:4',
                    "is_subdivide_stateowned_g" => 'integer|max:4',
                    "is_subdivide_communal_g" => 'integer|max:4',
                    "is_subdivide_communal_g" => 'integer|max:4',
                    "is_subdivide_private_g" => 'integer|max:4',
                    "is_jointdevelopmentzone_g" => 'integer|max:4',
                    "more_infromation_g" => 'max:45',
                    "is_servitudey_g" => 'integer|max:4',
                    "is_planningcertificate_r" => 'integer|max:4',
                    "is_certificate_owernership_r" => 'integer|max:4',
                    "is_descriptivequote_r" => 'integer|max:4',
                    "is_groundplan_r" => 'integer|max:4',
                    "is_sitesituationplan_r" => 'integer|max:4',
                    "is_executionplan_r" => 'integer|max:4',
                    "is_new_building_p" => 'integer|max:4',
                    "is_developement_work_p" => 'integer|max:4',
                    "is_living_operation_p" => 'integer|max:4',
                    "more_information_p" => 'max:45',
                    "is_industrial_p" => 'integer|max:4',
                    "is_agricultural_p" => 'integer|max:4',
                    "is_public_p" => 'integer|max:4',
                    "is_living_use_p" => 'integer|max:4',
                    "is_commercial_p" => 'integer|max:4',
                    "is_office_p" => 'integer|max:4',
                    "more_informationg_p" => 'max:45',
                    "area_out_use_p" => 'numeric',
                    "construction_company_p" => 'integer|max:4',
                    "is_personal_funding_f" => 'integer|max:4',
                    "is_loan_financing_f" => 'integer|max:4',
                    "lender_f" => 'max:45',
                    "more_information_f" =>'max:45',
                    "last_name_f" => 'max:45',
                    "fist_name_f" => 'max:45',
                    "postal_code_f" => 'max:20',
                    "email_f" => 'max:30',
                    "phone_number_f" => 'max:30',
                    "onac_id_f" => 'max:45',
                    "onuc_id_f" => 'max:45',
                    "request_no_request" => 'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "last_name_o" => 'max:45',
                    "fist_name_o" => 'max:45',
                    "address_o" => 'max:45',
                    "postal_code_o" => 'max:45',
                    "email_o" => 'max:45',
                    "phone_number_o" => 'max:45',
                    "cost_s" => 'numeric',
                    "object_s" => 'max:45',
                    "location_s" => 'max:1000',
                    "object_more_s" => 'max:45',
                    "area_unit_g" => 'max:45'
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }
            else{
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "last_name" => 'max:45',
                    "fist_name" => 'max:45',
                    "address" => 'max:20',
                    "postal_code" => 'max:20',
                    "email" => 'max:30',
                    "phone_number" => 'max:30',
                    "owner_name" => 'max:45',
                    "is_owner" => 'integer|max:4',
                    "is_representative" => 'integer|max:4',
                    "more_information" => 'max:45',
                    "social_reason" => 'max:45',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "arrondissement_g" => 'max:45',
                    "district_g" => 'max:45',
                    "placesaid_g" => 'max:45',
                    "street_g" => 'max:45',
                    "id_landtitle_g" => 'max:45',
                    "area_g" => 'numeric',
                    "is_operationalsector_g" => 'integer|max:4',
                    "is_restructuringarea_g" => 'integer|max:4',
                    "is_subdivide_stateowned_g" => 'integer|max:4',
                    "is_subdivide_communal_g" => 'integer|max:4',
                    "is_subdivide_communal_g" => 'integer|max:4',
                    "is_subdivide_private_g" => 'integer|max:4',
                    "is_jointdevelopmentzone_g" => 'integer|max:4',
                    "more_infromation_g" => 'max:45',
                    "is_servitudey_g" => 'integer|max:4',
                    "is_planningcertificate_r" => 'integer|max:4',
                    "is_certificate_owernership_r" => 'integer|max:4',
                    "is_descriptivequote_r" => 'integer|max:4',
                    "is_groundplan_r" => 'integer|max:4',
                    "is_sitesituationplan_r" => 'integer|max:4',
                    "is_executionplan_r" => 'integer|max:4',
                    "is_new_building_p" => 'integer|max:4',
                    "is_developement_work_p" => 'integer|max:4',
                    "is_living_operation_p" => 'integer|max:4',
                    "more_information_p" => 'max:45',
                    "is_industrial_p" => 'integer|max:4',
                    "is_agricultural_p" => 'integer|max:4',
                    "is_public_p" => 'integer|max:4',
                    "is_living_use_p" => 'integer|max:4',
                    "is_commercial_p" => 'integer|max:4',
                    "is_office_p" => 'integer|max:4',
                    "more_informationg_p" => 'max:45',
                    "area_out_use_p" => 'numeric',
                    "construction_company_p" => 'integer|max:4',
                    "is_personal_funding_f" => 'integer|max:4',
                    "is_loan_financing_f" => 'integer|max:4',
                    "lender_f" => 'max:45',
                    "more_information_f" =>'max:45',
                    "last_name_f" => 'max:45',
                    "fist_name_f" => 'max:45',
                    "postal_code_f" => 'max:20',
                    "email_f" => 'max:30',
                    "phone_number_f" => 'max:30',
                    "onac_id_f" => 'max:45',
                    "onuc_id_f" => 'max:45',
                    "request_no_request" => 'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "last_name_o" => 'max:45',
                    "fist_name_o" => 'max:45',
                    "address_o" => 'max:45',
                    "postal_code_o" => 'max:45',
                    "email_o" => 'max:45',
                    "phone_number_o" => 'max:45',
                    "cost_s" => 'numeric',
                    "object_s" => 'max:45',
                    "location_s" => 'max:1000',
                    "object_more_s" => 'max:45',
                    "area_unit_g" => 'max:45'
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }

            $no_request ="PC-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->BuildingPermit->register($request, $no_request);

        }
        elseif ($type == "PI"){

            if ($request->file()){
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "title" => 'required|max:255',
                    "last_name" => 'max:45',
                    "fist_name" => 'max:45',
                    "address" => 'max:20',
                    "postal_code" => 'max:20',
                    "email" => 'max:30',
                    "phone_number" => 'max:30',
                    "owner_name" => 'max:45',
                    "is_owner" => 'integer|max:4',
                    "is_representative" => 'integer|max:4',
                    "more_information" => 'max:45',
                    "social_reason" => 'max:45',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "arrondissement_g" => 'max:45',
                    "district_g" => 'max:45',
                    "placesaid_g" => 'max:45',
                    "street_g" => 'max:45',
                    "id_landtitle_g" => 'max:45',
                    "area_g" => 'numeric',
                    "is_operationalsector_g" => 'integer|max:4',
                    "is_restructuringarea_g" => 'integer|max:4',
                    "is_renovationarea_g" => 'integer|max:4',
                    "is_subdivide_stateowned_g" => 'integer|max:4',
                    "is_subdivide_communal_g" => 'integer|max:4',
                    "is_subdivide_private_g" => 'integer|max:4',
                    "is_jointdevelopmentzone_g" =>'integer|max:4',
                    "more_infromation_g" => 'max:45',
                    "is_servitudey_g" => 'integer|max:4',
                    "is_justificatif_r" => 'integer|max:4',
                    "is_attestation_r" => 'integer|max:4',
                    "is_planningcertificate_r" => 'integer|max:4',
                    "is_descriptivequote_r" => 'integer|max:4',
                    "is_situation_plan_r" => 'integer|max:4',
                    "is_buildingplan_r" => 'integer|max:4',
                    "is_new_building_p" => 'integer|max:4',
                    "is_developement_work_p" => 'integer|max:4',
                    "is_living_operation_p" => 'integer|max:4',
                    "more_information_p" => 'max:45',
                    "is_industrial_p" => 'integer|max:4',
                    "is_agricultural_p" => 'integer|max:4',
                    "is_public_p" => 'integer|max:4',
                    "is_living_use_p" => 'integer|max:4',
                    "is_commercial_p" => 'integer|max:4',
                    "is_office_p" => 'integer|max:4',
                    "more_informationg_p" => 'max:45',
                    "area_out_use_p" => 'numeric',
                    "construction_company_p" => 'integer|max:4',
                    "is_personal_funding_f" => 'integer|max:4',
                    "is_loan_financing_f" => 'integer|max:4',
                    "lender_f" => 'max:45',
                    "more_information_f" => 'max:45',
                    "last_name_f" => 'max:45',
                    "fist_name_f" => 'max:45',
                    "postal_code_f" => 'max:20',
                    "email_f" => 'max:30',
                    "phone_number_f" => 'max:30',
                    "onac_id_f" => 'max:45',
                    "onuc_id_f" => 'max:45',
                    "request_no_request" => 'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "address_o" => 'max:45',
                    "address_o" => 'max:45',
                    "address_o" => 'max:20',
                    "postal_code_o" => 'max:20',
                    "email_o" => 'max:30',
                    "phone_number_o" => 'max:30',
                    "cost_s" => 'numeric',
                    "object_s" => 'max:255',
                    "location_s" => 'max:1000',
                    "object_more_s" => 'max:255',
                    "area_unit_g" => 'max:15',
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }
            else{
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "last_name" => 'max:45',
                    "fist_name" => 'max:45',
                    "address" => 'max:20',
                    "postal_code" => 'max:20',
                    "email" => 'max:30',
                    "phone_number" => 'max:30',
                    "owner_name" => 'max:45',
                    "is_owner" => 'integer|max:4',
                    "is_representative" => 'integer|max:4',
                    "more_information" => 'max:45',
                    "social_reason" => 'max:45',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "arrondissement_g" => 'max:45',
                    "district_g" => 'max:45',
                    "placesaid_g" => 'max:45',
                    "street_g" => 'max:45',
                    "id_landtitle_g" => 'max:45',
                    "area_g" => 'numeric',
                    "is_operationalsector_g" => 'integer|max:4',
                    "is_restructuringarea_g" => 'integer|max:4',
                    "is_renovationarea_g" => 'integer|max:4',
                    "is_subdivide_stateowned_g" => 'integer|max:4',
                    "is_subdivide_communal_g" => 'integer|max:4',
                    "is_subdivide_private_g" => 'integer|max:4',
                    "is_jointdevelopmentzone_g" =>'integer|max:4',
                    "more_infromation_g" => 'max:45',
                    "is_servitudey_g" => 'integer|max:4',
                    "is_justificatif_r" => 'integer|max:4',
                    "is_attestation_r" => 'integer|max:4',
                    "is_planningcertificate_r" => 'integer|max:4',
                    "is_descriptivequote_r" => 'integer|max:4',
                    "is_situation_plan_r" => 'integer|max:4',
                    "is_buildingplan_r" => 'integer|max:4',
                    "is_new_building_p" => 'integer|max:4',
                    "is_developement_work_p" => 'integer|max:4',
                    "is_living_operation_p" => 'integer|max:4',
                    "more_information_p" => 'max:45',
                    "is_industrial_p" => 'integer|max:4',
                    "is_agricultural_p" => 'integer|max:4',
                    "is_public_p" => 'integer|max:4',
                    "is_living_use_p" => 'integer|max:4',
                    "is_commercial_p" => 'integer|max:4',
                    "is_office_p" => 'integer|max:4',
                    "more_informationg_p" => 'max:45',
                    "area_out_use_p" => 'numeric',
                    "construction_company_p" => 'integer|max:4',
                    "is_personal_funding_f" => 'integer|max:4',
                    "is_loan_financing_f" => 'integer|max:4',
                    "lender_f" => 'max:45',
                    "more_information_f" => 'max:45',
                    "last_name_f" => 'max:45',
                    "fist_name_f" => 'max:45',
                    "postal_code_f" => 'max:20',
                    "email_f" => 'max:30',
                    "phone_number_f" => 'max:30',
                    "onac_id_f" => 'max:45',
                    "onuc_id_f" => 'max:45',
                    "request_no_request" => 'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "address_o" => 'max:45',
                    "address_o" => 'max:45',
                    "address_o" => 'max:20',
                    "postal_code_o" => 'max:20',
                    "email_o" => 'max:30',
                    "phone_number_o" => 'max:30',
                    "cost_s" => 'numeric',
                    "object_s" => 'max:255',
                    "location_s" => 'max:1000',
                    "object_more_s" => 'max:255',
                    "area_unit_g" => 'max:15',
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }

            $no_request ="PI-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->ImplantationPermit->register($request, $no_request);

        }
        elseif ($type == "PD"){

            if ($request->file()){
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "title" => 'required|max:255',
                    "last_name" => 'max:45',
                    "fist_name" => 'max:45',
                    "address" => 'max:20',
                    "postal_code" => 'max:20',
                    "email" => 'max:30',
                    "phone_number" => 'max:30',
                    "owner_name" => 'max:45',
                    "is_owner" => 'integer|max:4',
                    "is_representative" => 'integer|max:4',
                    "more_information" => 'max:45',
                    "social_reason" => 'max:45',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "arrondissement_g" => 'max:45',
                    "district_g" => 'max:45',
                    "placesaid_g" => 'max:45',
                    "street_g" => 'max:45',
                    "id_landtitle_g" => 'max:45',
                    "area_g" => 'numeric',
                    "surfaceoutfloors_g" => 'numeric',
                    "surfaceoutdemolition_g" => 'numeric',
                    "totalbuilding_g" => 'max:100',
                    "is_diilapided_g" => 'integer|max:4',
                    "is_abandoned_g" =>'integer|max:4',
                    "is_living_g" => 'integer|max:4',
                    "more_information_g" => 'max:200',
                    "is_newbuilding_g" => 'integer|max:4',
                    "is_relhousing_g" => 'integer|max:4',
                    "is_ruined_g" => 'integer|max:4',
                    "is_abandonedg_g" => 'integer|max:4',
                    "more_informationg_g" => 'max:200',
                    "forstability_g" => 'max:255',
                    "forneighborhood_g" => 'max:255',
                    "is_justificatif_r" => 'integer|max:4',
                    "is_situationplan_r" => 'integer|max:4',
                    "is_groundplan_r" =>'integer|max:4',
                    "is_executionplan_r" => 'integer|max:4',
                    "request_no_request" => 'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "last_name_o" =>'max:45',
                    "fist_name_o" => 'max:45',
                    "address_o" => 'max:20',
                    "postal_code_o" => 'max:20',
                    "email_o" => 'max:30',
                    "phone_number_o" => 'max:30',
                    "cost_s" => 'numric',
                    "object_s" => 'max:255',
                    "location_s" => 'max:1000',
                    "level_g" => 'max:255',
                    "height_g" => 'max:255',
                    "object_more_s" => 'max:2555',
                    "surfaceoutfloors_unit_g" => 'max:15',
                    "surfaceoutdemolition_unit_g" => 'max:15'
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }
            else{
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "last_name" => 'max:45',
                    "fist_name" => 'max:45',
                    "address" => 'max:20',
                    "postal_code" => 'max:20',
                    "email" => 'max:30',
                    "phone_number" => 'max:30',
                    "owner_name" => 'max:45',
                    "is_owner" => 'integer|max:4',
                    "is_representative" => 'integer|max:4',
                    "more_information" => 'max:45',
                    "social_reason" => 'max:45',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "arrondissement_g" => 'max:45',
                    "district_g" => 'max:45',
                    "placesaid_g" => 'max:45',
                    "street_g" => 'max:45',
                    "id_landtitle_g" => 'max:45',
                    "area_g" => 'numeric',
                    "surfaceoutfloors_g" => 'numeric',
                    "surfaceoutdemolition_g" => 'numeric',
                    "totalbuilding_g" => 'max:100',
                    "is_diilapided_g" => 'integer|max:4',
                    "is_abandoned_g" =>'integer|max:4',
                    "is_living_g" => 'integer|max:4',
                    "more_information_g" => 'max:200',
                    "is_newbuilding_g" => 'integer|max:4',
                    "is_relhousing_g" => 'integer|max:4',
                    "is_ruined_g" => 'integer|max:4',
                    "is_abandonedg_g" => 'integer|max:4',
                    "more_informationg_g" => 'max:200',
                    "forstability_g" => 'max:255',
                    "forneighborhood_g" => 'max:255',
                    "is_justificatif_r" => 'integer|max:4',
                    "is_situationplan_r" => 'integer|max:4',
                    "is_groundplan_r" =>'integer|max:4',
                    "is_executionplan_r" => 'integer|max:4',
                    "request_no_request" => 'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "last_name_o" =>'max:45',
                    "fist_name_o" => 'max:45',
                    "address_o" => 'max:20',
                    "postal_code_o" => 'max:20',
                    "email_o" => 'max:30',
                    "phone_number_o" => 'max:30',
                    "cost_s" => 'numric',
                    "object_s" => 'max:255',
                    "location_s" => 'max:1000',
                    "level_g" => 'max:255',
                    "height_g" => 'max:255',
                    "object_more_s" => 'max:2555',
                    "surfaceoutfloors_unit_g" => 'max:15',
                    "surfaceoutdemolition_unit_g" => 'max:15'
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }

            $no_request ="PD-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->DemolitionPermit->register($request, $no_request);

        }
        elseif ($type == "CC"){

            if ($request->file()){
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "title" => 'required|max:255',
                    "undersigned" => 'max:65',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "request_no_request_buildingpermit" => 'max:45',
                    "request_no_request" => 'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "cost_s" => 'numeric',
                    "object_s" => 'max:255',
                    "commune_s" => 'max:65',
                    "object_more_s" => 'max:255'

                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }
            else{
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "undersigned" => 'max:65',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "request_no_request_buildingpermit" => 'max:45',
                    "request_no_request" => 'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "cost_s" => 'numeric',
                    "object_s" => 'max:255',
                    "commune_s" => 'max:65',
                    "object_more_s" => 'max:255'
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }

            $no_request ="CC-" . $this->user->id_user . "-" . time() . "-" . $random_number;
            $this->insertRequest($request, $no_request, $type);
            return $this->CertificateOfConformity->register($request, $no_request);

        }
        elseif ($type == "PL"){

            if ($request->file()){
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "title" => 'required|max:255',
                    "last_name" => 'max:45',
                    "fist_name" => 'max:45',
                    "address" => 'max:20',
                    "postal_code" => 'max:20',
                    "email" => 'max:30',
                    "phone_number" => 'max:30',
                    "owner_name" => 'max:45',
                    "is_owner" => 'integer|max:4',
                    "is_representative" => 'integer|max:4',
                    "more_information" => 'max:45',
                    "social_reason" => 'max:45',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "arrondissement_g" => 'max:45',
                    "district_g" => 'max:45',
                    "placesaid_g" => 'max:45',
                    "street_g" => 'max:45',
                    "id_landtitle_g" => 'max:45',
                    "area_g" => 'numeric',
                    "area_tosubdivide_g" => 'numeric',
                    "north_g" => 'max:45',
                    "south_g" => 'max:45',
                    "east_g" => 'max:45',
                    "west_g" => 'max:45',
                    "is_servitudey_g" => 'integer|max:4',
                    "numberoflots_l" => 'integer|max:11',
                    "planned_eqipment_l" => 'max:205',
                    "is_blocksboundary_l" => 'integer|max:4',
                    "is_lotsboundary_l" => 'integer|max:4',
                    "is_trackopening_l" => 'integer|max:4',
                    "is_crossing_canalbuilding_l" => 'integer|max:4',
                    "is_variouscanal_building_l" => 'integer|max:4',
                    "is_owner_procuration_r" => 'integer|max:4',
                    "is_certificate_ownership_r" => 'integer|max:4',
                    "is_planningcertificate_r" => 'integer|max:4',
                    "is_situation_plan_r" =>'integer|max:4',
                    "is_explanatory_report_r" => 'integer|max:4',
                    "is_commitment_complete_r" => 'integer|max:4',
                    "is_commitment_follow_r" => 'integer|max:4',
                    "is_statusproject_r" => 'integer|max:4',
                    "is_residential_subdivision_p" => 'integer|max:4',
                    "is_commercial_subdivision_p" => 'integer|max:4',
                    "is_industrial_subdivision_p" => 'integer|max:4',
                    "is_mixed_siubdivision_p" => 'integer|max:4',
                    "more_information_p" => 'max:45',
                    "request_no_request" => 'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "last_name_o" => 'max:45',
                    "fist_name_o" => 'max:45',
                    "address_o" => 'max:20',
                    "postal_code_o" => 'max:20',
                    "email_o" => 'max:30',
                    "phone_number_o" => 'max:30',
                    "cost_s" => 'numeric',
                    "object_s" => 'max:255',
                    "location_s" => 'max:1000',
                    "object_more_s" => 'max:255',
                    "area_unit_g" => 'max:15',
                    "area_tosubdivide_unit_g" => 'max:15'
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }
            else{
                $validator = Validator::make($request->all(), [
                    "requestcol" => 'max:45',
                    "last_name" => 'max:45',
                    "fist_name" => 'max:45',
                    "address" => 'max:20',
                    "postal_code" => 'max:20',
                    "email" => 'max:30',
                    "phone_number" => 'max:30',
                    "owner_name" => 'max:45',
                    "is_owner" => 'integer|max:4',
                    "is_representative" => 'integer|max:4',
                    "more_information" => 'max:45',
                    "social_reason" => 'max:45',
                    "date_a" => 'date',
                    "place_a" => 'max:45',
                    "arrondissement_g" => 'max:45',
                    "district_g" => 'max:45',
                    "placesaid_g" => 'max:45',
                    "street_g" => 'max:45',
                    "id_landtitle_g" => 'max:45',
                    "area_g" => 'numeric',
                    "area_tosubdivide_g" => 'numeric',
                    "north_g" => 'max:45',
                    "south_g" => 'max:45',
                    "east_g" => 'max:45',
                    "west_g" => 'max:45',
                    "is_servitudey_g" => 'integer|max:4',
                    "numberoflots_l" => 'integer|max:11',
                    "planned_eqipment_l" => 'max:205',
                    "is_blocksboundary_l" => 'integer|max:4',
                    "is_lotsboundary_l" => 'integer|max:4',
                    "is_trackopening_l" => 'integer|max:4',
                    "is_crossing_canalbuilding_l" => 'integer|max:4',
                    "is_variouscanal_building_l" => 'integer|max:4',
                    "is_owner_procuration_r" => 'integer|max:4',
                    "is_certificate_ownership_r" => 'integer|max:4',
                    "is_planningcertificate_r" => 'integer|max:4',
                    "is_situation_plan_r" =>'integer|max:4',
                    "is_explanatory_report_r" => 'integer|max:4',
                    "is_commitment_complete_r" => 'integer|max:4',
                    "is_commitment_follow_r" => 'integer|max:4',
                    "is_statusproject_r" => 'integer|max:4',
                    "is_residential_subdivision_p" => 'integer|max:4',
                    "is_commercial_subdivision_p" => 'integer|max:4',
                    "is_industrial_subdivision_p" => 'integer|max:4',
                    "is_mixed_siubdivision_p" => 'integer|max:4',
                    "more_information_p" => 'max:45',
                    "request_no_request" => 'max:45',
                    "notification_s" => 'max:1000',
                    "sessionviewed_s" => 'max:1000',
                    "folderfollow_s" => 'max:1000',
                    "taxes_participations_s" => 'max:1000',
                    "last_name_o" => 'max:45',
                    "fist_name_o" => 'max:45',
                    "address_o" => 'max:20',
                    "postal_code_o" => 'max:20',
                    "email_o" => 'max:30',
                    "phone_number_o" => 'max:30',
                    "cost_s" => 'numeric',
                    "object_s" => 'max:255',
                    "location_s" => 'max:1000',
                    "object_more_s" => 'max:255',
                    "area_unit_g" => 'max:15',
                    "area_tosubdivide_unit_g" => 'max:15'
                ]);

                if ($validator->fails()){
                    return response()->json([
                        $validator->errors()
                    ]);
                }
            }

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
