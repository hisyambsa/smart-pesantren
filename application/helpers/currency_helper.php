<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Currency Helper
 *
 * @package	CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author	Hisyam
 */

if (!function_exists('rupiah')) {

    function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
    function format_uang($angka)
    {
        $hasil_rupiah = number_format($angka, 0, ',', '.') . ",-";
        return $hasil_rupiah;
    }
    function format_uang_standar($angka)
    {
        $hasil_rupiah = number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}



 
 /* End of file currency.php */
 /* Location: ./application/helper/currency.php */
