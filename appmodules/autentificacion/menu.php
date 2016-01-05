<?php
$lugar = 3;
if ( $lugar == 1 ) $base_url= 'http://192.168.1.162/neointelperu/';
elseif ( $lugar == 2 ) $base_url= 'http://192.168.1.3/neointelperu/';
elseif ( $lugar == 3 ) $base_url= 'http://localhost/neointelperu/';

$modulos_url=$base_url . 'appmodules/';
?>
<div class="top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <?php  if ( isset($_SESSION['user_name']) ): ?>
        <li class="menu-text">
            <?php echo $_SESSION['user_name'] ?>
        </li>
      <?php  else: ?>
	<li class="menu-text">
          ...
        </li>
      <?php endif ?>
      <li class="has-submenu" data-dropdown-menu>
        <a href="#">Menu</a>
        <ul class="submenu menu vertical" data-submenu>
          <li><a href="<?php get_module_url('ubigeo/tree2.php') ?>">Ubigeos</a></li>
          <li><a href="<?php get_module_url('ubigeo/direcciones.php') ?>">Direcciones</a></li>
          <li><a href="<?php get_module_url('fuente/subir.php') ?>">Fuentes</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <?php  if ( isset($_SESSION['user_id'])): ?>
        <li><a href="<?php get_module_url('autentificacion/logout.php') ?>">LogOut</a></li>
      <?php else:  ?>
        <li><a href="<?php get_module_url('autentificacion') ?>">Login</a></li>
      <?php endif ?>
    </ul>
  </div>
</div>


<?php
function get_module_url($modulo) {
  global $modulos_url;
  echo $modulos_url . $modulo;
}
