<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Currency
 {
 	protected $ci;
 
 	public function __construct()
 	{
         $this->ci =& get_instance();
 	}
 
 function rupiah($angka)
 {	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
}

 	
 
 }
 
 /* End of file currency.php */
 /* Location: ./application/libraries/currency.php */
  ?>