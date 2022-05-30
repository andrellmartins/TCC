<?php
class pessoas extends model{
    
    public function inclui($dados){
        $this->begin_transaction();
        $queryPessoas = $this->query(
            "INSERT INTO pessoas(nome,ender,telefone,cpf,pis,id_tipo) VALUES 
            ('{$dados['nome']}','{$dados['endereco']}','{$dados['telefone']}','{$dados['cpf']}','{$dados['pis']}',{$dados['tipo']})"
        );
        if(!$queryPessoas) {
            $msgError = $this->error;
            $this->rollback();
            return $msgError;
        }
        
        $idPessoa = $this->insert_id;
        $queryUsuario = $this->query(
            "INSERT INTO usuarios(id_pessoa,usuario,senha) VALUES 
            ({$idPessoa},'{$dados['usuario']}','{$dados['senha']}')"
        );
        if(!$queryUsuario) {
            $msgError = $this->error;
            $this->rollback();
            return $msgError;
        }
        

        if($dados['tipo'] == '4'){
            $queryPacientes = $this->query(
                "INSERT INTO pacientes(id_pessoa,id_convenio) VALUES
                ({$idPessoa},'{$dados['convenio']}')"
            );
            if(!$queryPacientes) {
                $msgError = $this->error;
                $this->rollback();
                return $msgError;
            }
            
        }else{
            switch($dados['tipo']){
                case '1'://medico
                    $dados['cargo'] = '2';
                    break;
                case '2'://farmaceutico
                    $dados['cargo'] = '3';
                    break;
            }
            $queryFuncionarios = $this->query(
                "INSERT INTO funcionario(id_pessoa,id_cargo,time_futebol) VALUES
                ({$idPessoa},'{$dados['cargo']}','{$dados['futebol']}')"
            );
            if(!$queryFuncionarios) {
                $msgError = $this->error;
                $this->rollback();
                return $msgError;
            }
            $idFuncionario = $this->insert_id;
            if($dados['tipo'] == '1'){
                $queryMedico = $this->query(
                    "INSERT INTO medico(id_funcionario,crm,id_uf_crm) VALUES
                    ('{$idFuncionario}','{$dados['crm']}','{$dados['uf']}')"
                );
                if(!$queryMedico) {
                    $msgError = $this->error;
                    $this->rollback();
                    return $msgError;
                }
            }
            if($dados['tipo'] == '2'){
                $queryFarmaceutico = $this->query(
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


    /*public function exclui($id){
        $this->begin_transaction();
        $queryPessoas = $this->query(
            "DELETE FROM pessoas WHERE id = $id"
        );
        if(!$queryPessoas) {
            $msgError = $this->error;
            $this->rollback();
            return $msgError;
        }
        $this->commit();
        return true;
    }*/

    public function listar($dados){
        $this->begin_transaction();
        $queryPessoas = $this->query(
            "select * FROM pessoas"
        );
        if(!$queryPessoas) {
            $msgError = $this->error;
            $this->rollback();
            return $msgError;
        }
        $this->commit();
        return true;
    }

    

    

}
