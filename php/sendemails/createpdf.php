<?php
require('fpdf.php');
require 'PHPMailerAutoload.php' ;
$mail = new PHPMailer ;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com' ;
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';

$mail->Username='hbkfanxx1xx@gmail.com';
$mail->Password='IlYeS000';

$mail->setFrom('hbkfanxx1xx@gmail.com');
$mail->addAddress('Benmoussailyes13@gmail.com');
$mail->addReplyTo('hbkfanxx1xx@gmail.com');


$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("watchlist.pdf");

/*
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
*/
$pdfdoc = $pdf->Output('', 'S');
$mail->addStringAttachment($pdfdoc, 'my-doc.pdf');

$mail->isHTML(true);
$mail->Subject='PHP TEST';
$mail->Body='this is a test mail sent by php';

if(!$mail->send()){
	echo "message not sent : " ;
	echo  $mail->ErrorInfo ;
}
else {
	echo "message has been sent" ;
}

?>