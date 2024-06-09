<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movimiento extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('movimiento.php',(array)$output);
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
			//session_start();
			$crud = new grocery_CRUD();
			//UNSET
			$crud->unset_print();
			$crud->unset_clone();
			$crud->unset_export();
			//DISPLAY
			$crud->display_as('com_id','Comercio');
			$crud->display_as('mov_monto','Monto');
			$crud->display_as('mov_tipo_movimiento','Tipo de Movimiento');
			$crud->display_as('mov_tipo_pago','Tipo de Pago');
			$crud->display_as('mov_foto','Foto');
			$crud->display_as('mov_descripcion','Descripción');
			$crud->display_as('mov_fecha','Fecha');
			//WHERE
			$crud->where('movimiento.log_id', $_COOKIE['log_id']);
			//THEME
			$crud->set_theme('flexigrid');
			//TABLA A LEER
			$crud->set_table('movimiento');
			//COLUMNAS A MOSTRAR
			$crud->columns('mov_monto', 'com_id', 'mov_tipo_movimiento', 'mov_tipo_pago', 'mov_foto', 'mov_descripcion', 'mov_fecha');
			//CAMPOS A VISUALIZAR
			$crud->add_fields('mov_monto', 'com_id', 'mov_tipo_movimiento', 'mov_tipo_pago', 'mov_foto', 'mov_descripcion');
    		$crud->edit_fields('mov_monto', 'com_id', 'mov_tipo_movimiento', 'mov_tipo_pago', 'mov_foto', 'mov_descripcion');
			//File Type
			$crud->field_type(
			'mov_tipo_movimiento','dropdown', array(
				'0' => 'Ingreso', 
				'1' => 'Egreso'
			));
			$crud->field_type(
			'mov_tipo_pago','dropdown', array(
				'0' => 'Efectivo', 
				'1' => 'Cuenta Banco'
			));
			//Set Relation
			$crud->set_relation('com_id', 'comercio', 'com_nombre',array('log_id' => $_COOKIE['log_id']));
			//SUBIR FOTO
			$crud->set_field_upload('mov_foto','assets/uploads/files');
			//DESPUES DE INSERTAR CUALQUIER PRODUCTO
			$crud->callback_after_insert(array($this, 'InsertarID'));
			$output = $crud->render();
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function InsertarID($post_array, $primary_key) {
		$query = "UPDATE movimiento SET log_id = ".$_COOKIE['log_id']." WHERE mov_id = ".$primary_key;
		$this->db->query($query);
    }
}
