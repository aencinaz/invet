<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class usuario extends CI_Controller {
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
		$this->load->view('administracion\usuario\links',$data);
		$data['selected']="Usuarios";
		$this->load->view('main',$data);
		$this->load->view('footer');
	}

	public function listar($mensaje = FALSE)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('usuario_model');

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
		$data['usuario']=$this->usuario_model->get_usuario();	
  		
		$this->load->view('header',$data);
		$this->load->view('administracion\usuario\listado',$data);
		$this->load->view('footer');
	}
	public function nuevo()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('usuario_model');

		$data['selected']="Administración";
		$data['link_selected']="Nuevo";

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->view('administracion\usuario\nuevo',$data);
			$this->load->view('footer');
		}
		else
		{
			

			if($this->usuario_model->set_usuario())
			 	redirect(base_url().'/usuario/listar/success', 'location');	
			else
			 	redirect(base_url().'/usuario/listar/error', 'location');

		}
	}

	public function editar($id)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('usuario_model');

		$data['selected']="Administración";
		$data['link_selected']="Listado";
		$data['id']=$id;


		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['usuario']=$this->usuario_model->get_usuario($id);	
			$this->load->view('header',$data);
			$this->load->view('administracion\usuario\editar',$data);
			$this->load->view('footer');
		}
		else
		{
			

			if($this->usuario_model->edit_usuario($id))
			 	redirect(base_url().'/usuario/listar/success', 'location');	
			else
			 	redirect(base_url().'/usuario/listar/error', 'location');
	
		}
	}
	public function eliminar($id)
	{
			$this->load->model('usuario_model');
	
			if($this->usuario_model->del_usuario($id))
			 	redirect(base_url().'/usuario/listar/success', 'location');	
			else
			 	redirect(base_url().'/usuario/listar/error', 'location');

	}
}