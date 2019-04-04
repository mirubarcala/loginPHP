<?php
function dd($valor){
    echo "<pre>";
        var_dump($valor);
        exit;
    echo "</pre>";
}

function validar($datos){
    $errores=[];
    $nombre = trim($datos["nombre"]);
    if(empty($nombre)){
        $errores["nombre"]= "El campo nombre no debe estar vacio";
    }
    $email = trim($datos["email"]);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores["email"]="Hermano mio, ese email es invalido";
    }
    $password= trim($datos["password"]);
    $repassword = trim($datos["repassword"]);
    if(strlen($password) <= 6){
        $errores[$password]="Hermano mio, la contraseña debe tener como minimo 6 caracteres";
    }elseif (empty($password)) {
        $errores[$password]="Hermano mio, la contraseña no puede estar vacia";
    }elseif ($password != $repassword) {
        $errores["repassword"]="Las contraseñas no coinciden";
      
    }
    return $errores;
}

function inputUsuario($campo){
    if(isset($_POST[$campo])){
        return $_POST[$campo];
    }
}

function armarRegistro($datos){
    $usuario = [
        "nombre" => $datos["nombre"],
        "email" => $datos["email"],
        "password" => password_hash($datos["password"], PASSWORD_DEFAULT)
    ];
    return $usuario;

}

function guardar($usuario){
    $jsusuario = json_encode($usuario);
    file_put_contents('usuarios.json', $jsusuario.PHP_EOL, FILE_APPEND);

}