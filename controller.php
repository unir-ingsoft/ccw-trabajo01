<?php 
    session_start();

    function getUsuarios ($usr, $pwd){
        $db = file_get_contents("db.json");
        $jsonUsuarios = json_decode($db, true);

        foreach ($jsonUsuarios as $userdata) {
            if ($userdata['password'] == $pwd && $userdata['password'] == $usr){
                return true;
            }
            else {
                return false;
            }
        }
    }

    //if(!$_SESSION['logged']){
        //header("Location: index.html");
    //}

    if(isset($_REQUEST['action'])){

        if($_REQUEST['action'] == "login"){

            $result = false;
            $usuario = $_REQUEST['email'];
            $password = sha1($_REQUEST['pass']);

            $result = getUsuarios($usuario, $password);

            if ($result){
                echo "<script>alert('Acceso correcto')</script>";
            }
            else {
                echo "<script>alert('Datos incorrecto')</script>";
                header("Location: index.html");
            }
        }
        
    }
?>