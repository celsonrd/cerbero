<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';
require_once '../classes/local.php';

$visitante = new visitante();

$cbarras = addslashes($_POST['cBarras']);

$t = $visitante->pesquisaVisitanteCheckin(NULL, $cbarras);

if(($t) and count($t)==1){

$visitante->setAtributos($t[0]['id']);

?>
<div class="row text-center">
    <div class="col-md-6 text-left">
        <b>Nome:</b><br>
        <?php echo $visitante->getNome(); ?><br><br>
        
        <b>Identidade:</b><br>
        <?php echo $visitante->getRg(); ?><br><br>
        
        <b>Local:</b><br>
        <?php echo $visitante->getTipoAcesso(); ?><br><br>
        
        <?php
        //se possuir militar responsavel exibe
        if($visitante->getNomeMilRespRes()){
           
            echo "<b>Nome do Mil Respons&aacute;vel:</b> <br>";
            echo $visitante->getNomeMilRespRes() . "<br><br>";
            
        }
        ?>
        
        
    </div>
    <div class="col-md-4">
        <img class="image img-thumbnail" style="width: 250px; height: 180px;" src="<?php echo $visitante->getFoto(); ?>">
    </div>
    <!-- mostra se o acesso é liberado ou bloqueado -->
    <div class="col-md-10">
        <?php
        //converte a validade para stamp
        $dateTime = DateTime::createFromFormat('d/m/Y', $visitante->getValidade(), new DateTimeZone('America/Sao_Paulo'));
        $timestamp = $dateTime->getTimestamp();
        
        $now = time();
        
        if($now < $timestamp){
        ?>
        <div class="alert alert-success text-center">
            ACESSO LIBERADO
        </div>
        <div class="row">
            <form method="POST" action="../scripts/checkin.php">
                <input type="hidden" value="<?php echo $visitante->getId(); ?>" name="idVisitante">
                <div class="col-md-3">
                    <select class="form-control" name="idLocal">
                        <option value="">Selecione o Local</option>
                        <?php
                        $localObj = new local();

                        $l = $localObj->listaLocal();

                        for($i=0;$i<count($l);$i++){

                            if($l[$i]['local'] == $visitante->getTipoAcesso()){

                                $check = "selected";
                            }

                            echo "<option $check value='".$l[$i]['id']."'>".$l[$i]['local']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="modelo" placeholder="MODELO" class="form-control" value="<?php echo $visitante->getVeiculos()['modelo']; ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" name="cor" placeholder="COR" class="form-control" value="<?php echo $visitante->getVeiculos()['cor']; ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" name="placa" placeholder="PLACA" class="form-control" value="<?php echo $visitante->getVeiculos()['placa']; ?>">
                </div><br><br>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary form-control"><i class="fa fa-arrow-circle-o-left"></i> Check - In</button>
                </div>
                    
            </form>    
        </div>
        <?php
        }else{
        ?>    
        <div class="alert alert-danger text-center">
            ACESSO NEGADO
            <p style="font-size: 12px;">Cart&atilde;o com validade vencida - Recolha imediatamente</p>
        </div>
        <?php 
        }
        
        ?>
    </div>
</div>
<?php
}else{
?>
<div class="row">
    <div class="alert alert-danger text-center">
        CART&Atilde;O N&Atilde;O ENCONTRADO
    </div>
</div>

<?php    
}


