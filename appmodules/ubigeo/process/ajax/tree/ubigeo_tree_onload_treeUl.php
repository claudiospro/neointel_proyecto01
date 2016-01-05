<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../../../lib/html/tree.php";
include "../../../model/classes/ModeloTree.php";

$tree = new ModeloTree();
// -------------------------------------------------------- INPUT
$in = null;
// -------------------------------------------------------- PROCESS
$pr = $tree->ubigeoTreeOnload($in);
$ou= buildTree($pr);

// -------------------------------------------------------- TEST
// Html::printr($in);
// Html::printr($pr);
// Html::printr($ou);


// -------------------------------------------------------- PRINT
imprimir($ou['root']);

function imprimir($tree) {
    echo '<ol>';
    foreach ($tree as $row) {
        $l = explode("--||@!", $row['nombre']); 
        echo '<li class="list-item" id="list-item-' . $row['id'] . '">';
        echo '<a class="list">';
        echo utf8_encode($l[0]) ;
        echo '</a>';
        echo ' <span>' . utf8_encode($l[1]) . '</span>';
        echo '<a data-open="ubigeo_tree_edit_modal" codigo="' . $row['id'] . '" class="edit" title="Editar"><i class="fi-pencil medium"></i>';
        if ( count( $row['children'] ) > 0 ) {
            imprimir( $row['children'] );
        }	
        echo '</li>';
    }
    echo '</ol>';
    

}
