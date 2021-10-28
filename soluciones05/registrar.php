
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
<title>Registrar Usuario</title>
</head>
<body>
<div id="container" style="width: 600px;">
		<div id="header">
			<h1>FORMULARIO DE REGISTRO</h1>
		</div>

		<div id="content">
	
<?php
// Se solicita el formulario contraseña y email tipo text para pruebas
if($_SERVER['REQUEST_METHOD'] == "GET"){ ?>
<form  method="post">
     <fieldset>
     <legend>Datos para registrar:</legend>
	
	<input type="text" name="nombre" placeholder="Nombre" 
    value="<?= postvalor('nombre') ?>" size="10">
	<input type="text" name="email" placeholder="Correo electrónico"
    value="<?= postvalor('email')  ?>" size="15"><br>	
	<input type="text" name="contraseña1" placeholder="Contraseña"  
    value="<?= postvalor('contraseña1')  ?>" size="10"><br>	
	<input type="text" name="contraseña2" placeholder="Contraseña" 
    value="<?= postvalor('contraseña2') ?>"  size="10"><br>	
	<input type="submit" value="Enviar" /> 
    <input type="reset" value="Limpiar" />
</fieldset>
</form>
</div>
</div>
</body>
</html>
<?php 
exit();
}
// Proceso los datos

// No hay valores vacios
foreach ($_POST as $campo => $valor) {
    if (estaVacio($valor)){
        echo "El campo $campo esta vacio ";
        exit;
    }
   }
// No es un email
if ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $msg = " No es un email correcto. ";
} 

// Validando contraseña
else if (  $_POST['contraseña1'] != $_POST['contraseña2'] ){
    $msg = " Las contraseñas deben ser iguales ";
}

else if (  strlen($_POST['contraseña1']) < 8 ){
    $msg = "Tamaño de la contraseña debe ser igual o superior a 8 caracteres en total";
    
}

else if ( !hayMayusculas($_POST['contraseña1']) || !hayMinusculas($_POST['contraseña1'])){
    $msg = "Debe haber mayúsculas y minúsculas. ";
    echo $_POST['contraseña1'];
    
}
else if ( !hayDigito($_POST['contraseña1'])){
    $msg = " Debe haber algun dígito.";
    
}

else if ( !hayNoAlfanumerico($_POST['contraseña1'])){
    $msg = " No hay nigún caracter no alfanumérico ";
          
} else {
$msg = " Sus datos son correctos. <br> Ha sido registrado en el sistema.";
}
echo $msg."<br>";
echo " <button onclick='window.history.back();'>Volver</button> ";


?>
</div>
</div>
</body>
</html>
<?php  
// Funciones auxilires 

function estaVacio ($valor) {
    return empty(trim($valor));
}

function hayMayusculas ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( ctype_upper($valor[$i]) )
            return true;
    }
    return false;
}

function hayMinusculas ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( ctype_lower($valor[$i]))
            return true;
    }
    return false;
}

function hayDigito ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( ctype_digit($valor[$i]) )
            return true;
    }
    return false;
}

function hayNoAlfanumerico ($valor){
    for ($i=0; $i<strlen($valor); $i++){
        if ( !ctype_alnum($valor[$i]) )
            return true;
    }
    return false;
}

function postvalor(string $elemento):string {
    if ( isset($_POST[$elemento])){
        $resu = $_POST[$elemento];
    }else {
        $resu= "";
    }
    return $resu;
}

?>


