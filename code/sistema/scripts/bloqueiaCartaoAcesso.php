<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';

$idVisitante = (int)$_POST['idVisitante'];


$visitante = new visitante();

if($visitante->salvaCartaoAcesso($idVisitante, NULL, NULL, NULL)){
?>
<div id="retCartao">
    <div class="col-md-4 form-group">
       <button type="button" class="btn btn-danger form-control" onclick="salcaCartaoAcesso('<?php echo $idVisitante; ?>')" ><i class="fa fa-save"></i> Salvar</button>
    </div>
</div> 
<?php
}


