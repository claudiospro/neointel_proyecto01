<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../../../lib/html/tree.php";
include "../../../model/classes/ModeloTree.php";

$tree = new ModeloTree();
// -------------------------------------------------------- INPUT
$in['parent_id'] = Utilidades::clear_input_id($_POST['id']);
// -------------------------------------------------------- PROCESS
$ou = $tree->ubigeoParentOnload($in);

// -------------------------------------------------------- TEST
// Html::printr($in);
// Html::printr($ou);

// -------------------------------------------------------- PRINT
if (is_array($ou)) {
    imprimir($ou);
}


function imprimir($list) {
    foreach ($list as $row) {
        echo '<li class="list-item" id="list-item-' . $row['id'] . '">';
        echo '<a class="list" codigo="' . $row['id'] . '">';
        echo utf8_encode($row['nombre']) ;
        echo '</a>';
        echo ' <span>' . utf8_encode($row['tipo_nombre']) . '</span>';
        echo '<a data-open="ubigeo_tree_edit_modal" codigo="' . $row['id'] . '" class="button tiny edit no-margin" title="Editar"><i class="fi-pencil medium"></i></a>';
        echo '<ol id="parent_item_' . $row['id'] . '"" style="display:none"></ol>';
        echo '</li>';
    }
    /* echo '<ol>'; */
    /* foreach ($tree as $row) { */
    /*     $l = explode("--||@!", $row['nombre']);  */
    /*     echo '<li class="list-item" id="list-item-' . $row['id'] . '">'; */
    /*     echo '<a class="list">'; */
    /*     echo utf8_encode($l[0]) ; */
    /*     echo '</a>'; */
    /*     echo ' <span>' . utf8_encode($l[1]) . '</span>'; */
    /*     echo '<a data-open="ubigeo_tree_edit_modal" codigo="' . $row['id'] . '" class="edit" title="Editar"><i class="fi-pencil medium"></i>'; */
    /*     if ( count( $row['children'] ) > 0 ) { */
    /*         imprimir( $row['children'] ); */
    /*     }	 */
    /*     echo '</li>'; */
    /* } */
    /* echo '</ol>'; */
    

}
