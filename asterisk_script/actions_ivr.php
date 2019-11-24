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
	
	$stmt = $pdo->prepare("DELETE FROM call_settings WHERE amount_done>=amount_planned");
	$stmt->execute();
	
	foreach($pdo->query('SELECT id,number,cid,context FROM call_settings where last_call<=NOW() AND context LIKE \'ivr_%\'') as $row) {
        print_r($row);
		//echo date('Y-m-d H:i:s');
		$diff = strtotime(date('Y-m-d H:i:s')) - strtotime($row['last_call']);
		//echo $diff;
		if ($diff>=$row['seconds'])
		{
			$to = $row['number'];
			$from =$row['cid'];
			$context = $row['context'];
			$ast=new AsteriskAMI();
			$ast->make_call_context($from,$to,$context);
			
			$stmt = $pdo->prepare("UPDATE call_settings SET amount_done=amount_done+1 WHERE id=:id");
			$stmt->bindParam(':id', $row['id']);
			$stmt->execute();
		}
    }
?>
