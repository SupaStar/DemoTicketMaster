<html>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/head.php');
?>
<body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/header.php');
?>
<nav aria-label="breadcrumb" class="padBod">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Busqueda</li>
    </ol>
</nav>
<div class="contenido">
    <table class="table tablitaIndx table-hover">
        <?php
        $buscar = "%" . $_GET["busqueda"] . "%";
        require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/Eventos/fechas.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/dbConfig.php");
        $sql = "SELECT
    eventosaceptados.idEv,
    eventosaceptados.nombreEv,
    eventosaceptados.fechaVenta,
    forosaceptados.nombreF,
    categorias.descripcion,
    subcat.descripcion
FROM
    eventosaceptados
INNER JOIN forosaceptados ON eventosaceptados.idForo = forosaceptados.idF
INNER JOIN categorias ON eventosaceptados.idCati = categorias.idCat
INNER JOIN subcat ON categorias.idCat = subcat.idCati
WHERE
    eventosaceptados.nombreEv LIKE '$buscar' OR categorias.descripcion LIKE '$buscar' OR forosaceptados.nombreF LIKE '$buscar' OR subcat.descripcion LIKE '$buscar'";
        $resultados = $mysqli->query($sql);
        foreach ($resultados as $evento) {
            $fechaA = strtotime(date("Y-m-d"));
            $fechaBD = strtotime($evento["fechaVenta"]);
            if ($fechaA < $fechaBD) {
                ?>
                <tr>
                    <td align="center">
                        <div class="border border-secondary bg-secondary textoIndx">
                            <?php
                            $dia = date('d', strtotime($evento["fechaVenta"]));
                            $diaS = date('l', strtotime($evento["fechaVenta"]));
                            $mes = date('F', strtotime($evento["fechaVenta"]));
                            ?>
                            <div><?php echo diaEsp($diaS); ?></div>
                            <div><?php echo $dia ?></div>
                            <div><?php echo mesEsp($mes) ?></div>
                        </div>
                    </td>
                    <td>
                        <strong><?php echo $evento["nombreEv"] ?></strong>
                        <p><?php echo $evento["nombreF"] ?></p>
                    </td>
                    <td>
                        <a class="btn btn-primary rounded-pill"
                           href="/Vistas/Evento/verEvento.php?id=<?php echo $evento["idEv"] ?>">
                            Obtener boleto
                        </a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/footer.php');
?>
</body>
</html>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/scripts.php');
?>
