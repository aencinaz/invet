<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sucursal extends CI_Controller {
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
		$this->load->view('administracion\sucursal\links',$data);
		$data['selected']="Sucursales";
		$this->load->view('main',$data);
		$this->load->view('footer');
	}

	public function listar($mensaje = FALSE)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('sucursal_model');

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

		$data['selected']="Administración";
		$data['link_selected']="Listado";
		$data['sucursal']=$this->sucursal_model->get_sucursal();	
  		
		$this->load->view('header',$data);
		$this->load->view('administracion\sucursal\listado',$data);
		$this->load->view('footer');
	}


	public function nuevo()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('sucursal_model');

		$this->load->model('cliente_model');
		$data['clientes']=$this->cliente_model->get_cliente();	
		$data['selected']="Administración";
		$data['link_selected']="Nuevo";

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->view('administracion\sucursal\nuevo',$data);
			$this->load->view('footer');
		}
		else
		{
			if($this->sucursal_model->set_sucursal())
			 	redirect(base_url().'/sucursal/listar/success', 'location');	
			else
			 	redirect(base_url().'/sucursal/listar/error', 'location');	

		}
	}

	public function editar($id)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('sucursal_model');

		$data['selected']="Administración";
		$data['link_selected']="Listado";
		$data['id']=$id;


		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['sucursal']=$this->sucursal_model->get_sucursal($id);	
			$this->load->view('header',$data);
			$this->load->view('administracion\sucursal\editar',$data);
			$this->load->view('footer');
		}
		else
		{
			if($this->sucursal_model->edit_sucursal($id))
			 	redirect(base_url().'/sucursal/listar/success', 'location');	
			else
			 	redirect(base_url().'/sucursal/listar/error', 'location');	
		}
	}

	public function eliminar($id)
	{
		$this->load->model('sucursal_model');

		if($this->sucursal_model->del_sucursal($id))
			 	redirect(base_url().'/sucursal/listar/success', 'location');	
		else
			 	redirect(base_url().'/sucursal/listar/error', 'location');	
	}
}