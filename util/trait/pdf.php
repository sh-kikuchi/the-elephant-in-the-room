<?php
require_once('vendor/tecnickcom/tcpdf/tcpdf.php');

trait PDF{
    function output($html){
      	// 用紙の向き:縦(L)、単位:mm、用紙サイズ:A4 で作成
        $tcpdf = new TCPDF('L', "mm", 'A4');

        // カスタムヘッダーを削除（上下余白を消す）、ページを作成
        $tcpdf->setPrintHeader(false);
        $tcpdf->setPrintFooter(false);
        $tcpdf->AddPage();

        $tcpdf->WriteHTML($html, true, 0, false, true, 'L');

        // 変換してPDFをファイルに保存
        $fileName = rtrim(getcwd(), '\\/').DIRECTORY_SEPARATOR.'sample.pdf';
        $tcpdf->Output($fileName, 'F');
    }
}
