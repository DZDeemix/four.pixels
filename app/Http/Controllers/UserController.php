<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->get('paginateOff')) {
            $users = User::all();
        } else {
            $users = User::paginate(5);
        }
        return response(['data' => $users, 'message' => 'Список пользователей'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param null|int $id
     * @return Factory|View
     */
    public function createOrEditForm($id = null)
    {
        return view('user.form', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->get('password'));

        if ($user->save()) {
            return response(['data' => $user, 'message' => 'Отдел создан'], 201);
        }

        return response(['data' => '', 'errror_message' => 'Не удалось создать пользователя'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return response(['data' => $user, 'message' => ''], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Factory|View
     */
    public function list()
    {
        return view('user.list');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        if ($user->update()) {
            return response(['data' => $user, 'message' => 'Пользователь обновлен'], 200);
        }

        return response(['data' => '', 'errror_message' => 'Не удалось обновить пользователя'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return response(['data' => null, 'message' => 'Пользователь удален'], 204);
        }

        return response(['data' => '', 'errror_message' => 'Не удалось удалить пользователя'], 500);
    }
}
