<?php

require_once "conexion.php";

class ModeloUsuarios
{
	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	public static function mdlMostrarUsuarios($tabla2, $item, $valor)
	{
		$stmt = null;
		$partsql = "";
		$select = "";

		if ($item == "ID") {
			if ($tabla2 != null) {
				$partsql = "FROM usuarios join $tabla2 WHERE (usuarios.ID = '$valor' and  $tabla2.ID = '$valor')";
			} else {
				$partsql = "FROM usuarios  WHERE usuarios.ID = '$valor'";
			}
		} elseif ($item != null) {
			$partsql = "WHERE usuarios.ID = $tabla2.ID and $tabla2.$item ='$valor'";
		} else {
			$partsql = "WHERE usuarios.ID = $tabla2.ID";
		}

		if ($tabla2 == "dists" || $tabla2 == "mayoristas") {
			$tipo_user = substr($tabla2, 0, strlen($tabla2) - 1);
			$select = ", (SELECT COUNT(*) FROM pedidos_$tabla2 WHERE usuarios.ID = $tipo_user) as total_pedidos,
            (SELECT CONCAT('$', SUM(total)) FROM pedidos_$tabla2 WHERE usuarios.ID = $tipo_user) as total_compras,
            (SELECT CONCAT('$', AVG(total)) FROM pedidos_$tabla2 WHERE usuarios.ID = $tipo_user) as compra_promedio,
            (SELECT CONCAT('El día: ', MAX(fecha_llegada), ' de $', total) FROM pedidos_$tabla2 WHERE usuarios.ID = $tipo_user) as ultimo_pedido";
		} elseif ($tabla2 == "agentes") {
			$select = ", (SELECT SUM(comision) FROM comisiones WHERE usuarios.ID = agente) as comisiones,
            (SELECT CONCAT('El día: ', MAX(fecha_llegada), ' de $', comision) FROM pedidos_dists as pd, comisiones as c WHERE pd.ID = c.ID_pedido AND usuarios.ID = c.agente) as ultima_comision";
		}

		if ($item == "ID") {
			$stmt = Conexion::conectar()->prepare("SELECT * $select $partsql");
			$stmt->execute();
			return $stmt->fetch();
		} else {
			if ($tabla2 == null) {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE tipo = 'Administrador' OR tipo = 'Fabricante'");
			} else {
				$stmt = Conexion::conectar()->prepare("SELECT * $select FROM usuarios JOIN $tabla2 $partsql");
			}
			$stmt->execute();
			return $stmt->fetchAll();
		}
		$stmt->close();
	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	public static function mdlGuardarUsuario($tabla2, $datos, $tipo)
	{
		$stmt = null;
		$stmt1 = null;

		if ($tipo == "crear") {
			if ($tabla2 != null) {
				$stmt = Conexion::conectar()->prepare("INSERT INTO `usuarios`(ID, nombre_legal_o_rs, contrasena, tipo, email, tel, estado, ciudad, foto) VALUES(:ID, :nombre_legal_o_rs, :contrasena, :tipo, :email, :tel, :estado, :ciudad, :foto)");
				$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
				$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
			} else {
				$stmt = Conexion::conectar()->prepare("INSERT INTO `usuarios`(ID, nombre_legal_o_rs, contrasena, tipo, email, tel, foto) VALUES(:ID, :nombre_legal_o_rs, :contrasena, :tipo, :email, :tel, :foto)");
			}
			$stmt->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
		} else {
			if ($datos["contrasena"] != '' && $datos["contrasena"] != null) {
				if ($tabla2 != null) {
					$stmt = Conexion::conectar()->prepare("UPDATE `usuarios` SET ID = :ID, nombre_legal_o_rs = :nombre_legal_o_rs, contrasena = :contrasena, tipo = :tipo, email = :email, tel = :tel, estado = :estado, ciudad = :ciudad, foto = :foto WHERE `usuarios`.ID = :IDant");
					$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
					$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
				} else {
					$stmt = Conexion::conectar()->prepare("UPDATE `usuarios` SET ID = :ID, nombre_legal_o_rs = :nombre_legal_o_rs, contrasena = :contrasena, tipo = :tipo, email = :email, tel = :tel, foto = :foto WHERE `usuarios`.ID = :IDant");
				}
				$stmt->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
			} else {
				if ($tabla2 != null) {
					$stmt = Conexion::conectar()->prepare("UPDATE `usuarios` SET ID = :ID, nombre_legal_o_rs = :nombre_legal_o_rs, tipo = :tipo, email = :email, tel = :tel, estado = :estado, ciudad = :ciudad, foto = :foto WHERE `usuarios`.ID = :IDant");
					$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
					$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
				} else {
					$stmt = Conexion::conectar()->prepare("UPDATE `usuarios` SET ID = :ID, nombre_legal_o_rs = :nombre_legal_o_rs, tipo = :tipo, email = :email, tel = :tel, estado = :estado, ciudad = :ciudad, foto = :foto WHERE `usuarios`.ID = :IDant");
				}
			}
			$stmt->bindParam(":IDant", $datos["IDant"], PDO::PARAM_STR);
		}
		$stmt->bindParam(":ID", $datos["ID"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_legal_o_rs", $datos["nombre_legal_o_rs"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datos["tel"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

		if ($tabla2 != null) {
			if ($tabla2 != "agentes") {
				$campos_unicos = "";
				if ($tipo == "crear") {
					if ($tabla2 == "dists") {
						$campos_unicos = ", mayorista, zona, agente, historia, propuesta";
					} else if ($tabla2 == "solicitantes") {
						$datossolicregistrado = "";
						if (isset($datos["observs"])) {
							$datossolicregistrado = ", observs, mayorista, zona, agente";
						}
						$campos_unicos = $datossolicregistrado . ", historia, propuesta";
					}
					$campos_unicos1 = str_replace(", ", ", :", $campos_unicos);
					$stmt1 = Conexion::conectar()->prepare("INSERT INTO $tabla2(ID, tipo_persona, cp, sit_fiscal, acta_const, identificacion, dir_fiscal, domicilios, comp_dom$campos_unicos) VALUES(:ID, :tipo_persona, :cp, :sit_fiscal, :acta_const, :identificacion, :dir_fiscal, :domicilios, :comp_dom$campos_unicos1)");
				} else {
					if ($tabla2 == "dists") {
						$campos_unicos = "mayorista = :mayorista, zona = :zona, agente = :agente, historia = :historia, propuesta = :propuesta";
					} else if ($tabla2 == "solicitantes") {
						$campos_unicos = "observs = :observs, mayorista = :mayorista, zona = :zona, agente = :agente, historia = :historia, propuesta = :propuesta";
					}
					$stmt1 = Conexion::conectar()->prepare("UPDATE `$tabla2` SET ID = :ID, tipo_persona = :tipo_persona, dir_fiscal = :dir_fiscal, domicilios = :domicilios, cp = :cp, sit_fiscal = :sit_fiscal, acta_const = :acta_const, identificacion = :identificacion, comp_dom = :comp_dom$campos_unicos WHERE ID = :IDant");
					$stmt1->bindParam(":IDant", $datos["IDant"], PDO::PARAM_STR);
				}
				$stmt1->bindParam(":ID", $datos["ID"], PDO::PARAM_STR);
				$stmt1->bindParam(":tipo_persona", $datos["tipo_persona"], PDO::PARAM_STR);
				$stmt1->bindParam(":dir_fiscal", $datos["dir_fiscal"], PDO::PARAM_STR);
				$stmt1->bindParam(":domicilios", $datos["domicilios"], PDO::PARAM_STR);
				$stmt1->bindParam(":cp", $datos["cp"], PDO::PARAM_STR);
				$stmt1->bindParam(":sit_fiscal", $datos["sit_fiscal"], PDO::PARAM_STR);
				$stmt1->bindParam(":acta_const", $datos["acta_const"], PDO::PARAM_STR);
				$stmt1->bindParam(":identificacion", $datos["identificacion"], PDO::PARAM_STR);
				$stmt1->bindParam(":comp_dom", $datos["comp_dom"], PDO::PARAM_STR);

				if ($tabla2 == "dists") {
					$stmt1->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
				} else if ($tabla2 == "solicitantes" and isset($datos["observs"])) {
					$stmt1->bindParam(":observs", $datos["observs"], PDO::PARAM_STR);
				}
				if ($tabla2 == "dists" || ($tabla2 == "solicitantes" and isset($datos["observs"]))) {
					$stmt1->bindParam(":mayorista", $datos["mayorista"], PDO::PARAM_STR);
					$stmt1->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
					$stmt1->bindParam(":agente", $datos["agente"], PDO::PARAM_STR);
				}
				if ($tabla2 != "mayoristas") {
					$stmt1->bindParam(":historia", $datos["historia"], PDO::PARAM_STR);
					$stmt1->bindParam(":propuesta", $datos["propuesta"], PDO::PARAM_STR);
				}
			} else {
				if ($tipo == "crear") {
					$stmt1 = Conexion::conectar()->prepare("INSERT INTO $tabla2(ID, zona, mayorista) VALUES(:ID, :zona, :mayorista)");
				} else {
					$stmt1 = Conexion::conectar()->prepare("UPDATE $tabla2 SET ID = :ID, mayorista = :mayorista, zona = :zona WHERE $tabla2.ID = :IDant");
					$stmt1->bindParam(":IDant", $datos["IDant"], PDO::PARAM_STR);
				}
				$stmt1->bindParam(":ID", $datos["ID"], PDO::PARAM_STR);
				$stmt1->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
				$stmt1->bindParam(":mayorista", $datos["mayorista"], PDO::PARAM_STR);
			}
		}
		if ($stmt->execute() and ($stmt1 == null or $stmt1->execute())) {

			return "ok";
		} else {
			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());
			return "error";
		}

		$stmt->close();
	}
}
