<?php 
session_start();
// funciones
function exist() {
    if( isset($_SESSION['user_id']) ) {
        return True;
    } else {
        return False;
    }
}

function user_log($modulo, $url_exit) {
    $exit = False;
    if( isset($_SESSION['user_id']) ) {
        $lista = explode(" ", $_SESSION['resources'] );
        //var_dump($lista);
        if ( array_search($modulo, $lista ) == False ) {
            $exit = True;
        }
    } else {
        $exit = True;
    }
    if ( $exit==True ) {
        header('Location: '.$url_exit);
    }
}

function logOut() {
    session_destroy(); 
}

function logIn($pass) {
    if ($pass=='neoIntel2016') {
        $_SESSION["user_name"] = 'Admin';
        $_SESSION["user_id"] = '1';
        $_SESSION["resources"] = ' Campania';
    }
}


?>