<?php
//  Elaborar programa (01.php) en php que procese un formulario (01.html)
//  que solicita al usuario un nombre y una clave. El programa php tendrá un array asociativo
//  con 3 pares de valores de usuario => contraseña.  Se comprobará consultando la tabla si
//  los datos son válidos, en este caso se debe mostrar un mensaje de bienvenida con nombre introducido,
//  en otro caso se mostrar un mensaje de error para que usuario pueda volver a introducir nuevos datos.
//  
//  Se muestran dos formas para volver a la página anterior 01.html si se produce un error:
//  mediante javascript y modificado la respuesta en  la cabecera http

// Usuarios y contraseña de prueba
$tusuarios = [ 'pepe' => '1234',
               "luis" => "siul",
               "admin"=> "admin"];

$mostrarformulario = true;
// SI me han enviado datos
if ( isset ($_REQUEST['nombre'])){  
    if (empty($_REQUEST['nombre']) || empty ($_REQUEST['clave'])){
        $msg = " Error: falta valores introducir los valores de usuario y contraseña.<br> ";
    } else {
    // PELIGRO: No controlo la seguridad de las entradas, aqui no es necesaro
    $usuario = $_REQUEST['nombre'];
    $clave   = $_REQUEST['clave'];
    if ( array_key_exists($usuario, $tusuarios) &&  $tusuarios[$usuario] == $clave ){
        $msg = " Bienvenido $usuario al sistema ";
        $mostrarformulario = false;
    }
    else {
    $msg =  "Error: Usuario y contraseña no válidos.<br> ";
    }
}    
}
 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 400px;">
<div id="header">
        <h1>FORMULARIOS DE ACCESO</h1>
</div>

<div id="content">
 
 <?= isset($msg)?$msg:"" ?>

<?php if ($mostrarformulario ): ?>
<!-- sin action se procesa el mismo archivo -->
<form name='entrada' method="get" >
    <table  style="border: node; ">
        <tr>
            <td>Nombre:</td>
            <td><input type="text" name="nombre"
              value="<?= isset($_REQUEST['nombre'])?$_REQUEST['nombre']:'' ?>"
            size="20"></td>
        </tr>
        <tr>
            <td>Contraseña:</td>
            <td><input type="password" name="clave" size="20"></td>
        </tr>
    </table>
    <input type="submit" name="orden" value="Entrar">
</form>
</div>
</div>
<?php endif; ?>
</body>
</html>