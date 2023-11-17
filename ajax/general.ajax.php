<?php

require_once "../controladores/general.controlador.php";
require_once "../modelos/general.modelo.php";

class AjaxGeneral{

	/*=============================================
	EDITAR
	=============================================*/	

	public $id;
    public $tabla;

	public function ajaxEditar(){

		$item = "ID";
		$valor = $this->id;
        $table = $this->tabla;

		$respuesta = ControladorGeneral::ctrMostrarFilas($item, $valor, $table);

		echo json_encode($respuesta);

	}
	/*=============================================
	VALIDAR NO REPETIR ITEM
	=============================================*/	
	public $item_validar;
	public $validar;

	public function ajaxValidar(){

		$elem = $this->item_validar;
		$valor = $this->validar;
		$table = $this->tabla;

		$respuesta = ControladorGeneral::ctrValidarItem($elem, $valor, $table);

		echo json_encode($respuesta);

	}

	/*=============================================
	MOSTRAR ITEMS
	=============================================*/	
	public $item_enc;
	public $item_cond;
	public $valor_item_cond;

	public function ajaxItems(){

		$encontrar = $this->item_enc;
		$condicion = $this->item_cond;
		$valor = $this->valor_item_cond;
		$table = $this->tabla;

		$respuesta = ControladorGeneral::ctrMostrarItems($condicion, $valor, $table, $encontrar);

		echo json_encode($respuesta);

	}	

	/*=============================================
	ACTUALIZAR ITEM
	=============================================*/	

	public $actualizar1;
	public $actualizar2;
	public $item1;
	public $item2;

	public function ajaxActualizar(){

		$table = $this->tabla;

		$item_1 = $this->item1;
		$valor1 = $this->actualizar1;

		$item_2 = $this->item2;
		$valor2 = $this->actualizar2;

		$respuesta = ControladorGeneral::ctrActualizar($table, $item_1, $valor1, $item_2, $valor2);

        echo json_encode($respuesta);

	}

	/*=============================================
	ELIMINAR FILA A PARTIR DE ID
	=============================================*/	
	public $tabla2;

	public function ajaxEliminar(){

		$table = $this->tabla;
		$table2 = $this->tabla2;
		$id = $this->id;
	  
		$respuesta = ControladorGeneral::ctrEliminar($table, $table2, $id);
	  
		echo json_encode($respuesta);
	  
	  }
}

/*=============================================
EDITAR
=============================================*/	
if(isset($_POST["id"])){

	$item = new AjaxGeneral();
	$item -> id = $_POST["id"];
    $item -> tabla = $_POST["tabla"];
	$item -> ajaxEditar();
}

/*=============================================
VALIDAR
=============================================*/	
if(isset($_POST["validar"])){

	$item = new AjaxGeneral();
	$item -> validar = $_POST["validar"];
    $item -> tabla = $_POST["tabla"];
	$item -> item_validar = $_POST["item_validar"];
	$item -> ajaxValidar();
}

/*=============================================
ITEMS
=============================================*/	
if(isset($_POST["item_enc"])){

	$item = new AjaxGeneral();
	$item -> item_enc = $_POST["item_enc"];
	$item -> item_cond = $_POST["item_cond"];
	$item -> valor_item_cond = $_POST["valor_item_cond"];
    $item -> tabla = $_POST["tabla"];
	$item -> ajaxItems();
}

/*=============================================
ACTUALIZAR
=============================================*/	

if(isset($_POST["actualizar1"])){

	$actualizarItem = new AjaxGeneral();
	$actualizarItem -> tabla = $_POST["tabla"];
	$actualizarItem -> actualizar1 = $_POST["actualizar1"];
	$actualizarItem -> actualizar2 = $_POST["actualizar2"];
	$actualizarItem -> item1 = $_POST["item1"];
	$actualizarItem -> item2 = $_POST["item2"];
	$actualizarItem -> ajaxActualizar();

}

/*=============================================
ELIMINAR
=============================================*/	
if(isset($_POST["tabla2"])){

	$item = new AjaxGeneral();
	$item -> id = $_POST["id"];
	$item -> tabla = $_POST["tabla"];
	$item -> tabla2 = $_POST["tabla2"];
	$item -> ajaxEliminar();
  }
