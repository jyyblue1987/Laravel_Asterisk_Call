@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
						
                    @endif
					<form action="" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col-md-4">
					{!! Form::label('Number', 'Number:', ['class' => 'control-label']) !!}
					{!! Form::text('number', null , ['class' => 'form-control']) !!}
                    {!! Form::label('EverySecond', 'Every X seconds:', ['class' => 'control-label']) !!}
					{!! Form::text('seconds', null , ['class' => 'form-control']) !!}
					{!! Form::label('CallerIDPrefix', 'CallerID prefix:', ['class' => 'control-label']) !!}
					{!! Form::text('cid_prefix', null , ['class' => 'form-control']) !!}
					{!! Form::label('DateTime Start', 'Start at:', ['class' => 'control-label']) !!}
					<div class='input-group date' id='datetimepicker2'>
                    <input type='text' name="startdate" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
					</div>
					{!! Form::label('DateTimeStop', 'Stop at:', ['class' => 'control-label']) !!}
					<div class='input-group date' id='datetimepicker3'>
                    <input type='text' name="stopdate" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
					
					</div>
					<hr>
					<button type="submit" class="btn btn-primary">Start</button>
					</div>
					</form>
					        <script type="text/javascript">
            $(function () {
                $('#datetimepicker2').datetimepicker({
                    locale: 'ru',
					defaultDate:new Date()
                });
				$('#datetimepicker3').datetimepicker({
                    locale: 'ru'
                });
            });
        </script>
                </div>
            </div>



        </div>
    </div>
	<div class="row">
	        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Active Calls</div>

                <div class="panel-body">
	        <div class="table-scrollable">
			    <table class="table table-striped table-bordered table-hover">
    		    <thead>
			    <tr>
                   <th>number</th>
            	    <th>every X seconds</th>
<!--            	    <th>RX</th> -->
<!--            	    <th>TX</th> -->
            	    <th>Next Call</th>
					<th>Stop at</th>
					<th>CallerID prefix</th>
                  <th>Actions</th>
        	    </tr>
			    </thead>
    		    <tbody>
    		    @foreach($callsettings as $key => $value)
        	    <tr>
            	  <td>{{ $value->number }}</td>
                  <td>{{ $value->seconds }}</td>
                  <td>{{ $value->last_call }}</td>
				  <td>{{ $value->stop_call }}</td>
				  <td>{{ $value->cid_prefix }}</td>
				  <td>
				  <a class="btn btn-primary btn-sm btn-danger" href="{{ URL::to('home/delete/'.$value->id) }}"><i class="fa fa-trash"></i> Stop</a>
				  </td>
   	        </td>
        	    </tr>
    		    @endforeach
    		    </tbody>
			    </table>
				
			</div>
			</div>
			</div>
		</div>
		<div>
		</div>
</div>
@endsection
