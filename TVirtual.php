<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tv Virtual</title>
<style type="text/css">
body{background:url(imagen/fondo.jpg)}
.contenedor{width:600px;height:412px;margin:0 auto;background:url(imagen/tv.png);}
.contenido{width:508px;height:286px;margin:0 auto 0px;background:white;position:relative;top:46px;}
.botonera{width:520px;height:65px;margin:0 auto;text-align:center;}
</style>

<script type="text/javascript">
	
	function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}

    function apagar() { 
    					if(document.getElementById("tv").src == getAbsolutePath()+"imagen/apagado.jpg")
    						document.getElementById("tv").src = "imagen/encendido.jpg";
    					else
    						document.getElementById("tv").src = "imagen/apagado.jpg"
    }

	window.onload = function() { 
		
		document.getElementById("apagar").onclick = apagar;

	
	}

</script>
</head>




<body>
<div class="contenedor">
  <div class="contenido"><img src="imagen/encendido.jpg" id="tv" width="508" height="286" /></div>
</div>
<div class="botonera">
	<img src="imagen/apagar.jpg" id="apagar" width="127" height="65" />
	
</div>

<?php 
    if(isset($_REQUEST['enviar'])){

        $error="";

        if ($_REQUEST['anio']=='') 
            $error.="<p>El apellidos no puede estar vacio</p>";

        if ($_REQUEST['categoria']=='') 
            $error.="<p>El correo no puede estar vacio</p>";

        if ($_REQUEST['premio']=='') 
            $error.="<p>La sexo no puede estar vacio</p>";

        }
        if(isset($_REQUEST['enviar'])&& $error==""){    
       
            function SoloNumeros( $str){
            return preg_match('/^([0-9]*)$/', $str);
        }

        function SoloLetras($str){
            return preg_match('/^[A-Za-z]+$/', $str);
        }

        function validaEmail($valor){
        if(filter_var($valor, FILTER_VALIDATE_EMAIL) === FALSE){
         return false;
        }else{
      return true;
         }
        }
            }

            if(isset($_REQUEST['enviar'])&& $error==""){
            $servidor="localhost:3307";
            $bd="base";
            $usuario="root";
            $password="";


            $conexion=mysqli_connect($servidor, $usuario, $password, $bd) or die ("Error en la conexion a la base de datos");

            $query1="INSERT INTO premios(anio, categoria, premio) 
            VALUES ('".$_REQUEST['anio']."','".$_REQUEST['categoria']."','".$_REQUEST['premio']."')";     
            $resultado1 = mysqli_query($conexion, $query1) or die ("Error en ejecutar el query".$query1);   

        $query="SELECT * from premios";

        $resultado= mysqli_query($conexion,$query) or die ("Error en el ejecutar el query");

        if(mysqli_num_rows($resultado)!=0){

        $nresultados=mysqli_num_rows($resultado);
        print("Hay $nresultados resultados.");

        print("<table>");
        print("<th>ID</th><th>ANIO</th><th>CATEGORIA</th><th>PREMIO</th>");
        while($fila =mysqli_fetch_assoc($resultado)){
        print("<tr>");
        print("<td>".$fila['anio']."</td>");
        print("<td>".$fila['categoria']."</td>");
        print("<td>".$fila['premio']."</td>");
        print("</tr>");
    }
    print("<table>");
    }
    else{
    print("No hay resultados");
    }
    mysqli_close($conexion) or die ("Error");
            }
        else{
    ?>
    <h1>Cartelera</h1>
    <form action="TVirtual.php" method="post">
    <p>
        <label for="anio">Anio</label>
        <input type="text" name="anio" value="<?php if(isset($_REQUEST['anio'])) echo $_REQUEST['anio']?>">
    </p>
    <p>
        <label for="categoria">Categoria</label>
        <input type="text" name="categoria" value="<?php if(isset($_REQUEST['categoria'])) echo $_REQUEST['categoria']?>">
    </p>
    <p>
        <label for="premio">Premio</label>
        <input type="text" name="premio" value="<?php if(isset($_REQUEST['premio'])) echo $_REQUEST['premio']?>">
    </p>
    
    <input type="submit" name="enviar" value="enviar">


    if(isset($_REQUEST['enviar'])){

            if(isset($_REQUEST['enviar'])&& $error==""){
            $servidor="localhost:3307";
            $bd="base";
            $usuario="root";
            $password="";


            $conexion=mysqli_connect($servidor, $usuario, $password, $bd) or die ("Error en la conexion a la base de datos");

            $query1="INSERT INTO premios(anio, categoria, premio) 
            VALUES ('".$_REQUEST['anio']."','".$_REQUEST['categoria']."','".$_REQUEST['premio']."')";     
            $resultado1 = mysqli_query($conexion, $query1) or die ("Error en ejecutar el query".$query1);   

        $query="SELECT * from premios";

        $resultado= mysqli_query($conexion,$query) or die ("Error en el ejecutar el query");

        if(mysqli_num_rows($resultado)!=0){

        $nresultados=mysqli_num_rows($resultado);
        print("Hay $nresultados resultados.");

        print("<table>");
        print("<th>ID</th><th>ANIO</th><th>CATEGORIA</th><th>PREMIO</th>");
        while($fila =mysqli_fetch_assoc($resultado)){
        print("<tr>");
        print("<td>".$fila['anio']."</td>");
        print("<td>".$fila['categoria']."</td>");
        print("<td>".$fila['premio']."</td>");
        print("</tr>");
    }
    print("<table>");
    }

    <input type="submit" name="consultar" value="consultar">

    </form>
    <div class="error">
        <?php
    if (isset($error)) {
        echo $error;
    }
    ?>
    </div>
    <?php
    }
    ?>
</body>
</html>
