<?php
/*
 * generador de estructura html

*/
class Html {

    public static $title = '';
    public static $path = '';
    public static $files = '';
    protected static $testing = FALSE;
    
    // crear 4 funciones: add_css_(header o footer), add_js_(header o footer) 
    // estos llama a: add_file

    static function header_sass() {
        $files_str = "";
        if (isset(self::$files['header'])) {
            $files_str = self::files(self::$files['header']);
        }

        printf('
<!doctype html>
<html class="no-js" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>%3$s</title>
    <link rel="stylesheet" href="%1$s/lib/vendor/foundation/stylesheets/app.css" />
    %2$s
    <script src="%1$s/lib/vendor/foundation/bower_components/modernizr/modernizr.js"></script>
  </head>
  <body>
                '
                , self::$path
                , $files_str
                , self::$title
        );
    }
    static function header() {
        $files_str = "";
        if (isset(self::$files['header'])) {
            $files_str = self::files(self::$files['header']);
        }

        printf('
<!doctype html>
<html class="no-js" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>%3$s</title>
    <link rel="stylesheet" href="%1$s/lib/vendor/foundation-6/css/foundation.css" />
    <link rel="stylesheet" href="%1$s/lib/vendor/foundation-icons/foundation-icons.css" />
    <link rel="stylesheet" href="%1$s/lib/vendor/foundation-6/css/app.css" />
    %2$s
  </head>
  <body>
                '
                , self::$path
                , $files_str
                , self::$title
        );
    }

    static function footer_sass() {
        $files_str = "";
        if (isset(self::$files['footer'])) {
            $files_str = self::files(self::$files['footer']);
        }        
        self::debug();
        
        printf('
    <script src="%1$s/lib/vendor/foundation/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="%1$s/lib/vendor/foundation/bower_components/foundation/js/foundation.min.js"></script>
    <script src="%1$s/lib/vendor/foundation/js/app.js"></script>
    %2$s
  </body>
</html>
                '
                , self::$path
                , $files_str
        );
    }
    static function footer() {
        $files_str = "";
        if (isset(self::$files['footer'])) {
            $files_str = self::files(self::$files['footer']);
        }        
        self::debug();
        
        printf('
    <script src="%1$s/lib/vendor/foundation-6/js/vendor/jquery.min.js"></script>
    <script src="%1$s/lib/vendor/foundation-6/js/foundation.min.js"></script>
    <script src="%1$s/lib/vendor/foundation-6/js/app.js"></script>
    %2$s
  </body>
</html>
                '
                , self::$path
                , $files_str
        );
    }

    protected static function files($array) {
        $output = '';
        if ($array) {
            foreach ($array AS $key => $values) {
                if ($key == 'css') {
                    foreach ($values AS $val) {
                        $output.=sprintf('<link href="%s" rel="stylesheet">', $val);
                    }
                } elseif ($key == 'js') {
                    foreach ($values AS $val) {
                        $output.=sprintf('<script src="%s"></script>', $val);
                    }
                }
            }
        }
        return $output;
    }

    public static function debug() {
        echo "
                <style>
                .debug-claudio-printr {
                     background-color: #4F5256;
                     border: 3px solid #373737;
                     color: #F5F1FF;
                     font-family: monospace;
                     font-size: 1.2em;
                     margin: 1em 0;
                     max-height: 280px;
                     overflow: scroll;
                     padding: 1em 0.5em 0;
                }
               </style>
               <script>
                console.log('debug.php--------------------------');
                function c(input)
                {
                  console.log(input);
                }
                function a(input)
                {
                  alert(input);
                }
               </script>            
         ";
    }

    static function printr($imput) {
        print '<pre class="debug-claudio-printr">';
        print_r($imput);
        print '</pre>';
    }

}

?>