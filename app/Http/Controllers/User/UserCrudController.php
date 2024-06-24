<?php

namespace App\Http\Controllers\User;

use App\Domains\User\Requests\UserCreateRequest;
use App\Domains\User\Requests\UserUpdateRequest;
use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(UserCreateRequest $request, UserService $service)
    {
        return redirect()->route('user.page');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request, UserService $service)
    {
        $data = $request->validated();
        $service->create($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ?User
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request,User $user, UserService $service)
    {
        $service->update($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
    }
}
