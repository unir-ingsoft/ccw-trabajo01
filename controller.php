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

    function addUsuarios ($usr, $pwd, $name){
        $db = file_get_contents("db.json");
        $usrsDecoded = json_decode($db, true);

        try{
            $newUsuario = array('nombre'=> $name, 'email'=> $usr, 'password'=> $pwd);
            array_push($usrsDecoded, $newUsuario);

            $usrsEncoded = json_encode($usrsDecoded);
            $file = 'db.json';
            file_put_contents($file, $usrsEncoded);
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    if(isset($_REQUEST['action'])){

        if($_REQUEST['action'] == "login"){

            $result = false;
            $usuario = $_REQUEST['email'];
            $password = sha1($_REQUEST['pass']);

            $result = getUsuarios($usuario, $password);

            if ($result){
                echo "<script>alert('Acceso correcto')</script>";
                $_SESSION['logged'] = "ok";
            }
            else {
                echo"<script>alert('Datos incorrectos')</script>";
                header("Location: index.html");
            }
        }
        else if ($_REQUEST['action'] == "registrar"){
            $result = false;
            $usuario = $_REQUEST['email'];
            $nombre = $_REQUEST['nombre'];
            $password = sha1($_REQUEST['pass']);
            $result = getUsuarios($usuario, $password);

            if ($result){
                echo "<script>alert('Registrado exitosamente')</script>";
                header("Location: index.html");
                
            }
            else {
                echo"<script>alert('Ocurrio un error, intentelo de nuevo')</script>";
                header("Location: registro.html");
            }
        }
        
    }
    else if (!$_SESSION['logged']){
        header("Location: index.html");
    }
?>