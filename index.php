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
        <li class="breadcrumb-item" aria-current="page">Inicio</li>
    </ol>
</nav>
<div class="contenido">
    <table class="table tablitaIndx table-hover">
        <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/Eventos/fechas.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/dbConfig.php");
        $sql = "Select * from eventosindex limit 10";
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
