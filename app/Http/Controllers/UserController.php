<?php

namespace App\Http\Controllers;



use App\Events\SendMail;
use App\Jobs\SendEmailJob;
use Spatie\Permission\Models\Role;
use Smalot\PdfParser\Parser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\User;
use Spatie\PdfToText\Pdf;

use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    private $UserRepository;
    public function __construct(UserRepository $UserRepository)
     { 
    //     $this->middleware('permission:user.list',['only'=>['index']]); 
    //     $this->middleware('permission:user.create', ['only' => ['create']]);
    //     $this->middleware('permission:user.store', ['only' => ['store']]);
    //     $this->middleware('permission:user.edit', ['only' => ['edit']]);
    //     $this->middleware('permission:user.update', ['only' => ['update']]);
    //     $this->middleware('permission:user.delete', ['only' => ['destroy']]);
    //     $this->middleware('permission:user.update-password', ['only' => ['changePassword','saveChangePassword']]);
   
         $this->UserRepository = $UserRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->UserRepository->getUsers(); 
        // dd($user);
         
        
         return view('Admin.index',compact('user' ));
    }
    public function pdfReader(Request $request)
    {
        
        return view('pdf');

    }
    public function uploadPdf(Request $request)
    {
       
        // $request->validate([
        //     'file' => 'required|mimes:pdf',
        // ]);
    
   
        $file = $request->file;

        $PDFParser = new Parser();

        
        $pdf = $PDFParser->parseFile($file);
        $pages  = $pdf->getPages();

        $totalPages = count($pages);
        
          $text = $pdf->getText();
       
        $string = strpbrk($text, ':');

      return  $arr=explode(' ,',$string);

      foreach($arr as $array)
      {
        return  $name= $array['email'];
      }
        

        // $currentPage = 1;

        // // Create an empty variable that will store thefinal text
        // $text = "";
         
        // // Loop over each page to extract the text
        // foreach ($pages as $page) {

        //     // Add a HTML separator per page e.g Page 1/14
        //     $text .= "<h3>Page $currentPage/$totalPages</h3> </br>";
           
        //     // Concatenate the text
        //     $text .= $page->getText();
           
           

        //     // Increment the page counter
        //     $currentPage++;
        // }
     
    
    
        $wordarray = array('Virtual','abhsdgse');
       $pattern = implode("|",$wordarray);

      if (preg_match("/($pattern)/", $text)){
        return "Word is  found"; 	
    }else{
        return "Word is not found"; 	
    }
    return view('pdf', compact('text'));
      } 
        

//         $pos= strrpos($text,$search);
// return $pos;
// if ($pos !== false) {
//    return  substr($text,$pos + 20.);
    // prints: txt
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->UserRepository->getRoles();
        // dd($roles);
        return view('Admin.user.create', compact('roles'));

        // return view('Admin.user.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[ 
            'name'=>'required',
            'email'=>'required|email', 
            'password'=>'required', 

        ]);
        $email = $request->get('email');

        $data = ([
        'name' => $request->get('name'),
        'email'=> $request->get('email'),
            ]);

    //   Mail::to($email)->send(new WelcomeMail($data));
    // Event::fire(new SendMail(2));
    event(new SendMail($data));

    // dispatch(new SendEmailJob($data));

    
        try{
            
        
            DB::beginTransaction();
            $data=$request->all();
              
            $user = User::create($data);
            DB::commit();
            // $user = $user->setAttribute('item_id', encrypt($user->id));

    
            return response()->json(['status' => true, 'success' =>true, 'user' => $user, 'msg' => "user has been Created"]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(['status' => false, 'success' =>false, 'msg' => $e->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('Admin.user.show',compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $id = decrypt($id);
        
        $roles = $this->UserRepository->getRoles();
        $user = $this->UserRepository->getUserById($id); 
        // dd($user);
        if ($user instanceof \Exception) {
            return redirect('user')->with('error', $user->getMessage());
        }
        return view('Admin.user.edit_', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $id = decrypt($id);
        $user = $this->UserRepository->updateUser($request,$id); 
        if ($user instanceof \Exception) {
            return redirect('user')->with('error', $user->getMessage());
        }
        return redirect('user')->with('success', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            
            $id = decrypt($id); 
            DB::beginTransaction();
            user::find($id)->delete();
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'User has been deleted']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }
}
