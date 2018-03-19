<?php
	
    

	function _getvalue ($pin)
	{
        require ('config.php');
		$ch = curl_init();
        $url = $res_ip.$pin."/value";
        $username = $conf_username;
        $password = $conf_password;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch); 

        return $output;
	}

	function _getfunc ($pin)
	{
        require ('config.php');
		$ch = curl_init();
        $url = $res_ip.$pin."/function";
        $username = $conf_username;
        $password = $conf_password;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch); 

        return $output;
	}

       function _logcond() {
                $nowtime = date('H-i-s-j-m-y');
                $fh = fopen("logs/loggpio-".$nowtime.".txt",'w') or die ("Couldn't create the output log file");

              for($i = 2; $i<28; $i++)
        {
                $logvaluearray[$i] = _getvalue($i);
                $logfuncarray[$i] = _getfunc($i);
                $log = "The GPIO Pin is ".$i.": "."Condition is ".$logvaluearray[$i]." and function on is ".$logfuncarray[$i];
                fwrite($fh, $log) or die("Couldn't create the log file");

        } 
                fclose($fh);
               
             

        } 

	/* for($i = 2; $i<28; $i++)
	{
		$valuearray[$i] = _getvalue($i);
		$funcarray[$i] = _getfunc($i);

		print "The GPIO Pin is ".$i.": "."Condition is ".$valuearray[$i]." and function on is ".$funcarray[$i];
		echo "<br>";
		echo "<br>";
		

	}

	//print_r($valuearray);
	//print_r($funcarray);







        if (isset($_POST['btn']))
            _logcond();


	?>



    <form method='post'>
        <input type='submit' value='Log it!' name='btn'>
    </form> 
    */          