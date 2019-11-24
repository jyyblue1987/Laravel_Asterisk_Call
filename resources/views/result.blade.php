@extends('layouts.app')
@section('content')
<style type="text/css">
.div_retrieve_info {
	width:350px;
	height:auto;	
}
input[type="radio"]{
  margin: 0 8px 0 0px;
}
</style>
<div class="container">
    <div class="row">

<div class="col-md-3">
        
            <div class="navbar-default sidebar" role="navigation">  
                <div class="sidebar-nav navbar-collapse">
            
                    <ul class="nav" id="side-menu">            
                        <li>
                            <a href="{{url('autodial')}}" class="active"><i class="fa fa-phone fa-fw"></i> Call</a>
                        </li>
                        <li>
                            <a href="{{url('log')}}"><i class="fa fa-tty fa-fw"></i> Log</a>
                        </li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Log</div>
                <div class="panel-body">
 @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif  
					
 <table class="table table-striped">
    <thead>
      <tr>
        <th>Timestamp</th>
        <th>Name</th>
        <th>Number</th>
        <th>---OTP---</th>
      </tr>
    </thead>
    <tbody>
@foreach($logs as $log)
      <tr>
        <td>{{$log->created_at}}</td>
        <td>{{Auth::user()->name}}</td>
        <td>{{$log->number}}</td>
        <td><b>{!!$log->result!!}</b></td>
      </tr>

@endforeach;

    </tbody>
  </table>
{{ $logs->links() }}




					</div>
			
                </div>
            </div>

                        
        </div>
    </div>
</div>

	
    
@endsection
