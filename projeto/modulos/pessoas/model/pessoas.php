<?php
class pessoas extends model{
    
    public function inclui($dados){
        $this->begin_transaction();
        $queryPessoas = $this->execQuery(
            "INSERT INTO pessoas(nome,ender,telefone,cpf) VALUES 
            ('{$dados['nome']}','{$dados['endereco']}','{$dados['telefone']}','{$dados['cpf']}')"
        );
        if(!$queryPessoas) {
            $msgError = $this->error;
            $this->rollback();
            return $msgError;
        }
        
        $idPessoa = $this->insert_id;
        $queryUsuario = $this->execQuery(
            "INSERT INTO usuarios(id_pessoa,usuario,senha) VALUES 
            ({$idPessoa},'{$dados['usuario']}','{$dados['senha']}')"
        );
        if(!$queryUsuario) {
            $msgError = $this->error;
            $this->rollback();
            return $msgError;
        }
        

        if($dados['tipo'] == '0'){
            $queryPacientes = $this->execQuery(
                "INSERT INTO pacientes(id_pessoa,id_convenio) VALUES
                ({$idPessoa},'{$dados['convenio']}')"
            );
            if(!$queryPacientes) {
                $msgError = $this->error;
                $this->rollback();
                return $msgError;
            }
            
        }else{
            $queryFuncionarios = $this->execQuery(
                "INSERT INTO funcionario(id_pessoa,id_cargo,pis) VALUES
                ({$idPessoa},'{$dados['cargo']}','{$dados['pis']}')"
            );
            if(!$queryFuncionarios) {
                $msgError = $this->error;
                $this->rollback();
                return $msgError;
            }
            $idFuncionario = $this->insert_id;
            //id do médico no banco é 2
            if($dados['cargo'] == '2'){
                $queryMedico = $this->execQuery(
                    "INSERT INTO medico(id_funcionario,crm,id_uf_crm) VALUES
                    ('{$idFuncionario}','{$dados['crm']}','{$dados['uf']}')"
                );
                if(!$queryMedico) {
                    $msgError = $this->error;
                    $this->rollback();
                    return $msgError;
                }
            }
            //id do médico no banco é 3
            if($dados['cargo'] == '3'){
                $queryFarmaceutico = $this->execQuery(
                    "INSERT INTO farmaceutico(id_funcionario,crf,id_uf_crf) VALUES
                    ('{$idFuncionario}','{$dados['crf']}','{$dados['uf']}')"
                );
                if(!$queryFarmaceutico) {
                    $msgError = $this->error;
                    $this->rollback();
                    return $msgError;
                }

            }
        }
        $this->commit();
        return true;
    }


    public function excluir($id){
        $this->begin_transaction();
        
        $queryPessoa = $this->execQuery("SELECT * FROM pessoas p WHERE p.id=$id AND p.deletado=FALSE");
        if($queryPessoa->num_rows == 0){
            throw new Exception('Pessoa não existe');
        }

        $this->execQuery("
            UPDATE pessoas SET deletado=TRUE WHERE id=$id
        ");

        if($this->affected_rows != 1){
            throw new Exception('Erro ao deletar pessoa');
        }

        $this->commit();
        return true;
    }

}
