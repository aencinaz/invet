

public function hacer_backup()
	{
		date_default_timezone_set("Europe/Madrid");
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

	//print_r($copia_de_seguridad);
	// Carga el asistente de archivos y escribe el archivo en su servidor
	$this->load->helper('file');


	if ( ! write_file('./backup/backup_'.$fecha_hora.'.zip', $copia_de_seguridad))
	{
	     $this->smarty->assign('error','No se ha podido crear la copia.');
	}
	else
	{
	    $this->smarty->assign('success','Copia creada satisfactoriamente');
	}

	// Carga el asistente de descarga y envía el archivo a su escritorio
	//$this->load->helper('download');
	//force_download('copia_de_seguridad.zip', $copia_de_seguridad);
	$this->smarty->view('index');
}