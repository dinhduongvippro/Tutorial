<?php
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
function exportfilepdf($data){
    //print_r($data[0]); exit;
    require_once('html2pdf.class.php');

    //ob_start();

    if($data['template'] != '')
        require_once($data['template']);
    else require_once('templatepdf.php');

    $content = ob_get_clean();
    //$content = '<page style="font-family: freeserif"><br />'.nl2br($content).'</page>';

    // convert to PDF
    try
    {
        
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('real');

        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        

        $html2pdf->Output($data['booking_id'].'-'.date('d-m-Y').'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo 'hello123';exit;
        echo $e;
        exit;
    }
}



