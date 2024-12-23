<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\Users;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = User::get();
        return Users::collection($model);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $model = User::create($data);

        return $this->sendResponse($model, 'Success!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = User::findOrFail($id);

        return $this->sendResponse($model, 'Success!.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $model = User::find($id);
        $model->update($data);

        return $this->sendResponse($model, 'Success!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $model = User::find($id);
            $model->delete();

            return $this->sendResponse('', 'Success!.');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError($th);
        }
    }
}
