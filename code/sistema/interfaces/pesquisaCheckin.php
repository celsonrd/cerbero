<?php
session_start();
require_once '../includes/verifica3.php';
require_once '../classes/visitante.php';

if(isset($_POST['nome'])){
   $nome = addslashes($_POST['nome']); 
}else{
    $nome = NULL;
}

$cpf = addslashes($_POST['cpf']);

$visitante = new visitante();

$l = $visitante->pesquisaVisitanteCheckin($nome, $cpf);

if($l){
?>
<div class="table-responsive">
    <table class="table table-hover">
        <tr>
            <td></td>
            <td>NOME</td>
            <td>CPF</td>
            <td>FOTO</td>
        </tr>
    <?php
    for($i=0;$i<count($l);$i++){
    ?>    
        <tr style="vertical-align: center;">
            <td><input type="radio" name="idVisitante" value="<?php echo $l[$i]['id']; ?>"></td>
            <td style="vertical-align: center;"><?php echo $l[$i]['nome']; ?></td>
            <td style="vertical-align: center;"><?php echo $l[$i]['cpf']; ?></td>
            <td style="vertical-align: center;"><img src="<?php echo $l[$i]['foto']; ?>" class="img-reponsive img-thumbnail img-lg"></td>
        </tr>
    <?php    
    }
    ?>
    </table>
</div>


<?php    
}else{
 
    echo "<div class='alert alert-warning'>Registro n&atilde;o encontrado <br> <a class='text-primary' href='operador.php'>Cadastrar?</a></div>";

}

