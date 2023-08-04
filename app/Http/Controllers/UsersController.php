<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = [
            'data' =>[],
            'message' => ''
        ];
        try{
            $res['data'] = User::all();
        } catch (Exception $e){
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
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $res = [
            'data' =>[],
            'message' => ''
        ];
        try{
            $res['data'] = User::findOrFail($user);
        } catch (Exception $e){
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
            $User = User::findOrFail($user);
            $data['password'] = Hash::make($data['password']);
            $User->update($data);
            $res['data'] = $User;
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
    public function destroy(User $user)
    {
        //
    }
}
