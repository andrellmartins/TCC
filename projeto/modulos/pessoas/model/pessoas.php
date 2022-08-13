<?php
class pessoas extends model{
    
    public function incluir($dados){
        $this->begin_transaction();
        $this->execQuery(
            "INSERT INTO pessoas(nome,ender, telefone, cpf, sexo, data_nasc) VALUES 
            ('{$dados['nome']}','{$dados['endereco']}','{$dados['telefone']}','{$dados['cpf']}','{$dados['sexo']}','{$dados['nascimento']}')"
        );
        
        $idPessoa = $this->insert_id;
        $this->execQuery(
            "INSERT INTO usuarios(id_pessoa,usuario,senha) VALUES 
            ({$idPessoa},'{$dados['usuario']}','{$dados['senha']}')"
        );
        

        if($dados['tipo'] == '0'){
            $this->execQuery(
                "INSERT INTO pacientes(id_pessoa,id_convenio) VALUES
                ({$idPessoa},'{$dados['convenio']}')"
            );
            
        }else{
            $this->execQuery(
                "INSERT INTO funcionario(id_pessoa,id_cargo,pis) VALUES
                ({$idPessoa},'{$dados['cargo']}','{$dados['pis']}')"
            );

            $idFuncionario = $this->insert_id;
            //id do médico no banco é 2
            if($dados['cargo'] == '2'){
                $this->execQuery(
                    "INSERT INTO medico(id_funcionario,crm,id_uf_crm) VALUES
                    ('{$idFuncionario}','{$dados['crm']}','{$dados['uf']}')"
                );
            }
            //id do médico no banco é 3
            if($dados['cargo'] == '3'){
                $this->execQuery(
                    "INSERT INTO farmaceutico(id_funcionario,crf,id_uf_crf) VALUES
                    ('{$idFuncionario}','{$dados['crf']}','{$dados['uf']}')"
                );
            }
        }
        $this->commit();
        return true;
    }
    
    public function alterar($dados){
        $this->begin_transaction();
        //recuperar pessoa
        $query = $this->execQuery(
           "SELECT 
                u.id as id_usuario,
                pa.id as id_paciente,
                f.id as id_funcionario,
                f.id_cargo as cargo,
                m.id as id_medico,
                fa.id as id_farmaceutico
            FROM pessoas p
                LEFT JOIN usuarios u
                    ON u.id_pessoa=p.id
                LEFT JOIN pacientes pa
                    ON pa.id_pessoa=p.id
                LEFT JOIN funcionario f
                    ON f.id_pessoa=p.id
                LEFT JOIN medico m
                    ON m.id_funcionario=f.id
                LEFT JOIN farmaceutico fa
                    ON fa.id_funcionario=f.id
            WHERE   p.id={$dados['id']}
                AND p.deletado=FALSE
            "
        );
        

        $pessoaAtual = $query->fetch_assoc();
        if(is_null($pessoaAtual)){
            return false;
        }

        $this->execQuery(
            "UPDATE pessoas
            SET nome='{$dados['nome']}',
                ender='{$dados['endereco']}',
                telefone='{$dados['telefone']}',
                cpf='{$dados['cpf']}',
                sexo='{$dados['sexo']}',
                data_nasc='{$dados['nascimento']}'
            WHERE id={$dados['id']}"
        );
        if(!is_null($pessoaAtual['id_usuario'])){
            $this->execQuery(
                "UPDATE usuarios
                SET usuario = '{$dados['usuario']}',
                    senha   = '{$dados['senha']}' 
                WHERE id={$pessoaAtual['id_usuario']}
                "
            );
        }
        if(!is_null($pessoaAtual['id_paciente'])){
            $this->execQuery(
                "UPDATE pacientes 
                 SET id_convenio='{$dados['convenio']}'
                 WHERE id={$pessoaAtual['id_paciente']}"
            );
        }
        if(!is_null($pessoaAtual['id_funcionario'])){
            $this->execQuery(
                "UPDATE funcionario
                SET id_cargo='{$pessoaAtual['cargo']}',
                    pis='{$dados['pis']}'
                WHERE id={$pessoaAtual['id_funcionario']}"
            );
        }
        if(!is_null($pessoaAtual['id_medico'])){
            $this->execQuery(
                "UPDATE medico 
                SET crm='{$dados['crm']}',
                    id_uf_crm={$dados['uf']}
                WHERE id={$pessoaAtual['id_medico']}"
            );
        }        
        if(!is_null($pessoaAtual['id_farmaceutico'])){
            $this->execQuery(
                "UPDATE farmaceutico
                SET crf='{$dados['crf']}',
                    id_uf_crf={$dados['uf']}
                WHERE id={$pessoaAtual['id_farmaceutico']}"
            );
        }

        $this->commit();
        return true;
    }


    public function excluir($id){
        $this->begin_transaction();
        
        if($id == $_SESSION['usuarioLogado']['id_pessoa']){
            throw new Error('Pessoa não pode se excluir');
        }

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

        //$this->commit();
        return true;
    }

}
