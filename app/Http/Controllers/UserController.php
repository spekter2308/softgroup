<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
	/**
	 * @var PostRepository
	 */
	private $userRepository;

	/**
	 * PostController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->userRepository = app(UserRepository::class);
		$this->middleware('auth');
	}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = $this->userRepository->getAllUsers();

        return view('users.index', [
        	'users' => $users,
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->getUser($id);
        $roles = Role::all();

        return view('users.edit', [
        	'user' => $user,
			'roles' => $roles,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
		$user = $this->userRepository->getUser($id);
		$user->update($request->all());

		//Roles
		$user->roles()->detach();
		if($request->input('roles')){
			$user->roles()->attach($request->input('roles'));
		}

        return redirect()
			->route('users.index')
			->with(['success' => "Зміни успішно збережено"]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->getUser($id);

        $user->roles()->detach();
		$user->delete();
		return redirect()->route('users.index')->with(['success' => "Користувача було видалено"]);
    }
}
