<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;

        // check if field is not empty
        if(empty($email) || empty($password)) {
            return response()->json(['status' => 'error', 'message' => 'You must fill all fields.']);
        }

        $client = new Client();

        try {
            return $client->post('/v1/oauth/token', [
                "form_params" => [
                    "client_secret" => "WbSIOhnuNb0dqUKcsJmvLEhLdDChNfPXASfQ7GQn",
                    "grant_type" => "password",
                    "client_id" => 2,
                    "username" => $request->email,
                    "password" => $request->password,
                ]
            ]);
        } catch (BadResponseException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}