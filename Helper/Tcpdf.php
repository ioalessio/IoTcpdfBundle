<?php
/**
* TCPDF Bridge
*
* @author ioalessio
*/
namespace Io\TcpdfBundle\Helper;
use Symfony\Component\HttpFoundation\Response;

class Tcpdf extends \TCPDF
{
    public function init(array $options = array())
    {
        // set document information
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('Alessio');
        $this->SetTitle('Test');
        $this->SetSubject('TCPDF test');
        $this->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $this->SetHeaderData(isset($options['logo']) ? $options['logo'] : '', PDF_HEADER_LOGO_WIDTH, isset($options['title']) ? $options['title'] : '', isset($options['subtitle']) ? $options['subtitle'] : '');

        // set header and footer fonts
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margins
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $this->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $this->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $this->AddPage();

    }
    /**
     */
    public function quick_pdf($html, $file = "html.pdf", $format = "S", array $options = array())
    {
        $this->init($options);

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $this->writeHTML($html, true, false, true, false, '');

        $response =  new Response($this->Output($file, $format));
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;

    }
}
