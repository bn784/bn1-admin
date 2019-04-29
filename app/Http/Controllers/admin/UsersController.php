<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('user_access')) {
            return abort(401);
        }
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }

        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->name == 'administrator') {
            return redirect()->back()->with('warning', 'Cannot create name "administrator"!');
        }
        $user = new User();
        $user->preferred_language = $request->preferred_language;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin.users.index')->with('success', $user->name.' create successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('user_view')) {
            return abort(401);
        }
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }

        $roles = Role::all();

        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = User::findOrFail($id);
        if (Hash::check($request->get('password'), $user->password)) {
            if (($user->role_id == 1) && ($user->name == 'administrator') ) {
                return redirect()->route('admin.users.index')->with('warning', 'Cannot edit "administrator"!');
            }
            if ($request->name == 'administrator' ) {
                return redirect()->back()->with('warning', 'Cannot use name "administrator"!');
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->save();
            return redirect()->route('admin.users.index')->with('success', $user->name.' update successfully!');
        }else{
            return redirect()->back()->with('warning', 'Wrong password!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }

        $user = User::findOrFail($id);

        if ($user->email == 'administrator@example.com' ) {
            return redirect()->back()->with('warning', 'Cannot delete "administrator@example.com"!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', $user->name.' delete successfully!');
    }
    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();
            foreach ($entries as $entry) {
                if($entry->email !== 'administrator@example.com'){
                    $entry->delete();
                }
            }
        }
    }
    public function preferred_language($lang)
    {
        $user = \Auth::user();
        $user ->preferred_language = $lang ;
        $user->save();

        return redirect()->back();
    }
}
