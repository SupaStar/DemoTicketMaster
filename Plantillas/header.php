<header>
    <div align="right" class="busqueda">
        <div class="col-5 input-group">
            <input id="textoBusq" type="text" class="form-control rounded-left" placeholder="Que estas buscando?"
                   aria-label="Que estas buscando?" aria-describedby="busqueda">
            <div class="input-group-append">
                <button onclick="buscarEvt()" class="btn btn-outline-secondary rounded-right fas fa-search"
                        type="button" id="btnBuscar"></button>
            </div>
        </div>
    </div>
    <nav class="navbar justify-content-end" id="header">
        <div class="nav-link"><a href="/index.php">Inicio</a></div>
        <?php
        $status=session_status();
        if ($status == PHP_SESSION_NONE){
            session_start();
        }
        if (!isset($_SESSION["usuario"])) { ?>
            <div class="nav-link"><a href="/Vistas/vistaLogin.php">Iniciar sesion</a></div>
            <div class="nav-link"><a href="/Vistas/vistaRegistro.php">Registrarse</a></div>
        <?php } else {?>
            <div class="nav-link">
                <a href="/Phps/perfil.php">Mi Perfil</a>
            </div>
        <div class="nav-link">
            <a href="/Phps/Eventos/cerrarSesion.php">Cerrar sesion.</a>
        </div>
            <?php
        }
        ?>
    </nav>
    <ul id="site-nav">
        <div class="btn-group">
            <li class="dd-listener dropdown-toggle" data-toggle="dropdown" id="music">
                <a href="#"><span>Conciertos</span></a>
                <div id="mMusic" class="dropdown-menu">
                    <div class="dropDowns">
                        <b class="dropdown-header">Top categorias</b>
                        <ul>
                            <li class="liSin dropdown-item"><a onclick="buscar('Comedia')" href="#">Comedia</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('Jazz')" href="#">Jazz/Instrumental</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('conciertos')" href="#">Mas conciertos</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('Pop')" href="#">Pop/Romantica</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('Rock')" href="#">Rock/Metal</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </div>
        <div class="btn-group">
            <li class="dd-listener dropdown-toggle" data-toggle="dropdown" id="sports">
                <a href="#"><span>Deportes</span></a>
                <div class="dropdown-menu dropdown">
                    <div class="dropDowns">
                        <b class="dropdown-header">Top categorias</b>
                        <ul>
                            <li class="liSin dropdown-item"><a onclick="buscar('Automovilismo')" href="#">Automovilismo</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('Box')" href="#">Box/Lucha libre</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('deportes')" href="#">Mas deportes</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('Equestre')" href="#">Equestre</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('Tenis')" href="#">Tenis</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </div>
        <div class="btn-group">
            <li class="dd-listener dropdown-toggle" data-toggle="dropdown" id="arts">
                <a href="#"><span>Teatro y Culturales</span></a>
                <div class="dropdown-menu">
                    <div class="dropDowns">
                        <b class="dropdown-header">Top categorias</b>
                        <ul>
                            <li class="liSin dropdown-item"><a onclick="buscar('Ballet')" href="#">Ballet/Danza</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('Comedia')" href="#">Comedia</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('Musicales')" href="#">Musicales</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('teatro')" href="#">Mas teatro y culturales</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('Obras')" href="#">Obras de teatro</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </div>
        <div class="btn-group">
            <li class="dd-listener dropdown-toggle" data-toggle="dropdown" id="family">
                <a href="#"><span>Familiares</span></a>
                <div class="dropdown-menu">
                    <div class="dropDowns">
                        <b class="dropdown-header">Top categorias</b>
                        <ul>
                            <li class="liSin dropdown-item"><a onclick="buscar('Acuarios')" href="#">Acuarios/Parques acuaticos</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('Circos')" href="#">Circos/Espectaculo infantil</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('familiares')" href="#">Mas familiares</a></li>
                            <li class="liSin dropdown-item"><a onclick="buscar('OnIce')" href="#">OnIce</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </div>
    </ul>
</header>
