<?php
class Actividad_model extends CI_Model {


	var $table = 'actividades';
	var $column_order = array(null, 'fecha_actividad','nombre_sucursal','nombre_cliente','finalizada'); //set column field database for datatable orderable
	var $column_search = array('fecha_actividad','sucursales.nombre','clientes.nombre'); //set column field database for datatable searchable 
	var $order = array('fecha_actividad' => 'desc'); // default order 



		public function __construct()
	{
		$this->load->database();
	}
		public function get_actividad($id = FALSE)
	{
		if ($id === FALSE)
		{
			$this->db->select('actividades.*,sucursales.nombre as nombre_sucursal,clientes.nombre as nombre_cliente');
			$this->db->from('actividades');
			$this->db->join('sucursales', 'sucursales.id_sucursal = actividades.id_sucursal');
			$this->db->join('clientes', 'clientes.id_cliente = sucursales.id_cliente');
			$this->db->order_by("fecha_actividad", "asc"); 
			$query = $this->db->get();
			return $query->result_array();
		}

		$this->db->select('actividades.*,sucursales.nombre as nombre_sucursal,clientes.nombre as nombre_cliente');
		$this->db->from('actividades');
		$this->db->join('sucursales', 'sucursales.id_sucursal = actividades.id_sucursal');
		$this->db->join('clientes', 'clientes.id_cliente = sucursales.id_cliente');
		$this->db->where('id_actividad='.$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	
public function get_events($start, $end)
{
		$this->db->select('actividades.*,sucursales.nombre as nombre_sucursal,clientes.nombre as nombre_cliente');
		$this->db->from('actividades');
		$this->db->join('sucursales', 'sucursales.id_sucursal = actividades.id_sucursal');
		$this->db->join('clientes', 'clientes.id_cliente = sucursales.id_cliente');
		$this->db->where("fecha_actividad >=", $start);
    	$this->db->where("fecha_actividad <=", $end);

    	return 	$query = $this->db->get();
	 
   
}

public function get_actividad_pendiente($fecha = FALSE)
	{

		$this->db->select('actividades.*,sucursales.nombre as nombre_sucursal,clientes.nombre as nombre_cliente');
		$this->db->from('actividades');
		$this->db->join('sucursales', 'sucursales.id_sucursal = actividades.id_sucursal');
		$this->db->join('clientes', 'clientes.id_cliente = sucursales.id_cliente');
		if ($fecha==TRUE)
		{
			$this->db->where('finalizada='."0");
			$this->db->where('fecha_actividad=',$fecha);
		}
		else
		{
			$this->db->where('finalizada='."0");
		}
		$this->db->order_by("fecha_actividad", "asc"); 
		
		$query = $this->db->get();
		return $query->result_array();
	}


public function get_actividad_realizadas($fecha = FALSE)
	{

		$this->db->select('actividades.*,sucursales.nombre as nombre_sucursal,clientes.nombre as nombre_cliente');
		$this->db->from('actividades');
		$this->db->join('sucursales', 'sucursales.id_sucursal = actividades.id_sucursal');
		$this->db->join('clientes', 'clientes.id_cliente = sucursales.id_cliente');
		if ($fecha==TRUE)
		{
			$this->db->where('finalizada='."1");
			$this->db->where('fecha_actividad=',$fecha);
		}
		else
		{
			$this->db->where('finalizada='."1");
		}
		$this->db->order_by("fecha_actividad", "asc"); 
		
		$query = $this->db->get();
		return $query->result_array();
	}


public function get_actividad_realizadas_cliente($id_cliente)
	{

		$this->db->select('actividades.*,sucursales.nombre as nombre_sucursal,clientes.nombre as nombre_cliente');
		$this->db->from('actividades');
		$this->db->join('sucursales', 'sucursales.id_sucursal = actividades.id_sucursal');
		$this->db->join('clientes', 'clientes.id_cliente = sucursales.id_cliente');
		$this->db->where('finalizada='."1");
		$this->db->where('clientes.id_cliente='.$id_cliente);
		$this->db->order_by("fecha_actividad", "asc"); 
		
		$query = $this->db->get();
		return $query->result_array();
	}







public function get_actividades_servicios($id_actividad)
	{
			$this->db->select('servicios.*');
			$this->db->from('servicios');
			$this->db->join('actividades_servicios', 'actividades_servicios.id_servicio = servicios.id_servicio');
			$this->db->where('actividades_servicios.id_actividad='.$id_actividad);
			$query = $this->db->get();
			return $query->result_array();
	}
public function get_actividades_operadores($id_actividad)
	{
		$this->db->select('operadores.*');
		$this->db->from('operadores');
		$this->db->join('actividades_operadores', 'actividades_operadores.id_operador = operadores.id_operador');
		$this->db->where('actividades_operadores.id_actividad='.$id_actividad);
		$query = $this->db->get();
		return $query->result_array();
	}

public function get_actividades_operador($fecha,$id_operador)
	{

		$formato = 'Y-m';
		$fecha = DateTime::createFromFormat($formato, $fecha);
		$this->db->select('actividades.*,sucursales.nombre as nombre_sucursal,clientes.nombre as nombre_cliente');
		$this->db->from('actividades');
		$this->db->join('actividades_operadores', 'actividades_operadores.id_actividad = actividades.id_actividad');
		$this->db->join('sucursales', 'sucursales.id_sucursal = actividades.id_sucursal');
		$this->db->join('clientes', 'clientes.id_cliente = sucursales.id_cliente');
		$this->db->where('actividades_operadores.id_operador='.$id_operador);
		$this->db->where('finalizada='."1");
		$this->db->where('MONTH(actividades.fecha_actividad)='.$fecha->format('m'));
		$this->db->where('YEAR(actividades.fecha_actividad)='.$fecha->format('Y'));

		$this->db->order_by("fecha_actividad", "asc"); 
		
		$query = $this->db->get();
		return $query->result_array();
	}







public function set_movimiento($id_actividad,$fecha,$motivo)
	{
		$data = array('id_actividad' => $id_actividad,
				'fecha_destino' => $fecha,
				'motivo' => $motivo
			);
		return $this->db->insert('movimientos', $data);
	}	


	public function set_actividad($id_sucursal,$periodo,$fecha_actividad,$finalizada,$observaciones)
	{
		$data = array('id_sucursal' => $id_sucursal,
				'periodo' => $periodo,
				'fecha_actividad' => $fecha_actividad,
				'finalizada' => $finalizada,
				'observaciones' => $observaciones
			);


		return $this->db->insert('actividades', $data);
	}	

public function set_actividad_servicio($id_actividad,$id_servicio)
	{
		$data = array('id_actividad' => $id_actividad,
				'id_servicio' => $id_servicio
			);
		return $this->db->insert('actividades_servicios', $data);
	}	

public function set_actividad_operador($id_actividad,$id_operador)
	{
		$data = array('id_actividad' => $id_actividad,
				'id_operador' => $id_operador
			);
		return $this->db->insert('actividades_operadores', $data);
	}	


public function edit_actividad_ajax($id,$fecha)
	{
		$data = array('fecha_actividad' => $fecha);
		$this->db->where('id_actividad', $id);
		return $this->db->update('actividades', $data);
	}

public function edit_actividad($id)
	{
		$data = array(
				'fecha_actividad' => $this->input->post('fecha_actividad'),
				'observaciones' => $this->input->post('observaciones')
				);
			$this->db->where('id_actividad', $id);
		return $this->db->update('actividades', $data);
	}


public function finalizar($id)
	{
		$data = array('finalizada' => TRUE
				);
			$this->db->where('id_actividad', $id);
		return $this->db->update('actividades', $data);
	}



private function _get_datatables_query()
	{
		$this->db->select('actividades.*,sucursales.nombre as nombre_sucursal,clientes.nombre as nombre_cliente');
		$this->db->from('actividades');
		$this->db->join('sucursales', 'sucursales.id_sucursal = actividades.id_sucursal');
		$this->db->join('clientes', 'clientes.id_cliente = sucursales.id_cliente');
		
		//$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}	
	public function del_actividad($id)
	{
		$this->db->where('id_actividad', $id);
		return $this->db->delete('actividades');
	}

	public function del_actividad_servicios($id)
	{
		$this->db->where('id_actividad', $id);
		return $this->db->delete('actividades_servicios');
	}
	public function del_actividad_operadores($id)
	{
		$this->db->where('id_actividad', $id);
		return $this->db->delete('actividades_operadores');
	}
}

