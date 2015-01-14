<?php
require '../require/comun.php';
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Alta Usuario</title>
        <link href="../css/viewalta.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor">
            <div id="cabecera">
                <div id="titulo"><a href="../index.php"> Registrarse</a></div>
            </div>
            <div id="error">
                <?php
                if ($error == -1) {
                    echo "Error al crear el usuario ";
                } else {
                    echo Leer::get("r");
                }
                ?>
            </div>
            <div id="contenido">
                <form action="phpAlta.php" method="POST">            
                    <label for="login">Login </label>                
                    <input type="text" name="login" value="" id="login" required/><br/>
                    <label for="clave">Clave</label>
                    <input type="password" name="clave" value="" id="clave" required/> <br/>           
                    <label for="claveConfirmada">Confirmar clave</label>
                    <input type="password" name="claveConfirmada" value="" id="claveConfirmada" required/>  <br/>          
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="" id="nombre" required/><br/>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" value="" id="apellidos" required/><br/>
                    <label for="email">Email</label>
                    <input type="email" name="email" value="" id="email" required/><br/>
                    <label for="root">Root: </label>
                    <input type="checkbox" name="root" id="root" />
                    <input type="password" name="passRoot" placeholder="ContraseñaRoot" id="passRoot"/>
                    <br/><br/>
                    <input type="button" value="Cancelar" onClick="history.back()">
                    <input type="reset" value="limpiar"/>
                    <input type="submit" value="Alta" id="alta" />
                </form>
            </div>
        </div>
    </body>
    <script>
        /*
         var login = document.getElementById("login");
         
         var verRespuesta = function(textoJson){
         //var json = JSON.parse(textoJson);
         //alert ("la respuesta es "+ json);
         alert(textoJson);
         }
         
         var ajax = new Ajax();
         ajax.setUrl("../usuario/phpcomprobar.php?login=" + encodeURIComponent(login.value));
         ajax.setRespuesta(verRespuesta);
         ajax.doPeticion();
         
         var disponible = document.getElementById("disponible");
         /*
         var alta = document.getElementById("alta");
         alta.disabled = true;
         
         login.addEventListener("blur", function() {
         disponible.textContent = "";
         var peticionAsincrona;
         if (window.XMLHttpRequest) {
         peticionAsincrona = new XMLHttpRequest();
         peticionAsincrona.open("GET", "../usuario/phpcomprobar.php?login=" + encodeURIComponent(login.value), true);
         peticionAsincrona.onreadystatechange = function() {
         if (peticionAsincrona.readyState == 4) {
         if (peticionAsincrona.status == 200) {
         var respuesta = peticionAsincrona.responseText;
         disponible.textContent = respuesta;
         if (respuesta.indexOf("uso") >= 0)
         alta.disabled = true;
         else
         alta.disabled = false;
         }
         else {
         //alert("error: " + peticionAsincrona.responseText);
         }
         }
         }
         peticionAsincrona.send();
         }
         }); */
    </script>
</html>