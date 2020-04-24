<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/militar.php';

$pesq = addslashes($_POST['nomeMil']);

$militar = new militar();

$l = $militar->pesquisaMilitar($pesq);
?>
<div class="table-responsive text-info">
    
    <table class="table table-striped">
        <?php
            for($i=0;$i<count($l);$i++){
        ?>
        <tr>
            <td><?php echo $l[$i]['grd']; ?></td>
            <td><?php echo $l[$i]['nome_mil']; ?></td>
            <td><a href="#" data-dismiss="modal" onclick="marcaMil('<?php echo $l[$i]['id_mil']; ?>','<?php echo $l[$i]['nome_mil']; ?>')"><i class="fa fa-arrow-circle-o-right"></i></a></td>
        </tr>
        <?php
            }
        ?>
    </table>
    
</div>


