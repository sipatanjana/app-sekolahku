<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCourseRequest;
use App\Http\Resources\UserCourseResource;
use App\Models\Courses;
use App\Models\User;
use App\Models\UserCourses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = UserCourses::get();
        return UserCourseResource::collection($model);
    }

    /**
     * Display a listing of the resource.
     */
    public function allCourse()
    {
        $user = User::find(Auth::user()->id);
        if (!$user->hasRole('super_admin')) {
            $model = UserCourses::where('id_user', $user->id)->get();
        } else $model = UserCourses::get();

        foreach ($model as $key => $value) {
            $data[$key]['username'] = $value->User->name;
            $data[$key]['course'] = $value->Courses->course;
            $data[$key]['mentor'] = $value->Courses->mentor;
            $data[$key]['title'] = $value->Courses->title;
        }

        return $this->sendResponse($data, 'Success!.');
    }

    /**
     * Display a listing of the resource.
     */
    public function allCourseWithBachelorMentor()
    {
        $model = DB::table('user_courses')
            ->join('courses', 'courses.id', '=', 'user_courses.id_course')
            ->join('users', 'users.id', '=', 'user_courses.id_user')
            ->where('title', 'like', '%S.%')
            ->get();

        foreach ($model as $key => $value) {
            $data[$key]['username'] = $value->name;
            $data[$key]['course'] = $value->course;
            $data[$key]['mentor'] = $value->mentor;
            $data[$key]['title'] = $value->title;
        }

        return $this->sendResponse($data, 'Success!.');
    }

    /**
     * Display a listing of the resource.
     */
    public function allCourseWithNoBachelorMentor()
    {
        $model = DB::table('user_courses')
            ->join('courses', 'courses.id', '=', 'user_courses.id_course')
            ->join('users', 'users.id', '=', 'user_courses.id_user')
            ->where('title', 'not like', '%S.%')
            ->get();

        foreach ($model as $key => $value) {
            $data[$key]['username'] = $value->name;
            $data[$key]['course'] = $value->course;
            $data[$key]['mentor'] = $value->mentor;
            $data[$key]['title'] = $value->title;
        }

        return $this->sendResponse($data, 'Success!.');
    }

    /**
     * Display a listing of the resource.
     */
    public function allCourseAttendace()
    {
        $user = User::find(Auth::user()->id);
        $model_course = Courses::distinct('course')->get();
        foreach ($model_course as $key => $value) {
            $count = UserCourses::join('courses', 'courses.id', '=', 'user_courses.id_course')->where('courses.course', $value->course)->count();
            if ($count > 0) {
                $data[$key]['course'] = $value->course;
                $data[$key]['mentor'] = $value->mentor;
                $data[$key]['title'] = $value->title;
                $data[$key]['jumlah_peserta'] = $count;
            }
        }

        return $this->sendResponse($data, 'Success!.');
    }

    /**
     * Display a listing of the resource.
     */
    public function allCourseFeeMentor()
    {
        $user = User::find(Auth::user()->id);
        $model_course = Courses::distinct('mentor')->get();
        foreach ($model_course as $key => $value) {
            $count = UserCourses::join('courses', 'courses.id', '=', 'user_courses.id_course')->where('courses.mentor', $value->mentor)->count();
            if ($count > 0) {
                $data[$key]['mentor'] = $value->mentor;
                $data[$key]['jumlah_peserta'] = $count;
                $data[$key]['total_fee'] = $count * 2000000;
            }
        }

        return $this->sendResponse($data, 'Success!.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCourseRequest $request)
    {
        $data = $request->all();
        $model = UserCourses::create($data);

        return $this->sendResponse($model, 'Success!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = UserCourses::findOrFail($id);

        return $this->sendResponse($model, 'Success!.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserCourseRequest $request, string $id)
    {
        $data = $request->all();
        $model = UserCourses::find($id);
        $model->update($data);

        return $this->sendResponse($model, 'Success!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $model = UserCourses::find($id);
            $model->Courses->delete();
            $model->Courses->delete();
            $model->delete();

            return $this->sendResponse('', 'Success!.');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError($th);
        }
    }
}
