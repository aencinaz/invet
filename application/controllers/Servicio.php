<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Servicio extends CI_Controller {
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
		$this->load->view('administracion\servicio\links',$data);
		$data['selected']="Servicios";
		$this->load->view('main',$data);
		$this->load->view('footer');
	}

	public function listar($mensaje = FALSE)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('servicio_model');

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
		$data['servicio']=$this->servicio_model->get_servicio();	
  		
		$this->load->view('header',$data);
		//$this->load->view('administracion\servicio\links',$data);
		$this->load->view('administracion\servicio\listado',$data);
		$this->load->view('footer');
	}
	public function nuevo()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('servicio_model');
		$data['selected']="Administración";
		$data['link_selected']="Nuevo";
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
		//	$this->load->view('administracion\servicio\links',$data);
			$this->load->view('administracion\servicio\nuevo',$data);
			$this->load->view('footer');
		}
		else
		{
			
			if($this->servicio_model->set_servicio())
			 	redirect(base_url().'/servicio/listar/success', 'location');	
			else
			 	redirect(base_url().'/servicio/listar/error', 'location');	
				
			//$this->load->view('header',$data);
			//$this->load->view('administracion\servicio\links',$data);
			//$data['mensaje']="servicio Ingresado";
			//$this->load->view('sucess',$data);
			//$this->load->view('footer');
		}
	}

	public function editar($id)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('servicio_model');

		$data['selected']="Administración";
		$data['link_selected']="Listado";
		$data['id']=$id;


		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['servicio']=$this->servicio_model->get_servicio($id);	
			$this->load->view('header',$data);
	//		$this->load->view('administracion\servicio\links',$data);
			$this->load->view('administracion\servicio\editar',$data);
			$this->load->view('footer');
		}
		else
		{

			if($this->servicio_model->edit_servicio($id))	
			 	redirect(base_url().'/servicio/listar/success', 'location');	
			else
			 	redirect(base_url().'/servicio/listar/error', 'location');	
		}
	}
	public function eliminar($id)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('servicio_model');

		$data['selected']="Administración";
		$data['link_selected']="Listado";
		$data['id']=$id;


			if($this->servicio_model->del_servicio($id))	
				$this->listar('success');
			else
				$this->listar('error');


	}
}