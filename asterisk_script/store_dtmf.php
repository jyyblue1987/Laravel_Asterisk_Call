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

		$exten = $argv[1];
		$result1 = $argv[2];
		$result2 = $argv[3];

		if (isset($result2)) {

		$stmt = $pdo->prepare("INSERT INTO dtmf_logs (exten,result1,result2) VALUES (:exten,:result1,:result2)");

				$stmt->bindParam(':exten', $exten);
				$stmt->bindParam(':result1', $result1);
				$stmt->bindParam(':result2', $result2);
				$stmt->execute();

			}
			else
			{
			$stmt = $pdo->prepare("INSERT INTO dtmf_logs (exten,result1) VALUES (:exten,:result1)");

					$stmt->bindParam(':exten', $exten);
					$stmt->bindParam(':result1', $result1);
					$stmt->execute();

			}

?>
