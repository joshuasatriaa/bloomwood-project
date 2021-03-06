<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\Filters\UserRoleFilter;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role.check:superadmin'])->except(['update', 'show', 'changePassword']);
        // $this->middleware('check.pin')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->filter([
            UserRoleFilter::class,
            UserFilter::class,
        ])->paginate(request('per_page', 30));

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create');

        $validated = $request->validated();
        $user = User::create($validated);

        return (new UserResource($user))
            ->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();
        $user->update(array_filter($validated));

        $this->updateCustomerAddress($user, $validated);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function suspendUser(User $user)
    {
        $this->authorize('suspend', $user);

        $user->is_suspended = true;
        $user->save();

        return new UserResource($user);
    }

    public function unSuspendUser(User $user)
    {
        $this->authorize('suspend', $user);

        $user->is_suspended = false;
        $user->save();

        return new UserResource($user);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validated();
        $user->forceFill([
            'password' => Hash::make($validated['new_password'])
        ])->save();


        return response()->json(['message' => 'Ok'], 200);
    }

    private function getRoleId($id)
    {
        return Role::where('_id', $id)->first()->id;
    }

    protected function updateCustomerAddress(User $user, array $validated): void
    {
        $address = $user->customerAddresses()->first();
        $address->address = $validated['address'];
        $address->address_area_id = $validated['address_area_id'];
    }
}
