<?php
function obtener_edad ($fecha_nacimiento)
{
	$nacimiento = new DateTime($fecha_nacimiento);
	$ahora = new DateTime(date("Y-m-d"));
	$diferencia = $ahora->diff($nacimiento);
	return $diferencia->format("%y");
}

require_once './models/PersonasModel.php';

class PersonasController
{

	#estableciendo las vistas
	public function inicio()
	{

		/*HEADER */
		require_once('./views/includes/cabecera.php');

		require_once('./views/paginas/personas/inicio_personas.php');

		/* FOOTER */
		require_once('./views/includes/pie.php');
	}
	

	public function listarPersonas()
	{

		// Database connection info 
		$dbDetails = array(
			'host' => 'localhost',
			'user' => 'root',
			'pass' => '',
			'db'   => 'medicina'
		);

		// DB table to use 
		$table = <<<EOT
        (
            SELECT pe.id_persona, pe.n_documento, pe.nombres, pe.apellidos, pe.sexo, pe.telefono, e.estado, m.municipio, pa.parroquia, pe.correo FROM personas AS pe INNER JOIN estados e ON pe.id_estado = e.id_estado  INNER JOIN municipios m ON pe.id_municipio = m.id_municipio  INNER JOIN parroquias pa ON pe.id_parroquia = pa.id_parroquia ORDER BY pe.id_persona DESC
        ) temp
        EOT;

		// Table's primary key 
		$primaryKey = 'id_persona';

		// Array of database columns which should be read and sent back to DataTables. 
		// The `db` parameter represents the column name in the database.  
		// The `dt` parameter represents the DataTables column identifier. 
		$columns = array(

			array('db' => 'n_documento',   	'dt' => 0),
			array('db' => 'nombres',     	'dt' => 1),
			array('db' => 'apellidos',     	'dt' => 2),
			array('db' => 'sexo',     	    'dt' => 3),
			array('db' => 'telefono',     	'dt' => 4),
			array('db' => 'estado',     	'dt' => 5),
			array('db' => 'municipio',     	'dt' => 6),
			array('db' => 'parroquia',     	'dt' => 7),
			array('db' => 'correo',     	'dt' => 8),
			array('db' => 'id_persona', 	'dt' => 9)

		);

		// Include SQL query processing class 
		require './config/ssp.class.php';

		// Output data as json format 
		echo json_encode(
			SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
		);
	}

	public function registrarPersona()

	{
		$fecha_registro = date('Y-m-d');
		$modelPersonas  = new PersonasModel();

		$datos = array(
			'nombres'         		=> $_POST['nombres'],
			'apellidos'    	  		=> $_POST['apellidos'],
			'tipo_documento'  		=> $_POST['tipo_documento'],
			'n_documento'	  		=> $_POST['n_documento'],
			'fecha_nacimiento'		=> $_POST['fecha_nac'],
			'sexo'		     		=> $_POST['sexo'],
			'telefono'		  		=> $_POST['telefono'],
			'correo'          		=> $_POST['correo'],
			'id_estado'          	=> $_POST['estado'],
			'id_municipio'       	=> $_POST['municipio'],
			'id_parroquia'       	=> $_POST['parroquia'],
			'fecha_registro'  		=> $fecha_registro
		);
		$resultado = $modelPersonas->registrarPersona($datos);

		if ($resultado) {
			$data = [
				'data' => [
					'success'            =>  true,
					'message'            => 'Guardado exitosamente',
					'info'               =>  'La persona ha sido resistrada con éxito'
				],
				'code' => 1,
			];

			echo json_encode($data);
			exit();
		} else {
			$data = [
				'data' => [
					'success'            =>  false,
					'message'            => 'Ocurrió un error al registrar a la persona',
					'info'               =>  ''
				],
				'code' => 0,
			];

			echo json_encode($data);
			exit();
		}
	}


	public function selectEstado()
	{
		$modelPersonas = new PersonasModel();
		$estados = $modelPersonas->selectEstado();
		return $estados;
	}

