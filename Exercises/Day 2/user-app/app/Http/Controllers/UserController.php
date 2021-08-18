<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = DB::table('users')->get();
        return response()->json([
            'data' => $users,
            'description' => 'Successfully retrieved all users'
        ]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if($request->has(['first_name', 'last_name']) == false)
            return response()->json(['data' => null, 'description' => "Error! Invalid input"]);
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        DB::table('users')->insert([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'data' => null,
            'description' => 'Successfully created user'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = DB::table('users')->find($id);
        return response()->json([
            'data' => $user,
            'description' => 'Successfully retrieved user'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return response()->json([
            'data' => null,
            'description' => 'Successfully deleted user'
        ]);
    }
}
