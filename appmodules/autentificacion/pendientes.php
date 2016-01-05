<?php 
$list['cotizacion'][] = array('name'=>'Nuevo/Editar -> Fechas','description'=>'Implementar mejora para que estas se llenen automaticamente', 'ini'=>'2015-04-01', 'end'=>'');
$list['cotizacion'][] = array('name'=>'Nuevo/Editar -> Mensajes','description'=>'implementar jquery temporizador para que avise las fechas que hay pendientes', 'ini'=>'2015-03-01 Sab-Dom 2', 'end'=>'');
$list['cotizacion'][] = array('name'=>'Nuevo/Editar -> Bienes','description'=>'falta modales de segundo nivel', 'ini'=>'', 'end'=>'');
$list['cotizacion'][] = array('name'=>'Nuevo/Editar -> Montos','description'=>'falta hacer  modales de peritos', 'ini'=>'28-03-2015', 'end'=>'29-03-2015');
$list['cotizacion'][] = array('name'=>'Nuevo/Editar -> Montos','description'=>'mejorar concepto a cobrar:  sumatoria de todo', 'ini'=>'27-03-2015', 'end'=>'28-03-2015');
$list['cotizacion'][] = array('name'=>'Buscador -> filtros fecha','description'=>'implementar cuando el sistema este funcionando 2 meses', 'ini'=>'2015-05-01', 'end'=>'');
$list['cotizacion'][] = array('name'=>'Buscador -> resultados','description'=>'Mostrar los filtros, utilizados', 'ini'=>'', 'end'=>'');
$list['cotizacion'][] = array('name'=>'Buscador -> resultados','description'=>'Limpiar los filtros', 'ini'=>'', 'end'=>'');

$list['cotizacion'][] = array('name'=>'','description'=>'', 'ini'=>'', 'end'=>'');
$list['cotizacion'][] = array('name'=>'','description'=>'', 'ini'=>'', 'end'=>'');
$list['cotizacion'][] = array('name'=>'','description'=>'', 'ini'=>'', 'end'=>'');

$i = new Info();

$i->name = '';
$i->desc = '';
$i->ini = '';
$i->end = '';
$list['cotizacion'][] = $i->s();

$i->name = '';
$i->desc = '';
$i->ini = '';
$i->end = '';
$list['cotizacion'][] = $i->s();

$i->name = '';
$i->desc = '';
$i->ini = '';
$i->end = '';
$list['cotizacion'][] = $i->s();

$i->name = '';
$i->desc = '';
$i->ini = '';
$i->end = '';
$list['cotizacion'][] = $i->s();

$i->name = '';
$i->desc = '';
$i->ini = '';
$i->end = '';
$list['cotizacion'][] = $i->s();

$i->name = '';
$i->desc = '';
$i->ini = '';
$i->end = '';
$list['cotizacion'][] = $i->s();


imprimir( 'Cotización', $list['cotizacion'] );


?>
<?php function imprimir($label,$list) { ?>
<table>
  <caption><?php echo $label ?></caption>
  <thead>
    <tr>
      <td>Name</td>
      <td>Descripcion</td>
      <td>Date ini</td>
      <td>Date end</td>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($list as $row) {
      echo '
          <tr>
             <td><b>' . $row['name'] . '</b></td>
             <td>' . $row['description'] . '</td>
             <td>' . $row['ini'] . '</td>
             <td>' . $row['end'] . '</td>
          </tr>
          ';
    }
    ?>
  </tbody>
</table>
<?php } ?>
<?php 
class Info {
    public $name = ''; */
    public $desc = '';
    public $ini = '';
    public $end = '';
    public function s() {
	return array (
		      'name' => $this->name
		      , 'description' => $this->desc
		      , 'ini' => $this->ini
		      , 'end' => $this->end
		      );
    }
}
 ?>