<?php

require_once('ses1.php');
$access_name = $argv[1];
$access_pwd  = $argv[2];
$ses  = new SimpleEmailService($access_name,$access_pwd);
print_r($ses);
$mail = new SimpleEmailServiceMessage();
print_r($mail);
#$ses->verifyEmailAddress('amitesh.purwar05@gmail.com');
print_r($ses->listVerifiedEmailAddresses());
#die;

$mail->addTo('grab.daily.deals@gmail.com');
//$mail->to= array("kushabhi4u@gmail.com");
$mail->to= array("amitesh.purwar05@gmail.com");

print_r($ses->getSendQuota());
#die;

//$mail->setFrom('Deals.on.Flipkart@gmail.com');
//$mail->setFrom('AVL36Gurgaon <grab.daily.deals@gmail.com>');
$mail->setFrom('Flipkart.com <grab.daily.deals@gmail.com>');


$mail->fromName      ="Offers And Deals";

$mail->setSubject('Things you could buy with just 99 Rs. | Flipkart');
//$mail->setSubject('Govt. Approved Affordable homes in Gurgaon that start at just Rs. 13.73 lacs!');
$body = stripslashes(file_get_contents('/home/ubuntu/html/flipkart_temp.html'));
$body = str_replace("mid=13mar_ni","mid=13mar_ni&email=amitesh.purwar05@gmail.com",$body);
$mail->setMessageFromString("",$body);
print_r($ses->sendEmail($mail));
die;
//sleep(2);
$file = '/home/ubuntu/emails/13mar_niswey.csv';
$handle = fopen($file, 'r');
$i = 0;
$count = 0;
while(!feof($handle)){
    $line = fgets($handle);
    #$data =explode(" ", $line);
	echo trim($line);
    $body = stripslashes(file_get_contents('/home/ubuntu/html/niswey_1.html'));
    $rep="";
    $rep="mid=13mar_ni&em=".trim($line);
    $body = str_replace("mid=13mar_ni",$rep,$body);
    $mail->to= array(trim($line));
    $mail->setMessageFromString("",$body);
    $ses->sendEmail($mail);
  //  $mail->clearAddresses();
    if($i == 14) {
    sleep(1);
    $i = 0;
    }
 $i++;
$count++;
}
//$mail->clearAllRecipients();
?>


