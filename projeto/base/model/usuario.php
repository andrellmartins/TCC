<?php
class usuario extends model{
    public function login($usuario,$senha)
    {
        $query = $this->query(
            "SELECT * 
            FROM pessoas p 
                INNER JOIN usuarios u 
                    ON p.id=u.id_pessoa 
                    AND u.usuario='$usuario' 
                    AND u.senha='$senha'"
        );
        if(!$query->num_rows == 1){
            return false;
        }
        if(session_status() == PHP_SESSION_NONE)
            session_start();
        $_SESSION['usuarioLogado'] = $query->fetch_assoc();
        return true;
    }
    public function auth(){
        if(session_status() == PHP_SESSION_NONE)
            session_start();
        return isset($_SESSION['usuarioLogado']);
    }
}