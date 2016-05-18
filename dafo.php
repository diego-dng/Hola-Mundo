<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "dafo";

// Create connection
$conn = new mysqli($servername, $username, $password, $bdname);

// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
echo "Conectado!! <br/>";
?>
<html>
<head>
<meta charset="UTF-8">
<title>dafo</title>
<link rel="stylesheet" type="text/css" href="estilos_dafo.css">
</head>
	<body>
		<form action="dafo.php" method="post">
		Nombre: <input type="text" name="nombre"><br><br>
		
		<input type="submit">

		</form>
		
<?php
	$persona;
	$descripcion;
	$tipo;
	
	$fortalezas = array();
	$debilidades = array();
	$oportunidades = array();
	$amenazas = array();
	
	 if(isset($_POST['nombre'])){
		 $nombre=$_POST['nombre'];
		 $sql = "
		 select nombre as persona, descripcion,tipo 
		 from persona p join caracteristicas 
		 on p.id=id_p 
		 join puntos on cod=id_pun 
		 where nombre='$nombre' 
		 ";
		$result = $conn->query($sql);

		echo $sql."<br/>";
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				/*echo " persona ".$row["persona"];
				echo " descripcion: ".$row["descripcion"]."<br>";
				echo " tipo ".$row["tipo"];*/
				
					if($row["tipo"]=='fortaleza'){
						array_push($fortalezas, $row['descripcion']);
					}else{if($row["tipo"]=='debilidad'){
						array_push($debilidades, $row['descripcion']);
					}else{if($row["tipo"]=='oportunidad'){
						array_push($oportunidades, $row['descripcion']);
					}else{if($row["tipo"]=='amenaza'){
						array_push($amenazas, $row['descripcion']);
					}}}}
				
			}
		} else {
				echo "0 resultados";
			}

		
		
		
		 }else{
			echo "Selecciona uno";
		 }
		 
		
		 
	$conn->close();
?>		
		
		
		<section>
		<div class="contenedor">
			<div class="capa1"><h2 class="derecha">FORTALEZAS</h2>
				<?php
					foreach($fortalezas as $fortaleza){
						echo $fortaleza."<br/>";
					}
				?>
			</div>
			<div class="capa2"><h2 class="medio">DEBILIDADES</h2>
				<?php
				foreach($debilidades as $debilidad){
						echo $debilidad."<br/>";
					}
				?>
			</div>
			<div class="capa3"><h2 class="izquierda">OPORTUNIDADES</h2>
				<?php
				foreach($oportunidades as $oportunidad){
						echo $oportunidad."<br/>";
					}
				?>
			</div>
			<div class="capa4"><h2 class="izquierda">AMENAZAS</h2>
				<?php
				foreach($amenazas as $amenaza){
						echo $amenaza."<br/>";
					}
				?>
			</div>
		</div>
	</section>
	</body>
</html>
