<?php
   session_start();
   if (!$_SESSION['logged']){
      header("Location: index.html");
   }
?>
<html>
    <head>
        <title>Desarrollo web avanzado</title>
        <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="estilo.css">
   </head>
   <body>
        <div class="contenedor">
            <div class="login-general">
                <div class="login-screen">
                    <form action="controller.php" method="POST" class="login-form validate-form">
                        <span class="titulo">BIENVENIDO, <?php echo $_SESSION['nombre']; ?></span>

                        <div class="text-center p-t-136">
                           <a class="txt2" href="controller.php?action=ex">
                              Salir
                              <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                           </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>