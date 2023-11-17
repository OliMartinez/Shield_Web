<?php

require_once "conexion.php";

class ModeloCarrito
{
    /*=============================================
	GUARDAR PRODUCTO
	=============================================*/

	public static function mdlGuardarProducto($tabla, $datos)
	{
		$stmt = null;
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria, cantidad = :cantidad, precioxcantidad = :precioxcantidad WHERE ID = :ID");

		$stmt->bindParam(":ID", $datos["ID"], PDO::PARAM_STR);
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

	public static function mdlEliminarCarrito($tabla, $idUser){
		$stmt = null;
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID_user = '$idUser'");

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