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
          <div class="col-md-12">
                <div class="box-header">
                    <h2 class="box-title">Gr&aacute;ficos</h2>
                </div>
              <div class="box box-success">
                  <div class="box-header">
                      <div class="box-title">Per&iacute;odo de Exibi&ccedil;&atilde;o</div>
                  </div>
                  <div class="box-body">
                      <div class="row">
                          <div class="col-md-6 form-group">
                            <input type="date"  placeholder="Data Inicial" class="form-control">
                          </div>
                          <div class="col-md-6 form-group">
                            <input type="date" placeholder="Data Final" class="form-control">
                          </div>
                          <div class="col-md-12 form-group text-center">
                              <button class="btn btn-primary"><i class="fa fa-refresh"></i> Atualizar</button>  
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

<?php require_once 'footer.php'; // inclui script e arquivos javascript ?>

<!-- Code to handle taking the snapshot and displaying it locally -->
	

</body>
</html>
