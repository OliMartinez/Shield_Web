<?php

require_once "conexion.php";

class ModeloCatalogo
{
	/*=============================================
	AGREGAR AL CARRITO
	=============================================*/

	public static function mdlAgregarAlCarrito($tabla, $datos)
	{
		$stmt = null;
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ID, ID_user, ID_product, categoria, cantidad, precioxcantidad) VALUES(:ID, :ID_user, :ID_product, :categoria, :cantidad, :precioxcantidad)");

		$stmt->bindParam(":ID", $datos["ID"], PDO::PARAM_STR);
		$stmt->bindParam(":ID_user", $datos["ID_user"], PDO::PARAM_STR);
		$stmt->bindParam(":ID_product", $datos["ID_product"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":precioxcantidad", $datos["precioxcantidad"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {
			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());

			return "error";
		}
		$stmt->close();
    }
}

?>