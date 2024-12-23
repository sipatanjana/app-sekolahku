<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Courses;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = Courses::get();
        return CourseResource::collection($model);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $data = $request->all();
        $model = Courses::create($data);

        return $this->sendResponse($model, 'Success!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Courses::findOrFail($id);

        return $this->sendResponse($model, 'Success!.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, string $id)
    {
        $data = $request->all();
        $model = Courses::find($id);
        $model->update($data);

        return $this->sendResponse($model, 'Success!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $model = Courses::find($id);
            $model->delete();

            return $this->sendResponse('', 'Success!.');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError($th);
        }
    }
}
