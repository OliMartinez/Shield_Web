<?php

require_once "conexion.php";

class ModeloPedidos
{

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	public static function mdlSumaTotalVentas($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(precio) FROM $tabla");

		$stmt->execute();

		return $stmt->fetchColumn();

		$stmt->close();
	}

	public static function mdlCrearPedido($tabla, $datos)
	{
		$tipo_user = substr($tabla,7,strlen($tabla)-1);

		$stmt = null;
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ID, $tipo_user, tipo, productos, precio, motivo_pago, domicilio) VALUES(:ID, :$tipo_user, :tipo, :productos, :precio, :motivo_pago, :domicilio)");

		$stmt->bindParam(":ID", $datos["ID"], PDO::PARAM_STR);
		$stmt->bindParam(":".$tipo_user, $datos[$tipo_user], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo_pago", $datos["motivo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);

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
