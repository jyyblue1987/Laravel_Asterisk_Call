<?php
	//date_default_timezone_set();
	date_default_timezone_set('UTC');
	require_once('AsteriskAMI.class.php');
    $host = '127.0.0.1';
    $db   = 'laravel';
    $user = 'laravel';
    $pass = 'LaravelPassw0rd';
    $charset = 'utf8';
	$port='3306';

    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);
	
	$stmt = $pdo->prepare("DELETE FROM call_settings WHERE stop_call<=:stop_call");
			$time_now = date('Y-m-d H:i:s');
			$stmt->bindParam(':stop_call', $time_now);
			$stmt->execute();
	foreach($pdo->query('SELECT id,number,seconds,last_call,cid_prefix FROM call_settings WHERE context IS NULL') as $row) {
        //print_r($row);
		//echo date('Y-m-d H:i:s');
		$diff = strtotime(date('Y-m-d H:i:s')) - strtotime($row['last_call']);
		//echo $diff;
		if ($diff>=$row['seconds'])
		{
			$ast=new AsteriskAMI();
			//$to = '447392695851';
			$to = $row['number']."-".$row['cid_prefix'];
			$ast->make_call($to);
			
			$time_now = date('Y-m-d H:i:s');
			$stmt = $pdo->prepare("UPDATE call_settings SET last_call=:last_call WHERE id=:id");
			$stmt->bindParam(':id', $row['id']);
			$stmt->bindParam(':last_call', $time_now);
			$stmt->execute();
		}
    }
	//$active_calls=$pdo->prep("SELECT id,number,seconds,last_call FROM call_settings",PDO::FETCH_ASSOC);
	//$active_calls->execute();
	//print_r($active_calls);
	//foreach 
	//$stmt = $pdo->prepare("INSERT INTO ss_pickups (sid_original, sid_pickup) VALUES (:sid_original, :sid_pickup)");
	//$stmt->bindParam(':sid_original', $sid_original);
	//$stmt->bindParam(':sid_pickup', $sid_pickup);
	//$stmt->execute();
?>