	public function selectMunicipio()
	{
		$modelPersonas = new PersonasModel();
		$estados = $modelPersonas->selectMunicipio();
		return $estados;
	}

	public function selectParroquia()
	{
		$modelPersonas = new PersonasModel();
		$estados = $modelPersonas->selectParroquia();
		return $estados;
	}




	public function llenarSelectEstado()
	{
		$modelPersonas = new PersonasModel();
		$elegido = $_POST['elegido'];
		$data = $modelPersonas->llenarSelectMunicipio($elegido);

		$data = [
			'data' => [
				'success'            =>  true,
				'message'            => 'Registro encontrado',
				'info'               =>  '',
				'data'				 =>  $data,
			],
			'code' => 0,
		];

		echo json_encode($data);

		exit();
	}


	public function listarDatosPersona()
{
    $modelPersonas = new PersonasModel();

    $id_persona = $_POST['id_persona'];

    $listar = $modelPersonas->listarDatosPersona($id_persona);

    if (empty($listar)) {
        $data = [
            'data' => [
                'success' => false,
                'message' => 'No se encontraron registros para esta persona',
                'info' => ''
            ],
            'code' => 1,
        ];
    } else {
        foreach ($listar as $listar) {
            $tipo_documento     = $listar['tipo_documento'];
            $n_documento        = $listar['n_documento'];
            $nombres            = $listar['nombres'];
            $apellidos          = $listar['apellidos'];
            $sexo               = $listar['sexo'];
            $telefono           = $listar['telefono'];
            $estado             = $listar['id_estado'];
            $municipio          = $listar['id_municipio'];
            $parroquia          = $listar['id_parroquia'];
			$nombre_estado      = $listar['estado'];
            $nombre_municipio   = $listar['municipio'];
            $nombre_parroquia   = $listar['parroquia'];
            $correo             = $listar['correo'];
            $fecha_nacimiento   = $listar['fecha_nacimiento'];
            $id_persona         = $listar['id_persona'];
        }

        $data = [
            'data' => [
                'success'            => true,
                'message'            => 'Registro encontrado',
                'info'               => '',
                'tipo_documento'     => $tipo_documento,
                'n_documento'        => $n_documento,
                'nombres'            => $nombres,
                'apellidos'          => $apellidos,
                'sexo'               => $sexo,
                'telefono'           => $telefono,
                'estado'             => $estado,
                'municipio'          => $municipio,
                'parroquia'          => $parroquia,
				'nombre_estado'		 => $nombre_estado,
				'nombre_municipio'	 => $nombre_municipio,
				'nombre_parroquia'	 => $nombre_parroquia,
                'correo'             => $correo,
                'fecha_nacimiento'   => $fecha_nacimiento,
                'id_persona'         => $id_persona
            ],
            'code' => 0,
        ];
    }

    echo json_encode($data);
    exit();
}

public function verDatosPersona()
{
    $modelPersonas  = new PersonasModel();
	$modelPacientes = new PacientesModel();
	$modelCitas 	= new CitasModel();

    $id_persona = $_POST['id_persona'];

   
	$consultarPaciente = $modelPacientes->ObtenerPersona($id_persona);
	$id_paciente = $consultarPaciente['id_paciente'];
	$consultarCita = $modelCitas->historicoCitas($id_paciente);

		
	foreach ($consultarCita as $consultarCita) {

		$nombres_paciente     			= $consultarCita['nombres_paciente'];
		$apellidos_paciente   			= $consultarCita['apellidos_paciente'];
		$tipo_documento_paciente		= $consultarCita['tipo_documento_paciente'];	
		$n_documento_paciente 			= $consultarCita['n_documento_paciente'];
		$nombre_especialidad 			= $consultarCita['nombre_especialidad'];
		$fecha_cita 		  			= $consultarCita['fecha_cita'];
	}
	$listar = $modelPersonas->listarDatosPersona($id_persona);
	
    if (empty($listar)) {
        $data = [
            'data' => [
                'success' => false,
                'message' => 'No se encontraron registros para esta persona',
                'info' => ''
            ],
            'code' => 1,
        ];

    } else {

        foreach ($listar as $listar) {
            $tipo_documento     = $listar['tipo_documento'];
            $n_documento        = $listar['n_documento'];
            $nombres            = $listar['nombres'];
            $apellidos          = $listar['apellidos'];
            $sexo               = $listar['sexo'];
            $telefono           = $listar['telefono'];
            $estado             = $listar['id_estado'];
            $municipio          = $listar['id_municipio'];
            $parroquia          = $listar['id_parroquia'];
			$nombre_estado      = $listar['estado'];
            $nombre_municipio   = $listar['municipio'];
            $nombre_parroquia   = $listar['parroquia'];
            $correo             = $listar['correo'];
            $fecha_nacimiento   = $listar['fecha_nacimiento'];
            $id_persona         = $listar['id_persona'];
        }

        $data = [
            'data' => [
                'success'                 => true,
                'message'                 => 'Registro encontrado',
                'info'                    => '',
                'tipo_documento'          => $tipo_documento,
                'n_documento'             => $n_documento,
                'nombres'                 => $nombres,
                'apellidos'               => $apellidos,
                'sexo'                    => $sexo,
                'telefono'                => $telefono,
                'estado'                  => $estado,
                'municipio'               => $municipio,
                'parroquia'               => $parroquia,
				'nombre_estado'		 	  => $nombre_estado,
				'nombre_municipio'	 	  => $nombre_municipio,
				'nombre_parroquia'		  => $nombre_parroquia,
                'correo'             	  => $correo,
                'fecha_nacimiento'  	  => $fecha_nacimiento,
                'id_persona'        	  => $id_persona,
				'nombres_paciente'   	  => $nombres_paciente,
				'apellidos_paciente' 	  => $apellidos_paciente,
				'tipo_documento_paciente' => $tipo_documento_paciente,
				'n_documento_paciente' 	  => $n_documento_paciente,
				'nombre_especialidad' 	  => $nombre_especialidad,
				'fecha_cita' 	  		  => $fecha_cita,

            ],
            'code' => 0,
        ];
    }

    echo json_encode($data);
    exit();
}



