<?php


$pdf = '
// You can put your HTML code here
< h1 > Lorem Ipsum... </ h1 >
< h2 > Lorem Ipsum... </ h2 >
< h3 > Lorem Ipsum... </ h3 >
< h4 > Lorem Ipsum... </ h4 >
';

require('MPDF/mpdf.php');



//$pdf = readfile("http://localhost/shravani_tourism/receipt_template.php?ticket=F7CE00412B586D401841");

// $pdf = get_remote_data('http://localhost/shravani_tourism/receipt_template.php?ticket=F7CE00412B586D401841');


 $curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, 'http://localhost/shravani_tourism/receipt.php?ticket=F7CE00412B586D401841');
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

    $pdf = curl_exec($curlSession);
    curl_close($curlSession);


$mpdf = new mPDF();
$mpdf->WriteHTML($pdf);
 
//call watermark content aand image
#$mpdf->SetWatermarkText('phpflow.COM');
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
 
 
//save the file put which location you need folder/filname
$mpdf->Output("demo.pdf",'I');
 
 
//out put in browser below output function
$mpdf->Output();

?>