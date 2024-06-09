<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salir extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
	}
	public function _example_output($output = null)
	{
		$this->load->view('salir.php',(array)$output);
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

	public function show()
	{
		session_start();
		session_destroy();
		header("Location: ".base_url()."index.php/login?e=1");
	}
}
