<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Principal extends CI_Controller 
{
		public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('login'))
			   redirect(base_url()."login");
	}
	
	public function index()
	{
		$data['selected']="";
		$this->load->helper('url');
		$this->load->view('header',$data);
		$this->load->view('footer');
	}



public function hacer_backup()
	{
		// Carga la clase de utilidades de base de datos
		$this->load->dbutil();
		$fecha_hora = date("Ymd_His");

	$prefs = array(
        'tables'      => array(),  			// Arreglo de tablas para respaldar.
        'ignore'      => array(),           // Lista de tablas para omitir en la copia de seguridad
        'format'      => 'zip',             // gzip, zip, txt
        'filename'    => 'backup_'.$fecha_hora.'.sql',    // Nombre de archivo - NECESARIO SOLO CON ARCHIVOS ZIP
        'add_drop'    => TRUE,              // Agregar o no la sentencia DROP TABLE al archivo de respaldo
        'add_insert'  => TRUE,              // Agregar o no datos de INSERT al archivo de respaldo
        'newline'     => "\n"               // Caracter de nueva línea usado en el archivo de respaldo
    );

	// Crea una copia de seguridad de toda la base de datos y la asigna a una variable
	$copia_de_seguridad = $this->dbutil->backup($prefs); 
	$this->load->helper('download');
	force_download('copia_de_seguridad.zip', $copia_de_seguridad);
	}

}


