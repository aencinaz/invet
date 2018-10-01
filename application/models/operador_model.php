<?php
class Operador_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get_operador($id = FALSE)
	{
		if ($id === FALSE)
		{
			$this->db->select('*');
			$this->db->from('operadores');
			$this->db->order_by("nombre", "asc"); 
			$query = $this->db->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('operadores', array('id_operador' => $id));
		return $query->row_array();
	}

	
	public function set_operador()
	{
		$data = array('nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido')
			);
		return $this->db->insert('operadores', $data);
	}	
	public function edit_operador($id)
	{
		$data = array('nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido')				
				);
			$this->db->where('id_operador', $id);
		return $this->db->update('operadores', $data);
	}
	public function del_operador($id)
	{
		$this->db->where('id_operador', $id);
		return $this->db->delete('operadores');
	}

	public function get_rendimiento($fecha_actividad)
	{
		$formato = 'Y-m';
		$fecha = DateTime::createFromFormat($formato, $fecha_actividad);
	
			$this->db->select('nombre,apellido,rendimiento.id_operador,month(fecha_actividad) as mes,sum(rendimiento.cantidad_actividades) as cnt_actividades,sum(rendimiento.movimientos) as cnt_movimientos');
			$this->db->from('rendimiento');
			$this->db->join('operadores', 'operadores.id_operador = rendimiento.id_operador');
			$this->db->where('year(fecha_actividad)=',$fecha->format('Y'));
			$this->db->where('month(fecha_actividad)=',$fecha->format('m'));
			$this->db->group_by(array("nombre","apellido","id_operador","mes"));
			$query = $this->db->get();
			return $query->result_array();
	}
}

