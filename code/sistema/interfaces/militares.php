<?php
session_start();
?>
<!DOCTYPE html>
<html>

<?php require_once 'head.php'; //inclui o head (vabeçalho) do HTML ?>    
<body class="hold-transition skin-green sidebar-collapse sidebar-mini">
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
              <h3 class="box-title">Controle de Militares</h3>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#outros" data-toggle="tab">Cadastro</a></li>
                    <li><a href="#pesquisa" data-toggle="tab">Pesquisa de Militares</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="outros">
                        <div class="row">
                            
                                <div class="col-md-12">
                                    <form method="POST" action="../scripts/cadastra_militar.php">
                                    <div class="form-group">
                                        <label class="control-label">PST/GRD</label>
                                        <select name="grd" class="form-control">
                                            <option>CEL</option>
                                            <option>TEN CEL</option>
                                            <option>MAJ</option>
                                            <option>CAP</option>
                                            <option>1 Ten</option>
                                            <option>2 Ten</option>
                                            <option>S ten</option>
                                            <option>1 SGT</option>
                                            <option>2 SGT</option>
                                            <option>3 SGT</option>
                                            <option>CB</option>
                                            <option>SD</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">CPF</label>
                                        <input type="text" name="cpf" class="form-control" data-inputmask='"mask": "999.999.999-99"' data-mask>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nome Completo</label>
                                        <input type="text" name="nome" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control">Cadastrar</button>
                                    </div>     
                                    </form>    
                                </div> 
                        </div>
                    </div>
                    <div class="tab-pane" id="pesquisa">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Nome do Militar</label>
                                    <input type="text" id="nomeMilPesq" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary form-control" onclick="pesquisaMil()"><i class="fa fa-search"></i> Pesquisar</button>
                                </div>
                            </div>
                        </div>
                        <div id="retPesqMil"></div>
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

<?php require_once 'footer.php'; // inclui script e arquivos javascript ?>

<!-- Code to handle taking the snapshot and displaying it locally -->
	

</body>
</html>
