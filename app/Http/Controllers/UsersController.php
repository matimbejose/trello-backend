<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{

    /**
     * Send json response from API
     *
     * @return \Illuminate\Http\Response
     */
    private function sendResponse($data, $message = null, $status = 200)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, $status);
    }


    /**
     * Send API json response in case of error.
     *
     * @return \Illuminate\Http\Response
     */
    private function sendError($error, $errorMessages = [], $status = 404)
    {
        $response = [
            'status' => $status,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $status);
    }


    /**
     * Login the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'Login do usuário com sucesso.');
        } else {
            return $this->sendError('Não autorizado.', ['error' => 'Não autorizado'], 401);
        }
    }


    /**
     * Disconnect user.
     *
     * @return \Illuminate\Http\Response
     */

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return $this->sendResponse([], 'Usuário desconectado com sucesso');
        } else {
            return $this->sendError('Não autorizado.', ['error' => 'Não autorizado'], 401);
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        /// Create the user
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user->save()) {
            // Generate OAuth2 access token using Laravel Passport
            $token = $user->createToken('API Token')->accessToken;

            return $this->sendResponse([
                'user' => $user,
                'access_token' => $token
            ], 'User created successfully', 201);
        } else {
            return $this->sendError('Failed to create user', [], 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
