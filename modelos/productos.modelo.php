<?php

require_once "conexion.php";

class ModeloProductos
{

/*=============================================
EDITAR PRODUCTO
=============================================*/
public static function mdlGuardarProducto($tabla, $datos, $tipo){
    $mayorista = "";
    $value_mayorista = "";
    $update_mayorista = "";
    if ($tabla == "productos_mayorista") {
        $mayorista = ", stock, mayorista, precio_dist";
        $value_mayorista = ", :stock, :mayorista, :precio_dist";
		$update_mayorista = ", stock = :stock, mayorista = :mayorista, precio_dist = :precio_dist";
    }

    if ($tipo == "crear") {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ID, categorias, coleccion, nombre, imagenes, descripcion, caracteristicas, precio_mayorista, cantidad_min$mayorista) VALUES (:ID, :categorias, :coleccion, :nombre, :imagenes, :descripcion, :caracteristicas, :precio_mayorista, :cantidad_min$value_mayorista)");
    } else {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categorias = :categorias, coleccion = :coleccion, nombre = :nombre, imagenes = :imagenes, descripcion = :descripcion, caracteristicas = :caracteristicas, precio_mayorista = :precio_mayorista, cantidad_min = :cantidad_min$update_mayorista WHERE ID = :ID");
    }

    $stmt->bindParam(":ID", $datos["ID"], PDO::PARAM_INT);
    $stmt->bindParam(":categorias", $datos["categorias"], PDO::PARAM_STR);
    $stmt->bindParam(":coleccion", $datos["coleccion"], PDO::PARAM_STR);
    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":imagenes", $datos["imagenes"], PDO::PARAM_STR);
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":caracteristicas", $datos["caracteristicas"], PDO::PARAM_STR);
    $stmt->bindParam(":precio_mayorista", $datos["precio_mayorista"], PDO::PARAM_INT);
    $stmt->bindParam(":cantidad_min", $datos["cantidad_min"], PDO::PARAM_INT);

    if ($tabla == "productos_mayorista") {
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
        $stmt->bindParam(":mayorista", $datos["mayorista"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_dist", $datos["precio_dist"], PDO::PARAM_INT);
    }

    if($stmt->execute()) {
        return "ok";
    } else {
        echo "\nPDO::errorInfo():\n";
        print_r(Conexion::conectar()->errorInfo());
        return "error";
    }

    $stmt->close();
}
}
