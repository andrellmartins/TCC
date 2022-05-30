<?php class cadastro{
    public function render($return = false){

        $model = new model;
        $query = $model->query('SELECT id,tipo FROM tipo_pessoa ORDER BY tipo');
        $htmlTipo = '';
        if($query)
        while($option = $query->fetch_assoc()){
            $option['tipo'] = ucfirst(strtolower($option['tipo']));
            $htmlTipo .= "<option value=\"{$option['id']}\">{$option['tipo']}</option>";
        }

        $query = $model->query(
            'SELECT u.uf,p.pais,u.id 
            FROM uf u 
                INNER JOIN pais p 
                    ON u.id_pais=p.id
            ORDER BY p.pais,u.uf'
        );
        $htmlUF = '';
        if($query)
        while($option = $query->fetch_assoc()){
            $htmlUF .= "<option value=\"{$option['id']}\">{$option['pais']} - {$option['uf']}</option>";
        }
        
        $query = $model->query('SELECT id,cargo FROM cargos WHERE id NOT IN (2,3)');
        $htmlCargo = '';
        if($query)
        while($option = $query->fetch_assoc()){
            $option['cargo'] = ucfirst(strtolower($option['cargo']));
            $htmlCargo .= "<option value=\"{$option['id']}\">{$option['cargo']}</option>";
        }

        $query = $model->query('SELECT id,nome FROM convenios');
        $htmlConvenio = '';
        if($query)
        while($option = $query->fetch_assoc()){
            $option['nome'] = ucfirst(strtolower($option['nome']));
            $htmlConvenio .= "<option value=\"{$option['id']}\">{$option['nome']}</option>";
        }



        ob_start();
        ?>
    <div class="container w-50 self-align-middle">
        <div class="row text-center">
            <form action="?modulo=pessoas&programa=pessoas&acao=inclui" method="post">
                <div class="form-floating mb-3">
                    <input type="Input" class="form-control" name="nome" id="floatingNome" placeholder="Nome" required>
                    <label for="floatingNome">Nome</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="Input" class="form-control" name="endereco" id="floatingEndereço" placeholder="Endereço" required>
                    <label for="floatingEndereço">Endereço</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="Input" class="form-control" name="telefone" id="floatingTelefone" placeholder="Telefone" required>
                    <label for="floatingTelefone">Telefone</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="Input" class="form-control" name="cpf" id="floatingCpf" placeholder="Cpf" required>
                    <label for="floatingCpf">Cpf</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="Input" class="form-control" name="pis" id="floatingPis" placeholder="Pis" required>
                    <label for="floatingPis">Pis</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingTipo" name="tipo" required>
                        <option selected>Selecionar Tipo de Usuário</option>
                        <?php echo $htmlTipo ?>
                    </select>
                    <label for="floatingTipo">Tipo</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="Input" class="form-control" name="crm" id="floatingCrm" placeholder="CRM" required>
                    <label for="floatingCrm">CRM</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="Input" class="form-control" name="crf" id="floatingCrf" placeholder="CRF" required>
                    <label for="floatingCrf">CRF</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingUf" name="uf" required>
                        <option selected>Selecionar UF do Documento</option>
                        <?php echo $htmlUF ?>
                    </select>
                    <label for="floatingUf">UF</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingCargo" name="cargo" required>
                        <option selected>Selecionar Cargo do Funcionário</option>
                        <?php echo $htmlCargo ?>
                    </select>
                    <label for="floatingCargo">Cargo</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="Input" class="form-control" name="futebol" id="floatingFutebol" placeholder="Futebol" required>
                    <label for="floatingFutebol">Time de Futebol</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingConvenio" name="convenio" required>
                        <option selected>Selecionar Convênio</option>
                        <?php echo $htmlConvenio ?>
                    </select>
                    <label for="floatingConvenio">Convenio</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="Input" class="form-control" name="usuario" id="floatingUsuario" placeholder="Usuario" required>
                    <label for="floatingUsuario">Usuario</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="Password" class="form-control" name="senha" id="floatingSenha" placeholder="Senha" required>
                    <label for="floatingSenha">Senha</label>
                </div>
                <div class="form-floating mb-3">
                    <p>Já tem Usuário ? <a href="/">Faça Login</a></p>
                </div>
                <div class="form-floating mb-3">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(()=>{
            //carrega as mascaras dos campos
                $('#floatingCpf').mask('000.000.000-00'); //14
                $('#floatingTelefone').mask('+00 (00) 0 0000-0000');//20
                $('#floatingPis').mask('000.00000.00-0');//14
                $('#floatingCrm, #floatingCrf').mask('00000');//5
            //esconde CRF CRM e UF
                let disabled = $("#floatingCrf,#floatingUf,#floatingCrm,#floatingCargo,#floatingConvenio");
                disabled.prop('disabled',true);
                disabled.parent().css('display','none');
            //onchange floatingTipo
            $('#floatingTipo').on('change',(evento)=>{
                let tipo = $(evento.currentTarget),
                    tipoValue = tipo.val();
                let enable = $('#floatingConvenio'),
                    disabled = $('#floatingCrf, #floatingUf, #floatingCrm, #floatingCargo, #floatingFutebol');
                switch(tipoValue){
                    //médico
                    case '1':
                        enable      = $("#floatingCrm,#floatingUf, #floatingFutebol");
                        disabled    = $("#floatingCrf,#floatingCargo,#floatingConvenio");
                        break;
                    //farmacêutico
                    case '2':
                        enable      = $("#floatingCrf,#floatingUf, #floatingFutebol");
                        disabled    = $("#floatingCrm,#floatingCargo,#floatingConvenio");
                        break;
                    //outro funcionário
                    case '4':
                        enable       = $("#floatingCargo, #floatingFutebol")
                        disabled     = $('#floatingCrf, #floatingUf, #floatingCrm,#floatingConvenio');
                    break;
                }
                enable.prop('disabled',false);
                enable.parent().css('display','block');

                disabled.prop('disabled',true);
                disabled.parent().css('display','none');
            }).trigger('change');
        })
    </script>
    <?php
        $content = ob_get_clean();
        if($return){
            return $content;
        }
        echo $content;
    }
}