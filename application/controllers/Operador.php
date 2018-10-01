<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Operador extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('login'))
			   redirect(base_url()."login");
	}
	

	public function listar($mensaje = FALSE)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('operador_model');

		$data['selected']="Administración";
		$data['link_selected']="Listado";
		$data['operadores']=$this->operador_model->get_operador();	



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
		$this->load->view('administracion\operador\listado',$data);
		$this->load->view('footer');
	}
	public function nuevo()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('operador_model');

		$data['selected']="Administración";
		$data['link_selected']="Nuevo";

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->view('administracion\operador\nuevo',$data);
			$this->load->view('footer');
		}
		else
		{

			if($this->operador_model->set_operador())
			 	redirect(base_url().'/operador/listar/success', 'location');	
			else
			 	redirect(base_url().'/operador/listar/error', 'location');	
		}
	}

	public function editar($id)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('operador_model');

		$data['selected']="Administración";
		$data['link_selected']="Listado";
		$data['id']=$id;


		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['operador']=$this->operador_model->get_operador($id);	
			$this->load->view('header',$data);
			$this->load->view('administracion/operador/editar',$data);
			$this->load->view('footer');
		}
		else
		{

		if($this->operador_model->edit_operador($id))
		 	redirect(base_url().'/operador/listar/success', 'location');	
		else
		 	redirect(base_url().'/operador/listar/error', 'location');			
		}
	}
	public function eliminar($id)
	{
		$this->load->model('operador_model');
		if($this->operador_model->del_operador($id))
		 	redirect(base_url().'/operador/listar/success', 'location');	
		else
		 	redirect(base_url().'/operador/listar/error', 'location');	
	}
}