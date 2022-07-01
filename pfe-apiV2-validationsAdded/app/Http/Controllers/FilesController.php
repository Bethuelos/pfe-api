<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\FilesModel;

class FilesController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    // Upload
    public function upload(Request $request, $type, $no_request)
    {
        $this->user = Auth::user();
        // return response(['message' => 'ok']);
        // $data[];

        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'mimes:doc,pdf,jpg,png,docx,zip'

        ]);

        // $name = time() . "_" . $no_request . "." . $request->file('filename')->extension();

        if($request->hasfile('filename'))
         {

            foreach($request->file('filename') as $file)
            {
                $name=$no_request . "_" . $file->getClientOriginalName();
                // $file->move(public_path().'/files/', $name);
                // $data[] = $name;

                $path = $file->storeAs(
                    "userID_" . $this->user->id_user . "_documents",
                    $name,
                    'public'
                );
                DB::table('upload')->insert([
                    "title" => $request->input('title'),
                    "path" => $path,
                    "request_no_request" => $no_request,
                    "filename" => $name,
                ]);

            }

            return response([
                "message" => "registration successfull"
            ]);
        }
        else{
            return response(['message' => 'doesn\'t exist']);
        }

        // return response(['message' => 'doesn\'t exist']);

        // return back()->with('success', 'Your files has been successfully added');

        // $filename = $no_request . "." . $request->file('file')->extension();

        // $path = $request->file('file')->storeAs(
        //     "userID_" . $this->user->id_user . "_documents",
        //     $filename,
        //     'public'
        // );
        // DB::table('upload')->insert([
        //     "title" => $request->input('title'),
        //     "path" => $path,
        //     "request_no_request" => $no_request,
        // ]);
    }

    public function documents($no_request = "", $doc = "")
    {
        $this->user = Auth::user();

        if ($no_request == "" && $doc == "")
        {
            // retrieve all files
            // $files = Storage::disk('public')->allFiles("userID_" . $this->user->id_user . "_documents");

            $upload = DB::table('upload')
                ->join('request', 'upload.request_no_request', '=', 'request.no_request')
                    ->where('request.user_id_user', '=', $this->user->id_user)
                ->select('upload.filename')
                ->get();

            if ( Storage::disk('public')->exists("userID_" . $this->user->id_user . "_documents"))
            {
                // foreach ($files as $file) {

                // }
                return response()->json([
                    "files" => $upload,
                ]);

            }
            else{
                return response([
                    "message" => "file doesn't exist"
                ]);
            }
        }
        elseif ($no_request != "" && $doc == "")
        {
            if ( Storage::disk('public')->exists("userID_" . $this->user->id_user . "_documents"))
            {
                $files = DB::table('upload')->where('request_no_request', $no_request)->get();
                foreach ($files as $file) {
                    $data[] = $file->filename;
                }
                return response()->json([
                    "files" => $data,
                ]);

            }
            else{
                return response([
                    "message" => "folder doesn't exist"
                ]);
            }

        }
        else
        {
           if ( Storage::disk('public')->exists("userID_" . $this->user->id_user . "_documents" . "/" . $doc))
            {
                return Storage::download("public/userID_" . $this->user->id_user . "_documents" . "/" . $doc, "my file");
            }
            else{
                return response([
                    "message" => "doesn't exist"
                ]);
            }
        }


    }

    public function download($no_request = "", $doc = "")
    {
        $this->user = Auth::user();

        if ($no_request == "" && $doc == "")
        {
            return $this->documents();
        }
        elseif ($no_request != "" && $doc == "")
        {
            return $this->documents($no_request);
        }
        else
        {
            $result = DB::table('request')->where('no_request', $no_request)->first();

            if ($result->user_id_user == $this->user->id_user){
                return $this->documents($no_request, $doc);
            }
            else{
                return response([
                    "message" => "no access"
                ]);
            }
        }

    }

}
