<?php
session_start();
date_default_timezone_set("America/Sao_Paulo"); //configura horario para o timestamp

require_once '../classes/local.php';
require_once '../classes/visitante.php';
?>
<!DOCTYPE html>
<html>

<?php require_once 'head.php'; //inclui o head (vabe�alho) do HTML ?>    
    <body class="hold-transition skin-green sidebar-collapse sidebar-mini" onload="">

<?php
require_once '../includes/verifica3.php'; //protege pagina
require_once '../includes/msg.php';

?>
<div class="wrapper">

  <?php require_once 'menuOperador.php'; // inseri o menu lateral dos manipuladores ?>

    <!-- Main content -->
    <section class="content">
        <?php
        if(isset($_GET['msg'])){
        ?>
        <div class="pad margin no-print">
            <div class="callout callout-<?php echo $tipo; ?>">
                <i class="fa fa-info-circle fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <?php echo $conteudo; ?>
            </div>
        </div>
        <?php
        }
        ?> 
      <div class="row">
        <div class="col-md-1"></div>  
        <div class="col-md-10">
            <div class="box-header">
              <h3 class="box-title">Controle de Visitas</h3>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#entrada" data-toggle="tab">Check-in</a></li>
                    <li><a href="#saida" data-toggle="tab">Check-out</a></li>
                    <li><a href="#leitor" data-toggle="tab">Leitor de Cart&atilde;o</a></li>
                    <li><a href="#relatorio" data-toggle="tab">Relat&oacute;rio</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="entrada">
                        <div class="row">
                            <form method="POST" action="../scripts/checkin.php">
                                <div class="col-md-6 text-center">
                                    <div class="form-inline">
                                        <label>Sele&ccedil;&atilde;o de Visitante</label><br>
                                        <div class="form-group" style="width: 45%;">
                                            <input type="text" id="nomePesq" class="form-control" placeholder="NOME">
                                        </div>
                                        <div class="form-group" style="width: 45%;">
                                            <input type="text" id="cpfPesq" class="form-control" placeholder="CPF" data-inputmask='"mask": "999.999.999-99"' data-mask>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <button type="button" class="btn btn-warning" onclick="pesquisaVisitanteCheckin()">Pesquisar</button>
                                    </div>
                                    
                                    <div id="retPesquisa"></div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Destino</label>
                                        <select name="idLocal" class="form-control select2" >
                                            <option value="0"></option>
                                            <?php
                                            $localObj = new local();
                                            $l = $localObj->listaLocal();
                                            for($i=0;$i<count($l);$i++){

                                                echo "<option value='".$l[$i]['id']."'>".$l[$i]['local']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Placa do Carro/Moto</label>
                                        <input type="text" name="placa" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Modelo do Carro/Moto</label>
                                        <input type="text" name="modelo" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Cor do Carro/Moto</label>
                                        <input type="text" name="cor" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control">Cadastrar</button>
                                    </div>        
                                </div> 
                            </form>    
                        </div>
                    </div>
                    <div class="tab-pane" id="saida">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr class="text-info">
                                            <td>NOME</td>
                                            <td>CPF</td>
                                            <td>DESTINO</td>
                                            <td>HORA ENTRADA</td>
                                            <td>PLACA</td>
                                            <td></td>
                                        </tr>
                                <?php
                                    $visitanteObj = new visitante();
                                    
                                    $lva = $visitanteObj->visitasAbertas();
                                    
                                    for($i=0;$i<count($lva);$i++){
                                ?>
                                        <tr>    
                                            <td><?php echo $lva[$i]['nome']; ?></td>
                                            <td><?php echo $lva[$i]['cpf']; ?></td>
                                            <td><?php echo $lva[$i]['local']; ?></td>
                                            <td><?php echo date('d/m/Y H:i:s', $lva[$i]['stamp_entrada']); ?></td>
                                            <td><?php echo $lva[$i]['placa']; ?></td>
                                            <td><a href="../scripts/checkout.php?id=<?php echo $lva[$i]['id_visita']; ?>" class="text-danger"><i alt="Check-out" class="fa fa-sign-out fa-2x"></i></a></td>
                                        </tr>
                                <?php        
                                    }
                                        
                                        
                                ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="leitor">
                        <div class="row">
                            <div class="col-md-10 form-group">
                                <input type="text" id="cBarras" class="form-control" placeholder="C&oacute;digo de Barras" data-inputmask='"mask": "999.999.999-99"' data-mask>
                            </div>
                            <div class="col-md-2 form-group">
                                <button onclick="pesquisaCBarras()" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div id="retPesqCBarras"></div>
                    </div>
                    <div class="tab-pane" id="relatorio">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>In&iacute;cio do Intervalo</label>
                                <input type="date" id="inicio" placeholder="Inc&iacute;o" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>T&eacute;rmino do Intervalo</label>
                                <input type="date" id="termino" class="form-control" >
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Local</label><br>
                                <select id="idLocalPesq" class="form-control select2" style="width: 100%;" >
                                <option value="0">Selecione</option>
                                <?php
                                $localObj = new local();
                                $l = $localObj->listaLocal();
                                for($i=0;$i<count($l);$i++){
                                    echo "<option $check value='".$l[$i]['id']."'>".$l[$i]['local']."</option>";
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Placa do Ve&iacute;culo</label>
                                <input type="text" id="placa" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Modelo do Ve&iacute;culo</label>
                                <input type="text" id="modelo" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Cor do Ve&iacute;culo</label>
                                <input type="text" id="cor" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary form-control" onclick="pesquisaVisitas()"> Pesquisar</button>
                            </div>
                        </div>
                        <div class="row">
                            <div id="retPesquisaVisitas"></div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<!-- modais -->  
<div class="modal fade" id="modal-foto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 70%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-6">
                  <!-- Divs da webcam -->
                  <div class="form-group">
                      <div id="my_camera"></div><br>
                      <button type="button" class="btn btn-primary" onClick="take_snapshot()" style="width: 320px;"><i class="fa fa-camera">&nbsp Capturar</i></button>
                  </div>  
              </div>
              <div class="col-md-6">
                  <div id="results"></div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'footer.php'; // inclui script e arquivos javascript ?>

<?php
///// fun��o que verifiva se visitante ja foi selecionado e carrega na pagina de checkin

if(isset($_GET['ids']) and $_GET['ids']>0){
?>
<script language="JavaScript">
    window.onload = onLoadCheckin('<?php echo $_GET['ids']; ?>');
</script>    
    
<?php    
}
///////////////////////////////////////////////////////////////////////////////////////
?>
	

</body>
</html>
