<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('inicio.php',(array)$output);
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
		try{
			if(isset($_POST['txt_user']) 
			&& !empty($_POST['txt_user']) 
			&& isset($_POST['txt_pass']) 
			&& !empty($_POST['txt_pass'])){
				$usuario = str_replace("'", "", $_POST['txt_user']);
				$password = $_POST['txt_pass'];
				$salt = "billeton";
				$MD5Password = MD5($password.$salt);
				$fila = $this->db->query("SELECT * FROM login WHERE log_user = '".$usuario."' AND log_pass = '".$MD5Password."'")->row();
				if(isset($fila)){
					setcookie("log_id", $fila->log_id, time()+365 * 24 * 60 * 60, "/");
					session_start();
					$_SESSION['log_id'] = $fila->log_id;
					$_SESSION['Usuario'] = $usuario;
					header("Location: ".base_url()."index.php/Login/Show");
				}else{
					header("Location: ".base_url()."index.php/Inicio?p=0");
				}
			}else{
				header("Location: ".base_url()."index.php/Inicio?e=1");
			}
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}
