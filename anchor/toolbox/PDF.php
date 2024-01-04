<?php

namespace app\anchor\toolbox;

require_once('vendor/tecnickcom/tcpdf/tcpdf.php');
use TCPDF;

class PDF{
  /**
   * PDF output
   * @param string $html 
   * @return void
   */
    function output($html){
      	// Paper orientation: portrait (L), unit: mm, paper size: A4.
        $tcpdf = new TCPDF('L', "mm", 'A4', true, "UTF-8");
        $tcpdf->SetFont('times', '', 12);// font

        // Remove custom headers (top and bottom margins), create templates
        $tcpdf->setPrintHeader(false);
        $tcpdf->setPrintFooter(false);
        $tcpdf->AddPage();

        $tcpdf->WriteHTML($html, true, 0, false, true, 'L');
        ob_end_clean();
        $tcpdf->Output('test.pdf', 'D');
    }
}
