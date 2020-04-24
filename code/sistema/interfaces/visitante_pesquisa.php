<?php
//session_start();
require_once '../includes/verifica.php';
require_once '../classes/local.php';

?>

<div class="row">
    <div class="col-md-12">
        <p class="text-info">Preencha o formul&aacute;rio com os campos desejados pra refinar a pesquisa</p>
        <div class="row">
            <div class="col-md-4 form-group">
                <input type="text" id="nomep" placeholder="NOME" class="form-control">
            </div>
            <div class="col-md-4 form-group">
                <input type="text" id="cpfp" placeholder="CPF" class="form-control" data-inputmask='"mask": "999.999.999-99"' data-mask>
            </div>
            <div class="col-md-4 form-group">
                <input type="text" id="rgp" placeholder="RG" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <input type="text" id="dnp" placeholder="DATA DE NASCIMENTO" class="form-control">
            </div>
            <div class="col-md-3 form-group">
                <input type="text" id="fonep" placeholder="FONE" class="form-control" data-inputmask='"mask": "(99)99999-9999"' data-mask>
            </div>
            <div class="col-md-3 form-group">
                <input type="text" id="omOrigemp" placeholder="OM DE ORIGEM" class="form-control">
            </div>
            <div class="col-md-3 form-group">
                <input type="text" id="idMilp" placeholder="IDENTIDADE MILITAR" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                <select id="idLocalpes" class="form-control select2" style="width:100%" >
                    <option value="0">LOCAL DE ACESSO</option>
                    <?php
                    $localObj = new local();
                    $l = $localObj->listaLocal();
                    for($i=0;$i<count($l);$i++){

                        echo "<option value='".$l[$i]['id']."'>".$l[$i]['local']."</option>";
                    }
                    ?>
                </select>    
                </div>
                
            </div>
            <div class="col-md-3 form-group">
                <label>Sexo</label>
                <input type="radio" name="sexop" value="M"> Masculino
                <input type="radio" name="sexop" value="F"> Feminino
            </div>
            <div class="col-md-3 form-group">
                <input type="checkbox" id="acessoLivre" value="1"> Cart&atilde;o de Acesso?
            </div>
            <div class="col-md-3 form-group">
                <input type="checkbox" id="alerta" value="1"> Alerta?
            </div>
            <div class="col-md-12 form-group">
                <button type="button" class="btn btn-primary form-control" onclick="pesquisaVisitante()" ><i class="fa fa-search"></i> Pesquisar</button>
            </div>
        </div>
        <div id="resultPesquisa">
            
        </div>
    </div>
</div>


