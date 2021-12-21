<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{
    private $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        // $this->middleware('permission:role.list',['only'=>['index']]); 
        // $this->middleware('permission:role.create', ['only' => ['create']]);
        // $this->middleware('permission:role.store',['only'=>['store']]);
        // $this->middleware('permission:role.edit',['only'=>['edit']]);
        // $this->middleware('permission:role.update', ['only' => ['update']]);
        // $this->middleware('permission:role.delete', ['only' => ['destroy']]);
         $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->getRoles();
       
        if ($roles instanceof \Exception) {
            return redirect('role')->with('error', $roles->getMessage());
        }
        return view('Admin.roles.role', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->roleRepository->getAllPermission();
        // dd($permissions);
        if ($permissions instanceof \Exception) {
            return redirect('role')->with('error', $permissions->getMessage());
        }
        return view('Admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $this->roleRepository->createRole($request); 
        // dd($role);
 
        if ($role instanceof \Exception) {
            return redirect('role')->with('error', $role->getMessage());
        }
        return redirect('role')->with('success', 'User Role has been Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $role = $this->roleRepository->getRoleById($id);
        $permissions = $this->roleRepository->getAllPermission();
        if ($role instanceof \Exception) {
            return redirect('role')->with('error', $role->getMessage());
        }
        return view('Admin.roles.update', compact('role', 'permissions'));
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
        $id = decrypt($id); 
        $role = $this->roleRepository->updateRole($request, $id); 
        if ($role instanceof \Exception) {
            return redirect('role')->with('error', $role->getMessage());
        }
        return redirect('role')->with('success', 'User Role has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
