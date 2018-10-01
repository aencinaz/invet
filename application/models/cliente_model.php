<?php
class Cliente_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get_cliente($id = FALSE)
	{
		if ($id === FALSE)
		{
			$this->db->select('*');
			$this->db->from('clientes');
			$this->db->order_by("nombre", "asc"); 
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('clientes', array('id_cliente' => $id));
		return $query->row_array();
	}

	public function get_sucursal($id)
	{
		$query = $this->db->get_where('sucursales', array('id_cliente' => $id));
		return $query->result_array();
	}

	
	public function set_cliente()
	{
		$data = array('nombre' => $this->input->post('nombre'),
				'rut' => $this->input->post('rut'),
				'telefono' => $this->input->post('telefono'),
				'direccion' => $this->input->post('direccion')
			);
		return $this->db->insert('clientes', $data);
	}	
	public function edit_cliente($id)
	{
		$data = array('nombre' => $this->input->post('nombre'),
				'rut' => $this->input->post('rut'),
				'telefono' => $this->input->post('telefono'),
				'direccion' => $this->input->post('direccion')
				);
			$this->db->where('id_cliente', $id);
		return $this->db->update('clientes', $data);
	}
	public function del_cliente($id)
	{
		$this->db->where('id_cliente', $id);
		return $this->db->delete('clientes');
	}
     
}

