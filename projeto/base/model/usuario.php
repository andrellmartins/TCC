<?php
class usuario extends model{
    public function login($usuario,$senha)
    {
        $query = $this->execQuery(
            "SELECT 
                p.id as id_pessoa,
                p.nome,p.ender,p.telefone,p.cpf,p.data_nasc,p.sexo,
                u.id as id_usuario,
                u.usuario,u.senha 
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