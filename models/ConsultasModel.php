<?php

require_once 'ModeloBase.php';

class ConsultasModel extends ModeloBase {

	public function __construct() {
		parent::__construct();
	}

/*------------ Método para registrar una consulta -------*/
	public function registrarConsulta($datos) {
		$db = new ModeloBase();
		try {
			$insertar = $db->insertar('consultas', $datos);
			return $insertar;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*-------	Listar tipos de consultas	-------------------- */
	public function SelectTipos()
	{
		$db = new ModeloBase();
		$query = "SELECT * FROM  tipo_consulta";
		$resultado = $db->obtenerTodos($query);
		return $resultado;
	}

}