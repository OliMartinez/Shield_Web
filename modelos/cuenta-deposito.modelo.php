<?php
require_once "conexion.php";
class ModeloCuentasDeps{

    public static function mdlGuardarCuentaDep($datos, $tipo){

		if($tipo=="crear"){
            $stmt = Conexion::conectar()->prepare("INSERT INTO `cuentas_deps`(ID, propietario, tipo, valor, beneficiario, cuenta, clabe, tarjeta) VALUES (:ID, :propietario, :tipo, :valor, :beneficiario, :cuenta, :clabe, :tarjeta)");
            }else{
            $stmt = Conexion::conectar()->prepare("UPDATE `cuentas_deps` SET ID = :ID, propietario = :propietario, tipo = :tipo, valor = :valor, beneficiario = :beneficiario, cuenta = :cuenta, clabe = :clabe, tarjeta = :tarjeta WHERE ID = :ID");
            }
            $stmt->bindParam(":ID", $datos["ID"], PDO::PARAM_INT);
            $stmt->bindParam(":propietario", $datos["propietario"], PDO::PARAM_INT);
            $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
            $stmt->bindParam(":coleccion", $datos["coleccion"], PDO::PARAM_STR);
            $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_STR);
            $stmt->bindParam(":beneficiario", $datos["beneficiario"], PDO::PARAM_STR);
            $stmt->bindParam(":cuenta", $datos["cuenta"], PDO::PARAM_STR);
            $stmt->bindParam(":clabe", $datos["clabe"], PDO::PARAM_STR);
            $stmt->bindParam(":tarjeta", $datos["tarjeta"], PDO::PARAM_STR);
    
            if($stmt->execute()){
    
                return "ok";
    
            }else{
                echo "\nPDO::errorInfo():\n";
                print_r(Conexion::conectar()->errorInfo());
                return "error";
            
            }
    
            $stmt->close();
    }

}
?>