	public function llenarSelectParroquia()
	{
		$modelPersonas = new PersonasModel();
		$elegido = $_POST['municipio'];
		$data = $modelPersonas->llenarSelectParroquia($elegido);

		$data = [
			'data' => [
				'success'            =>  true,
				'message'            => 'Registro encontrado',
				'info'               =>  '',
				'data'				 =>  $data,
			],
			'code' => 0,
		];

		echo json_encode($data);

		exit();
	}

	public function consultarPersona()
	{	
		
		$n_documento_persona = $_POST['n_documento_persona'];
		$modelPersonas = new PersonasModel();
		$listar = $modelPersonas->consultarPersona($n_documento_persona);

		/*echo json_encode("andamos por aqui");
		exit();*/

		foreach ($listar as $lista) {
			$id_persona				= $lista['id_persona'];
			$n_documento_persona 	= $lista['documento'];
			$nombres_persona 		= $lista['nombres'];
			$sexo_persona 		    = $lista['sexo'];
			$fecha_nac  			= $lista['fecha_nacimiento'];
			$tlf_persona 		    = $lista['telefono'];
			$direccion 				= $lista['direccion'];
		}

		$edad_persona = obtener_edad($fecha_nac);
			
		if ($listar) {
			
			$data = [
				'data' => [
					'success'           	 	  	=>  true,
					'message'           	 		=> 'Registro encontrado',
					'info'              	 	    =>  '',
					'id_persona'		   			=> $id_persona,
					'n_documento_persona' 			=> $n_documento_persona,
					'fecha_nac_persona' 		    => $fecha_nac,
					'nombres_persona'				=> $nombres_persona,
					'sexo_persona'			    	=> $sexo_persona,
					'tlf_persona'			    	=> $tlf_persona,
					'direccion'						=> $direccion,
					'edad'							=> $edad_persona,
				],
				'code' => 0,
			];

			
			echo json_encode($data);
			exit();
		}else {

			$data = [
				'data' => [
					'success'            =>  false,
					'message'            => 'La persona no se encuentra registrada',
					'info'               =>  'Debe registrar al Beneficiario'
				],
				'code' => 0,
			];
			echo json_encode($data);
			exit();

		}
		
	}

