<?php

require_once "conexion.php";

class ModeloCategoriasColecciones{

	/*=============================================
	GUARDAR
	=============================================*/

	public static function mdlGuardar($tabla, $datos, $tipo){
		
        if ($tipo == "crear") {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ID, imagen, descripcion) VALUES (:ID, :imagen, :descripcion)");
        } else {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ID = :ID, imagen = :imagen, descripcion = :descripcion WHERE ID = :IDant");
			$stmt->bindParam(":IDant", $datos["IDant"], PDO::PARAM_STR);
        }

        $stmt->bindParam(":ID", $datos["ID"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
	}

}

?>