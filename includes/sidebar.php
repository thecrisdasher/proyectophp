 
   <!-- Barra lateral -->
  
   <aside id="sidebar">

   <?php if(isset($_SESSION['usuario'])): ?>
   <div id="usuario_logeado" class="block-aside">
    <h3>Bienvenido, <?=$_SESSION['usuario']['nombre']. " ".$_SESSION['usuario']['apellidos'];?></h3>
   <!--BOTONES -->
   <a href="crear_entradas.php" class="boton">Crear Entradas</a></br>
   <a href="crear_categoria.php" class="boton">Crear Categoría</a></br>
   <a href="log_out.php" class="boton">Mis Datos</a></br>
   <a href="log_out.php" class="boton">Cerrar Sesión</a>
   </div>
   <?php endif; ?>
   <?php if(!isset($_SESSION['usuario'])): ?>
        <div id="Login" class="block-aside">
        <h3>Identificate</h3>

        <?php if(isset($_SESSION['error_login'])): ?>
            <div class="alerta alerta-error">
            <?=$_SESSION["error_login"];?>
            </div>
            <?php endif; ?>
        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email">
            
            <label for="password">Contraseña</label>
            <input type="password" name="password">

            <input type="submit" value="Entrar">
        </form>
    </div>
   
        <div id="register" class="block-aside">

        <h3>Registrate</h3>
        <!-- mostrar errores-->
        <?php
        if(isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
            <?= $_SESSION['completado']; ?>    
            </div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-exito">
            <?= $_SESSION['errores']['general']; ?>    
            </div>
        <?php endif;?>    
        <form action="register.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '';?>

            <label for="Apellidos">Apellidos</label>
            <input type="text" name="apellidos">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '';?>

            
            <label for="email">Email</label>
            <input type="text" name="email">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : '';?>

            
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : '';?>


            <input type="submit" name="submit" value="Registrar">
        </form>
        <?php borrarErrores(); ?>
        </div>
        <?php endif;?>
    </aside>
