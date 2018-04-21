<?php

class ConectorBD
{
	private $host;
	private $user;
	private $password;
	private $conexion;

	function __construct($host, $user, $password){
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
	}

	function initConexion($nombre_db){
		$this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
		if ($this->conexion->connect_error) {
			return "Error:" . $this->conexion->connect_error;
		}else {
			return "OK";
		}
	}


	function ejecutarQuery($query){
		//echo $query;
		return $this->conexion->query($query);
	}

	function cerrarConexion(){
		$this->conexion->close();
	}

	function insertData($tabla, $data){
		$sql = 'INSERT INTO '.$tabla.' (';
		$i = 1;
		foreach ($data as $key => $value) {
			$sql .= $key;
			if ($i<count($data)) {
				$sql .= ', ';
			}else $sql .= ')';
			$i++;
		}
		$sql .= ' VALUES (';
		$i = 1;
		foreach ($data as $key => $value) {
			$sql .= $value;
			if ($i<count($data)) {
				$sql .= ', ';
			}else $sql .= ');';
			$i++;
		}
		return $this->ejecutarQuery($sql);

	}

	function getConexion(){
		return $this->conexion;
	}

	function actualizarRegistro($tabla, $data, $condicion){
		$sql = 'UPDATE '.$tabla.' SET ';
		$i=1;
		foreach ($data as $key => $value) {
			$sql .= $key.'='.$value;
			if ($i<sizeof($data)) {
				$sql .= ', ';
			}else $sql .= ' WHERE '.$condicion.';';
			$i++;
		}
		return $this->ejecutarQuery($sql);
	}

	function eliminarRegistro($tabla, $condicion){
		$sql = "DELETE FROM ".$tabla." WHERE ".$condicion.";";
		return $this->ejecutarQuery($sql);
	}

	function consultar($tablas, $campos, $condicion = ""){
		$sql = "SELECT 1";

		//$ultima_key = end(array_keys($campos));
		//echo $ultima_key;
		foreach ($campos as $key => $value) {
			//echo ($key);
		//	$sql .= $value;
		//	if ($key!=$ultima_key) {
				$sql.=", ".$value;
		//	}else $sql .=" FROM ";
		}
    $sql .=" FROM ";
		//$ultima_key = end(array_keys($tablas));
		$num_tab = count($tablas);
		$i=1;
		foreach ($tablas as $key => $value) {

			  $sql .= $value;
			if($i<$num_tab)
				$sql.=", ";
			else
			$sql.=" ";
      $i++;
		}

		if ($condicion == "") {
			$sql .= ";";
		}else {
			$sql .= $condicion.";";
		}

		return $this->ejecutarQuery($sql);
	}

}

 ?>
