<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CustomersModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CustomersController extends Controller
{
    // Customer registration
    public function register(Request $request)
    {
        DB::table('customer')->insert([
            "id_customer" => $request->input('id_customer'),
            "name" => $request->input('name'),
            "first_name" => $request->input('first_name'),
            "email" => $request->input('email'),
            "boring_year" => $request->input('boring_year'),
            "gender" => $request->input('gender'),
            "phone_number" => $request->input('phone_number'),
            "password" => Hash::make($request->input('password')),
            "address" => $request->input('address'),
            "nationality" => $request->input('nationality'),
            "postal_code" => $request->input('postal_code'),
        ]);

        return response ([
            'message' => 'registration successful'
        ]);

    }

    //  Customer login
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))){
            return response([
                'message' => 'Customer invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $Customer = Auth::user();

        $token = $Customer->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60*24); // 1 day

        return response([
            'message' => 'Login success',
            'token' => $Customer,
        ])->withCookie($cookie);
    }

    // Current Customer info
    public function user()
    {
        return Auth::user();
    }

    // Users info
    public function customers()
    {
        // return DB::select('select * from user');
        return DB::table('customer')->get();
    }

    // Specific Customer info
    public function specific($id)
    {
        // return DB::table('customer')->find($id);
        return DB::table('customer')->where('id_customer', $id)->first();
    }

    // Modify customer
    public function modify(Request $request, $id)
    {
        // return DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
        DB::table('customer')
              ->where('id_customer', $id)
              ->update([
                "id_customer" => $request->input('id_customer'),
                "name" => $request->input('name'),
                "first_name" => $request->input('first_name'),
                "email" => $request->input('email'),
                "boring_year" => $request->input('boring_year'),
                "gender" => $request->input('gender'),
                "phone_number" => $request->input('phone_number'),
                "password" => Hash::make($request->input('password')),
                "address" => $request->input('address'),
                "nationality" => $request->input('nationality'),
                "postal_code" => $request->input('postal_code'),
              ]);

        return response([
            'message' => 'modification success'
        ]);
    }

    // Delete user
    public function delete($id)
    {
        // return DB::delete('delete users where name = ?', ['John']);
        DB::table('customer')->where('id_customer', $id)->delete();

        return response([
            'message' => 'deletion success'
        ]);
    }

    // Customer logout
    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Logout success',
        ])->withCookie($cookie);
    }


}
