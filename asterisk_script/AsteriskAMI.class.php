<?php
class AsteriskAMI
{
    public $conn;
    public $host;
    public $port;
    public $login;
    public $password;
    
    function __construct ()
    {
        $this->conn=true;
        $this->host = "127.0.0.1";
        $this->port = "5038";
        $this->login= "calls";
        $this->password = "212215842";
        
//        $this->conn=false;
//        $this->host = "";
//        $this->port = "5038";
//        $this->login= "";
//        $this->password = "";

    }

    function __destruct()
    {
        
    }

    public function make_call($to)
    {
		$this->conn = fsockopen($this->host,$this->port, $errno, $errstr);
		fputs($this->conn, "Action: Login\r\n");
		fputs($this->conn, "UserName: ".$this->login."\r\n");
		fputs($this->conn, "Secret: ".$this->password."\r\n\r\n");
		fputs($this->conn, "Action: Command\r\n");
		//fputs($this->conn, "Command: channel originate SIP/trunk-out/".$to." extension ".$to."@localplayback\r\n\r\n");
		fputs($this->conn, "Command: channel originate Local/".$to."@outgoing extension ".$to."@localplayback\r\n\r\n");
		//fputs($this->conn, "Command: reload\r\n\r\n");
		$wrets=fgets($this->conn,128);
		fputs($this->conn, "Action: Logoff\r\n\r\n");
		
        fclose($this->conn);
	}


    public function make_call_context($from,$to,$context)
    {
        $this->conn = fsockopen($this->host,$this->port, $errno, $errstr);
        fputs($this->conn, "Action: Login\r\n");
        fputs($this->conn, "UserName: ".$this->login."\r\n");
        fputs($this->conn, "Secret: ".$this->password."\r\n\r\n");
        fputs($this->conn, "Action: Command\r\n");
        //fputs($this->conn, "Command: channel originate SIP/trunk-out/".$to." extension ".$to."@localplayback\r\n\r\n");
        fputs($this->conn, "Command: channel originate Local/".$to."-".$from."@outgoing_cid extension ".$to."@".$context."\r\n\r\n");
        //fputs($this->conn, "Command: reload\r\n\r\n");
        $wrets=fgets($this->conn,128);
        fputs($this->conn, "Action: Logoff\r\n\r\n");
        
        fclose($this->conn);
    }
}

//$ast=new AsteriskAMI();
//$to = '447392695851';
//print_r( $ast->make_call($to));
?>