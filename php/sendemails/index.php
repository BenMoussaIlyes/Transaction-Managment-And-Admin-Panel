<?php

include("../database.php");
require_once 'dompdf/autoload.inc.php';
	require 'class/class.phpmailer.php';
	require 'PHPMailerAutoload.php' ;
use Dompdf\Dompdf ;
function fetch_customer_data($bdd,$cust)
{
        
    	$req='SELECT * FROM dataflex ' ;
    $req.="	where `CustID` = '$cust'" ;
    if (date('n')-1 != 0 ){
            $req.="	and month(`Dates`) = ".(date('n')-1) ;
            $req.="	and year(`Dates`) = ".(date('Y')) ;

    }
    else {
    $req.="	and year(`Dates`) = ".(date('Y')-1) ;
    }
    
    $rep=$bdd->query($req);
    
    	$output = '          <table class="table table-striped table-hover">
                    <thead>
                        <tr>
    
    
                            <th>TransID</th>
                            <th>Dates</th>
                            <th>CustID</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Banace</th>
                        </tr>
                    </thead>
                    <tbody> ' ;
    	
              foreach ( $rep as $i ){ 
    		  extract($i);
    				$output.= '
                        <tr> ' ;
    						
    
    
    						
                          $output.= "  <td>$TransID</td> " ;
                          $output.= "  <td>$Dates</td> " ;
                          $output.= "  <td>$CustID</td> " ;
                          $output.= "  <td>$Debit</td> " ;
                          $output.= "  <td>$Credit</td> " ;
                          $output.= "  <td>$Balance</td> " ;
                          $output.= '   </tr>'	 ;
    		  }
    		  
    		  
    	return $output;

}



$req2="	SELECT * FROM `customer` ";
$rep2=$bdd->query($req2);
foreach ($rep2 as $j){






	//echo fetch_customer_data($bdd , $j['CustID'] );
	$file_name = md5(rand()) . '.pdf';
	$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	$html_code .= '<link rel="stylesheet" href="style.css">';
	$html_code .= fetch_customer_data($bdd , $j['CustID'] );
	$pdf = new Dompdf();
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	file_put_contents($file_name, $file);
	

	
$mail = new PHPMailer ;
$mail->isSMTP();
$mail->Host = 'ssl://smtp.gmail.com' ;
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';
$mail->SMTPKeepAlive = true;   
$mail->Mailer = "“smtp”"; // don't change the quotes!

$mail->Username='hbkfanxx1xx@gmail.com';
$mail->Password='IlYeS000';

$mail->setFrom('hbkfanxx1xx@gmail.com');
$mail->addAddress( $j['Email'] ); //
$mail->addReplyTo('hbkfanxx1xx@gmail.com');

$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
	
$mail->Subject = 'Customer Details';			//Sets the Subject of the message
$mail->Body = 'Please Find Customer details in attach PDF File.';				//An HTML or plain text message body

$mail->isHTML(true);
if($mail->Send())								//Send an Email. Return true on success or false on error
	{
		$message = '<label class="text-success">Customer Details has been sent successfully to '.$j['CustID'].' : '.$j['Email'].' </label><br>';
	}
	else 	{
		$message = '<label class="text-danger">Customer Details was not sent to '.$j['CustID'].' : '.$j['Email'].' '. $mail->ErrorInfo.'</label><br>' ;
	} /*	 */
	unlink($file_name);
				//echo fetch_customer_data($bdd , $j['CustID'] );
				echo $message ;

}


?>
<br>
<a href="../index.php">Back to dashboard</a>







