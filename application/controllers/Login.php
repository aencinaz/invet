<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	public function index()
	{
		$this->load->library(array('form_validation'));
		$this->load->helper('url');
		$this->form_validation->set_rules('login', 'Usuario', 'required');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		$data['mensaje']='';

		if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('login',$data);
			}
		else
		{			
				$login =$this->input->post('login');
				$password 	=$this->input->post('password');	
				if($this->loginuser($login,$password)){
						redirect(base_url(), 'location');
				}
				else{
						$data['mensaje']='<p>Usuario o contraseña incorrecta</p>';
						$this->load->view('login',$data);
				}
		
		}
	}
	private function loginuser($login,$password)
	{
				$this->load->model('usuario_model');
				$user_data=$this->usuario_model->get_usuario_access($login);
				if($user_data == TRUE)
				{
					if($user_data['pass']==$password)
					{
						$this->load->library('session');
						$data = array(
		                'is_logued_in' 	=> 		TRUE,
		                'id_usuario' 			=>		$user_data['id_usuario'],
		                'login' 		=> 		$user_data['login']
            			);	
						$this->session->set_userdata($data);
						return true;
					}
					else
					{
						return false;
					}
				}
				else
				{		
					return false;
				}	
	}
	public function cerrar()
	{	
		$data = array(
	                'is_logued_in',
	                'id_usuario',
	                'perfil',
	                'nombre',
	                'apellido',
	                'login'
	                );
		$this->session->unset_userdata($data);
		redirect(base_url()."login");
	}
}