

<?php

ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");


// the message
if (isset($_GET['submit'])){
$msg = $_GET['text'] ;

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
$headers = 'From: <hbkfanxx1xx@gmail.com>' . "\r\n";

mail("benmoussailyes13@gmail.com",$_GET['subject'],$msg,$headers );
}
?>
<html>
<body>
<form>
<input name="subject" placeholder="subject" type="text">
<input name="text" placeholder="text" type="text">
<input name="submit" type="submit">

</form>
</body>
</html>