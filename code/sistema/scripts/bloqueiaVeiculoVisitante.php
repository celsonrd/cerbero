<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';

$idVeiculo = (int)$_POST['idVeiculo'];


$visitante = new visitante();

if($visitante->bloqueiaVeiculo($idVeiculo)){
?>
<div id="retVeiculo">
    <div class="col-md-2 form-group">
        <button type="button" class="btn btn-success form-control" title="Salvar" onclick="bloqueiaVeiculoVisitante()"><i class="fa fa-save"></i></button>
    </div>    
</div>
 
<?php
}


