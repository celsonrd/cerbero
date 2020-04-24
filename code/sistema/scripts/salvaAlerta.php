<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';

$idVisitante = (int)$_POST['idVisitante'];
$motivo = addslashes($_POST['motivo']);


$visitante = new visitante();

if($visitante->salvaAlerta($idVisitante, $motivo)){
?>
<div id="retAlerta">
    <div class="col-md-4">
        <button class="btn btn-warning form-control" onclick="encerraAlerta('<?php echo $_POST['idvs']; ?>')">><i class="fa fa-close"></i> Encerrar</button>
    </div>
</div>
<?php
}else{
?>
<div id="retAlerta">
    <div class="col-md-4">
        <button class="btn btn-warning form-control" onclick="salvaAlerta('<?php echo $_POST['idvs']; ?>')"><i class="fa fa-save"></i> Salvar</button>
    </div>
</div>

<?php
}


