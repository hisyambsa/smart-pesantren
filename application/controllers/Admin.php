<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */

require APPPATH . "/reports/Dashboard_report.php";
class Admin extends CI_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'language']);

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');

        if (!$this->ion_auth->logged_in()) {
            redirect('', 'refresh');
        }
    }

    public function home()
    {
        $this->load->view('admin/home');


        $data = array();
        $report = new Dashboard_report($data);
        $data = array('report' => $report,);
        $this->load->view('koolreport/render', $data);
    }
}
