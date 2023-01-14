<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('tcpdf')) {
    function tcpdf($judul = 'View PDF', $subject = '', $signer = '', $orientation = 'p', $pdf_unit = 'cm', $pdf_page_format = 'A4', $margin = NULL, $watermark = false, $kop_surat = false, $uuid = false, $revisi_sistem = false, $version = '2.0', $footer = false, $watermark_text = false, $font = array('arial', '11'), $version_core = 1)
    {
        if ($version_core == 1) {
            $pdf = new My_extend_tcpdf($orientation, $pdf_unit, $pdf_page_format, true, 'UTF-8', false, false, $watermark, $kop_surat, $uuid, $revisi_sistem, $version, $footer, $watermark_text);
        } elseif ($version_core == 2) {
            $pdf = new My_extend_tcpdf_1($orientation, $pdf_unit, $pdf_page_format, true, 'UTF-8', false, false, $watermark, $kop_surat, $uuid, $revisi_sistem, $version, $footer, $watermark_text);
        }

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('@hisyambsa');
        $pdf->SetTitle($judul);
        $pdf->SetSubject($subject);
        $pdf->SetKeywords('TCPDF');

        // set default header data
        // if ($watermark) {
        // } else {
        //     $pdf->setPrintHeader(false);
        //     $pdf->setPrintFooter(false);
        // }
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setHeaderData(false);
        $pdf->setFooterData(false);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        if (is_array($margin)) {
            $margin_left = $margin[0];
            $margin_top = $margin[1];
            $margin_right = $margin[2];
            $margin_bottom = $margin[3];
            $pdf->SetMargins($margin_left, $margin_top, $margin_right);
            $pdf->SetAutoPageBreak(TRUE, $margin_bottom);
        } else {
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        }
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
        $pdf->SetFooterMargin(0);

        // set auto page breaks

        // set image scale factor
        $pdf->setImageScale(1);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $ci = get_instance(); // CI_Loader instance
        $ci->load->config('config');
        $envi = (ENVIRONMENT == 'development') ? '/' . $ci->config->item('development_folder') : '';
        // if ($envi == 'development') {
        $path_certificate = $_SERVER['DOCUMENT_ROOT'] . $envi . '/credential/tcpdf.crt';
        $path_private_key = $_SERVER['DOCUMENT_ROOT'] . $envi . '/credential/tcpdf.crt';

        //in your case
        $certificate = 'file://' . realpath($path_certificate);
        $private_key = 'file://' . realpath($path_private_key);

        if (is_array($signer)) {
            $info = array(
                'Name' => '@hisyambsa',
                'Location' => implode(';', $signer),
                'Reason' => 'SIGNING : ' . $subject,
                'ContactInfo' => 'http://apps.len-telko.co.id/',
            );
        } else {
            $info = array(
                'Name' => '@hisyambsa',
                'Location' => $signer,
                'Reason' => 'SIGNING : ' . $subject,
                'ContactInfo' => 'http://apps.len-telko.co.id/',
            );
            // set document information

        }

        $pdf->setSignature($certificate, $private_key, 'lentelko', '', 1, $info);
        $pdf->SetProtection(array('modify', 'copy', 'annot-forms', 'fill-forms', 'extract', 'assemble'), '', null, 0, null);
        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.


        if (is_array($font)) {
            if ($font[0] != 'helvetica' and $font[0] != 'times') {;
                // convert TTF font to TCPDF format and store it on the fonts folder
                $fontname = TCPDF_FONTS::addTTFfont('application/libraries/tcpdf_font/' . $font[0] . '.ttf', 'TrueTypeUnicode', '', 96);
                $fontname = TCPDF_FONTS::addTTFfont('application/libraries/tcpdf_font/' . $font[0] . 'b.ttf', 'TrueTypeUnicode', '', 96);
                $fontname = TCPDF_FONTS::addTTFfont('application/libraries/tcpdf_font/zapfdingbats', 'TrueTypeUnicode', '', 96);
            }
            // use the font
            $pdf->SetFont($font[0], '', $font[1], '', false);
        } else {
            $pdf->SetFont($font[0]);
        }

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage($orientation, $pdf_page_format, TRUE);
        if ($kop_surat) {
            if (is_array($margin)) {
                $margin_left = $margin[0];
                if ($pdf->getPage() == 1) {
                    $margin_top = $margin[1] - 2;
                } else {
                    $margin_top = $margin[1];
                    //do nothing
                }
                $margin_right = $margin[2];
                $margin_bottom = $margin[3];
                $pdf->SetMargins($margin_left, $margin_top, $margin_right);
                $pdf->SetAutoPageBreak(TRUE, $margin_bottom);
            } else {
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            }
        }
        // set text shadow effect
        // $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));   
        return $pdf;
    }
    // /path/to/tcpdf/tools/tcpdf_addfont.php -i /path/to/fonts/arial.ttf
    // vendor/tecnickcom/tcpdf/tools/tcpdf_addfont.php -i /path/to/fonts/arial.ttf
    // vendor/tecnickcom/tcpdf/tools/tcpdf_addfont.php
}
