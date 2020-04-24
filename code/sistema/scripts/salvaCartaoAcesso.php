<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';

$idVisitante = (int)$_POST['idVisitante'];
$idLocal = (int)$_POST['idLocal'];
$validade = addslashes($_POST['validade']);


$visitante = new visitante();

if($visitante->salvaCartaoAcesso($idVisitante, 1, $idLocal, $validade)){
?>
<div id="retCartao">
    <div class="col-md-1">
        <button type="button" class="btn btn-danger form-control" onclick="salcaCartaoAcesso('<?php echo $idVisitante; ?>')"><i class="fa fa-pencil"></i></button>
    </div>
    <div class="col-md-1">
        <button type="button" class="btn btn-danger form-control" onclick="bloqueiaCartaoAcesso('<?php echo $idVisitante; ?>')"><i class="fa fa-close"></i></button>
    </div>
    <div class="col-md-1">
        <a href="../PDF/cartaoUnico.php?id=<?php echo $idVisitante; ?>" target="_blank" title="Imprimir Cart&atilde;o de Acesso" class="btn btn-danger form-control"><i class="fa fa-id-badge"></i></a>
    </div>  
</div> 
<?php
}


