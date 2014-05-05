<?php
/* PHP HTTP Tarpit
 * Purpose: Confuse and waste bot scanners time.
 * Use: Url rewrite unwanted bot traffic to this file. It is important you use Url rewrites not redirects as most bots ignore location headers.
 * Version: 1.0.0
 * Author: Chaoix
 *
 * Change Log:
 *	-Weighted Random defense to use HTTP Tarpit more often. (1.0.2)
 *	-Changed default defense to Random (4). (1.0.1)
 */
 
//Basic Options
$random_content_length = 1024; //In characters. Used to fill up the size of the scanner's log files.
$defense_number = 4; //1 is Blinding Mode, 2 is Ninja Mode, 3 is HTTP Tarpit, 4 is a Random defense for each request.
$debug = false; //Echo messages for testing the script.

function rand_content() {
	global $random_content_length;
	
	$random_prefixes = array( '', 'Public Key:', 'Private Key:'); //Send them down a wild goose chase.
	echo $random_prefixes[ rand( 0, count($random_prefixes) - 1 ) ];
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	for( $i = 0; $i < $random_content_length; $i++ ) {
		echo $chars[ rand( 0, $size - 1 ) ];
	}
}

//Randomize defense
if (4 == $defense_number) {
	//Weight random selection to use the Tarpit more often
	$number_sample = array(1, 2, 3, 3, 3, 3);
	$defense_number = $number_sample[ array_rand( $number_sample ) ];
}

switch ($defense_number) {
	//Blinding Mode
	case 1:
		header("HTTP/1.1 200 OK");
		rand_content();
		break;
	
	//Ninja Mode
	case 2:
		header("HTTP/1.1 404 Not Found");
		echo 'HTTP/1.1 404 Not Found';
		break;
	
	//HTTP Tarpit
	case 3:
		$rand_num = rand(0, 3);
		if (3 == $rand_num) {
			//Ask for unneccessary authentication
			header("HTTP/1.1 401 Not Authorized");
			header('WWW-Authenticate: realm="My Realm"');
			echo 'HTTP/1.1 401 Not Authorized'."\n";
			rand_content();
			break;
		}
		//Reply with random keep conection open status code.
		if (!$debug) {
			header("HTTP/1.1 10$rand_num"); 
			if(1 == $rand_num)
				header("Upgrade: HTTP/2.0"); //Ask client to request the page again.
		} else
			echo "HTTP/1.1 10$rand_num";
		break;
}

die(); //Stop kill php process to reduce resource overhead
