<?php

class usuario{
    public function incluir($idPessoa,$usuario,$senha){
        include($_SERVER['DOCUMENT_ROOT'].'/conexao.php');
        $query = $con->query("INSERT INTO usuario(id_pessoa, usuario, senha)VALUES($idPessoa,'$usuario','$senha')");
        if($query === false){
            die($con->error);
        }
        return $con->affected_rows > 0 ? $con->insert_id : false;
    }

    public function auth($usuario,$senha){
        include($_SERVER['DOCUMENT_ROOT'].'/conexao.php');
        $query = $con->query("SELECT id FROM usuario WHERE usuario='$usuario' AND senha='$senha'");
        if($query === false){
            die($con->error);
        }
        return $con->affected_rows > 0 ? $query->fetch_assoc()['id'] : false;
    }
}
