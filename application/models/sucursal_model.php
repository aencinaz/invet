<?php
class Sucursal_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get_sucursal($id = FALSE)
	{
		if ($id === FALSE)
		{
			$this->db->select('sucursales.*,clientes.nombre as nombre_cliente');
			$this->db->from('sucursales');
			$this->db->join('clientes', 'clientes.id_cliente = sucursales.id_cliente');
			$this->db->order_by("nombre", "asc"); 
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('sucursales', array('id_sucursal' => $id));
		return $query->row_array();
	}
	public function set_sucursal()
	{
		$data = array('nombre' => $this->input->post('nombre'),
				'ubicacion' => $this->input->post('ubicacion'),
				'id_cliente' => $this->input->post('id_cliente')	
			);
		return $this->db->insert('sucursales', $data);
	}	
	public function edit_sucursal($id)
	{
		$data = array('nombre' => $this->input->post('nombre'),
				'ubicacion' => $this->input->post('ubicacion')		
			);
			$this->db->where('id_sucursal', $id);
		return $this->db->update('sucursales', $data);
	}


	public function del_sucursal($id)
	{
		$this->db->where('id_sucursal', $id);
		return $this->db->delete('sucursales');
	}
}

