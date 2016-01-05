<?php
/* $str='123'; */
/* echo md5($str); */
// ---------------------------------------------- ini-libs
include ("../../lib/html/html.php");
include ("./logica.php");

// ---------------------------------------------- ini-header
Html::$title = 'Autentificación';
Html::$path = '../..';
Html::header();
// ---------------------------------------------- ini-body
include ("./menu.php");

$bandera = exist();
if($bandera===False) {
  imprimir_formulario();
}
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/';
Html::footer();

// funciones 
function imprimir_formulario(){
?>
  <div class="row"> 
    <div class="large-12 column">
      <fieldset class="fieldset">
        <legend>Autentificación</legend>
        <form action="login.php" method="POST">
          <div class="row"> 
            <div class="large-2 columns text-right">
              <label for="pass">Password</label>          
            </div> 
            <div class="large-10 columns">
              <input type="password" name="pass" id="pass">
            </div>
          </div>
          <div class="row"> 
            <div class="large-12 columns text-right">
              <input class="button" type="submit" name="enviar" value="Acceder">
            </div>
          </div>            
        </form>
      </fieldset>
    </div>
  </div>
<?php
}
