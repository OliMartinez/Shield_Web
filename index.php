<?php
require_once 'vendor/autoload.php';

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/pedidos.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/categorias-colecciones.controlador.php";
require_once "controladores/cuenta-deposito.controlador.php";
require_once "controladores/general.controlador.php";
require_once "controladores/catalogo.controlador.php";
require_once "controladores/carrito.controlador.php";
require_once "controladores/zonas.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/pedidos.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/categorias-colecciones.modelo.php";
require_once "modelos/cuenta-deposito.modelo.php";
require_once "modelos/general.modelo.php";
require_once "modelos/catalogo.modelo.php";
require_once "modelos/zonas.modelo.php";
require_once "modelos/carrito.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
