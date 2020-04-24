<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/militar.php';

$idMil = $_POST['idMil'];


$militar = new militar();
$militar->setAtributos($idMil)
?>

<div class="modal-dialog" role="document" style="width: 50%;">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edi&ccedil;&atilde;o de Militar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                <form method="POST" action="../scripts/edita_militar.php">
                    <input type="hidden" name="idMil" value="<?php echo $idMil; ?>">
                        <div class="form-group">
                            <label class="control-label">PST/GRD</label>
                            <select name="grd" class="form-control">
                                <option <?php if($militar->getGrd() == "CEL"){ echo "selected"; } ?>>CEL</option>
                                <option <?php if($militar->getGrd() == "TEN CEL"){ echo "selected"; } ?>>TEN CEL</option>
                                <option <?php if($militar->getGrd() == "MAJ"){ echo "selected"; } ?>>MAJ</option>
                                <option <?php if($militar->getGrd() == "CAP"){ echo "selected"; } ?>>CAP</option>
                                <option <?php if($militar->getGrd() == "1 TEN"){ echo "selected"; } ?>>1 TEN</option>
                                <option <?php if($militar->getGrd() == "2 TEN"){ echo "selected"; } ?>>2 TEN</option>
                                <option <?php if($militar->getGrd() == "S TEN"){ echo "selected"; } ?>>S TEN</option>
                                <option <?php if($militar->getGrd() == "1 SGT"){ echo "selected"; } ?>>1 SGT</option>
                                <option <?php if($militar->getGrd() == "2 SGT"){ echo "selected"; } ?>>2 SGT</option>
                                <option <?php if($militar->getGrd() == "3 SGT"){ echo "selected"; } ?>>3 SGT</option>
                                <option <?php if($militar->getGrd() == "CB"){ echo "selected"; } ?>>CB</option>
                                <option <?php if($militar->getGrd() == "SD"){ echo "selected"; } ?>>SD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">CPF</label>
                            <input type="text" name="cpf" class="form-control" data-inputmask='"mask": "999.999.999-99"' data-mask value="<?php echo $militar->getCpf(); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nome Completo</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $militar->getNome(); ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control"><i class="fa fa-pencil"></i> Editar</button>
                        </div>     
                </form> 
              </div>
          </div>
      </div>
    </div>
  </div>

<?php
 require_once 'footerJs.php';