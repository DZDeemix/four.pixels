<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response(['data' => Department::with('users')->paginate(5), 'message' => 'Список отделов'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param null|int $id
     * @return Factory|View
     */
    public function createOrEditForm($id = null)
    {
        return view('department.form', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $request
     * @return Response
     */
    public function store(DepartmentRequest $request)
    {
        $department = new Department();
        $department->fill($request->all());
        $department->logo = $request->file('logo')->store('logo');
        $department->save();
        if ($request->get('users')) {
            $department->users()->sync($request->get('users'));
        }

        if ($department->save()) {
            return response(['data' => $department, 'message' => 'Отдел создан'], 201);
        }

        return response(['data' => '', 'errror_message' => 'Не удалось создать отдел'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return Response
     */
    public function show(Department $department)
    {
        $department->users = $department->users()->pluck('user_id');
        return response(['data' => $department, 'message' => ''], 200);
    }

    /**
     * Show the list view of resource.
     *
     * @return Factory|View
     */
    public function list()
    {
        return view('department.list');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param Department $department
     * @return Response
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $department->fill($request->all());
        if ($request->hasFile('logo')) {
            if ($department->logo) {
                Storage::delete($department->logo);
            }
            $department->logo = $request->file('logo')->store('logo');
        }

        if ($request->get('users')) {
            $department->users()->sync($request->get('users'));
        }

        if ($department->update()) {
            return response(['data' => $department, 'message' => 'Отдел обновлен'], 200);
        }

        return response(['data' => '', 'errror_message' => 'Не удалось обновить отдел'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return Response
     * @throws Exception
     */
    public function destroy(Department $department)
    {
        if ($department->logo) {
            Storage::delete($department->logo);
        }
        if ($department->delete()) {
            return response(['data' => null, 'message' => 'Задание удалено'], 204);
        }

        return response(['data' => '', 'errror_message' => 'Не удалось удалить отдел'], 500);
    }
}
