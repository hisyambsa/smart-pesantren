<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
<!-- .................................. -->
<!-- ...........COPYRIGHT ............. -->
<!-- Authors : Hisyam Husein .......... -->
<!-- Email : hisyam.husein@gmail.com .. -->
<!-- About : hisyambsa.github.io ...... -->
<!-- Instagram : @hisyambsa............ -->
<!-- .................................. -->
*/

use Carbon\Carbon;
// include the base class
require_once("application/core/GCrud.php");

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->GCrud = new GCrud();
        Carbon::setLocale('id');
        // var_dump($this->ion_auth->is_admin());
        // die;
        if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect('/home', 'refresh');
        }
    }
    public function output_crud($output = null, $link_tambah = false)
    {
        if (isset($output->isJSONResponse) && $output->isJSONResponse) {
            header('Content-Type: application/json; charset=utf-8');
            echo $output->output;
            exit;
        }

        $output->link_tambah = $link_tambah;
        $output->nama_link = 'Create';
        $output->link =  'auth' . '/create_user';
        $output->group = array('all_users');


        $this->load->view('db/view_crud', (array)$output);
    }
    public function index()
    {
        $crud = $this->GCrud->_getGroceryCrudEnterprise();
        $crud->setTable('users');
        $table = $crud->getTable();
        $crud->setSubject('USERS', 'USERS LOGIN');

        $crud = $this->initial_config($crud);
        $crud = $this->display_as($crud);

        $crud->setEdit();
        $crud->editFields(['active', 'username', 'first_name']);


        $crud->columns(['active', 'username', 'first_name', 'created_on', 'last_login']);
        $crud->uniqueFields(['username']);
        $crud->requiredFields(['username']);
        // $crud->setRead();
        // $crud->setAdd();
        $crud->setConfig('action_button_type', 'icon');

        $crud->callbackInsert(function ($stateParameters) {

            $group = $_POST['data']['groups'];

            // As we are skipping the actual insert we will need to insert by our own
            $stateParameters->data['username'] = $stateParameters->data['username'];
            $stateParameters->data['email'] = $stateParameters->data['email'];
            $stateParameters->data['job_level'] = $stateParameters->data['job_level'];


            $insertId = $this->ion_auth->register($stateParameters->data['username'], '123123123', NULL, $stateParameters->data, $group);;


            $stateParameters->insertId = $insertId;
            return $stateParameters;
        });


        $crud->callbackColumn('created_on', function ($value, $row) {
            return Carbon::createFromTimestamp($value)->format('D, j M Y H:i:s');
        });
        $crud->callbackColumn('last_login', function ($value, $row) {
            if ($value != NULL) {
                return date('D, j M Y H:i:s', $value);
            } else {
                return 'BELUM LOGIN';
            }
        });
        $crud->callbackColumn('active', function ($value, $row) {
            if ($value == 1) {
                return 'Aktif';
            } else {
                return 'TIDAK AKTIF';
            }
        });
        $crud->callbackReadField('created_on', function ($value, $row) {
            return date('D, j M Y H:i:s', $value);
        });
        $crud->callbackReadField('last_login', function ($value, $row) {
        });

        $output = $crud->render();
        $this->output_crud($output, true,);
    }
    public function reset_password()
    {
        $crud = $this->GCrud->_getGroceryCrudEnterprise();
        $crud->setTable('users');
        $table = $crud->getTable();
        $crud->setSubject('PASSWORD', 'RESET PASSWORD');

        $crud->setLangString('edit', 'Reset Password');
        $crud->setLangString('error_generic_title', 'INFO');
        $crud->setLangString('edit_item', 'Reset Password');

        $crud->callbackEditField('password', function ($fieldValue, $primaryKeyValue, $rowData) {
            return '<input class="form-control" name="password" value=""  />';
        });
        $crud->callbackUpdate(function ($stateParameters) {

            if ($stateParameters->data['password'] == '') {
                unset($stateParameters->data['password']);
            }
            // check to see if we are updating the user
            if ($this->ion_auth->update($stateParameters->primaryKeyValue, $stateParameters->data)) {
                // redirect them back to the admin page if admin, or to the base url if non admin
                return $stateParameters;
            } else {
                // redirect them back to the admin page if admin, or to the base url if non admin
                $errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
                return $errorMessage->setMessage("Kesalahan Sistem Update, Hubungi Sistem Admin <br> Error Code :"   . __LINE__);
            }
            return $stateParameters;
        });



        $crud->callbackColumn('created_on', function ($value, $row) {
            return date('D, j M Y H:i:s', $value);
        });
        $crud->callbackColumn('last_login', function ($value, $row) {
            return date('D, j M Y H:i:s', $value);
        });
        $crud->callbackReadField('created_on', function ($value, $row) {
            return date('D, j M Y H:i:s', $value);
        });
        $crud->callbackReadField('last_login', function ($value, $row) {
            return date('D, j M Y H:i:s', $value);
        });



        $crud->columns(['username', 'created_on', 'last_login', 'last_user_agent', 'ip_address']);

        $crud->readOnlyEditFields(['first_name']);
        $crud->editFields(['first_name', 'password']);
        $crud->unsetOperations();
        $crud->setEdit();


        $crud = $this->display_as($crud);;
        $output = $crud->render();
        $this->output_crud($output);
    }
    public function groups()
    {
        $crud = $this->GCrud->_getGroceryCrudEnterprise();
        $crud->setTable('groups');
        $table = $crud->getTable();
        $crud->setSubject('Role Akses', 'Role Akses');
        $crud = $this->initial_config($crud);
        $crud = $this->display_as($crud);

        $crud->where([
            'groups.name != ? AND groups.name != ?' => array('admin', 'all_users'),
        ]);

        // $crud->setAdd();
        // $crud->setEdit();
        // $crud->setDelete();
        $crud->setConfig('action_button_type', 'icon');
        $crud->unsetSearchColumns(['name', 'description']);

        $crud->uniqueFields(['name', 'description', 'link']);
        $crud->requiredFields(['name', 'description']);
        $output = $crud->render();
        $this->output_crud($output);
    }

    public function akses()
    {
        if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            redirect('/home', 'refresh');
        }
        $crud = $this->GCrud->_getGroceryCrudEnterprise();
        $crud->setTable('users');
        $table = $crud->getTable();
        $crud->setSubject('USER AKSES', 'USER AKSES');
        $crud->setRelationNtoN('groups', 'users_groups', 'groups', 'user_id', 'group_id', '{description}',);

        $crud->columns(['active', 'username', 'first_name', 'groups']);

        $crud = $this->initial_config($crud);
        $crud = $this->display_as($crud);;
        $output = $crud->render();
        $this->output_crud($output);
    }

    private function initial_config($crud)
    {
        $crud->fieldType('active', 'dropdown_search', [
            '1' => 'Aktif',
            '0' => 'Tidak Aktif',
        ]);

        $crud->where([
            'users. username != ?' => 'administrator',
        ]);

        $crud->unsetColumns(['create_by', 'modify', 'modify_by', 'delete_at']);
        $crud->unsetFields(['timestamp', 'create_by', 'modify', 'modify_by', 'delete_at']);

        $crud->unsetPrint();
        $crud->unsetExport();
        $crud->unsetSettings();
        $crud->unsetOperations();
        $crud->unsetFilters();

        return $crud;
    }
    private function display_as($crud)
    {
        $crud->displayAs('id', 'ID');
        $crud->displayAs('ip_address', 'IP Address');
        $crud->displayAs('username', 'Username');
        $crud->displayAs('password', 'Password');
        $crud->displayAs('email', 'Email');

        $crud->displayAs('created_on', 'Created On');
        $crud->displayAs('last_login', 'Last Login');
        $crud->displayAs('last_user_agent', 'Last User Agent');
        $crud->displayAs('active', 'Status Akun');
        // $crud->displayAs('nama', 'Nama Lengkap');
        $crud->displayAs('first_name', 'Nama Aplikasi');

        return $crud;
    }
}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* http://hisyambsa.github.io */
