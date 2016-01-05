<style>
  td{
  border: 1px solid;
  }
</style>
<table>
  <caption>Jquery</caption>
  <tr>
    <td>capturar y asignando valores</td>
    <td>
      <table>
        <tr><td>text()</td></tr>
        <tr><td>html()</td></tr>
        <tr><td>val()</td></tr>
        <tr><td>attr()</td></tr>                
      </table>
    </td>
  </tr>
  <tr>
    <td>ocultando y eliminando</td>
    <td>
      <table>
        <tr><td>hide()</td></tr>
        <tr><td>remove()</td></tr>
        <tr><td>empty()</td></tr>
      </table>
    </td>
  </tr>    
  <tr>
    <td>clases, css</td>
    <td>
      <table>
        <tr><td>addClass()</td></tr>
        <tr><td>removeClass()</td></tr>
        <tr><td>css()</td></tr>
      </table>
    </td>
  </tr>  
  <tr>
    <td>padres, hijos:</td>
    <td>
      <table>
        <tr><td>div.children(hijo)</td></tr>
        <tr><td>div.parent(padre)</td></tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>html dinamico:</td>
    <td>
      <table>
        <tr><td>div.append("insertar dentro de, al final")</td></tr>
        <tr><td>div.prepend("insertar dentro de, primero")</td></tr>
        <tr><td>div.before("insertar fuera de, antes")</td></tr>
        <tr><td>div.after("insertar fuera de, despues")</td></tr>

      </table>
    </td>
  </tr> 
  <tr>
    <td>valor de radio button seleccionado</td>
    <td>
      <table>
        <tr>
	  <td>$('#div-de-options:checked').val()</td>
	</tr>
        <tr>
	  <td>$(elemento).is(':checked')</td>
	</tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>evento change en cajas</td>
    <td>
      <table>
        <tr><td>
	    <pre>
	      $( div ).keyup(function() {
	        var value = $( this ).val();
	        a( value );
	      });
	    </pre>
	</td></tr>

      </table>
    </td>
  </tr>        
  <tr>
    <td>evento click tradicional:</td>
    <td>
      <table>
        <tr>
          <td>
            <pre>
	      componente.click(function(){
	      //code
	      });
            </pre>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>evento click para html dinamico</td>
    <td>
      <table>
        <tr>
          <td>
            <pre>
	      $(estatico).on("click", dinamico, function(e){
	      e.preventDefault();
	      //codear
	      });
            </pre>                    
          </td>
        </tr>
        <tr><td></td></tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>for each :</td>
    <td>
      <table>
        <tr>
          <td>
            <pre>
	      $(div).each(function(){
	      //codear 
	      });
            </pre>
          </td>
        </tr> 
      </table>
    </td>
  </tr>
  <tr>
    <td>ocultar el segundo li</td>
    <td>
      <table>
        <tr><td>$( "li" ).eq( 2 ).hide();</td></tr>
      </table>
    </td>
  </tr>   
  <tr>
    <td>dentro del DIV buscar el segundo ENLACE y ocultar</td>
    <td>
      <table>
        <tr><td>$( div ).find( "a" ).eq( 2 ).hide();</td></tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>check box</td>
    <td>
      <table>
        <tr><td>$(this).prop('checked', true);</td></tr>
	<tr><td>$(this).prop('checked', false);</td></tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>Json</td>
    <td>
      <table>
	<tr>
	  <td>
	    <pre>
// php
echo '{';
foreach ($output as $key => $value) {
    echo '
          "' . $key . '":"' . $value . '"
          ';
    echo ",";
}
echo '"zz":"zz"}';
	    </pre>
	  </td>
	</tr>
        <tr>
	  <td>
	    <pre>
// js capturando la cadena
var data = '{ "var01":"value01", "zz":"zz" }';
var jsn = jQuery.parseJSON( data );
console.log(jsn.var01);// value01
	    </pre>
	  </td>
	</tr>

      </table>
    </td>
  </tr>
  <tr>
    <td>test</td>
    <td>
      <table>
        <tr><td></td></tr>
        <tr><td></td></tr>
      </table>
    </td>
  </tr>
</table>
