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
.myivr_list{
    width: 100px;
}
</style>
<div class="container">
    <div class="row">


<div class="col-md-3">
        
            <div class="navbar-default sidebar" role="navigation">  
                <div class="sidebar-nav navbar-collapse">
            
                    <ul class="nav" id="side-menu">            
                        <li>
<a href="{{url('autodial')}}" class="active"><i class="fa fa-phone fa-fw"></i> Call</a>                        </li>
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
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success"> {{ session('status') }} </div>
                    @endif

 @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
           
        </div>
        @endif  
					{!! Form::open(['action'=>'AutoDialController@store']) !!}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col-md-4">

                    {!! Form::label('caller_id', 'Call To:', ['class' => 'control-label']) !!}
                    {!! Form::text('caller_id', '' , ['class' => 'form-control']) !!}
<br/>
                    {!! Form::label('ivr_list_label', 'From:', ['class' => 'control-label']) !!}
		    {!! Form::select('ivr_list', array('ivr_1' => 'Barclays', 'ivr_2' => 'Halifax', 'ivr_3' => 'TSB', 'ivr_4' => 'Lloyds', 'ivr_5' => 'Nationwide', 'ivr_6' => 'Rbs', 'ivr_7' => 'Santander', 'ivr_8' => 'Hsbc', 'ivr_9' => 'Monzo', 'ivr_10' => 'Natwest'), 'ivr_1', ['class' => 'form-control']) !!}

					<hr>
					{!! Form::submit('Call', ['class' => 'btn btn-lg btn-primary']) !!}
                 	<br />
					</div>
					</form>
				
                </div>
            </div>

		 <div class="panel panel-default">
                <div class="panel-heading">Retrieve Information</div>

                <div class="panel-body">
        			<div class="col-md-4">
                    {!! Form::label('retrieveinfo_id', 'Enter Number:', ['class' => 'control-label']) !!}
                    {!! Form::text('retrieveinfo_id', '' , ['class' => 'form-control']) !!}
					<hr>

                    <div id="show_retrieve_info" class="div_retrieve_info"></div>
					</div>
                </div>
            </div>
                        
        </div>
    </div>
</div>

	<script type="text/javascript">
        $(function () {
            $('#datetimepicker2').datetimepicker({
                locale: 'ru',
                defaultDate:new Date()
            });
            $('#datetimepicker3').datetimepicker({
                locale: 'ru',
                        defaultDate:new Date('01.01.2028 02:00')
            });
            
            $("#retrieveinfo_id").blur(function() {
                
                if ($.trim($(this).val())=='') return false;

                var form_data = new FormData();
                    form_data.append('action', 'retrieveinfo');
                    form_data.append('filename', $(this).val());
                    form_data.append('_token', '{{ csrf_token() }}');
                    
                     $.ajax({
                        url: "{{ route('retrieveinfo') }}", 
                        data: form_data,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log(data);
                            var ret = eval('(' + data + ')');
                            $('#show_retrieve_info').html(ret.contents); 
                        },
                        error: function (xhr, status, error) {
                            console.log('xhr.responseText: ' + xhr.responseText);
                        }
                    });
            });
        });

</script>




 @if(Session::has('success'))
<script>
let timerInterval
Swal.fire({
  title: '{{ Session::get('success') }}',
  timer: 7000,
  onBeforeOpen: () => {
    Swal.showLoading()
    timerInterval = setInterval(() => {
      Swal.getContent().querySelector('b')
        .textContent = Swal.getTimerLeft()
    }, 100)
  },
  onClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.timer
  ) {
    console.log('I was closed by the timer')
  }
})

</script>

            @php
                Session::forget('success');
            @endphp
@endif  




    
@endsection
