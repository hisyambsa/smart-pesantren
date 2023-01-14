<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require_once("./vendor/dompdf/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
use Dompdf\Options;
use iio\libmergepdf\Merger;

class Pdf extends Dompdf
{

  public function generate($html, $filename = 'unname', $stream = TRUE, $paper = 'A4', $orientation = "portrait")
  {
    $options = new Options();
    $options->set('isRemoteEnabled', TRUE);
    $dompdf = new Dompdf($options);

    // satuan ukuran point ($paper)
    $dompdf->setPaper($paper, $orientation);
    $dompdf->loadHtml($html);
    $dompdf->render();
    if ($stream) {
      // 0 = attachment | preview
      // 1 = attachment | force download
      $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
    } else {
      return $dompdf->output();
    }
  }
  public function generate_by_file($file, $filename = 'unname', $stream = TRUE, $paper = 'A4', $orientation = "portrait")
  {
    $m = new Merger;

    // $jumlah_file = array($file);
    // count($jumlah_file);
    for ($i = 0; $i < count($file); $i++) {
      $options = new Options();
      $options->set('isRemoteEnabled', TRUE);
      $dompdf = new Dompdf($options);

      $file_name_download = $filename;

      // satuan ukuran point ($paper)
      $dompdf->setPaper($paper, $orientation[$i]);
      $dompdf->loadHtml($file[$i]);
      $dompdf->render();

      file_put_contents(base64_encode($filename) . '_' . $i . '.pdf', $dompdf->output());
      $m->addFile(base64_encode($filename) . '_' . $i . '.pdf');
      unset($dompdf);
    }
    // $take_file = array();
    // $data_iterator = '';
    // for ($i = 0; $i < count($file); $i++) {
    //   array_push($take_file, base64_encode($filename) . '_' . $i . '.pdf');
    //   $data_iterator .= base64_encode($filename) . '_' . $i . '.pdf';
    // }
    // var_dump($data_iterator);
    // $data_str = array('[', ']', '"');
    // $m->addIterator([$data_iterator]);
    file_put_contents(base64_encode($filename) . '.pdf', $m->merge());
    // $createdPdf = $m->merge();
    // var_dump($createdPdf);

    header("Content-type: application/pdf");
    header("Content-Disposition:attachment;filename=" . $file_name_download . ".pdf");
    if (file_exists(base64_encode($filename) . '.pdf')) {
      readfile(base64_encode($filename) . '.pdf');
    }
    for ($i = 0; $i < count($file); $i++) {
      if (file_exists(base64_encode($filename) . '_' . $i . '.pdf')) {
        unlink(base64_encode($filename) . '_' . $i . '.pdf');
      }
      if (file_exists(base64_encode($filename) . '.pdf')) {
        unlink(base64_encode($filename) . '.pdf');
      }
    }
  }
}
