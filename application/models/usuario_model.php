<?php
class usuario_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get_usuario($id = FALSE)
	{
		if ($id === FALSE)
		{
			$this->db->select('*');
			$this->db->from('usuarios');
			$this->db->order_by("login", "asc"); 
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('usuarios', array('id_usuario' => $id));
		return $query->row_array();
	}


	public function get_usuario_access($login)
	{
		$query = $this->db->get_where('usuarios', array('login' => $login));
		return $query->row_array();
	}

	public function set_usuario()
	{
		$data = array('login' => $this->input->post('login'),
				'nombre' => $this->input->post('nombre'),
				'pass' => $this->input->post('pass')
			);



		return $this->db->insert('usuarios', $data);
	}	

	public function edit_usuario($id)
	{
		$data = array('nombre' => $this->input->post('nombre'),
						'login' => $this->input->post('login')
			);
			$this->db->where('id_usuario', $id);
		return $this->db->update('usuarios', $data);
	}


	public function del_usuario($id)
	{
		$this->db->where('id_usuario', $id);
		return $this->db->delete('usuarios');
	}

	public function edit_password()
	{
		$data = array('password' =>  md5($this->input->post('password')));
		$id = $this->input->post('id_usuario');
		$this->db->where('id', $id);
		return $this->db->update('usuarios', $data);;
	}

}

