<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';

$idVisitante = (int)$_POST['idVisitante'];
$tipo = (int)$_POST['tipo'];
$marca = addslashes($_POST['marca']);
$modelo = addslashes($_POST['modelo']);
$cor = addslashes($_POST['cor']);
$placa = addslashes($_POST['placa']);


$visitante = new visitante();

if($visitante->salvaVeiculo($idVisitante, $tipo, $marca, $modelo, $cor, $placa)){
?>
<div id="retVeiculo">
    <div class="col-md-2 form-group">
        <button type="button" class="btn btn-success form-control" title="Excluir" onclick="bloqueiaVeiculoVisitante('<?php echo $idVisitante; ?>')"><i class="fa fa-close"></i></button>
    </div>    
</div>
<?php
}else{
?>    
    <div id="retVeiculo">
        <div class="col-md-2 form-group">
            <button type="button" class="btn btn-success form-control" title="Salvar" onclick="salvaVeiculoVisitante('<?php echo $idVisitante; ?>')"><i class="fa fa-save"></i></button>
            <p class="text-danger" style="font-size: 10px;">Preencha todos os campos <br> Ou Verifique se a placa j&aacute; est&aacute; cadastrada</p>
        </div>    
    </div>
<?php
}


