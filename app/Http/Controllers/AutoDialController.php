<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CallSettings;
use App\Record;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AutoDialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $callsettings = CallSettings::all();
    //return $callsettings;
        return view('autodial')
    ->with('callsettings',$callsettings);
    }

    public function store(Request $request)
    {
           if($request->caller_id) 
             {
    

                $offset = 0;
                $tick = 0;
                $offset_time = date('Y-m-d H:i:s',time() + $offset);
                //echo "Строка #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";

                    $newcall = new CallSettings;
                    $newcall->number = $request->caller_id;
                    
                    

                    //echo "tick=".$tick."-".$offset_time;
                    //echo "</br>"; 
//        $callto = DB::select('select number from ongoing_calls where id = 1');
//  foreach ($callto as $callnum) {
//       $newcall->cid=$callnum->number;
//  }

                    $newcall->cid='';
//              $newcall->user_id= Auth::id();
                    $newcall->amount_done=0; 
                    $newcall->amount_planned=1; 
//                   $newcall->context='ivr';
//                    $newcall->context=$request->ivr_list;
		    $mycontext=Input::only('ivr_list');
		    $newcall->context = $mycontext['ivr_list'];
                    $newcall->last_call = date("Y-m-d H:i:s",strtotime($offset_time));
                    $newcall->save();


                }
 return redirect()->back()->with('success','Call in progress , try and retrieve after this closes');
           
    }

      public function stopall()
    {
                CallSettings::truncate();
                return redirect('autodial');
    }


    public function show(Request $request)
    {
    $contents = "--";
    //$file = '/root/info-' . $request -> filename . '.txt';
    $file = public_path() . '/call_files/info-' . $request -> filename . '.txt';
    if (file_exists($file)==false) {
         $contents = "<span style='color:red'>They did not answer or give it.. better luck next time</span>"; // . $file;
    } else {
      $contents = file_get_contents($file);
      //$contents = str_replace(chr(13), '<br />', $contents);
      $contents = nl2br($contents,false);
      

// $check = Record::where('user_id',Auth::user()->id)->where('result',$contents)->count();

     $record= new Record;
     $record->user_id = Auth::user()->id;
     $record->number=$request ->filename;
     $record->result=$contents;
     $record->save();

}



    //$contents = 'Here are content of ' . $request -> filename;
        return json_encode(array('contents' => $contents));
    }



public function logresult(){
$title='All Logs';    
$logs=Record::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
return view('result',compact('logs','title'));
}


    
}
