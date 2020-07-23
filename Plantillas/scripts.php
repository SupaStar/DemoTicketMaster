<script>
    function buscarEvt() {
        var busc = $("#textoBusq").val();
        window.location.href = "/Vistas/vistaBusqueda.php?busqueda=" + busc + "";
    }
    function buscar(busqueda){
    	window.location.href = "/Vistas/vistaBusqueda.php?busqueda=" + busqueda + "";
    }
</script>