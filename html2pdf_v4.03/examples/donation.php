<?php





$DonateID=$_GET['DonateID'];
$currency=$_GET['currency'];	
$payshul=$_GET['payshul'];			

/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
  
    // get the HTML http://smaatapps.com/Myshul/website_dev/index.php/invoicewithtax/index/3/
    ob_start();
   
	include(dirname(__FILE__).'/res/donation.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml'],$DonateID,$currency,$payshul));
		$my_string = substr(str_shuffle(MD5(microtime())), 0, 6); 
       // $html2pdf->Output("invoice.pdf"); 
		$path='../../invoice/donate'.$DonateID.'.pdf';
		$html2pdf->Output($path, 'F');
		$html2pdf->Output("donation.pdf");
		 
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
