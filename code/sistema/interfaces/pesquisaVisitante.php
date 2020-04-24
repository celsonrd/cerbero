<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';

$nome = addslashes($_POST['nome']);
$cpf = addslashes($_POST['cpf']);
$rg = addslashes($_POST['rg']);
$dn = addslashes($_POST['dn']);
$fone = addslashes($_POST['fone']);
$omOrigem = addslashes($_POST['omOrigem']);
$idMil = addslashes($_POST['idMil']);
$idLocal = addslashes($_POST['idLocal']);

if($_POST['sexo']){
   $sexo = addslashes($_POST['sexo']); 
}else{
    $sexo = NULL;
}

if($_POST['acessoLivre']){
   $acessoLivre = addslashes($_POST['acessoLivre']); 
}else{
    $acessoLivre = NULL;
}

if($_POST['alerta']){
    $alerta = addslashes($_POST['alerta']);
}else{
    $alerta = NULL;
}



$visitante = new visitante();

$l = $visitante->pesquisaVisitante($nome, $cpf, $rg, $dn, $fone, $omOrigem, $idMil, $sexo, $idLocal, $acessoLivre, $alerta);

if($l){
?>
<div class="table-responsive">
    <form action="../PDF/cartaoMultiplo.php" method="POST" target="_blank">
    <table class="table table-hover">
        <tr class="text-center">
            <td colspan="4"><button type="submit" class="btn btn-warning"><i class="fa fa-id-badge fa-2x"></i> Imprimir Cart&otilde;es Selecionados</button></td>
        </tr>
        <tr class="text-info">
            <td></td>
            <td>NOME</td>
            <td>CPF</td>
            <td>FOTO</td>
        </tr>
        
    <?php
    for($i=0;$i<count($l);$i++){
    ?>    
        <tr style="vertical-align: center;">
            <td>
                <input type="checkbox" name="idCartao[]" id="idCartao" value="<?php echo $l[$i]['id']; ?>">
                <a href="#" class="text-success" title="Cadastro do Visitante" data-toggle="modal" data-target="#modal-form-visitante" onclick="formVisitante(<?php echo $l[$i]['id']; ?>)" ><i class="fa fa-id-card fa-3x"></i></a>&nbsp;
            </td>
            <td style="vertical-align: center;"><?php echo $l[$i]['nome']; ?></td>
            <td style="vertical-align: center;"><?php echo $l[$i]['cpf']; ?></td>
            <td style="vertical-align: center;"><img src="<?php echo $l[$i]['foto']; ?>" class="img-reponsive img-thumbnail img-lg"></td>
        </tr>
    <?php    
    }
    ?>
    <tr class="text-center">
        <td colspan="4"><button type="submit" class="btn btn-warning"><i class="fa fa-id-badge fa-2x"></i> Imprimir Cart&otilde;es Selecionados</button></td>
    </tr>   
    </table>
    </form>    
</div>


<?php    
}else{
 
    echo "<div class='alert alert-warning'>Registro n&atilde;o encontrado</div>";

}

