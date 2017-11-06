<?php
$message="This is a test";		
error_reporting(E_ALL);
echo $message;
ob_start();
require_once(dirname(__FILE__).'/html2pdf.class.php');
$html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
$html2pdf->WriteHTML($message);
$filename="Booking.pdf";
$pdf_file="bookingPDFs/".$filename;
$html2pdf->Output($pdf_file);
?>
	
	
	