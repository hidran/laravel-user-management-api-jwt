<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        } catch (\Exception $e){
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
        } catch (\Exception $e){
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
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
