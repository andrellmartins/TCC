<?php

class pessoas{
    public function incluir($nome,$endereco,$telefone,$cpf,$pis,$tipo){
        include($_SERVER['DOCUMENT_ROOT'].'/conexao.php');
        $query = $con->query("INSERT INTO pessoa(nome,ender, fone, cpf, pis, tipo )VALUES('$nome','$endereco','$telefone','$cpf','$pis','$tipo')");
        
        if($query === false){
            die($con->error);
        }
        return $con->affected_rows > 0 ? $con->insert_id : false;
    }
    public function getPessoa($idUser){
        include($_SERVER['DOCUMENT_ROOT'].'/conexao.php');
        $query = $con->query("SELECT p.* FROM pessoa p INNER JOIN usuario u ON u.id=p.id AND u.id=$idUser");
        if($query === false){
            die($con->error);
        }
        return $query->fetch_assoc();
    }
}
