<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('login.php',(array)$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function Show()
	{
		try{
			$crud = new grocery_CRUD();
			//UNSET
			$crud->unset_print();
			$crud->unset_clone();
			$crud->unset_export();
			//DISPLAY
			$crud->display_as('log_user','Usuario');
			$crud->display_as('log_pass','Password');
			$crud->display_as('log_estado','Estado');
			//THEME
			$crud->set_theme('flexigrid');
			//TABLA A LEER
			$crud->set_table('login');
			//COLUMNAS A MOSTRAR
			$crud->columns('log_user', 'log_pass', 'log_estado');
			//CAMPOS A VISUALIZAR
			$crud->add_fields('log_user', 'log_pass');
    		$crud->edit_fields('log_user', 'log_pass', 'log_estado');
			//FIELD TYPE
			$crud->field_type(
				'log_estado','dropdown', array(
					'1' => 'Activo', 
					'0' => 'Inactivo'
				));
			//FUNCION MD5
			$crud->callback_before_insert(array($this, 'MD5Password'));
            $crud->callback_before_update(array($this, 'MD5Password'));
			$output = $crud->render();
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function MD5Password($post_array)
	{
		$pass = $post_array['log_pass'];
		$salt = "billeton";
		$post_array['log_pass'] = MD5($pass.$salt);
		return $post_array;
	}
}
