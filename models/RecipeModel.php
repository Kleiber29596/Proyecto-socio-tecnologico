<?php

require_once 'ModeloBase.php';

class RecipeModel extends ModeloBase {

	public function __construct() {
		parent::__construct();
	}

/*------------ Método para registrar un recipe -------*/
	public function registrarRecipe($datos) {
		$db = new ModeloBase();
		try {
			$insertar = $db->insertar('recipes', $datos);
			return $insertar;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*------------ Método para registrar un recipe -------*/
	public function registrarTblIntermedia($datos) {
		$db = new ModeloBase();
		try {
			$insertar = $db->insertar('recipes_medicamentos', $datos);
			return $insertar;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	/*------------Método para consultar datos del recipe --------*/
public function consultarReceta($id_consulta) {
    $db = new ModeloBase();
    $query = "SELECT c.id_consulta, c.id_usuario AS id_usuario_creador, r.instrucciones, re_me.id_presentacion_medicamento, re_me.dosis, re_me.unidad_medida, re_me.frecuencia, CONCAT(re_me.cantidad, ' ', re_me.intervalo) AS duracion, pre_me.id_medicamento, pre_me.id_presentacion, m.nombre_medicamento, p.presentacion FROM  consultas AS c INNER JOIN  recipes AS r ON c.id_recipe = r.id_recipe INNER JOIN recipes_medicamentos AS re_me ON c.id_recipe = re_me.id_recipe INNER JOIN presentacion_medicamentos AS pre_me ON re_me.id_presentacion_medicamento = pre_me.id_presentacion_medicamento INNER JOIN medicamentos AS m ON pre_me.id_medicamento = m.id_medicamento INNER JOIN presentacion AS p ON pre_me.id_presentacion = p.id_presentacion  WHERE c.id_consulta = ".$id_consulta."";
    $resultado = $db->obtenerTodos($query);
    return $resultado;
}

public function consultarRecetaUpdate($id_consulta) {
    $db = new ModeloBase();
    $query = "SELECT c.id_consulta, c.id_usuario AS id_usuario_creador, r.instrucciones, re_me.id_presentacion_medicamento, re_me.dosis, re_me.unidad_medida, re_me.frecuencia, CONCAT(re_me.cantidad, ' ', re_me.intervalo) AS duracion, pre_me.id_medicamento, pre_me.id_presentacion, m.nombre_medicamento, p.presentacion FROM  consultas AS c INNER JOIN  recipes AS r ON c.id_recipe = r.id_recipe INNER JOIN recipes_medicamentos AS re_me ON c.id_recipe = re_me.id_recipe INNER JOIN presentacion_medicamentos AS pre_me ON re_me.id_presentacion_medicamento = pre_me.id_presentacion_medicamento INNER JOIN medicamentos AS m ON pre_me.id_medicamento = m.id_medicamento INNER JOIN presentacion AS p ON pre_me.id_presentacion = p.id_presentacion  WHERE c.id_consulta = ".$id_consulta."";
    $resultado = $db->FectAll($query);
    return $resultado;
}

}
