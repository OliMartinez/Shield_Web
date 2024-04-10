<?php

class ControladorGeneral
{
	/*=============================================
	MOSTRAR UN ITEM
	=============================================*/

	public static function ctrValidarItem($item, $valor, $tabla)
	{

		$respuesta = ModeloGeneral::mdlValidarItem($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR ITEMS
	=============================================*/

	public static function ctrMostrarItems($item, $valor, $tabla, $item1)
	{

		$respuesta = ModeloGeneral::mdlMostrarItems($tabla, $item, $valor, $item1);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR FILAS
	=============================================*/

	public static function ctrMostrarFilas($item, $valor, $tabla)
	{

		$respuesta = ModeloGeneral::mdlMostrarFilas($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	ACTUALIZAR ITEM
	=============================================*/

	public static function ctrActualizar($tabla, $item, $valor, $item1, $valor2)
	{

		$respuesta = ModeloGeneral::mdlActualizar( $tabla, $item, $valor, $item1, $valor2);

		return $respuesta;
	}

	/*=============================================
	ELIMINAR
	=============================================*/

	public static function ctrEliminar($tabla, $tabla2, $datos)
	{

		$respuesta = ModeloGeneral::mdlEliminar($tabla, $tabla2, $datos);

		return $respuesta;
	}

	/*=============================================
	CONTEO DE FILAS
	=============================================*/

	public static function ctrContFilas($tabla, $item, $valor)
	{

		$respuesta = ModeloGeneral::mdlContFilas($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	SUMA DE VALORES DE UNA COLUMNA
	=============================================*/

	public static function ctrSumar($tabla, $columna, $item, $valor)
	{

		$respuesta = ModeloGeneral::mdlSumar($tabla, $columna, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	OBTENER VALOR MÁS GRANDE DE UNA COLUMNA
	=============================================*/

	public static function ctrValorMasGrande($tabla, $columna, $item, $cond)
	{

		$respuesta = ModeloGeneral::mdlValorMasGrande($tabla, $columna, $item, $cond);

		return $respuesta;
	}

}