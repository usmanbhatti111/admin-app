<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\User;
use Database\Seeders\Users;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomController extends Controller
{
    private $UserRepository;
    public function __construct(UserRepository $UserRepository)
     { 
   
         $this->UserRepository = $UserRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->UserRepository->getUsers(); 
        // $users =  DB::table('users')->get();

        // dd($users);

        return view('Admin.user.index', compact('users' ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new User();
         $users = $product->getTableColumns();
         $coloumns_to = array("id", "email_verified_at", "password","created_at","updated_at","remember_token","user_type");
         foreach($users as $user){
             if((in_array($user, $coloumns_to))){
                $key = array_search( $user,$users);
                unset($users[$key]);
             }
         }
        //  return $columns;
         
         
        
        
         unset($users[$key]);
        //  return $columns;
    //      $result = array_diff_key($columns, array_flip(["email_verified_at", "gender"]));
    // //   $columns->exclude('email_verified_at');
    //     $users = DB::getSchemaBuilder()->getColumnListing('users');
    //    dd($users);
    // dd($user);
        return view('Admin.user.create', compact('users' ) );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $field=$request->all();
        // return ($field);
        // return $field;
        // dd($request->all());
        $num=count($request->field_name);
        if (Schema::hasTable('users')) {

        Schema::table('users', function (Blueprint $table) use ($request,$num) {
           
           
                for($i=0;$i<$num;$i++){
                    $type=$request->field_type[$i];
                    
                    $table->$type($request->field_name[$i])->nullable();
                }
              
                return redirect()->route('custom.create');

            // return response()->json(['message' => 'Given table has been successfully created!'], 200);

        });
    
        return response()->json(['status' => true, 'success' =>true, 'msg' => "Form Fields has been Created"]);

      };
        
    //

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
        //
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
        //
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
