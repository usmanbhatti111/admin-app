<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PermissionRepository;

class PermissionController extends Controller
{
    private $PermissionRepository; 
    
    public function __construct(PermissionRepository $PermissionRepository)
    {
        // $this->middleware('permission:permission.list',['only'=>['index']]); 
        // $this->middleware('permission:permission.create',['only'=>['create']]);
        // $this->middleware('permission:permission.store', ['only' => ['store']]);
        // $this->middleware('permission:permission.edit', ['only' => ['edit']]);
        // $this->middleware('permission:permission.update', ['only' => ['update']]);
        // $this->middleware('permission:permission.delete', ['only' => ['destroy']]); 
        $this->PermissionRepository = $PermissionRepository;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->PermissionRepository->getPermissions();
        if ($permissions instanceof \Exception) {
            return redirect('permission')->with('error', $permissions->getMessage());
        }
        return view('Admin.permissions.permission', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.permissions.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = $this->PermissionRepository->createPermission($request); 
                if ($permission instanceof \Exception) {
                    return redirect('permission')->with('error', $permission->getMessage());
                }
                return redirect('permission')->with('success', 'User Permission has been Created');
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
        $permission = $this->PermissionRepository->getPermissionById($id);
        if ($permission instanceof \Exception) {
            return redirect('permission')->with('error', $permission->getMessage());
        }
        return view('Admin.permissions.update', compact('permission'));
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
        $permission = $this->PermissionRepository->updatePermission($request, $id);
        if ($permission instanceof \Exception) {
            return redirect('permission')->with('error', $permission->getMessage());
        }
        return redirect('permission')->with('success', 'User Permission has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $id = decrypt($id);
        $permission =  $this->PermissionRepository->deletePermission($id);
        if ($permission instanceof \Exception) {
            return response()->json(['status' => false, 'error' =>$permission->getMessage()]);
        }
        return response()->json(['status' => true, 'success' => 'Permission has been Deleted']);
    }
    public function assignPermission($id)
    { 
        $id = decrypt($id);
        $roles = $this->PermissionRepository->roles();
        $permissions = $this->PermissionRepository->getAllPermission();
        $user = $this->PermissionRepository->getUser($id);
        if ($roles instanceof \Exception) {
            return redirect('role')->with('error', $roles->getMessage());
        }
        return view('permissions.assign-permission', compact('roles', 'permissions', 'user' ));
    }
    public function saveAssignPermission(Request $request)
    {
        dd($request);
        $user_id = decrypt($request->user_id);
        $permission = $this->PermissionRepository->saveAssignPermission($request,$user_id);
        if ($permission instanceof \Exception) {
            return redirect('permission')->with('error', $permission->getMessage());
        }
        return redirect('user')->with('success', 'Role/Permission Created');
    }
}
