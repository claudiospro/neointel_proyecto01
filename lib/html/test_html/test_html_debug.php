<?php
/*
 * para ajax
*/ 

// ---------------------------------------------- ini-libs
include ("../html.php");

$data[] =array('categoria'=>'1', 'producto'=>'p1');
$data[] =array('categoria'=>'2', 'producto'=>'p2');
$data[] =array('categoria'=>'3', 'producto'=>'p7');

Html::debug();
Html::printr($data);

?>
<script>
c('console.log');
a('alert');
</script>