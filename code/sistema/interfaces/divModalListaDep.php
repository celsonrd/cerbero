<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/militar.php';

$idMil = $_POST['idMil'];

$militar = new militar();

$l = $militar->listaDependente($idMil);

?>
<div class="modal-dialog" role="document" style="width: 50%;">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Lista de Dependentes por Militar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                  <div class="table-responsive">
                      <table class="table table-striped">
                          <tr class="text-info">
                              <td>NOME</td>
                              <td>DATA DE NASCIMENTO</td>
                              <td></td>
                          </tr>
                          <?php
                          for($i=0;$i<count($l);$i++){
                          ?>
                          <tr>
                              <td><?php echo $l[$i]['nome']; ?></td>
                              <td><?php echo $l[$i]['dn']; ?></td>
                              <td><img src="<?php echo $l[$i]['foto']; ?>" class="img img-thumbnail" style="width: 75px; height: 75px;"></td>
                          </tr>
                          <?php    
                          }
                          ?>
                          
                      </table>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>

