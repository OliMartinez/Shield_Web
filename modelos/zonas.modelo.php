<?php

require_once "conexion.php";

class ModeloZonas
{
    public static function mdlGuardarZona($datos, $tipoguardar)
    {

        if ($tipoguardar == "crear") {
            $stmt = Conexion::conectar()->prepare("INSERT INTO `zonas`(ID, mayorista, estados, ciudades) VALUES (:ID, :mayorista, :estados, :ciudades)");
        } else {
            $stmt = Conexion::conectar()->prepare("UPDATE `zonas` SET ID = :ID, mayorista = :mayorista, estados = :estados, ciudades = :ciudades WHERE ID = :IDant");
        }
        $stmt->bindParam(":ID", $datos["ID"], PDO::PARAM_STR);
        $stmt->bindParam(":IDant", $datos["IDant"], PDO::PARAM_STR);
        $stmt->bindParam(":mayorista", $datos["mayorista"], PDO::PARAM_STR);
        $stmt->bindParam(":estados", $datos["estados"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudades", $datos["ciudades"], PDO::PARAM_STR);

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
