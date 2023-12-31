<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['create']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = [
            'data' => [],
            'message' => ''
        ];
        try {
            $res['data'] = User::all();
        } catch (Exception $e) {
            $res['message'] = $e->getMessage();
        }
        return $res;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        $res = [
            'data' => [],
            'message' => 'User Created',
            'success' => true
        ];
        try {
            $userData = $request->except('id');
            $userData['password'] = $userData['password'] ?? 'dededede';
            $userData['password'] = \Hash::make($userData['password']);
            $user = new User();
            /*  $user->name = $request->input('name');
              $user->phone = $request->input('phone');
            */
            $user->fill($userData);
            $user->save();
            $res['data'] = $user;
        } catch (Exception $e) {
            $res = [
                'data' => [],
                'message' => $e->getMessage(),
                'success' => false
            ];
        }
        return $res;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $user)
    {
        $res = [
            'data' => [],
            'message' => ''
        ];
        try {
            $res['data'] = User::findOrFail($user);
        } catch (Exception $e) {
            $res['message'] = $e->getMessage();
        }
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): array
    {
        $data = $request->except(['id']);

        $res = [
            'data' => null,
            'message' => '',
            'success' => true
        ];

        try {
            $data['password'] = 'dededede';

            $data['password'] = Hash::make($data['password']);
            $user->update($data);
            $res['data'] = $user;
            $res['message'] = 'User updated!';
        } catch (Exception $e) {
            $res['success'] = false;
            $res['message'] = $e->getMessage();
        }
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): array
    {
        $res = [
            'data' => $user,
            'message' => 'User ' . $user->id . ' deleted',
            'success' => true
        ];
        try {
            $res['success'] = $user->delete();
            if (!$res['success']) {
                $res['message'] = 'Could not delete $user ' + $user->id;
            }
        } catch (Exception $e) {
            $res['success'] = false;
            $res['message'] = $e->getMessage();
        }
        return $res;
    }
}
