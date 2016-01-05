<?php 
function buildTree($data, $rootId=0)
{
    $tree = array('children' => array(),
		  'root' => array()
		  );
    foreach ($data as $ndx=> $node)
	{
	    $id = $node['id'];
	    /* Puede que exista el children creado si los hijos entran antes que el padre */
	    $node['children'] = (isset($tree['children'][$id])) ? $tree['children'][$id]['children'] : array();
	    $tree['children'][$id] = $node;

	    if ($node['parentId'] == $rootId)
		$tree['root'][$id] =& $tree['children'][$id];
	    else
		{
		    $tree['children'][$node['parentId']]['children'][$id] =& $tree['children'][$id];
		}

	}
    return $tree;
}

// ---------------------------------------------------------------- TEST
// tree_test();

function tree_test() {
    $ex = array(
		array('id' => 1,
		      'nombre' => 'Género',
		      'parentId' => 0),
		array('id' => 2,
		      'nombre' => 'Técnica',
		      'parentId' => 0),
		array('id' => 3,
		      'nombre' => 'Prehistoria',
		      'parentId' => 7),
		array('id' => 4,
		      'nombre' => 'Edad antigua',
		      'parentId' => 7),
		array('id' => 7,
		      'nombre' => 'Histórica',
		      'parentId' => 1),
		array('id' => 5,
		      'nombre' => 'Óleo',
		      'parentId' => 2),
		array('id' => 6,
		      'nombre' => 'Retrato',
		      'parentId' => 1),
		array('id' => 8,
		      'nombre' => 'Soporte',
		      'parentId' => 0),
		array('id' => 9,
		      'nombre' => 'Lienzo',
		      'parentId' => 8),
		array('id' => 10,
		      'nombre' => 'Edad media',
		      'parentId' => 7),
		array('id' => 11,
		      'nombre' => 'Paisaje',
		      'parentId' => 1),
		array('id' => 12,
		      'nombre' => 'Bodegón',
		      'parentId' => 1),
		array('id' => 13,
		      'nombre' => 'Cera',
		      'parentId' => 2),
		array('id' => 14,
		      'nombre' => 'Acuarela',
		      'parentId' => 2),
		array('id' => 15,
		      'nombre' => 'Papel',
		      'parentId' => 8),
		array('id' => 16,
		      'nombre' => 'Vidrio',
		      'parentId' => 8),
		array('id' => 17,
		      'nombre' => 'Edad moderna',
		      'parentId' => 7),
		array('id' => 18,
		      'nombre' => 'Edad contemporánea',
		      'parentId' => 7),
		); 
    echo '<pre>';
    print_r($ex);
    echo '</pre>';
    $tree=buildTree( $ex );
    echo '<pre>';
    print_r($tree);
    echo '</pre>';
    tree_test_print( $tree['root'] );
}
function tree_test_print($tree) {
    echo '<ul>';
    foreach ($tree as $row) {
	echo '<li>';
	echo $row['nombre'];
	if ( count( $row['children'] ) > 0 ) {
	    tree_test_print( $row['children'] );
	}	
	echo '</li>';
    }
    echo '</ul>';    
}
