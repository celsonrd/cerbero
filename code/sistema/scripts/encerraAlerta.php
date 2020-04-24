<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';

$idVisitante = (int)$_POST['idVisitante'];


$visitante = new visitante();

if($visitante->encerraAlerta($idVisitante)){
?>
<div id="retAlerta">
    <div class="col-md-4">
        <button class="btn btn-warning form-control" onclick="salvaAlerta('<?php echo $_POST['idvs']; ?>')"><i class="fa fa-save"></i> Salvar</button>
    </div>
</div>
<?php
}


