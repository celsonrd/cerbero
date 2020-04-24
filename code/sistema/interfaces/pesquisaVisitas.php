<?php
session_start();
date_default_timezone_set("America/Sao_Paulo"); //configura horario para o timestamp
require_once '../includes/verifica3.php';
require_once '../classes/visitante.php';

$inicio = addslashes($_POST['inicio']);
$termino = addslashes($_POST['termino']);
$local = addslashes($_POST['idLocal']);
$cor = addslashes($_POST['cor']);
$placa = addslashes($_POST['placa']);
$modelo = addslashes($_POST['modelo']);

$visitante = new visitante();

$l = $visitante->relatorioVisitas($inicio, $termino, $local, $modelo, $cor, $placa);

if($l){
    
    //grava variavel de sessão para se for o caso imprimir o relatorio
    $_SESSION['array_relatorio_visitas'] = $l;
    
?>
<div class="table-responsive">
    <table class="table table-hover">
        <tr class="text-info">
            <td></td>
            <td>NOME</td>
            <td>LOCAL</td>
            <td>MODELO</td>
            <td>COR</td>
            <td>PLACA</td>
            <td>ENTRADA</td>
            <td>SA&Iacute;DA</td>
        </tr>
        <tr class="text-orange">
            <td colspan="8" class="text-center"> <a href="../PDF/relatorioVisita.php?tipo=2" target="_blank"><i class="fa fa-print fa-2x text-orange" title="Impimir Relat&oacute;rio"></i></a> &nbsp;&nbsp;&nbsp; <?php echo count($l); ?> resultados econtrados. </td>
        </tr>
    <?php
    for($i=0;$i<count($l);$i++){
    ?>    
        <tr style="vertical-align: center;">
            <td>
                <a href="#" class="text-success" title="Cadastro do Visitante" data-toggle="modal" data-target="#modal-form-visitante" onclick="formVisitante(<?php echo $l[$i]['id_visitante']; ?>)" ><i class="fa fa-id-card fa-3x"></i></a>&nbsp;
            </td>
            <td><?php echo $l[$i]['nome']; ?></td>
            <td><?php echo $l[$i]['local']; ?></td>
            <td><?php echo $l[$i]['modelo']; ?></td>
            <td><?php echo $l[$i]['cor']; ?></td>
            <td><?php echo $l[$i]['placa']; ?></td>
            <td><?php echo date('d/m/Y H:i:s', $l[$i]['stamp_entrada']); ?></td>
            <td><?php echo date('d/m/Y H:i:s', $l[$i]['stamp_saida']); ?></td>
        </tr>
    <?php    
    }
    ?>
    </table>
</div>
<!-- modal de formulario de visitantes -->
<div class="modal fade" id="modal-form-visitante" tabindex="-1" role="dialog" aria-hidden="true"></div>

<?php    
}else{
 
    echo "<br><br><br><br><div class='col-md-12'><div class='alert alert-warning'>Registro n&atilde;o encontrado</div></div>";

}

