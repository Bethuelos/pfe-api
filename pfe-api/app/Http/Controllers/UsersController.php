<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FilesController;

class UsersController extends Controller
{
    private $File;
    // User registration
    public function register(Request $request)
    {
        DB::table('user')->insert([
            "username" => $request->input('username'),
            "email" => $request->input('email'),
            "password" => Hash::make($request->input('password')),
            "first_name" => $request->input('first_name'),
            "last_name" => $request->input('last_name'),
            "avatar" => "public/avatars/1.jpg",
            "rules" => $request->input('rules')
        ]);

        return response()->json([
            'message' => 'registration successful'
        ]);
        // return Storage::download("public/avatar/1.jpg");

    }

    //  User login
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))){
            return response()->json([
                'message' => 'invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('auth-token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60*24); // 1 day

        return response()->json([
            'token' => $token,
            'created at' => time(),
            // 'expiring at' => time() + 1,
            'user' => $user
        ])->withCookie($cookie);
    }

    // Current user info
    public function user()
    {
        return response()->json(Auth::user());
    }

    // Users info
    public function users()
    {
        // return DB::select('select * from user');
        return response()->json(DB::table('user')->get());
    }

    // Specific user info
    public function specific($id)
    {
        // return DB::table('user')->find($id);
        return response()->json(DB::table('user')->where('id_user', $id)->first());
    }

    public function avatar(Request $request){
        $user = Auth::user();

        $filename = "avatar_userID_" . $user->id_user . "." . $request->file('file')->extension();

        $path = $request->file('file')->storeAs(
            "avatars",
            $filename,
            'public'
        );

        DB::table('user')
            ->where('id_user', $user->id_user)
            ->update([
            "avatar" => $path,
            ]);
        return response()->json([
            'message' => $path
        ]);
    }

    // Modify user
    public function modify(Request $request, $id)
    {
        $user = Auth::user();

        DB::table('user')
              ->where('id_user', $id)
              ->update([
                'username' => $request->input('username'),
                "email" => $request->input('email'),
                "password" => Hash::make($request->input('password')),
                "first_name" => $request->input('first_name'),
                "last_name" => $request->input('last_name'),
                "rules" => $request->input('rules')
              ]);
        return response()->json([
            'message' => 'modification success'
        ]);

    }

    // Delete user
    public function delete($id)
    {
        // return DB::delete('delete users where name = ?', ['John']);
        DB::table('user')->where('id_user', $id)->delete();

        return response()->json([
            'message' => 'deletion success'
        ]);
    }

    // User logout
    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response()->json([
            'message' => 'Logout success',
        ])->withCookie($cookie);
    }
}
