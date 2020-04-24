<?php
session_start();
?>
<!DOCTYPE html>
<html>

<?php require_once 'head.php'; //inclui o head (vabe�alho) do HTML ?>    
<body class="hold-transition skin-green sidebar-collapse sidebar-mini">
    
<!-- script js que habilitam camera pra foto do viistante -->    
<script type="text/javascript" src="../includes/js/webcam.js"></script>
<script language="JavaScript">
    Webcam.set({
	width: 320,
	height: 240,
	image_format: 'jpeg',
	jpeg_quality: 90
    });
</script>
<script language="JavaScript">
    function setup() {
	Webcam.reset();
	Webcam.attach( '#my_camera' );
    }
		
    function take_snapshot() {
	// take snapshot and get image data
	Webcam.snap( function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML =
		'<img src="'+data_uri+'"/>'+ '<br><br>'+
                '<button class="btn btn-warning" data-dismiss="modal" style="width: 320px;"><i class="fa fa-save"></i>&nbsp Confirmar</button>';
        
            document.getElementById('fotoForm').innerHTML = '<img src="'+data_uri+'"/>';
            document.getElementById('fotoInput').value = data_uri;
	} );
    }
</script>

<?php
require_once '../includes/verifica.php'; //protege pagina
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
              <h3 class="box-title">Controle de Visitantes</h3>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#outros" data-toggle="tab">Cadastro</a></li>
                    <?php
                    if($_SESSION['funcao'] != 3){
                    ?>
                    <li><a href="#pesquisa" data-toggle="tab">Pesquisa de Visitantes</a></li>
                    <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="outros">
                        <div class="row">
                            <form method="POST" action="../scripts/cadastra_visitante.php">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nome Completo</label>
                                        <input type="text" name="nome" class="form-control">
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">

                                                <div class="form-group">
                                                    <label class="control-label">RG</label>
                                                    <input type="text" name="rg" class="form-control" placeholder="NR IDENTIDADE / OE" >
                                                </div>

                                        </div>
                                        <div class="col-md-4">

                                                <div class="form-group">
                                                    <label class="control-label">CPF</label>
                                                    <input type="text" name="cpf" class="form-control" data-inputmask='"mask": "999.999.999-99"' data-mask>
                                                </div>

                                        </div>
                                        <div class="col-md-4">

                                                <div class="form-group">
                                                    <label class="control-label">Data de Nascimento</label>
                                                    <input type="text" name="dn" class="form-control" data-inputmask='"mask": "99/99/9999"' data-mask >
                                                </div>
                                        </div>
                                                                         
                                    </div>

                                    
                                    <!--
                                        <div class="form-group">
                                        <label class="control-label">Telefone</label>
                                        <input type="text" name="fone" class="form-control" data-inputmask='"mask": "(99) 99999-9999"' data-mask >
                                    </div>
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <input type="radio" name="sexo" value="M"> Masculino
                                        <input type="radio" name="sexo" value="F"> Feminino
                                    </div>
                                    -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Telefone</label>
                                                <input type="text" name="fone" class="form-control" data-inputmask='"mask": "(99) 99999-9999"' data-mask >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sexo</label>
                                                <input type="radio" name="sexo" value="M"> Masculino
                                                <input type="radio" name="sexo" value="F"> Feminino
                                            </div>
                                        </div>
                                    </div>







                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Identidade Militar</label>
                                        <input type="text" name="idMil" class="form-control" placeholder="SE MILITAR OU DEPENDENTE">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">OM de Origem</label>
                                        <input type="text" name="omOrigem" class="form-control" placeholder="SE MILITAR DE OUTRA OM">
                                    </div>
                                    <div class="form-group">
                                        <!-- bot�o que pega militares do sisbol -->
                                        <button type="button" class="btn btn-warning form-control" data-toggle="modal" data-target="#modal-mil-om"><i class="fa fa-user-secret"></i>&nbsp;&nbsp; Selecionar Militar da OM</button>
                                        <input type="hidden" value="" name="idMilResp" id="idMilHidden">
                                        <div id="idMilHiddenInput"></div>
                                    </div>
                                    <div class="form-group">
                                        <!-- bot�o que aciona a webcam -->
                                        <button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#modal-foto" onClick="setup();" ><i class="fa fa-camera"></i>&nbsp;&nbsp; Tirar Foto</button>
                                    </div>
                                    <div id="fotoForm"></div>
                                    <input type="hidden" value="" name="foto" id="fotoInput">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control">Cadastrar</button>
                                    </div>        
                                </div>
                            </form>    
                        </div>
                    </div>
                    <?php
                    if($_SESSION['funcao'] != 3){
                    ?>
                    <div class="tab-pane" id="pesquisa">
                        <?php require 'visitante_pesquisa.php'; ?>
                    </div>
                    <?php
                    }
                    ?>
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

<!-- modal pesquisa de militar da OM -->
<div class="modal fade" id="modal-mil-om" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 70%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Militar da OM - Respons&aacute;vel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <input type="text" id="nomeMilOmPesq" class="form-control" placeholder="NOME DO MILITAR">
                  </div>
                  <div class="form-group">
                      <button type="button" class="btn btn-primary form-control" onclick="pesquisaMilOm()" ><i class="fa fa-search"></i> &nbsp;&nbsp;&nbsp;Pesquisar</button>
                  </div>
              </div>
              <div class="col-md-6">
                  <div id="retPesquMilOm"></div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- modal de formulario de visitantes -->
<div class="modal fade" id="modal-form-visitante" tabindex="-1" role="dialog" aria-hidden="true"></div>

<?php require_once 'footer.php'; // inclui script e arquivos javascript ?>

<!-- Code to handle taking the snapshot and displaying it locally -->
	

</body>
</html>
