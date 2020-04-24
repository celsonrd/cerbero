<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/militar.php';

$pesq = addslashes($_POST['nomeMil']);

$militar = new militar();

$l = $militar->pesquisaMilitar($pesq);
?>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">

            <table class="table table-hover">
                <tr class="text-info">
                    <td></td>
                    <td>PST/GRD</td>
                    <td>NOME COMPLETO</td>
                </tr>
                <?php
                    for($i=0;$i<count($l);$i++){
                ?>
                <tr>
                    <td>
                        <a href="#" class="text-info" title="Editar Militar" data-toggle="modal" data-target="#modal-edita-mil" onclick="editaMil('<?php echo $l[$i]['id_mil']; ?>')"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;&nbsp;
                        <a href="#" class="text-orange" title="Lista de Dependentes" data-toggle="modal" data-target="#modal-lista-visitantes" onclick="listaDep('<?php echo $l[$i]['id_mil']; ?>')"><i class="fa fa-search-plus"></i></a>
                    </td>
                    <td><?php echo $l[$i]['grd']; ?></td>
                    <td><?php echo $l[$i]['nome_mil']; ?></td>
                </tr>
                <?php
                    }
                ?>
            </table>

        </div>        
    </div>
</div>
<!-- modal de edição de mil -->
<div class="modal fade" id="modal-edita-mil" tabindex="-1" role="dialog" aria-hidden="true"></div>

<!-- modal de lista de visitantes do mil selecionado -->
<div class="modal fade" id="modal-lista-visitantes" tabindex="-1" role="dialog" aria-hidden="true"></div>



