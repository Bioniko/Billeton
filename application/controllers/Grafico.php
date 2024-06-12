<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grafico extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('grafico.php',(array)$output);
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
			$efe = $this->db->query("SELECT SUM(CASE WHEN mov_tipo_movimiento = 0 THEN mov_monto ELSE 0 END) - SUM(CASE WHEN mov_tipo_movimiento = 1 THEN mov_monto ELSE 0 END) AS EfectivoTotal FROM movimiento WHERE log_id = ".$_COOKIE['log_id']." AND mov_tipo_pago = 0;")->row();
			$cue = $this->db->query("SELECT SUM(CASE WHEN mov_tipo_movimiento = 0 THEN mov_monto ELSE 0 END) - SUM(CASE WHEN mov_tipo_movimiento = 1 THEN mov_monto ELSE 0 END) AS EfectivoTotal FROM movimiento WHERE log_id = ".$_COOKIE['log_id']." AND mov_tipo_pago = 1;")->row();
			$ing = $this->db->query("SELECT SUM(mov_monto) FROM movimiento WHERE log_id = ".$_COOKIE['log_id']." AND mov_tipo_movimiento = 0 AND YEAR(mov_fecha) = YEAR(CURDATE()) AND MONTH(mov_fecha) = MONTH(CURDATE());")->row();
			$egr = $this->db->query("SELECT SUM(mov_monto) FROM movimiento WHERE log_id = ".$_COOKIE['log_id']." AND mov_tipo_movimiento = 1 AND YEAR(mov_fecha) = YEAR(CURDATE()) AND MONTH(mov_fecha) = MONTH(CURDATE());")->row();
			$data = (object)array('efe' => $efe, 'cue' => $cue, 'ing' => $ing, 'egr' => $egr);
			$this->load->view('grafico.php',(array)$data);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}
