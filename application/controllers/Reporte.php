<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Controller {

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
			if(isset($_GET['desde']) && !Empty($_GET['desde']))
			{
				$gpc = $this->db->query("SELECT 
											CONCAT(c.com_nombre) AS comercios, 
											SUM(CASE WHEN m.mov_tipo_movimiento = 1 THEN m.mov_monto ELSE -m.mov_monto END) AS total
										FROM 
											movimiento m
										JOIN 
											comercio c ON m.com_id = c.com_id
										WHERE 
											m.mov_fecha >= '".$_GET['desde']."' AND m.mov_fecha < '".$_GET['hasta']."'
											AND m.log_id = ".$_COOKIE['log_id']."
                                            AND m.mov_tipo_pago = '".$_GET['tpago']."'
										GROUP BY 
											comercios
										HAVING 
											total > 0
										ORDER BY 
											total DESC;")->result();
				$data = (object)array('gpc' => $gpc);
			}else{
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
										HAVING 
											total > 0
										ORDER BY 
											total DESC")->result();
				$data = (object)array('gpc' => $gpc);
			}
			$this->load->view('reportepagos.php',(array)$data);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}
