<?php
class lote extends model{
    public function incluiLote($idProduto, $idFuncionario, $dadosLote){
        $this->begin_transaction();

        (new estoque)->isProdutoValido($idProduto);

        foreach($dadosLote as $lote){
            $this->execQuery("
                INSERT INTO lote(id_produto, validade, lote, id_funcionario) VALUES ({$idProduto},'{$lote['validade']}','{$lote['lote']}',{$idFuncionario})
            ");
            $idLote = $this->insert_id;
            $this->execQuery("
                INSERT INTO movimentacoes(id_produto, id_lote, qtd, id_funcionario) VALUES({$idProduto},{$idLote},{$lote['qtd']},{$idFuncionario})
            ");
            $this->execQuery("
                UPDATE produto SET qtdEstoque = qtdEstoque + {$lote['qtd']}
            ");
        }
        
        $this->commit();
    }
}