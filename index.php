<?php
/**
 * @author      EtMDB Devs (developers@etmdb.com)
 * @copyright   15/08/2017
 * @license     https://www.etmdb.com/license
 * @version     1.1.0
 */

require_once(__DIR__ . '/init.php');

use EtMDB\TelegramBot\RequestHandler;
use EtMDB\TelegramBot\SystemLog;
use EtMDB\TelegramBot\DataHandler;
use EtMDB\TelegramBot\ApiAccessManager;

define('SEARCH_MOVIE', 0);
define('SEARCH_PEOPLE', 1);
define('SEARCH_CINEMA', 2);
define('SEARCH_COMPANY', 3);

SystemLog::addLog('-------------------------------------');
SystemLog::addLog('-------------------------------------');
SystemLog::addLog('-------------------------------------');
SystemLog::addLog('-------------------------------------');
SystemLog::addLog('Start process ....');


$requestHandler = new RequestHandler($config);
$apiAccessHandler = new ApiAccessManager($config);


$jsonFromMessenger=file_get_contents('php://input');
$input = json_decode($jsonFromMessenger, true);

$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$postbackMessage = $input['entry'][0]['messaging'][0]['postback']['payload'];

SystemLog::addLog($jsonFromMessenger);


 
 $message=null;
 switch($postbackMessage){
 case 'GET_STARTED_PAYLOAD':
	  $message="GET_STARTED_PAYLOAD";
	 break;	 	 	 
	 case 'CINEMA_SCHEDULE_PAYLOAD':
	 	  $message="CINEMA_SCHEDULE_PAYLOAD";

	 break;	 	 	
	 case 'SEARCH_MOVIES_PAYLOAD':
	 	  $message="SEARCH_MOVIES_PAYLOAD";

	 break;
	 	 case 'SEARCH_ACTORS_PAYLOAD':
	 	  $message="SEARCH_ACTORS_PAYLOAD";

	 break;

	 	 case 'SEARCH_CINEMAS_PAYLOAD':
	 	  $message="SEARCH_CINEMAS_PAYLOAD";

	 break;
	 	 case 'SEARCH_FILM_COMPANIES_PAYLOAD':
	 	  $message="GET_STARTED_PAYLOAD";

	 break;

 }
 
 

 $requestHandler->sendTextMessage($senderId, $message);
 
 
 
 
   //$jsonFromETMDB = $requestHandler->search("a", SEARCH_MOVIE);	
   
SystemLog::addLog("Showing list: ".$requestHandler->showHorizontalListResults($senderId));	
 

?>