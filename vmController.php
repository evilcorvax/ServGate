<?php

	include ('Net/SSH2.php');
	$ssh = new Net_SSH2('144.76.67.203');
		if (!$ssh->login('root', 'LG<deP#%"sq^CWX8jx')) {
    			exit('Login Failed');
		}


	function strparsing($_str) {
  		$mod=substr($_str, strpos($_str,'"')+1,-2);
   		return $mod;
  	}

	function getsumm_vm ($ssh,$i) {

		$name = $ssh->exec('vim-cmd vmsvc/get.summary '.($i).' | egrep name');
		$powstate = $ssh->exec('vim-cmd vmsvc/get.summary '.($i).' | egrep power');
		$ipvm = $ssh->exec('vim-cmd vmsvc/get.summary '.($i).' | egrep ip');
		$summ_arr[] = strparsing($name);
		$summ_arr[] = strparsing($powstate);
		$summ_arr[] = strparsing($ipvm);
		return $summ_arr;
	}

	function powstate_change($ssh,$i,$powstate) {
		if ($powstate == "poweredOn") {
			$ssh -> exec('vim-cmd vmsvc/power.on '.$i);
		};
		if ($powstate == "poweredOff") {
			$ssh -> exec('vim-cmd vmsvc/power.off '.$i);	
		};

	}

	function onpaused($ssh,$i,$powstate) {
		if ($powstate == "poweredOn") {
			$ssh -> exec('vim-cmd vmsvc/power.suspend '.$i);	
		};

		if ($powstate == "suspended") {
			$ssh -> exec('vim-cmd vmsvc/power.suspendResume '.$i);	
		};
	}

	function createsnapshot($ssh,$i,$powstate) {
		if ($powstate == "poweredOn") {
			$ssh -> exec('vim-cmd vmsvc/snapshot.create '.$i);	
		}
	}

	


	// foreach (getsumm_vm($ssh,1) as $value) {
	// echo($value);

  	//}
	


?>