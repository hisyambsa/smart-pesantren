<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Auth extends CI_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(['language']);
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    /**
     * Redirect if needed, otherwise display the user list
     */
    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            // default controller auth/login
            redirect('/', 'refresh');
        }
    }

    public function login()
    {
        if ($this->ion_auth->logged_in()) {
            redirect('admin/home', 'refresh');
        } else {

            $this->data['title'] = $this->lang->line('login_heading');

            // validate form input
            $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
            $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

            if ($this->form_validation->run() === TRUE) {
                // check to see if the user is logging in
                // check for "remember me"
                $remember = (bool) $this->input->post('remember');

                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    //if the login is successful
                    //redirect them back to the home page
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('admin', 'refresh');
                } else {
                    // if the login was un-successful
                    // redirect them back to the login page
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    $this->_render_page('auth/login');
                    redirect('admin', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
                }
            } else {
                // the user is not logging in so display the login page
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['identity'] = [
                    'name' => 'identity',
                    'id' => 'identity',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('identity'),
                ];

                $this->data['password'] = [
                    'name' => 'password',
                    'id' => 'password',
                    'type' => 'password',
                ];

                $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
            }
        }
    }
    /**
     * Log the user in
     */
    public function read_user()
    {
        $this->load->library('user_agent');
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('admin', 'refresh');
        }

        $this->load->model('Users_model');

        $kondisi = array(
            'username' => $this->ion_auth->user()->row()->username,
        );
        $row = $this->Users_model->get_all($kondisi)->row();

        $last_user_agent = $this->agent->platform() . '/' . $retVal = ($this->agent->is_browser()) ? $this->agent->browser() : '-';


        if ($row) {
            $time = strtotime($row->tanggal_lahir);
            $tanggal_lahir = date("d F Y", $time);
            $data = array(
                'id' => $row->id,
                'ip_address' => $row->ip_address,
                'username' => $row->username,
                'password' => $row->password,
                'email' => $row->email,
                'activation_selector' => $row->activation_selector,
                'activation_code' => $row->activation_code,
                'forgotten_password_selector' => $row->forgotten_password_selector,
                'forgotten_password_code' => $row->forgotten_password_code,
                'forgotten_password_time' => $row->forgotten_password_time,
                'remember_selector' => $row->remember_selector,
                'remember_code' => $row->remember_code,
                'created_on' => date(
                    "d F Y H:i:s",
                    $row->created_on
                ),
                'last_login' => date(
                    "d F Y H:i:s",
                    $row->last_login
                ),
                'last_user_agent' => $last_user_agent,
                'active' => $row->active,
                'nip' => $row->nip,
                'first_name' => $row->first_name,
                'last_name' => $row->last_name,
                'boss' => $row->boss,
                'company' => $row->company,
                'telp' => $row->telp,
                'job_level' => $row->job_level,
                'unit_kerja' => $row->unit_kerja,
                'region' => $row->region,
                'telp' => $row->telp,
                'tanggal_lahir' => $tanggal_lahir,
                'alamat' => $row->alamat,
                'in_charge_company' => $row->in_charge_company,
            );
        }
        $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'read_user', $data);
    }
    /**
     * Log the perizinan / permission
     */
    public function permission()
    {
        $this->load->library('user_agent');
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('admin', 'refresh');
        }

        $this->load->model('Users_notifications_model');

        $kondisi = array(
            'nama_users_notifications ' => $this->ion_auth->user()->row()->first_name,
        );
        $list_notifikasi = $this->Users_notifications_model->get_all($kondisi);

        $data_1 = array(
            'list_notifikasi_data' => $list_notifikasi,
        );

        $data = array_merge($data_1);
        // $data = array_merge($data, $data_3);

        $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'permission', $data);
    }

    /**
     * Log the user out
     */
    public function logout()
    {
        $this->data['title'] = "Logout";
        if ($this->ion_auth->logged_in()) {
            // log the user out
            $this->ion_auth->logout();
            // redirect them to the login page
            redirect('auth/logout_message_user', 'refresh');
        }
        redirect('auth/logout_message_custom', 'refresh');
    }
    /**
     * Log the user out message 
     */
    public function logout_message_custom()
    {

        $this->session->set_flashdata('message', 'Data Survey Anda sudah Masuk');

        redirect('admin', 'refresh');
    }
    /**
     * Log the user out message user
     */
    public function logout_message_user()
    {

        $this->session->set_flashdata('message', 'Berhasil Logout');

        redirect('admin', 'refresh');
    }

    /**
     * Change password
     */
    public function change_password()
    {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in()) {
            redirect('admin', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() === FALSE) {
            // display the form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = [
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
            ];
            $this->data['new_password'] = [
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            ];
            $this->data['new_password_confirm'] = [
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            ];
            $this->data['user_id'] = [
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id,
            ];

            // render
            $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'change_password', $this->data);
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $messages = $this->ion_auth->messages();
                $this->session->set_tempdata('pesan', $messages, 5);
                // $this->logout();
                redirect('admin', 'refresh');
            } else {
                $messages = 'Kata Sandi Lama Salah';
                $this->session->set_tempdata('pesan', $messages, 5);
                redirect('auth/change_password', 'refresh');
            }
        }
    }

    /**
     * Forgot password
     */
    public function forgot_password()
    {
        $this->data['title'] = $this->lang->line('forgot_password_heading');

        // setting validation rules by checking whether identity is username or email
        if ($this->config->item('identity', 'ion_auth') != 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }


        if ($this->form_validation->run() === FALSE) {
            $this->data['type'] = $this->config->item('identity', 'ion_auth');
            // setup the input
            $this->data['identity'] = [
                'name' => 'identity',
                'id' => 'identity',
            ];

            if ($this->config->item('identity', 'ion_auth') != 'email') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            // set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'forgot_password', $this->data);
        } else {
            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

            if (empty($identity)) {

                if ($this->config->item('identity', 'ion_auth') != 'email') {
                    $this->ion_auth->set_error('forgot_password_identity_not_found');
                } else {
                    $this->ion_auth->set_error('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }

            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                // if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }
        }
    }

    /**
     * Reset password - final step for forgotten password
     *
     * @param string|null $code The reset code
     */
    public function reset_password($code = NULL)
    {
        if (!$code) {
            show_404();
        }

        $this->data['title'] = $this->lang->line('reset_password_heading');

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            // if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() === FALSE) {
                // display the form

                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors('<span>', '</span>') : $this->session->flashdata('message');
                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = [
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                ];
                $this->data['new_password_confirm'] = [
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                ];
                $this->data['user_id'] = [
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                ];
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                // render
                $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'reset_password', $this->data);
            } else {
                $identity = $user->{$this->config->item('identity', 'ion_auth')};

                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($identity);

                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        // if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    /**
     * Activate the user
     *
     * @param int         $id   The user ID
     * @param string|bool $code The activation code
     */
    public function activate($id, $code = FALSE)
    {
        $activation = FALSE;

        if ($code !== FALSE) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            // redirect them to the auth page
            // $this->session->set_flashdata('message', $this->ion_auth->messages());
            $this->session->set_flashdata('message', 'Berhasil aktivasi akun');
            redirect("admin", 'refresh');
        } else {
            // redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    /**
     * Deactivate the user
     *
     * @param int|string|null $id The user ID
     */
    public function deactivate($id = NULL)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            // redirect them to the home page because they must be an administrator to view this
            show_error('You must be an administrator to view this page.');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() === FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();

            $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'deactivate_user', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                    $this->session->set_flashdata('message', 'Berhasil deaktivasi akun');
                }
            }

            // redirect them back to the auth page
            redirect('	', 'refresh');
        }
    }

    /**
     * Create a new user
     */
    public function create_user()
    {

        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
        } else {
            // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]', array('matches' => 'Konfirmasi Password tidak Sama'));
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = [
                'first_name' => $this->input->post('first_name'),
            ];
        } // $group = array('2'); // Sets user to kadiv.
        $group = $this->input->post('groups');
        if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data, $group)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = [
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            ];
            $this->data['identity'] = [
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            ];
            $this->data['password'] = [
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
            ];
            $this->data['password_confirm'] = [
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            ];
            $this->data['groups'] = $this->ion_auth->groups()->result_array();
            $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'create_user', $this->data);
        }
    }
    /**
     * Redirect a user checking if is admin
     */
    public function redirectUser()
    {
        if ($this->ion_auth->is_admin()) {
            redirect('admin', 'refresh');
        }
        redirect('admin', 'refresh');
    }

    /**
     * Edit a user client
     *
     * @param int|string $id
     */
    public function edit_user_client()
    {
        $this->load->model('Users_model');

        $kondisi = array(
            'username' => $this->ion_auth->user()->row()->username,
        );
        $row = $this->Users_model->get_all($kondisi)->result();


        $id = $row[0]->id;

        $row = $this->Users_model->get_by_id($id)->result();

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('auth/edit_user_client_action'),
                'id' => set_value('id', $row->id),
                'ip_address' => set_value('ip_address', $row->ip_address),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'email' => set_value('email', $row->email),
                'activation_selector' => set_value('activation_selector', $row->activation_selector),
                'activation_code' => set_value('activation_code', $row->activation_code),
                'forgotten_password_selector' => set_value('forgotten_password_selector', $row->forgotten_password_selector),
                'forgotten_password_code' => set_value('forgotten_password_code', $row->forgotten_password_code),
                'forgotten_password_time' => set_value('forgotten_password_time', $row->forgotten_password_time),
                'remember_selector' => set_value('remember_selector', $row->remember_selector),
                'remember_code' => set_value('remember_code', $row->remember_code),
                'created_on' => set_value('created_on', $row->created_on),
                'last_login' => set_value('last_login', $row->last_login),
                'last_user_agent' => set_value('last_user_agent', $row->last_user_agent),
                'active' => set_value('active', $row->active),
                'nip' => set_value('nip', $row->nip),
                'first_name' => set_value('first_name', $row->first_name),
                'last_name' => set_value('last_name', $row->last_name),
                'boss' => set_value('boss', $row->boss),
                'company' => set_value('company', $row->company),
                'telp' => set_value('telp', $row->telp),
                'job_level' => set_value('job_level', $row->job_level),
                'unit_kerja' => set_value('unit_kerja', $row->unit_kerja),
                'region' => set_value('region', $row->region),
                'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
                'alamat' => set_value('alamat', $row->alamat),
                'in_charge_company' => set_value('in_charge_company', $row->in_charge_company),
            );
            $this->load->view('auth/edit_user_client', $data);
        } else {
            $this->session->set_flashdata('pesan', 'Data tidak ditemukan');
            redirect(site_url(''));
        }
    }

    public function edit_user_client_action()
    {
        $this->load->model('Users_model');

        $kondisi = array(
            'username' => $this->ion_auth->user()->row()->username,
        );
        $row = $this->Users_model->get_all($kondisi)->result();
        if ($row[0]->username != $this->input->post('username', TRUE)) {
            $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[4]|is_unique[users.username]', array('is_unique' => 'Username sudah ada yang menggunakan'));
        }
        if ($row[0]->email != $this->input->post('email', TRUE)) {
            $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[4]|is_unique[users.email]', array('is_unique' => 'Email sudah ada yang menggunakan'));
        }

        $this->form_validation->set_rules('last_name', 'Nama', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('telp', 'Nomor HP', 'trim|required|numeric|min_length[10]');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->edit_user_client();
        } else {
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'email' => $this->input->post('email', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'telp' => $this->input->post('telp', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
            );

            $this->Users_model->update_where($row[0]->username, $data);

            $id = $row[0]->id;
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'email' => $this->input->post('email', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'telp' => $this->input->post('telp', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
            );
            if ($this->ion_auth->update_user($id, $data)) {
                $messages = $this->ion_auth->messages();
                $this->session->set_tempdata('pesan', $messages, 5);
                $this->session->set_tempdata('type', 'success', 5);
                redirect(site_url(''), 'refresh');
            } else {
                $errors = $this->ion_auth->errors();
                $this->session->set_tempdata('pesan', $errors, 5);
                $this->session->set_tempdata('type', 'error', 5);
                redirect(site_url(''), 'refresh');
            }
        }
    }

    /**
     * Edit a user
     *
     * @param int|string $id
     */
    public function edit_user($id)
    {
        $this->data['title'] = $this->lang->line('edit_user_heading');

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('admin', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        //USAGE NOTE - you can do more complicated queries like this
        //$groups = $this->ion_auth->where(['field' => 'value'])->groups()->result_array();


        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
        $this->form_validation->set_rules('telp', $this->lang->line('edit_user_validation_telp_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('job_level', $this->lang->line('edit_user_validation_job_level_label'), 'trim');
        $this->form_validation->set_rules('unit_kerja', $this->lang->line('edit_user_validation_unit_kerja_label'), 'trim');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $this->input->post('company'),
                    'telp' => $this->input->post('telp'),
                    'job_level' => $this->input->post('job_level'),
                    'unit_kerja' => $this->input->post('unit_kerja'),
                ];

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }

                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    // Update the groups user belongs to
                    $this->ion_auth->remove_from_group('', $id);

                    $groupData = $this->input->post('groups');
                    if (isset($groupData) && !empty($groupData)) {
                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    $this->redirectUser();
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    $this->redirectUser();
                }
            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['email'] = [
            'name'  => 'email',
            'id'    => 'email',
            'type'  => 'email',
            'value' => $this->form_validation->set_value('email', $user->email),
        ];
        $this->data['first_name'] = [
            'name'  => 'first_name',
            'id'    => 'first_name',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        ];
        $this->data['last_name'] = [
            'name'  => 'last_name',
            'id'    => 'last_name',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        ];
        $this->data['company'] = [
            'name'  => 'company',
            'id'    => 'company',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('company', $user->company),
        ];
        $this->data['telp'] = [
            'name'  => 'telp',
            'id'    => 'telp',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('telp', $user->telp),
        ];
        $this->data['job_level'] = [
            'name'  => 'job_level',
            'id'    => 'job_level',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('job_level', $user->job_level),
        ];
        $this->data['unit_kerja'] = [
            'name'  => 'unit_kerja',
            'id'    => 'unit_kerja',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('unit_kerja', $user->unit_kerja),
        ];
        $this->data['password'] = [
            'name' => 'password',
            'id'   => 'password',
            'type' => 'password'
        ];
        $this->data['password_confirm'] = [
            'name' => 'password_confirm',
            'id'   => 'password_confirm',
            'type' => 'password'
        ];

        $this->_render_page('auth/edit_user', $this->data);
    }

    /**
     * Create a new group
     */
    public function create_group()
    {
        $this->data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('admin', 'refresh');
        }

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'trim|required|alpha_dash');

        if ($this->form_validation->run() === TRUE) {
            die;
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("", 'refresh');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
            }
        }

        // display the create group form
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        $this->data['group_name'] = [
            'name'  => 'group_name',
            'id'    => 'group_name',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('group_name'),
        ];
        $this->data['description'] = [
            'name'  => 'description',
            'id'    => 'description',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('description'),
        ];

        $this->_render_page('auth/create_group', $this->data);
    }

    /**
     * Edit a group
     *
     * @param int|string $id
     */
    public function edit_group($id)
    {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('admin', 'refresh');
        }

        $this->data['title'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('admin', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'trim|required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], array(
                    'description' => $_POST['group_description']
                ));

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                    redirect("", 'refresh');
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
            }
        }

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['group'] = $group;

        $this->data['group_name'] = [
            'name'    => 'group_name',
            'id'      => 'group_name',
            'type'    => 'text',
            'value'   => $this->form_validation->set_value('group_name', $group->name),
        ];
        if ($this->config->item('admin_group', 'ion_auth') === $group->name) {
            $this->data['group_name']['readonly'] = 'readonly';
        }

        $this->data['group_description'] = [
            'name'  => 'group_description',
            'id'    => 'group_description',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        ];

        $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'edit_group', $this->data);
    }

    /**
     * @return array A CSRF key-value pair
     */
    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_tempdata('csrfkey', $key, 300);
        $this->session->set_tempdata('csrfvalue', $value, 300);

        return [$key => $value];
    }

    /**
     * @return bool Whether the posted CSRF token matches
     */
    public function _valid_csrf_nonce()
    {

        $csrfkey = $this->input->post($this->session->userdata('csrfkey'));
        if ($csrfkey && $csrfkey === $this->session->userdata('csrfvalue')) {
            return TRUE;
        }
        return FALSE;
        // return TRUE;
    }

    /**
     * @param string     $view
     * @param array|null $data
     * @param bool       $returnhtml
     *
     * @return mixed
     */
    public function _render_page($view, $data = NULL, $returnhtml = FALSE) //I think this makes more sense
    {

        $viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $viewdata, $returnhtml);

        // This will return html on 3rd argument being true
        if ($returnhtml) {
            return $view_html;
        }
    }
}
