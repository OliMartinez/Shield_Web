<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos
{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $tabla;
  public $idCategoria;
  public $idProducto;
  public $traerProductos;
  public $nombreProducto;
  public $imgs;

  public function ajaxCrearCodigoProducto()
  {

    $item = "categoria";
    $valor = $this->idCategoria;
    $tabla = $this->tabla;

    $respuesta = ControladorGeneral::ctrMostrarFilas($item, $valor, $tabla);

    echo json_encode($respuesta);
  }


  /*=============================================
  EDITAR PRODUCTO
  =============================================*/

  public function ajaxEditarProducto()
  {

    if ($this->traerProductos == "ok") {

      $item = null;
      $valor = null;
      $tabla = $this->tabla;

      $respuesta = ControladorGeneral::ctrMostrarFilas(
        $item,
        $valor,
        $tabla
      );

      echo json_encode($respuesta);
    } else if ($this->nombreProducto != "") {

      $item = "descripcion";
      $valor = $this->nombreProducto;
      $tabla = $this->tabla;

      $respuesta = ControladorGeneral::ctrMostrarFilas(
        $item,
        $valor,
        $tabla
      );

      echo json_encode($respuesta);
    } else {

      $item = "ID";
      $valor = $this->idProducto;
      $tabla = $this->tabla;

      $respuesta = ControladorGeneral::ctrMostrarFilas(
        $item,
        $valor,
        $tabla
      );

      echo json_encode($respuesta);
    }
  }
}

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/

if (isset($_POST["idCategoria"])) {

  $codigoProducto = new AjaxProductos();
  $codigoProducto->idCategoria = $_POST["idCategoria"];
  $codigoProducto->tabla = $_POST["tabla"];
  $codigoProducto->ajaxCrearCodigoProducto();
}
/*=============================================
EDITAR PRODUCTO
=============================================*/

if (isset($_POST["idProducto"])) {

  $editarProducto = new AjaxProductos();
  $editarProducto->idProducto = $_POST["idProducto"];
  $editarProducto->tabla = $_POST["tabla"];
  $editarProducto->ajaxEditarProducto();
}

/*=============================================
TRAER PRODUCTO
=============================================*/

if (isset($_POST["traerProductos"])) {

  $traerProductos = new AjaxProductos();
  $traerProductos->traerProductos = $_POST["traerProductos"];
  $traerProductos->tabla = $_POST["tabla"];
  $traerProductos->ajaxEditarProducto();
}

/*=============================================
TRAER PRODUCTO
=============================================*/

if (isset($_POST["nombreProducto"])) {

  $traerProductos = new AjaxProductos();
  $traerProductos->nombreProducto = $_POST["nombreProducto"];
  $traerProductos->tabla = $_POST["tabla"];
  $traerProductos->ajaxEditarProducto();
}