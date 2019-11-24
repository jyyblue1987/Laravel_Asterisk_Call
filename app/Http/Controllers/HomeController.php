<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CallSettings;

class HomeController extends Controller
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
        return view('home')
		->with('callsettings',$callsettings);
    }
	
	public function start(Request $request)
    {
		$newcall = new CallSettings;
		$newcall->number = $request->number;
		$newcall->seconds = $request->seconds;
		$newcall->cid_prefix = $request->cid_prefix;
		$newcall->last_call = date("Y-m-d H:i:s",strtotime($request->startdate));
		$newcall->stop_call = date("Y-m-d H:i:s",strtotime($request->stopdate));
		$newcall->save();
		return redirect('autodial');
    }
	
    public function stop($id)
    {
		$stopcall = CallSettings::Find($id);
		$stopcall->delete();
		return redirect('autodial');
    }

    public function stopall()
    {
                CallSettings::truncate();
                return redirect('autodial');
    }
}
