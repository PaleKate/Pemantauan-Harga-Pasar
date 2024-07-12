<?php 
	require '../html2pdf/html2pdf.php';
    
    try {
    	// first fill in the license that you received upon sign-up
    	$pdf = new HTML2PDF ();
    	
    	// now set the options, so for example when we want to have a page in A4 in orientation portrait
    	$pdf->SetPageSize('F4');
    	$pdf->SetPageOrientation('Portrait');
    	
    	// then do the conversion - this is how you convert Google to PDF and display the PDF to the user
    	$pdf->CreateFromURL ('harga-pdf.php');
    	
    	// if you'd rather convert raw HTML then you would use this function instead
    	//$pdf->CreateFromHTML('Your HTML here');
    	$pdf->Display();
    	
    }  catch (Exception $error) {
    	   echo $error->getMessage();
    	   echo $error->getCode();
    }
?>