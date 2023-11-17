<?php

class Conexion{

	public static function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=shield_web",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

}