	/*public function consultarPersonaCita()
	{	
		
		$n_documento_persona = $_POST['n_documento_persona'];
		$modelPersonas = new PersonasModel();
		$listar = $modelPersonas->consultarPersonaCita($n_documento_persona);

		echo json_encode($n_documento_persona);
		exit();

		foreach ($listar as $lista) {
			$id_persona				= $lista->id_persona;
			$n_documento_persona 	= $lista->documento;
			$nombres_persona 		= $lista->nombres;
			$fecha_nac  			= $lista->fecha_nacimiento;
			$sexo_persona 		    = $lista->sexo;
			$tlf_persona 		    = $lista->telefono;
			$email					= $lista->correo;
			$fecha_Reg 				= $lista->fecha_registro;
			$direccion 				= $lista->direccion;
		}

		$edad_persona = obtener_edad($fecha_nac);

		echo json_encode($direccion);
		exit();
			
		if ($listar) {
			
			$data = [
				'data' => [
					'success'           	 	  	=>  true,
					'message'           	 		=> 'Registro encontrado',
					'info'              	 	    =>  '',
					'id_persona'		   			=> $id_persona,
					'n_documento_persona' 			=> $n_documento_persona,
					'fecha_nac' 		    		=> $fecha_nac,
					'nombres_persona'				=> $nombres_persona,
					'sexo_persona'			    	=> $sexo_persona,
					'tlf_persona'			    	=> $tlf_persona,
					'correo' 						=> $email,
					'direccion' 					=> $direccion,
					'edad'							=> $edad_persona,
				],
				'code' => 0,
			];
			
			echo json_encode($edad_persona);
			exit();
		}else{

			$data = [
				'data' => [
					'success'            =>  false,
					'message'            => 'La persona no se encuentra registrada',
					'info'               =>  'Debe registrar al Beneficiario'
				],
				'code' => 0,
			];
			echo json_encode($edad_persona);
			exit();

		}
		
	}*/

	public function modificarPersona()
	{
		
		$modelPersonas = new PersonasModel();
		$id_persona = $_POST['id_persona'];

		$datosPersona = array(

			'tipo_documento'   	 => $_POST['tipo_documento'],
			'n_documento'        => $_POST['n_documento'],
			'nombres'			 => $_POST['nombres'],
			'apellidos'			 => $_POST['apellidos'],
			'sexo'			     => $_POST['sexo'],
			'telefono'			 => $_POST['telefono'],
			'id_estado'			 => $_POST['estado'],
			'id_municipio'	     => $_POST['municipio'],
			'id_parroquia'	     => $_POST['parroquia'],
			'correo'			 => $_POST['correo'],
			'fecha_nacimiento'	 => $_POST['fecha_nac']
		);


		$resultado = $modelPersonas->modificarPersona($id_persona, $datosPersona);
		
		if ($resultado) {
			$data = [
				'data' => [
					'success'            =>  true,
					'message'            => 'Guardado exitosamente',
					'info'               =>  'Los datos de la persona han sido modificados'
				],
				'code' => 1,
			];

			echo json_encode($data);
			exit();
		} else {
			$data = [
				'data' => [
					'success'            =>  false,
					'message'            => 'Ocurrió un error al modificar los datos de la persona',
					'info'               =>  ''
				],
				'code' => 0,
			];

			echo json_encode($data);
			exit();
		}
	}

}