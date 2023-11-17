<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/general.controlador.php";
require_once "../modelos/general.modelo.php";

class AjaxUsuarios{

/*=============================================
EDITAR USUARIO
=============================================*/	

	public $idUsuario;
	public $tabla;

	public function ajaxEditarUsuario(){

		$item = "ID";
		$valor = $this->idUsuario;
		$tabla = $this->tabla;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR ITEM DE VENDEDORES
	=============================================*/	
/*	public $validar;
	public $validaritem;

	public function ajaxValidarV(){

		$valor = $this->validar;

		$vitem = $this->validaritem;

		$respuesta = ControladorGeneral::ctrValidarItem($vitem, $valor, "solicitantes");

		if($respuesta==null){
			$respuesta = ControladorGeneral::ctrValidarItem($vitem, $valor, "dists");
		}

		if($respuesta==null){
			$respuesta = ControladorGeneral::ctrValidarItem($vitem, $valor, "mayoristas");
		}

		echo json_encode($respuesta);

	}*/
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idUsuario"])){

	$editar = new AjaxUsuarios();
	$editar -> idUsuario = $_POST["idUsuario"];
	$editar -> tabla = $_POST["tabla"];
	$editar -> ajaxEditarUsuario();

}

/*=============================================
VALIDAR ITEM DE VENDEDORES
=============================================*/	
/*if(isset($_POST["validarV"])){

	$item = new AjaxUsuarios();
	$item -> validar = $_POST["validarV"];
	$item -> validaritem = $_POST["item"];
	$item -> ajaxValidarV();
}*/

?>