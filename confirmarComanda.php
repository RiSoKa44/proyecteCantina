<!DOCTYPE html>
<html>
<?php
include 'header.php';
?>

<body>
  <h1>Confirmació de comanda</h1>

  <?php
  
  #Comprobar si la cookie pedidos existe formar array a través de json
  if(isset($_COOKIE['pedidos'])){
    #Leer la la COOKIE que es una string en formato json y castearla a array
    $listaProductos= (array)json_decode($_COOKIE['pedidos']);
  }else{
    #Redirigir a error 
    header('Location: error.php');  
  }

  $textoHTML = "<div class='divGeneralComanda'> <table><thead><tr><th>Producte</th><th>Quantitat</th><th>Preu Unitari</th><th>Preu Total</th></tr></thead>";

  $precioTotal = 0;

  #Recorrer el array de productos seleccionados
  for ($i = 0; $i < count($listaProductos); $i++) {
    $producto = current($listaProductos);
    $textoHTML .= "<tr>";
    $textoHTML .= "<td>" . key($listaProductos) . "</td><td>" . $producto[0] . "</td><td>" . $producto[1] . "</td><td>" . $producto[2] . "</td>";
    $precioTotal += $producto[2];
    $textoHTML .= "</tr>";
    next($listaProductos);
  }

  $textoHTML .= "</table>";
  $textoHTML .= "<p class='totalPrecioTxt'>Preu total: &nbsp &nbsp " . $precioTotal . "€</p><br></div>";
  echo $textoHTML;
  ?>

  <div>
    <form id="formularioUsuario">
      <legend class="legend">Informació de l'usuari:</legend>
      <label>Nom:</label><br>
      <input type="text" name="nombre" id="nombre" placeholder="Nom" autofocus required><br>
      <label>Cognom:</label><br>
      <input type="text" name="apellido" id="apellido" placeholder="Cognom"><br>
      <label>Telèfon:</label><br>
      <input type="tel" name="telefono" id="telefono" placeholder="Teléfon" required><br>
      <label>Correu:</label><br>
      <input type="email" name="correo" id="correo" placeholder="Email/Correu" required><br><br>
    </form>
    <!-- El botón del forms está fuera porque sinó reinicia la página cuando haces click 
        Este botón utiliza el require pero borra el formulario, no vale
        <input type="button"  value="Confirmar" id="confirmar">
    -->
    <button id="confirmar" onclick="validarFormulario()">Confirmar</button>
    <!-- Div que se oculta o se muestra con los mensajes de error referentes al formulario -->
    <div id="mensajeError">

    </div>
    <br>
    <br>

    <button id="volver" onclick=" location.href='menu.php' ">Tornar enrere</button>

  </div>

  <!-- Comprobacions en javaScript HTML4 -->
  <script type="text/javascript" src="js/confirmarComanda.js"></script>

</body>
<?php
include 'footer.php';
?>

</html>