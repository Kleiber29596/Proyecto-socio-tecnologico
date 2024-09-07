<?php
function obtener_edad ($fecha_nacimiento)
{
	$nacimiento = new DateTime($fecha_nacimiento);
	$ahora = new DateTime(date("Y-m-d"));
	$diferencia = $ahora->diff($nacimiento);
	return $diferencia->format("%y");
}

require_once './models/CitasModel.php';

class CitasController
{

	#estableciendo las vistas
	public function inicioCitas()
	{

		/*HEADER */
		require_once('./views/includes/cabecera.php');

		require_once('./views/paginas/citas/inicioCitas.php');

		/* FOOTER */
		require_once('./views/includes/pie.php');
	}

	public function listarCitas()
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
			SELECT CONCAT(p.tipo_documento,'-',p.n_documento) AS n_documento_paciente, CONCAT(p.nombres, ' ', p.apellidos) AS nombre, c.fecha_cita, E.nombre_especialidad, c.estatus, c.id_cita FROM citas c INNER JOIN personas as p on c.id_persona = p.id_persona INNER JOIN especialidad AS E ON E.id_especialidad = c.id_especialidad ORDER BY c.id_cita DESC) temp
EOT;


		// Table's primary key 
		$primaryKey = 'id_cita';

		// Array of database columns which should be read and sent back to DataTables. 
		// The `db` parameter represents the column name in the database. 
		/*
			SELECT datos_paciente.nombres AS nombres_paciente, datos_paciente.apellidos AS apellidos_paciente, datos_paciente.n_documento AS n_documento_paciente, personas.nombres AS nombres_doctor, personas.apellidos AS apellidos_doctor, personas.n_documento AS n_documento_doctor, citas.observacion, citas.fecha_cita, citas.estatus, citas.id_cita, especialidad.nombre_especialidad FROM citas AS citas JOIN pacientes AS pacientes ON pacientes.id_paciente=citas.id_paciente JOIN especialidad AS especialidad ON especialidad.id_especialidad=citas.id_especialidad JOIN doctor AS doctor ON doctor.id_doctor=citas.id_doctor JOIN personas AS personas ON personas.id_persona=doctor.id_persona JOIN personas AS datos_paciente ON datos_paciente.id_persona = pacientes.id_persona
		*/ 
		// The `dt` parameter represents the DataTables column identifier. 
		$columns = array(

			array('db' => 'n_documento_paciente',   'dt' => 0),
			array('db' => 'nombre', 'dt' => 1),
			array('db' => 'fecha_cita', 'dt' => 2),
			array('db' => 'nombre_especialidad', 'dt' => 3),
			array(
				'db'        => 'estatus',
				'dt'        => 4,
				'formatter' => function ($d, $row) {
					switch ($d) {
						case 1:
							return '<button class="btn btn-success btn-sm">Finzalizado</button>';
						case 2:
							return '<button class="btn btn-secondary btn-sm">Inasistente</button>';
						default:
							return '<button class="btn btn-danger btn-sm">Pendiente</button>';
					}
				}
			),
			array('db' => 'id_cita', 'dt' => 5)

		);

			/*$columns = array(

			array('db' => 'n_documento_paciente', 'dt' => 0),
			array('db' => 'nombres_paciente',   'dt' => 1),
			array('db' => 'fecha_cita', 'dt' => 2),
			array('db' => 'nombres_doctor', 'dt' => 3),
			array('db' => 'nombre_especialidad', 'dt' => 4),
			array(
				'db'        => 'estatus',
				'dt'        => 5,
				'formatter' => function ($d, $row) {
					switch ($d) {
						case 1:
							return '<button class="btn btn-success btn-sm">Finzalizado</button>';
						case 2:
							return '<button class="btn btn-secondary btn-sm">Inasistente</button>';
						default:
							return '<button class="btn btn-danger btn-sm">Pendiente</button>';
					}
				}
			),
			array('db' => 'estatus', 'dt' => 6),
			array('db' => 'id_cita',   'dt' => 7)

		);*/

		// Include SQL query processing class 
		require './config/ssp.class.php';

		// Output data as json format 
		echo json_encode(
			SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
		);
	}

	public function ModificarCita()
	{
		
	}

	public function EliminarCita()
	{
		
	}
}

?>