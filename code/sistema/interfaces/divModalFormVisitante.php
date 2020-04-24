<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';
require_once '../classes/local.php';

$visitante = new visitante();

$visitante->setAtributos($_POST['idvs']);

?>
<div class="modal-dialog" role="document" style="width: 70%;">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Ficha do Visitante</h3>
        <a href="../PDF/historicoVisitante.php?v=<?php echo $_POST['idvs']; ?>&tipo=1" target="_blank"><i class="fa fa-history fa-2x text-danger" title="Imprimir Hist&oacute;rico"></i></a>&nbsp;&nbsp;&nbsp;<i class="fa fa-print fa-2x text-success" title="Imprimir Ficha"></i>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-3 form-group">
                  <label>Nome Completo</label><br>
                  <input type="text" id="nomeEdt" value="<?php echo $visitante->getNome() ?>" class="form-control"><br>
                  
                  <label>Sexo</label><br>
                  <select class="form-control" id="sexoEdt">
                      <option value="M" <?php if($visitante->getSexo() == 'M'){ echo "Selected"; } ?>>Masculino</option>
                      <option value="F" <?php if($visitante->getSexo() == 'F'){ echo "Selected"; } ?>>Feminino</option>
                  </select>
              </div>
              <div class="col-md-3 form-group">
                  <label>CPF</label><br>
                  <input type="text" id="cpfEdt" value="<?php echo $visitante->getCpf() ?>" data-inputmask='"mask": "999.999.999-99"' data-mask class="form-control"><br>
                  
                  <label>Data de Nascimento</label><br>
                  <input type="text" id="dnEdt" value="<?php echo $visitante->getDn() ?>" class="form-control" data-inputmask='"mask": "99/99/9999"' data-mask>
              </div>
              <div class="col-md-3 form-group">
                  <label>RG</label><br>
                  <input type="text" id="rgEdt" value="<?php echo $visitante->getRg() ?>" class="form-control"><br>
                  
                  <label>Fone</label><br>
                  <input type="text" id="foneEdt" value="<?php echo $visitante->getFone() ?>" class="form-control" data-inputmask='"mask": "(99)99999-9999"' data-mask>
              </div>
              <div class="col-md-3">
                  <img src="<?php echo $visitante->getFoto(); ?>" class="img-thumbnail img-bordered" style="width: 150px; height: 150px;" >
              </div>
              <div class="col-md-6 form-group">
                  <label>Nome do Militar Respons&aacute;vel</label><br>
                  <input type="text" class="form-control" value="<?php echo $visitante->getNomeMilRespRes(); ?>" ><br>
              </div>
              <div class="col-md-6 form-group">
                  <label>Identidade Militar</label><br>
                  <input id="idtMilEdt" type="text" value="<?php echo $visitante->getIdMil(); ?>" class="form-control">
              </div>
              <div class="col-md-12 form-group">
                  <button class="btn btn-warning form-control" onclick="editaVisitante('<?php echo $_POST['idvs']; ?>')" ><i class="fa fa-pencil"></i> Salvar Edi&ccedil;&atilde;o</button>
              </div>
          </div>
          
          <div class="row">
              <fieldset>
                  <legend class="text-danger" style="margin-left: 10px;"><i class="fa fa-address-book"></i> Cart&atilde;o de Acesso</legend>
                      <div class="col-md-4 form-group">
                            <select id="idLocal" class="form-control select2" >
                                <option value="0">Local de Acesso</option>
                                <?php
                                $localObj = new local();
                                $l = $localObj->listaLocal();
                                for($i=0;$i<count($l);$i++){
                                    
                                    if($l[$i][local] == $visitante->getTipoAcesso()){
                                        $check = "selected";
                                    }

                                    echo "<option $check value='".$l[$i][id]."'>".$l[$i][local]."</option>";
                                }
                                ?>
                            </select>
                      </div>
                      <div class="col-md-4 form-group">
                          <input type="text" class="form-control" id="validade" placeholder="VALIDADE" data-inputmask='"mask": "99/99/9999"' data-mask <?php if($visitante->getAcessoLivre()){ echo "value='".$visitante->getValidade()."'"; } ?> >
                      </div>
                <?php
                if(!$visitante->getAcessoLivre()){
                ?>
                  <div id="retCartao">
                      <div class="col-md-4 form-group">
                          <button type="button" class="btn btn-danger form-control" onclick="salcaCartaoAcesso('<?php echo $_POST['idvs']; ?>')" ><i class="fa fa-save"></i> Salvar</button>
                      </div>
                  </div>    
                <?php
                }else{
                ?>
                  <div id="retCartao">
                    <div class="col-md-1">
                        <button type="button" title="Editar Cart&atilde;o de Acesso" class="btn btn-danger form-control" onclick="salcaCartaoAcesso('<?php echo $_POST['idvs']; ?>')"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" title="Bloquear Acesso" class="btn btn-danger form-control" onclick="bloqueiaCartaoAcesso('<?php echo $_POST['idvs']; ?>')"><i class="fa fa-close"></i></button>
                    </div>
                    <div class="col-md-1">
                        <a href="../PDF/cartaoUnico.php?id=<?php echo $_POST['idvs']; ?>" target="_blank" title="Imprimir Cart&atilde;o de Acesso" class="btn btn-danger form-control"><i class="fa fa-id-badge"></i></a>
                    </div>  
                  </div>  
                <?php  
                }
                ?>
              </fieldset>
          </div>
          
          <div class="row">
              <fieldset>
                  <legend class="text-success" style="margin-left: 10px;"><i class="fa fa-car"></i> Ve&iacute;culos</legend>
                  <div class="col-md-2 form-group">
                      <select id="tipoVeiculo" class="form-control">
                          <option value="1" <?php if($visitante->getVeiculos() and $visitante->getVeiculos()[tipo] == 1){ echo "selected"; } ?> >CARRO</option>
                          <option value="2" <?php if($visitante->getVeiculos() and $visitante->getVeiculos()[tipo] == 2){ echo "selected"; } ?> >MOTO</option>
                      </select>
                  </div>
                  <div class="col-md-2 form-group">
                      <input type="text" placeholder="MARCA" id="marca" class="form-control" <?php if($visitante->getVeiculos()){ echo "value='".$visitante->getVeiculos()['marca']."'"; } ?>>
                  </div>
                  <div class="col-md-2 form-group">
                      <input type="text" placeholder="MODELO" id="modelo" class="form-control" <?php if($visitante->getVeiculos()){ echo "value='".$visitante->getVeiculos()['modelo']."'"; } ?>>
                  </div>
                  <div class="col-md-2 form-group">
                      <input type="text" placeholder="COR" id="cor" class="form-control" <?php if($visitante->getVeiculos()){ echo "value='".$visitante->getVeiculos()['cor']."'"; } ?>>
                  </div>
                  <div class="col-md-2 form-group">
                      <input type="text" placeholder="PLACA" id="placa" class="form-control" <?php if($visitante->getVeiculos()){ echo "value='".$visitante->getVeiculos()['placa']."'"; } ?>>
                  </div>
                  <?php
                  if($visitante->getVeiculos()){
                  ?>
                  <div id="retVeiculo">
                    <div class="col-md-2 form-group">
                        <button type="button" class="btn btn-success form-control" title="Bloquear" onclick="bloqueiaVeiculoVisitante('<?php echo $visitante->getVeiculos()['id_veiculo']; ?>')"><i class="fa fa-close"></i></button>
                    </div>    
                  </div>
                  
                  <?php
                  }else{
                  ?>
                  <div id="retVeiculo">
                    <div class="col-md-2 form-group">
                        <button type="button" class="btn btn-success form-control" title="Salvar" onclick="salvaVeiculoVisitante('<?php echo $_POST['idvs']; ?>')"><i class="fa fa-save"></i></button>
                    </div>    
                  </div>
                  
                  <?php    
                  }
                  ?>
              </fieldset>
          </div>
          
          <div class="row">
              <fieldset>
                  <legend class="text-warning" style="margin-left: 10px;"><i class="fa fa-exclamation-triangle"></i> Alerta</legend>
                  <div class="col-md-8">
                      <input type="text" id="motivoAlerta" placeholder="TEXTO DO ALERTA" class="form-control" <?php if($visitante->getAlerta()){ echo "value='".$visitante->getMotivoAlerta()."'"; } ?> >
                  </div>
                  <?php
                  if($visitante->getAlerta()){
                  ?>
                    <div id="retAlerta">
                        <div class="col-md-4">
                          <button class="btn btn-warning form-control" onclick="encerraAlerta('<?php echo $_POST['idvs']; ?>')"><i class="fa fa-close"></i> Encerrar</button>
                        </div>
                    </div>
                    
                  <?php
                  }else{
                  ?>
                    <div id="retAlerta">
                        <div class="col-md-4">
                            <button class="btn btn-warning form-control" onclick="salvaAlerta('<?php echo $_POST['idvs']; ?>')"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </div>
                  <?php
                  }
                  ?>
                  
              </fieldset>
          </div>
      </div>
    </div>
  </div>
<?php
require_once 'footerJs.php';