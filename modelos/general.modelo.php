<?php

require_once "conexion.php";

class ModeloGeneral
{
	/*=============================================
	VALIDAR LA EXISTENCIA DE UN ITEM
	=============================================*/

	public static function mdlValidarItem($tabla, $item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT $item FROM $tabla WHERE $item = :$item");

		$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return $stmt->fetch();
		} else {
			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());

			return "error";
		}


		$stmt->close();
	}

	/*=============================================
	MOSTRAR ITEMS
	=============================================*/
	public static function mdlMostrarItems($tabla, $item, $valor, $item1)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT $item1 FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			if ($stmt->execute()) {
				if ($item == "ID") {
					if ($item1 == '*' || strpos($item1, ',') != false) {
						return $stmt->fetch();
					} else {
						return $stmt->fetchColumn();
					}
				} else {
					return $stmt->fetchAll();
				}
			} else {
				echo "\nPDO::errorInfo():\n";
				print_r(Conexion::conectar()->errorInfo());

				return "error";
			}
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT $item1 FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();
	}

	/*=============================================
	MOSTRAR FILA(S)
	=============================================*/

	public static function mdlMostrarFilas($tabla, $item, $valor)
	{
		$stmt = null;
		if ($item == "ID") {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			if ($stmt->execute()) {

				return $stmt->fetch();
			} else {
				echo "\nPDO::errorInfo():\n";
				print_r(Conexion::conectar()->errorInfo());

				return "error";
			}
		} else {

			if ($item == null) {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			} else {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $tabla.$item = '$valor'");
			}

			if ($stmt->execute()) {

				return $stmt->fetchAll();
			} else {
				echo "\nPDO::errorInfo():\n";
				print_r(Conexion::conectar()->errorInfo());

				return "error";
			}
		}

		$stmt->close();
	}


	/*=============================================
	ELIMINAR
	=============================================*/

	public static function mdlEliminar($tabla, $tabla2, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID = :ID");

		$stmt->bindParam(":ID", $datos, PDO::PARAM_STR);

		$stmt1 = null;

		if ($tabla2 != null) {
			$stmt1 = Conexion::conectar()->prepare("DELETE FROM $tabla2 WHERE ID = :ID");

			$stmt1->bindParam(":ID", $datos, PDO::PARAM_STR);
		}

		if ($stmt->execute() and ($stmt1 == null or $stmt1->execute())) {

			return "ok";
		} else {
			// return "error";
			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());

			return "error";
		}

		$stmt->close();
	}
	/*=============================================
	ACTUALIZAR
	=============================================*/

	public static function mdlActualizar($tabla, $item1, $valor1, $item2, $valor2)
	{


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = '$valor1' WHERE $item2 = '$valor2'");

		if ($stmt->execute()) {

			return "ok";
		} else {
			// return "error";
			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());

			return "error";
		}

		$stmt->close();
	}

	/*=============================================
	CONTAR FILAS
	=============================================*/
	public static function mdlContFilas($tabla, $item, $valor)
	{
		$condicion = "";
		if ($item != null) {
			$condicion = "where " . $item . "=" . "'".$valor."'";
		}
		$stmt = null;
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla $condicion");

		if ($stmt->execute()) {

			return $stmt->fetchColumn();
		} else {
			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());

			return "error";
		}
		$stmt->close();
	}

	/*=============================================
	SUMAR VALORES DE COLUMNA
	=============================================*/

	public static function mdlSumar($tabla, $columna, $item, $valor){

		$condicion = "";
		if ($item != null) {
			$condicion = "where " . $item . "=" . "'".$valor."'";
		}

		$stmt = null;
		$stmt = Conexion::conectar()->prepare("SELECT SUM($columna) from $tabla $condicion");

		if ($stmt->execute()) {

			return $stmt->fetchColumn();

		} else {
			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());

			return "error";
		}
		$stmt->close();

	}

	/*=============================================
	OBTENER VALOR MÁS GRANDE DE UNA COLUMNA
	=============================================*/
/*	public static function mdlValorMasGrande($tabla, $columna)
	{
		$stmt = null;
		$stmt = Conexion::conectar()->prepare("SELECT MAX($columna) FROM $tabla");

		if ($stmt->execute()) {

			return $stmt->fetchColumn();
		} else {
			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());

			return "error";
		}
		$stmt->close();
	}*/
}
