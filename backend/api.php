<?php
echo "adasdsa";
die();
//Allow from any origin
if(isset($_SERVER["HTTP_ORIGIN"]))
{
    // You can decide if the origin in $_SERVER['HTTP_ORIGIN'] is something you want to allow, or as we do here, just allow all
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
}
else
{
    //No HTTP_ORIGIN set, so we allow any. You can disallow if needed here
    header("Access-Control-Allow-Origin: *");
}

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 600");    // cache for 10 minutes

if($_SERVER["REQUEST_METHOD"] == "OPTIONS")
{
    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT"); //Make sure you remove those you do not want to support

    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    //Just exit with 200 OK with the above headers for OPTIONS method
    exit(0);
}

require_once 'lib/RunRobot.php';



// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'),true);

$argv = array(0=>'api.php');

if ($method  =="POST"){
	// 
	
	switch (trim($input['do'])) {
		case 'place':
			$argv[] = 'PLACE'.$input['placeX'].','.$input['placeY'].",".$input['placeDirection'];
			$argv[] = strtoupper($input['do']);
		
			$robotApp = new RunRobot($argv);

			break;
		case 'move':
			$argv[] = 'PLACE'.$input['placeX'].','.$input['placeY'].",".$input['placeDirection'];
			$argv[] = strtoupper($input['do']);
			$robotApp = new RunRobot($argv);

			break;
		case 'left':
			$argv[] = 'PLACE'.$input['placeX'].','.$input['placeY'].",".$input['placeDirection'];
			$argv[] = strtoupper($input['do']);

			$robotApp = new RunRobot($argv);

			break;

		case 'right':
			$argv[] = 'PLACE'.$input['placeX'].','.$input['placeY'].",".$input['placeDirection'];
			$argv[] = strtoupper($input['do']);
		
			$robotApp = new RunRobot($argv);

			break;
		case 'report':
			$argv[] = 'PLACE'.$input['placeX'].','.$input['placeY'].",".$input['placeDirection'];
			$argv[] = strtoupper($input['do']);
		
			$robotApp = new RunRobot($argv);

			break;
	}

}



?>