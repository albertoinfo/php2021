<?php
require_once "BiciElectrica.php";

function cargabicis(): array
{
    $fich = @fopen("bicis.csv", "r");
    if ($fich == false) {
        die(" No se puede abrir el fichero.");
    }

    $tablabicis = [];
    while ($datosarray = fgetcsv($fich)) {

        $bici = new BiciElectrica();
        $bici->id       = $datosarray[0];
        $bici->coordx    = $datosarray[1];
        $bici->coordy    = $datosarray[2];
        $bici->bateria  = $datosarray[3];
        $bici->operativa = $datosarray[4] == 1;
        if ($bici->operativa) {
            $tablabicis[] = $bici;
        }
    }
    return $tablabicis;
}

function mostrartablabicis($tbicis): string
{
    $msg = "<table><th>Id</th><th>Coord X</th><th>Coord Y</th><th>Bateria</th>";
    foreach ($tbicis as $bici) {
        $msg .= "<tr>";
        $msg .= "<td>$bici->id </td>\n";
        $msg .= "<td>$bici->coordx </td>\n";
        $msg .= "<td>$bici->coordy </td>\n";
        $msg .= "<td>$bici->bateria% </td>\n";
        $msg .= "</tr>";
    }
    $msg .= "</table>";

    return $msg;
}

function bicimascercana($x, $y, $tabla)
{

    $biciMaxProxima = array_shift($tabla);
    $distanciamin = $biciMaxProxima->distancia($x, $y);
    foreach ($tabla as $bici) {
        $distancia = $bici->distancia($x, $y);
        if ($distancia < $distanciamin) {
            $distanciamin = $distancia;
            $biciMaxProxima = $bici;
        }
    }

    return $biciMaxProxima;
}


// Programa principal
$tabla = cargabicis();
if (!empty($_GET['coordx']) && !empty($_GET['coordy'])) {
    $biciRecomendada = bicimascercana($_GET['coordx'], $_GET['coordy'], $tabla);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>MOSTRAR BICIS OPERATIVA</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>

</head>

<body>
    <h1> Listado de bicicletas operativas </h1>
    <?= mostrartablabicis($tabla); ?>
    <?php if (isset($biciRecomendada)) : ?>
        <h2> Bicicleta disponible más cercana es <?= $biciRecomendada ?> </h2>
        <button onclick="history.back()"> Volver </button>
    <?php else : ?>
        <h2> Indicar su ubicación: <h2>
                <form>
                    Coordenada X: <input type="number" name="coordx"><br>
                    Coordenada Y: <input type="number" name="coordy"><br>
                    <input type="submit" value=" Consultar ">
                </form>
            <?php endif ?>
</body>

</html>