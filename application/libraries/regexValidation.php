<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegexValidation
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

		public function sqldate($date)
	{
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
		{
			return true;
		}
		else{
			
		return FALSE;
	}
	}

}

/* End of file regexValidation.php */
/* Location: ./application/libraries/regexValidation.php */

 ?>