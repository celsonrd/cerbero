<?php
session_start();
require_once '../classes/usuario.php';
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
                  <h3 class="box-title">Cadastro de Usu&aacute;rios</h3>
              </div>  
            <div class="box-body">
                <form action="../scripts/cadastra_user.php" method="POST">
                <div class="form-group">
                    <label class="control-label">Nome Completo</label>
                    <input type="text" name="nome" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Login</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Fun&ccedil;&atilde;o</label>
                    <select name="funcao" class="form-control">
                        <option value="1">Administrador</option>
                        <option value="2">Gerente</option>
                        <option value="3">Operador</option>
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
              <h3 class="box-title">Usu&aacute;rios Cadastrados</h3>
            </div>
            <div class="box-body">
             <?php
                $user = new usuario();
                $l = $user->listarUser();
             ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr class="text-info">
                            <td>Nome</td>
                            <td>Login</td>
                            <td>Fun&ccedil;&atilde;o</td>
                        </tr>
                    <?php
                    
                    for($i=0;$i<count($l);$i++){
                        
                        switch ($l[$i]['funcao']) {
                            case 1:
                                $funcao = "Administrador";
                                break;
                            case 2:
                                $funcao = "Gerente";
                                break;
                            case 3:
                                $funcao = "Operador";
                                break;

                            default:
                                break;
                        }
                        
                        if($l[$i]['status']){
                        ?>
                        <tr>
                            <td><?php echo $l[$i]['nome'] ?></td>
                            <td><?php echo $l[$i]['email'] ?></td>
                            <td><?php echo $funcao ?></td>
                            <td>
                                <a href="../scripts/muda_status_user.php?id=<?php echo $l[$i]['id'] ?>&status=0" title="Desabilitar" class="text-danger"><i class="fa fa-close fa-2x"></i></a>
                                <a href="../scripts/reseta_senha.php?id=<?php echo $l[$i]['id'] ?>" title="Resetar Senha" class="text-warning" ><i class="fa fa-unlock-alt fa-2x"></i></a>
                            </td>
                        </tr>
                        <?php
                        }
                    }
                    
                    ?>
                        
                    </table>
                </div>
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
