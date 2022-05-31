<?php
class usuario extends model{
    public function login($usuario,$senha)
    {
        $query = $this->execQuery(
            "SELECT * 
            FROM pessoas p 
                INNER JOIN usuarios u 
                    ON p.id=u.id_pessoa 
                    AND u.usuario='$usuario' 
                    AND u.senha='$senha'
            WHERE p.deletado=FALSE"
        );
        if(!$query->num_rows == 1){
            return false;
        }
        $_SESSION['usuarioLogado'] = $query->fetch_assoc();
        return true;
    }
    public function auth(){
        return isset($_SESSION['usuarioLogado']);
    }
}