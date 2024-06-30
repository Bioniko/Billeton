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
			$ult = $this->db->query("SELECT m.*, c.com_nombre comercio, c.com_icono icono FROM movimiento m LEFT JOIN comercio c ON m.com_id = c.com_id where m.log_id = ".$_COOKIE['log_id']." ORDER BY m.mov_fecha DESC LIMIT 7;")->result();
			$dia = $this->db->query("SELECT 
										DATE(mov_fecha) AS Dia,
										SUM(CASE WHEN mov_tipo_movimiento = 1 THEN mov_monto ELSE 0 END) AS Egreso,
										SUM(CASE WHEN mov_tipo_movimiento = 0 THEN mov_monto ELSE 0 END) AS Ingreso,
										SUM(CASE WHEN mov_tipo_movimiento = 0 THEN mov_monto ELSE 0 END) - 
										SUM(CASE WHEN mov_tipo_movimiento = 1 THEN mov_monto ELSE 0 END) AS Monto
									FROM 
										movimiento
									WHERE 
										mov_fecha >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND log_id = ".$_COOKIE['log_id']."
									GROUP BY 
										DATE(mov_fecha)
									ORDER BY 
										DATE(mov_fecha) DESC")->result();
			$gpc = $this->db->query("SELECT 
										CONCAT(c.com_nombre) AS comercios, 
										SUM(CASE WHEN m.mov_tipo_movimiento = 1 THEN m.mov_monto ELSE -m.mov_monto END) AS total
									FROM 
										movimiento m
									JOIN 
										comercio c ON m.com_id = c.com_id
									WHERE 
										m.mov_fecha >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
										AND m.log_id = ".$_COOKIE['log_id']."
									GROUP BY 
										comercios
									ORDER BY 
										total DESC")->result();
			$gp7 = $this->db->query("SELECT 
										CONCAT(c.com_nombre) AS comercios, 
										SUM(CASE WHEN m.mov_tipo_movimiento = 1 THEN m.mov_monto ELSE -m.mov_monto END) AS total
									FROM 
										movimiento m
									JOIN 
										comercio c ON m.com_id = c.com_id
									WHERE 
										m.mov_fecha >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
										AND m.log_id = ".$_COOKIE['log_id']."
									GROUP BY 
										comercios
									ORDER BY 
										total DESC LIMIT 7")->result();
			$data = (object)array('efe' => $efe, 'cue' => $cue, 'ing' => $ing, 'egr' => $egr, 'ult' => $ult, 'dia' => $dia, 'gpc' => $gpc, 'gp7' => $gp7);
			$this->load->view('grafico.php',(array)$data);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}
