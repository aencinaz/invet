<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Informes extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('login'))
			   redirect(base_url()."login");
	}
		
public function planificadas()
	{

			$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
	
		$data['selected']="Informes";
		$data['link_selected']="Nuevo";

		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
	
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->view('informes\planificadas',$data);
			$this->load->view('footer');
		}
		else
		{		

						$this->load->library('PHPExcel.php');
				        $file = './assets/plantillaxls/informe.xlsx';                             
				        $this->phpexcel = PHPExcel_IOFactory::load($file);
				        // configuramos las propiedades del documento
				        $this->phpexcel->getProperties()->setCreator("Invet Austral")
				                                     ->setLastModifiedBy("Invet Austral")
				                                     ->setTitle("Actividades Planificadas")
				                                     ->setSubject("")
				                                     ->setDescription("")
				                                     ->setKeywords("")
				                                     ->setCategory("");         
				        // agregamos información a las celdas
				      $this->load->model('actividad_model');
				      $actividades = $this->actividad_model->get_actividad_pendiente($this->input->post('fecha'));
				      $i=1;
				      $j=5;
				      $aux1;
				      $aux2;
				      $inicio;
				      foreach ($actividades as $key ) {
				      	$inicio=$j;
				        $this->phpexcel->setActiveSheetIndex(0)
				        ->setCellValue('A'.$j, $i)
				        ->setCellValue('B'.$j, $key['nombre_cliente'])
				        ->setCellValue('C'.$j, $key['nombre_sucursal'])
				        ->setCellValue('D'.$j, $key['observaciones']);

				        $servicios=$this->actividad_model->get_actividades_servicios($key['id_actividad']);
							$operadores=$this->actividad_model->get_actividades_operadores($key['id_actividad']);
							$aux=$j;
							foreach ($servicios as $item) {
								 $this->phpexcel->setActiveSheetIndex(0)->setCellValue('E'.$j, $item['nombre']); 
							$j++;
							}
							$aux2=$j;
							$j=$aux;
							foreach ($operadores as $item) {
								$this->phpexcel->setActiveSheetIndex(0)->setCellValue('F'.$j, $item['nombre']." ".$item['apellido']); 
							$j++;
							}
							if($aux>$aux2)
								$j=$j+$aux;
							$this->phpexcel->getActiveSheet()->getStyle('A'.$inicio.':F'.$j)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

				        $i++;
				        $j++;
				      }  


				    


						 $this->phpexcel->setActiveSheetIndex(0)->setCellValue('B'.'2', 'INFORME DE ACTIVIDADES A REALIZAR '.date("d-m-Y",strtotime($this->input->post('fecha')))); 
				        // Renombramos la hoja de trabajo
				        $this->phpexcel->getActiveSheet()->setTitle('Actividades del día');         
				        // configuramos el documento para que la hoja
				        // de trabajo número 0 sera la primera en mostrarse
				        // al abrir el documento
				        $this->phpexcel->setActiveSheetIndex(0);
				        // redireccionamos la salida al navegador del cliente (Excel2007)
				        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				        header('Content-Disposition: attachment;filename="informediario.xlsx"');
				        header('Cache-Control: max-age=0');         
				        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
				        $objWriter->save('php://output');
				        redirect(base_url(), 'location');	

		}


	}

	public function finalizadas()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		
		$data['selected']="Informes";
		$data['link_selected']="Nuevo";

		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
	
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->view('informes\finalizadas',$data);
			$this->load->view('footer');
		}
		else
		{		

						$this->load->library('PHPExcel.php');
				        $file = './assets/plantillaxls/informe.xlsx';                             
				        $this->phpexcel = PHPExcel_IOFactory::load($file);
				        // configuramos las propiedades del documento
				        $this->phpexcel->getProperties()->setCreator("Invet Austral")
				                                     ->setLastModifiedBy("Invet Austral")
				                                     ->setTitle("Actividades Realizadas")
				                                     ->setSubject("")
				                                     ->setDescription("")
				                                     ->setKeywords("")
				                                     ->setCategory("");         
				        // agregamos información a las celdas
				      $this->load->model('actividad_model');
				      $actividades = $this->actividad_model->get_actividad_realizadas($this->input->post('fecha'));
				      $i=1;
				      $j=5;
				      $aux1;
				      $aux2;
				      $inicio;
				      foreach ($actividades as $key ) {
				      	$inicio=$j;
				        $this->phpexcel->setActiveSheetIndex(0)
				        ->setCellValue('A'.$j, $i)
				        ->setCellValue('B'.$j, $key['nombre_cliente'])
				        ->setCellValue('C'.$j, $key['nombre_sucursal'])
				        ->setCellValue('D'.$j, $key['observaciones']);

				        $servicios=$this->actividad_model->get_actividades_servicios($key['id_actividad']);
							$operadores=$this->actividad_model->get_actividades_operadores($key['id_actividad']);
							$aux=$j;
							foreach ($servicios as $item) {
								 $this->phpexcel->setActiveSheetIndex(0)->setCellValue('E'.$j, $item['nombre']); 
							$j++;
							}
							$aux2=$j;
							$j=$aux;
							foreach ($operadores as $item) {
								$this->phpexcel->setActiveSheetIndex(0)->setCellValue('F'.$j, $item['nombre']." ".$item['apellido']); 
							$j++;
							}
							if($aux>$aux2)
								$j=$j+$aux;
							$this->phpexcel->getActiveSheet()->getStyle('A'.$inicio.':F'.$j)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

				        $i++;
				        $j++;
				      }  


				    


						 $this->phpexcel->setActiveSheetIndex(0)->setCellValue('B'.'2', 'INFORME DE ACTIVIDADES FINALIZADAS '.$this->input->post('fecha')); 
				        // Renombramos la hoja de trabajo
				        $this->phpexcel->getActiveSheet()->setTitle('Actividades del día');         
				        // configuramos el documento para que la hoja
				        // de trabajo número 0 sera la primera en mostrarse
				        // al abrir el documento
				        $this->phpexcel->setActiveSheetIndex(0);
				        // redireccionamos la salida al navegador del cliente (Excel2007)
				        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				        header('Content-Disposition: attachment;filename="informefinalizadas.xlsx"');
				        header('Cache-Control: max-age=0');         
				        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
				        $objWriter->save('php://output');
				        redirect(base_url(), 'location');	

		}
	}
	public function operador()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		
		$data['selected']="Informes";
		$data['link_selected']="Nuevo";

		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('id_operador', 'Operador', 'required');
	
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('operador_model');
			$data['operadores']=$this->operador_model->get_operador();    
			$this->load->view('header',$data);
			$this->load->view('informes\operador',$data);
			$this->load->view('footer');
		}
		else
		{		

						$this->load->library('PHPExcel.php');
				        $file = './assets/plantillaxls/informeoperadores.xlsx';                             
				        $this->phpexcel = PHPExcel_IOFactory::load($file);
				        // configuramos las propiedades del documento
				        $this->phpexcel->getProperties()->setCreator("Invet Austral")
				                                     ->setLastModifiedBy("Invet Austral")
				                                     ->setTitle("Actividades Realizadas")
				                                     ->setSubject("")
				                                     ->setDescription("")
				                                     ->setKeywords("")
				                                     ->setCategory("");         
				        // agregamos información a las celdas
				      $this->load->model('actividad_model');
				      $actividades = $this->actividad_model->get_actividades_operador($this->input->post('fecha'),$this->input->post('id_operador'));
				      $this->load->model('operador_model');
				      $operador = $this->operador_model->get_operador($this->input->post('id_operador'));
				      $i=1;
				      $j=6;
				      foreach ($actividades as $key ) {
				        $this->phpexcel->setActiveSheetIndex(0)
				        ->setCellValue('A'.$j, $i)
				        ->setCellValue('B'.$j, date("d-m-Y",strtotime($key['fecha_actividad'])))
				        ->setCellValue('C'.$j, $key['nombre_cliente'])
				        ->setCellValue('D'.$j, $key['nombre_sucursal'])
				        ->setCellValue('E'.$j, $key['observaciones']);
						$this->phpexcel->getActiveSheet()->getStyle('A'.$j.':E'.$j)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				        $i++;
				        $j++;
				      }  


				    


						 $this->phpexcel->setActiveSheetIndex(0)->setCellValue('B'.'2', 'INFORME DE ACTIVIDADES FINALIZADAS '.date("m-Y",strtotime($this->input->post('fecha')))); 
						 $this->phpexcel->setActiveSheetIndex(0)->setCellValue('B'.'3', $operador['nombre']." ".$operador['apellido']); 
						 
				        // Renombramos la hoja de trabajo
				        $this->phpexcel->getActiveSheet()->setTitle('Actividades del día');         
				        // configuramos el documento para que la hoja
				        // de trabajo número 0 sera la primera en mostrarse
				        // al abrir el documento
				        $this->phpexcel->setActiveSheetIndex(0);
				        // redireccionamos la salida al navegador del cliente (Excel2007)
				        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				        header('Content-Disposition: attachment;filename="informefinalizadas.xlsx"');
				        header('Cache-Control: max-age=0');         
				        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
				        $objWriter->save('php://output');
				        redirect(base_url(), 'location');	
				 }

	}
	public function rendimiento()
	{
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$this->form_validation->set_rules('fecha', 'fecha', 'required');
				if ($this->form_validation->run() == FALSE)
					{
						$data['selected']="Informes";
						$this->load->model('operador_model');
						//$data['rendimiento']=$this->operador_model->get_rendimiento();  
						$this->load->helper('url');
						$this->load->view('header',$data);
						$this->load->view('informes\rendimiento',$data);
						$this->load->view('footer');
					}
					else
					{
						$data['selected']="Informes";
						$this->load->model('operador_model');
						$data['rendimiento']=$this->operador_model->get_rendimiento($this->input->post('fecha'));  
						$this->load->helper('url');
						$this->load->view('header',$data);
						$this->load->view('informes\rendimiento',$data);
						$this->load->view('footer');
					

					}
	}

		public function empresa()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		
		$data['selected']="Informes";
		$data['link_selected']="Nuevo";

		$this->form_validation->set_rules('id_cliente', 'cliente', 'required');
	
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header',$data);
			$this->load->model('cliente_model');
			$data['clientes']=$this->cliente_model->get_cliente();    
			$this->load->view('informes\empresa',$data);
			$this->load->view('footer');
		}
		else
		{		

						$this->load->library('PHPExcel.php');
				        $file = './assets/plantillaxls/informeempresas.xlsx';                             
				        $this->phpexcel = PHPExcel_IOFactory::load($file);
				        // configuramos las propiedades del documento
				        $this->phpexcel->getProperties()->setCreator("Invet Austral")
				                                     ->setLastModifiedBy("Invet Austral")
				                                     ->setTitle("Actividades Realizadas")
				                                     ->setSubject("")
				                                     ->setDescription("")
				                                     ->setKeywords("")
				                                     ->setCategory("");         
				        // agregamos información a las celdas
				      $this->load->model('actividad_model');
				      $actividades = $this->actividad_model->get_actividad_realizadas_cliente($this->input->post('id_cliente'));
				      $i=1;
				      $j=5;
				      $aux1;
				      $aux2;
				      $inicio;
				      foreach ($actividades as $key ) {
				      	$inicio=$j;
				        $this->phpexcel->setActiveSheetIndex(0)
				        ->setCellValue('A'.$j, $i)
				        ->setCellValue('B'.$j, date("d-m-Y",strtotime($key['fecha_actividad'])))
				        ->setCellValue('C'.$j, $key['nombre_sucursal'])
				        ->setCellValue('D'.$j, $key['observaciones']);

				        $servicios=$this->actividad_model->get_actividades_servicios($key['id_actividad']);
							$operadores=$this->actividad_model->get_actividades_operadores($key['id_actividad']);
							$aux=$j;
							foreach ($servicios as $item) {
								 $this->phpexcel->setActiveSheetIndex(0)->setCellValue('E'.$j, $item['nombre']); 
							$j++;
							}
							$aux2=$j;
							$j=$aux;
							foreach ($operadores as $item) {
								$this->phpexcel->setActiveSheetIndex(0)->setCellValue('F'.$j, $item['nombre']." ".$item['apellido']); 
							$j++;
							}
							if($aux>$aux2)
								$j=$j+$aux;
							$this->phpexcel->getActiveSheet()->getStyle('A'.$inicio.':F'.$j)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

				        $i++;
				        $j++;
				      }  


				    


						 $this->phpexcel->setActiveSheetIndex(0)->setCellValue('B'.'2', 'INFORME DE ACTIVIDADES FINALIZADAS'); 
				        // Renombramos la hoja de trabajo
				        $this->phpexcel->getActiveSheet()->setTitle('Actividades del día');         
				        // configuramos el documento para que la hoja
				        // de trabajo número 0 sera la primera en mostrarse
				        // al abrir el documento
				        $this->phpexcel->setActiveSheetIndex(0);
				        // redireccionamos la salida al navegador del cliente (Excel2007)
				        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				        header('Content-Disposition: attachment;filename="informefinalizadas.xlsx"');
				        header('Cache-Control: max-age=0');         
				        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
				        $objWriter->save('php://output');
				        redirect(base_url(), 'location');	

		}
			}




		

}