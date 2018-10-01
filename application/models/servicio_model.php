<?php
class Servicio_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get_servicio($id = FALSE)
	{
		if ($id === FALSE)
		{
			$this->db->select('*');
			$this->db->from('servicios');
			$this->db->order_by("nombre", "asc"); 
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('servicios', array('id_servicio' => $id));
		return $query->row_array();
	}
	public function set_servicio()
	{
		$data = array('nombre' => $this->input->post('nombre'),
				'descripcion' => $this->input->post('descripcion')	
			);
		return $this->db->insert('servicios', $data);
	}	
	public function edit_servicio($id)
	{
		$data = array('nombre' => $this->input->post('nombre'),
				'descripcion' => $this->input->post('descripcion')		
			);
			$this->db->where('id_servicio', $id);
		return $this->db->update('servicios', $data);
	}


	public function del_servicio($id)
	{
		$this->db->where('id_servicio', $id);
		return $this->db->delete('servicios');
	}
}

