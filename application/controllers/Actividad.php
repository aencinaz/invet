<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Actividad extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('login'))
			   redirect(base_url()."login");
	}
	

	public function index()
	{
		$this->load->helper('url');
		$data['selected']="Actividades";
		$data['link_selected']="";

		$this->load->view('header',$data);
		$this->load->view('main');
		$this->load->view('footer');
	}

	public function servicios_ajax()
	{
			$id_actividad = $this->input->post("id_actividad");
			$this->load->model('actividad_model');
			$servicios=$this->actividad_model->get_actividades_servicios($id_actividad);
			$operadores=$this->actividad_model->get_actividades_operadores($id_actividad);
			echo "<div class='row'>";
			echo "<div class='col'>";
			echo '<ul class="list-group">';
			echo ' <li class="list-group-item active">Servicios</li>';
			foreach ($servicios as $item) {
				echo '<li class="list-group-item">'.$item['nombre']."  ".$item['descripcion']."</li>";
			}
			echo "</ul>";
			echo "</div>";
			echo "<div class='col'>";
			echo '<ul class="list-group">';
			echo ' <li class="list-group-item active">Operadores</li>';
			
			foreach ($operadores as $item) {
				echo '<li class="list-group-item">'.$item['nombre']." ".$item['apellido']."</li>";
			}
				echo "</ul>";
			echo "</div>";

			echo "<div>";
	}


		public function listar($mensaje = FALSE)
	{
		$this->load->helper('url');
		$this->load->model('actividad_model');
		$data['selected']="Actividades";
		$data['link_selected']="Listado";
		$data['actividad']=$this->actividad_model->get_actividad();	


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
		$this->load->view('actividad\lista');
		$this->load->view('footer');
	}

	public function get_events()
 {
 	date_default_timezone_set('America/Santiago');
	 // Our Start and End Dates
     $start = $this->input->get("start");
     $end = $this->input->get("end");

     $startdt = new DateTime('now'); // setup a local datetime
     $startdt->setTimestamp($start); // Set the date based on timestamp
     $start_format = $startdt->format('Y-m-d H:i:s');

     $enddt = new DateTime('now'); // setup a local datetime
     $enddt->setTimestamp($end); // Set the date based on timestamp
     $end_format = $enddt->format('Y-m-d H:i:s');

	$this->load->model('actividad_model');
		
     $events = $this->actividad_model->get_events($start_format, $end_format);

     $data_events = array();

     foreach($events->result() as $r) {

	$hoy = date("Y-m-d"); 
	
			if($r->finalizada) {
         			$color='#01DF74'; //verde
         	}
         	else
         	{
         		if($r->fecha_actividad < $hoy)
					{$color='#FF0040';} //rojo
				else
					{$color='#2E9AFE';}//azul
         			
         	}

         $data_events[] = array(
         	 "color" => $color,
         	 "id_actividad" => $r->id_actividad,
         	 "description" => 					"<table class='table'>
         	 										<tr><td>Sucursal	</td><td>".$r->nombre_sucursal."</td></tr>
         	 										<tr><td>Fecha 		</td><td>".$r->fecha_actividad."</td></tr>
         	 										<tr><td>Observación </td><td>".$r->observaciones."</td></tr>
         	 										</table>",
             "title" => $r->nombre_cliente,
             "start" => $r->fecha_actividad,
             "finalizada" => $r->finalizada,
         );
     }

     echo json_encode(array("events" => $data_events));
     exit();
     

 }

	public function editar_ajax()
	{
			$fecha = $_POST["fecha"];
			$id_actividad = $_POST["id_actividad"];
			$motivo = $_POST["motivo"];
			$this->load->model('actividad_model');
			$this->actividad_model->edit_actividad_ajax($id_actividad,$fecha);	
			$this->actividad_model->set_movimiento($id_actividad,$fecha,$motivo);			
	}
	public function Calendario()
	{
		$this->load->helper('url');
		$this->load->model('actividad_model');
		$data['selected']="Calendario";
		$data['link_selected']="Calendario";
		$this->load->view('header',$data);
		$this->load->view('actividad\calendario');
		$this->load->view('footer');
	}



	public function finalizar($id)
	{

			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->helper('url_helper');
			$this->load->model('actividad_model');
			$this->load->helper('date');
			$data['selected']="Actividades";
			$data['link_selected']="Finalizar";
			$data['id']=$id;

			$this->form_validation->set_rules('fecha_actividad', 'Fecha', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['actividad']=$this->actividad_model->get_actividad($id);	
				$this->load->view('header',$data);
				$this->load->view('actividad\finalizar',$data);
				$this->load->view('footer');
			}
			else
			{
				if($this->actividad_model->finalizar($id))
				{
					//$this->actividad_model->set_actividad();
					redirect(base_url().'actividad/listar/success', 'location');	
				}
				else
			 		redirect(base_url().'actividad/listar/error', 'location');
			}		
	}



	


	public function nuevo()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->helper('date');
		
		$this->load->model('sucursal_model');
		$this->load->model('cliente_model');
		$this->load->model('servicio_model');
		$this->load->model('operador_model');
		$this->load->model('actividad_model');

		
		$data['clientes']=$this->cliente_model->get_cliente();	
		$data['servicios']=$this->servicio_model->get_servicio();	
		$data['operadores']=$this->operador_model->get_operador();	
			

		$data['selected']="Actividades";
		$data['link_selected']="Nuevo";

		$this->form_validation->set_rules('id_sucursal', 'Sucursal', 'required');
		$this->form_validation->set_rules('id_cliente', 'Cliente', 'required');
		
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->view('actividad\nuevo',$data);
			$this->load->view('footer');
		}
		else
		{
			$id_servicio = $this->input->post('id_servicio');
			$seleccionados = $this->input->post('seleccionados');
			
			$id_operador = $this->input->post('id_operador');
			$id_sucursal = $this->input->post('id_sucursal');
			$periodo = $this->input->post('periodo');
			$fecha_actividad = $this->input->post('fecha_actividad');
			$fecha_termino = $this->input->post('fecha_termino');
			$finalizada = FALSE;
			$observaciones = $this->input->post('observaciones');
			$fecha_termino = new DateTime($fecha_termino);
			$actividades=array();
			foreach ($seleccionados as $key ) {
				$fecha = new DateTime($fecha_actividad[$key]);
					while ( $fecha < $fecha_termino) {
						$actividades[$fecha->format('Y-m-d')][]=$id_servicio[$key];
						$fecha->add(new DateInterval('P'.$periodo[$key].'D'));
					}
			}


			foreach ($actividades as $key => $value) {
				
				$this->actividad_model->set_actividad($id_sucursal,"0",$key,$finalizada,$observaciones);
				$id_actividad=$this->db->insert_id();
				foreach ($value as $servicios) {
						$this->actividad_model->set_actividad_servicio($id_actividad,$servicios);		
					}
				foreach ($id_operador as $values) {
						$this->actividad_model->set_actividad_operador($id_actividad,$values);		
					}

					
			}
			
			redirect(base_url().'/actividad/listar/success', 'location');	
	}
	}



	public function ajax_list()
	{
		$this->load->model('actividad_model','item');
		$this->load->helper('url');
		
		$list = $this->item->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = date("d-m-Y",strtotime($item->fecha_actividad)) ;
			$row[] = $item->nombre_cliente;
			$row[] = $item->nombre_sucursal;
			if($item->finalizada){
				$row[] = "Finalizada";
			}
			else{
				$row[] = "Pendiente";
			}

			$row[] = '<a href="'. base_url().'actividad/ficha/'.$item->id_actividad.'/muestra">Ficha</a>';
			if($item->finalizada)
				{
					$row[] = '';
					$row[] = '';
				}	
			else
			{
				$row[] = '<a href="'. base_url().'actividad/editar/'.$item->id_actividad.'">Editar</a>';
				$row[] = '<a href="'. base_url().'actividad/finalizar/'.$item->id_actividad.'">Finalizar</a>';
			}

			$row[] = '<a onclick="return confirmar()" href="'. base_url().'actividad/eliminar/'.$item->id_actividad.'">Eliminar</a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->item->count_all(),
						"recordsFiltered" => $this->item->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}



	public function ficha($id)
	{

		$this->load->helper('url');
		$this->load->model('actividad_model');
		
		
		$data['selected']="Actividades";
		$data['link_selected']="Listado";
		$data['actividad']=$this->actividad_model->get_actividad($id);	

		$data['operadores']=$this->actividad_model->get_actividades_operadores($id);	
		$data['servicios']=$this->actividad_model->get_actividades_servicios($id);	
		
		$this->load->view('header',$data);
		$this->load->view('actividad\ficha',$data);
		$this->load->view('footer');
	}


	public function editar($id)
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->load->model('actividad_model');

		$data['selected']="Actividades";
		$data['link_selected']="Listado";
		$data['id']=$id;

		$this->form_validation->set_rules('fecha_actividad', 'Fecha', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['actividad']=$this->actividad_model->get_actividad($id);	
			$data['operadores_actividad']=$this->actividad_model->get_actividades_operadores($id);	
			$data['servicios_actividad']=$this->actividad_model->get_actividades_servicios($id);	
		
			$this->load->model('servicio_model');
			$this->load->model('operador_model');

			$data['servicios']=$this->servicio_model->get_servicio();	
			$data['operadores']=$this->operador_model->get_operador();	
		
			$this->load->view('header',$data);
			$this->load->view('actividad\editar',$data);
			$this->load->view('footer');
		}
		else
		{

			if($this->actividad_model->edit_actividad($id)){
				$this->actividad_model->del_actividad_operadores($id);
				$this->actividad_model->del_actividad_servicios($id);


					$id_servicio = $this->input->post('id_servicio');
					foreach ($id_servicio as $values) {
						$this->actividad_model->set_actividad_servicio($id,$values);
						}		
					
					$id_operador = $this->input->post('id_operador');
					foreach ($id_operador as $values) {
						$this->actividad_model->set_actividad_operador($id,$values);		
					}


			 	redirect(base_url().'/actividad/listar/success', 'location');	
			}
			else
			 	redirect(base_url().'/actividad/listar/error', 'location');
	
		}
	}

	public function eliminar($id)
	{
		$this->load->model('actividad_model');
		if($this->actividad_model->del_actividad($id))
		 	redirect(base_url().'/actividad/listar/success', 'location');	
		else
		 	redirect(base_url().'/actividad/listar/error', 'location');	
	}

}