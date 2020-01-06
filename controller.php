<?php 
    session_start();

    function getUsuarios ($usr, $pwd){
        $db = file_get_contents("db.json");
        $jsonUsuarios = json_decode($db, true);

        foreach ($jsonUsuarios as $userdata) {
            if ($userdata['password'] == $pwd && $userdata['email'] == $usr){
                $_SESSION['nombre'] = $userdata['nombre'];
                return 1;
            }
        }
    }

    function addUsuarios ($usr, $pwd, $name){
        $db = file_get_contents("db.json");
        $usrsDecoded = json_decode($db, true);

        try{
            $newUsuario = array('nombre'=> $name, 'email'=> $usr, 'password'=> $pwd);
            array_push($usrsDecoded, $newUsuario);

            $usrsEncoded = json_encode($usrsDecoded);
            $file = 'db.json';
            file_put_contents($file, $usrsEncoded);
            return 1;
        }
        catch(Exception $e){
            return 0;
        }
    }

    if(isset($_REQUEST['action'])){

        if($_REQUEST['action'] == "login"){

            $result = 0;
            $usuario = $_REQUEST['email'];
            $password = sha1(trim($_REQUEST['pass'], " "));

            $result = getUsuarios($usuario, $password);

            echo $result;

            if ($result === 1){
                $_SESSION['logged'] = "ok";
                header("Location: perfil.php");
            }
            else {
                echo "<script>alert('Datos incorrectos'); window.location.href='index.html';</script>";
                //header("Location: index.html");
            }
        }
        else if ($_REQUEST['action'] == "registrar"){
            $result = false;
            $usuario = $_REQUEST['email'];
            $nombre = $_REQUEST['nombre'];
            $password = sha1(trim($_REQUEST['pass'], " "));
            $result = addUsuarios($usuario, $password, $nombre);

            if ($result){
                echo "<script>alert('Registrado exitosamente'); window.location.href='index.html';</script>";
                //header("Location: index.html");
                
            }
            else {
                echo "<script>alert('Ocurrio un error, intentelo de nuevo');window.location.href='registro.html';</script>";
                //header("Location: registro.html");
            }
         }
         else if ($_REQUEST['action'] == "ex") {
            session_destroy();
            header("Location: index.html");
         }
        
    }
    else if (!$_SESSION['logged']){
        header("Location: index.html");
    }
    else {
        header("Location: perfil.php");
    }
?>