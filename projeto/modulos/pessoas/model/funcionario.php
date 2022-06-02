<?php
class funcionario extends model{
    public function getFuncionarioByIdPessoa($idPessoa){
        $query = $this->execQuery(
            "SELECT * FROM funcionario WHERE id_pessoa={$idPessoa}"
        );
        if($query->num_rows != 1){
            return false;
        }
        return $query->fetch_assoc();
    }
}