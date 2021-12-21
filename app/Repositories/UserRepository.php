<?php

namespace App\Repositories;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\FileUploadTrait;

//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository 
{
    use FileUploadTrait;

    /**
     * @return string
     *  Return the model
     */
    public function getUsers()
    {
        try {
          return  User::all();
        } catch (\Exception $e) {
            return $e;
        }
    } 
    public function getUserById($id)
    {
        try {
            $user = User::find($id);
            return $user;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function updateUser($request, $id){
        try { 
            DB::beginTransaction(); 
            $update_request = $request->except('_token','_method'); 

            if ($request->hasFile('file')){
               
                $image =  $this->fileUpload( $request->file('file'), 'users' );
                $update_request['image'] = $image;
             }

            $user=User::find($id); 
            $user->update($update_request);

       

            
            
            $userss=User::find($id); 
            $this->manageRoles($request->roles, $userss);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    
    public function manageRoles($request, $user)
    {
        try {
            $user->syncRoles($request);
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function getRoles(){
        try { 
            return Role::all(); 
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
}
