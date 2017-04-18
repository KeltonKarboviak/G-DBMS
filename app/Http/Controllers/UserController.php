<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Carbon\Carbon;

use App\User;
use App\UserRole;

class UserController extends Controller
{
    private $rules = [
        'first_name' => 'required|max:50',
        'last_name' => 'required|max:50',
        'role_id' => 'required|exists:user_roles,id',
        'new_password' => 'required:different:password|confirmed',
    ];

    private $messages = [

    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('/user/index', [
            'users' => $users = User::with('role')->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get(),
        ]);
    }

    public function update(User $user) {
        // Check to see if the current user is authorized to edit $user
        if (Auth::user()->cannot('update', $user)) {
            session()->flash('alert-danger','You do not have the permissions needed to perform that action.');
            return redirect()->back();
        }

        $user->load('role');

        return view('/user/update', [
            'user' => $user,
            'roles' => UserRole::pluck('name', 'id'),
        ]);
    }

    public function update_pass(Request $request, User $user) {
        $this->validate($request, [
            'password' => 'hash:' . $user->password,
            'new_password' => 'required|different:password|confirmed',
        ]);

        $user->password = bcrypt($request->get('new_password'));
        $user->password_updated_at = Carbon::now()->toDateTimeString();
        $user->save();

        session()->flash('alert-success', 'The password has been successfully updated.');

        return redirect()->back();
    }

    public function update_info(Request $request, User $user) {
        $rules = [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|max:255|unique:users,email,' . $user->email . ',email',
        ];

        $to_fill = $request->all();

        // Check to see if current user is able to update their permissions
        if ($request->user->can('update_role_id', $user)) {
            $rules['role_id'] = 'required|exists:user_roles,id';
            $to_fill['role_id'] = $request->get('role_id');
        }

        $this->validate($request, $rules);

        $user->update($to_fill);

        session()->flash('alert-success', 'The information has been successfully updated.');

        return redirect()->route('user.update', $user);
    }

    public function delete(User $user) {
        $user->delete();
        session()->flash('alert-success', "The user '{$user->full_name}' has been successfully deleted.");
        return redirect()->back();
    }
}
