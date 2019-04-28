<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('role_access')) {
            return abort(401);
        }
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('role_create')) {
            return abort(401);
        }
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('role_create')) {
            return abort(401);
        }
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255','unique:roles']
        ]);
        $role = Role::create($request->all());
        return redirect()->route('admin.roles.index')->with('success', $role->title.' create successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('role_view')) {
            return abort(401);
        }
        $users = User::where('role_id', $id)->get();

        $role = Role::findOrFail($id);

        return view('admin.roles.show', compact('role', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('role_edit')) {
            return abort(401);
        }
        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role'));
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
        if (! Gate::allows('role_edit')) {
            return abort(401);
        }
        $this->validate($request, [
             'title' => 'required|string|max:255|unique:roles,title,'.$id,
        ]);
        $role = Role::findOrFail($id);
        if ($role->title == 'administrator' ) {
            return redirect()->route('admin.roles.index')->with('warning', 'Cannot update administrator!');
        }
        if ($role->title == 'user' ) {
            return redirect()->route('admin.roles.index')->with('warning', 'Cannot update user!');
        }

        $role->update($request->all());

        return redirect()->route('admin.roles.index')->with('success', $role->title.' update successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('role_delete')) {
            return abort(401);
        }
        $role = Role::findOrFail($id);

        if ($role->title == 'administrator' ) {
            return redirect()->back()->with('warning', 'Cannot delete role "administrator"!');
        }
        if ($role->title == 'user' ) {
            return redirect()->back()->with('warning', 'Cannot delete role "user"!');
        }
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', $role->title.' delete successfully!');
    }

}
