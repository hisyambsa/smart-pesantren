<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require_once("./vendor/dompdf/dompdf/autoload.inc.php");

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;

class libqrcode
{

    public function create($data, $filename = 'test', $label = 'security by apps', $label_size = 16, $size = 300, $logo_size = 100)
    {
        $qrCode = new QrCode('Life is too short to be generating QR codes');

        // Create a basic QR code
        $qrCode = new QrCode($data);
        $qrCode->setSize($size);

        // Set advanced options
        $qrCode->setWriterByName('png');
        $qrCode->setMargin(10);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        $qrCode->setLabel($label, $label_size, __DIR__ . '/qrcode/assets/noto_sans.otf', LabelAlignment::CENTER());
        $qrCode->setLogoPath(__DIR__ . '/qrcode/assets/logo.png');

        // var_dump(__DIR__);
        $qrCode->setLogoSize($logo_size, $logo_size);
        $qrCode->setRoundBlockSize(false);
        $qrCode->setValidateResult(false);
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);

        // Directly output the QR code
        // header('Content-Type: ' . $qrCode->getContentType());
        // $img_qrcode = $qrCode->writeString();

        // Save it to a file
        $img_qrcode = $qrCode->writeFile(__DIR__ . '/qrcode/assets/' . $filename . '.png');

        // Create a response object
        $response = $qrCode->writeDataUri();
        return $response;
    }
}
