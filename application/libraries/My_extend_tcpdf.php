<?php


class My_extend_tcpdf extends TCPDF
{

    protected $watermark = FALSE;
    protected $watermark_text = 'PREVIEW';
    protected $kop_surat = FALSE;
    protected $uuid = FALSE;
    protected $version = FALSE;
    protected $footer = FALSE;



    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false, $watermark = false, $kop_surat = false, $uuid = false, $revisi_sistem = false, $version = '2.0', $footer = false, $watermark_text = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
        $this->watermark = $watermark;
        $this->kop_surat = $kop_surat;
        $this->uuid = $uuid;
        $this->revisi_sistem = $revisi_sistem;
        $this->version = $version;
        $this->footer = $footer;
        if ($watermark_text) {
            $this->watermark_text = $watermark_text;
        }
    }

    public function Header()
    {
        if ($this->kop_surat) {
            if ($this->page == 1) {
                $this->kop_surat();
            } else {
                //do nothing
            }
        }
        if ($this->watermark) {
            $this->watermark();
        }
    }
    public function Footer()
    {
        if ($this->footer) {
            $this->generated();
        }
    }
    public function kop_surat()
    {
        $CI = &get_instance();

        $envi = (ENVIRONMENT == 'development') ? '/' . $CI->config->item('development_folder') : '';
        $image = $_SERVER['DOCUMENT_ROOT'] . $envi . '/application/views/tempelate_pdf/img/logo_full_transparant.png';
        $html = '<table class="mceNonEditable" style="border-collapse: collapse; width: 115%;  margin-left: auto; margin-right: auto;" border="0">
            <tbody>
                <tr style="width: 100; color:rgb(0, 93, 167);">
                    <td style="width: 50%;">&nbsp;</td>
                    <td style="width: 10%;">&nbsp;</td>
                    <td style="width: 40%; font-size:7.5px;">
                        &nbsp;
                        <br>
                        PT Len Telekomunikasi Indonesia
                        <br>
                        Menara MTH M Floor Suite M-02
                        <br>
                        Jl. Letjen MT Haryono Kav 23
                        <br>
                        Jakarta 12820
                        <br>
                        Tlpn: +62 21 2283 3872 / +62 81 1953 0600
                        <br>
                        Email: kontak@len-telko.co.id
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>';

        // $this->setCellHeightRatio(1.0);
        $this->writeHTML($html, true, false, true, false, '');


        $image_location = $_SERVER['DOCUMENT_ROOT'] .  $CI->config->item('envi') . '/gambar/logo_16-9.png';
        $this->Image($image_location, 0.5, -0.5, 6.4, 3.6, '', '', '', false, 300, '', false, false, 1, false, false, false);

        $width_page = $this->getPageWidth();
        $style = array('width' => 0.1, 'solid' => '2,2,2,2', 'phase' => 0, 'color' => array(0, 93, 167));
        $this->Line(0.5, 2.6,  $width_page - 0.5, 2.6, $style);
        $style = array('width' => 0.03, 'solid' => '2,2,2,2', 'phase' => 0, 'color' => array(0, 93, 167));
        $this->Line(0.5, 2.7,  $width_page - 0.5, 2.7, $style);
    }
    public function watermark()
    {
        // Get the current page break margin
        $bMargin = $this->getBreakMargin();

        // Get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;

        // Disable auto-page-break
        $this->SetAutoPageBreak(true, 1);

        // Define the path to the image that you want to use as watermark.

        $fontName = "Helvetica";
        $fontSize = 135;
        $fontStyle = "B";

        // Calcular ancho de la cadena
        $widthCadena = $this->GetStringWidth(trim("MY TEXT"), $fontName, $fontStyle);
        $factorCentrado = round(($widthCadena * sin(deg2rad(45))) / 2, 0);

        // Get the page width/height
        $myPageWidth = $this->getPageWidth();
        $myPageHeight = $this->getPageHeight();

        // Find the middle of the page and adjust.
        $myX = ($myPageWidth / 2) - $factorCentrado - 10;
        $myY = ($myPageHeight / 2) - $factorCentrado + 5;

        // Set the transparency of the text to really light
        $this->SetAlpha(0.09);

        // Rotate 45 degrees and write the watermarking text
        $this->StartTransform();
        $this->Rotate(45, $myX, $myY);
        $this->SetFont($fontName, $fontStyle, $fontSize);
        $this->Text($myX, $myY, trim($this->watermark_text));
        $this->StopTransform();

        // Reset the transparency to default
        $this->SetAlpha(1);
        // Restore the auto-page-break status
        // $this->SetAutoPageBreak($auto_page_break, $bMargin);

        // Set the starting point for the page content
        $this->setPageMark();
    }

    public function generated()
    {
        $this->SetY(-1);
        $this->SetFont('helvetica', 'N', 6);
        if ($this->revisi_sistem) {
            $revisi_sistem = 'Revisi Sistem : ' . $this->revisi_sistem;
        } else {
            $revisi_sistem = NULL;
        }
        if ($this->uuid) {
            $uuid = '# '  . $this->uuid . ' #';
        } else {
            $uuid = NULL;
        }
        $html = '<table class="mceNonEditable" style="border-collapse: collapse; width: 100%;  margin-left: auto; margin-right: auto;" border="0">
            <tbody>
                <tr style="width: 100%; color:rgb(0, 93, 167);">
                    <td style="width: 60%; text-align:left;">' . 'DOKUMEN INI DIBUAT MENGGUNAKAN SISTEM - TERDAPAT QR-CODE YANG DAPAT DIVERIFIKASI</td>
                    <td style="width: 40%; text-align:right; font-size:9px;color:rgb(233,30,42)">' . $uuid . '</td>
                </tr>
                <tr style="width: 100%; color:rgb(0, 93, 167);">
                    <td style="width: 50%;">Generated by System Server: V-' . $this->version . ' / ' . date('r') . '</td>
                    <td style="width: 50%; text-align:right;">' .
            $revisi_sistem
            . '</td>
                </tr>
            </tbody>
        </table>';

        $this->setCellHeightRatio(1.25);
        $this->writeHTML($html, true, false, true, false, '');
    }
}
