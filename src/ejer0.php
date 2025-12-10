<!DOCTYPE html>
<html>
<head>
    <style>
   	 table {margin-top:30px;}
   	 td {border:1px solid blue;}
    </style>
</head>
<body>

   <h1>Ejercicio 1</h1>
    <br >
    El resultado de la consulta es:
    <br>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $server='mysqllamp';
    $bd='musica';
    $usu='lamp_user';
    $pass='lamp_password';
    $port='3306';
    $conn=mysqli_connect($server,$usu,$pass,$bd, $port);

    if (mysqli_connect_error()){
   	 echo 'error de conexión';
   	 exit();
    }
    $datos=array();
    $sql="SELECT nombre FROM grupo WHERE pais <> 'España'";
    if ($resultado = mysqli_query($conn, $sql)) {
   	 while ($row = mysqli_fetch_assoc($resultado)) {
   			 $datos[]=$row;
   	 }
   	 mysqli_free_result($resultado);
    }
    echo '<table celpadding="0" cellspacing="0">';
    echo '<tr><td><strong>NOMBRE</strong></td></tr>';
    foreach($datos as $registro){
    	echo '<tr><td>' . $registro["nombre"] . '</td></tr>';
    }
    echo '</table>';
    mysqli_close($conn);
?>
</body>
</html>

