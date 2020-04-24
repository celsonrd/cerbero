<?php
session_start();
require_once '../classes/local.php';
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
        <div class="col-md-6">
             
          <div class="box box-danger">
              <div class="box-header">
                  <h3 class="box-title">Cadastro de Locais de Visita</h3>
              </div>  
            <div class="box-body">
                <form action="../scripts/cadastra_local.php" method="POST">
                <div class="form-group">
                    <label class="control-label">Nome do Local</label>
                    <input type="text" name="local" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Respons&aacute;vel</label>
                    <input type="text" name="resp" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Local Pai</label>
                    <select name="idPai" class="form-control select2" >
                        <option value="0"></option>
                        <?php
                        $localObj = new local();
                        $l = $localObj->listaLocal();
                        for($i=0;$i<count($l);$i++){
                            
                            echo "<option value='".$l[$i][id]."'>".$l[$i][local]."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">Cadastrar</button>
                </div>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (left) -->
        <div class="col-md-6"> 
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">&Aacute;rvore Hierarquica</h3>
            </div>
            <div class="box-body">
             <?php
             $lp1 = $localObj->listaLocalporPai(NULL); //lista as categorias primarias
             
             for($i=0;$i<count($lp1);$i++){
                 echo $lp1[$i]['local']."<br>";
                 
                 $lp2 = $localObj->listaLocalporPai($lp1[$i]['id']); //lista novel 2
                 
                 for($j=0;$j<count($lp2);$j++){
                     
                     echo "&nbsp;  <i class='fa fa-angle-right'></i> ".$lp2[$j]['local']."<br>";
                     
                     $lp3 = $localObj->listaLocalporPai($lp2[$j]['id']); //lista novel 3
                     
                     for($k=0;$k<count($lp3);$k++){
                         
                         echo "&nbsp;&nbsp;  <i class='fa fa-angle-double-right'></i> ".$lp3[$k]['local']."<br>";
                     }
                 }
                 
             }
             ?>
            </div>
            <!-- /.box-body -->
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

</body>
</html>
