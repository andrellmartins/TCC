<?php 
class estoque extends model{
    public function isProdutoValido($idProduto){
        $queryProduto = $this->execQuery("SELECT 1 FROM produtos p WHERE p.id={$idProduto} AND p.deletado=FALSE");
        if($queryProduto->num_rows == 0){
            throw new Exception('Produto não existe');
        }
    }

    public function incluir($dados){
        $this->begin_transaction();
        
        $this->execQuery(
            "INSERT INTO produtos(descricao, fabricante, id_func_cadastro) VALUES 
            ('{$dados['descricao']}', '{$dados['fabricante']}', {$dados['id_funcionario']})
            "
        );
        $insertProduto = $this->insert_id;

        if($dados['isMedicamento'] == 1){
            $this->execQuery(
                "INSERT INTO medicamentos (id_produto,laboratorio, nome_comercial, principio_ativo) VALUES 
                ($insertProduto,'{$dados['laboratorio']}', '{$dados['comercial']}', '{$dados['principio']}')
                "
            );
        }

        $this->commit();
        return true;
    }


    public function excluir($id){
        $this->begin_transaction();
        
        $this->isProdutoValido($id);

        $this->execQuery("
            UPDATE produtos SET deletado=TRUE WHERE id=$id
        ");

        if($this->affected_rows != 1){
            throw new Exception('Erro ao deletar produto');
        }

        $this->commit();
        return true;
    }

    public function alterar($dados){
        $this->begin_transaction();

        $this->isProdutoValido($dados['id']);

        $this->execQuery(
            "UPDATE produtos
                SET descricao = '{$dados['descricao']}',
                    fabricante = '{$dados['fabricante']}'
            WHERE id={$dados['id']}"
        );
        
        $idMedicamento = $this->execQuery('SELECT id FROM medicamentos WHERE id_produto='.$dados['id']) -> fetch_assoc()['id'];


        if($dados['isMedicamento'] == 1){
            $this->execQuery(
                "UPDATE medicamentos
                    SET laboratorio = '{$dados['laboratorio']}', 
                        nome_comercial = '{$dados['comercial']}',
                        principio_ativo = '{$dados['principio']}'
                WHERE id=$idMedicamento
                "
            );
        }

        $this->commit();
        return true;
    }     
}