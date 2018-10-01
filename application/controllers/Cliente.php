<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cliente extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('login'))
			   redirect(base_url()."login");
	}
		public function index()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		
		$data['selected']="Administración";
		$data['link_selected']="";
		$this->load->view('header',$data);
		$this->load->view('administracion\cliente\links',$data);
		$data['selected']="Clientes";
		$this->load->view('main',$data);
		$this->load->view('footer');
	}

	public function sucursal($id)
	{
		$this->load->model('cliente_model');
		$list=$this->cliente_model->get_sucursal($id);	
		$data = array();
		foreach ($list as $obra) {	
			$row = array();	
			$row[] = $obra['nombre'];
			$row[] = $obra['id_sucursal'];
			$data[] =$row;
		}
		//output to json format
		echo json_encode($data);
	}

	public function listar($mensaje = FALSE)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('cliente_model');

		$data['selected']="Administración";
		$data['link_selected']="Listado";
		$data['clientes']=$this->cliente_model->get_cliente();	



		if($mensaje == "error")
			$mensaje = array('mensaje' =>  'No se pudo completar la operación.',
							 'class' =>  	'danger',
				             'strong' =>  	'Error!'
			 );

		if($mensaje == "success")
			$mensaje = array('mensaje' =>  'Registros Actualizados.',
							 'class' => 	'success',
				             'strong' =>  	'Aceptado!'
			 );



		$data['mensaje']=$mensaje;
  		
		$this->load->view('header',$data);
		//$this->load->view('administracion\cliente\links',$data);
		$this->load->view('administracion\cliente\listado',$data);
		$this->load->view('footer');
	}
	public function nuevo()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('cliente_model');

		$data['selected']="Administración";
		$data['link_selected']="Nuevo";

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('rut', 'Rut', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->view('administracion\cliente\nuevo',$data);
			$this->load->view('footer');
		}
		else
		{

			if($this->cliente_model->set_cliente())
			 	redirect(base_url().'/cliente/listar/success', 'location');	
			else
			 	redirect(base_url().'/cliente/listar/error', 'location');	
		}
	}

	public function editar($id)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('cliente_model');

		$data['selected']="Administración";
		$data['link_selected']="Listado";
		$data['id']=$id;


		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('rut', 'Rut', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['cliente']=$this->cliente_model->get_cliente($id);	
			$this->load->view('header',$data);
			$this->load->view('administracion\cliente\editar',$data);
			$this->load->view('footer');
		}
		else
		{

		if($this->cliente_model->edit_cliente($id))
		 	redirect(base_url().'/cliente/listar/success', 'location');	
		else
		 	redirect(base_url().'/cliente/listar/error', 'location');	


		
		}
	}
	public function eliminar($id)
	{
		$this->load->model('cliente_model');
		if($this->cliente_model->del_cliente($id))
		 	redirect(base_url().'/cliente/listar/success', 'location');	
		else
		 	redirect(base_url().'/cliente/listar/error', 'location');	
	}
}