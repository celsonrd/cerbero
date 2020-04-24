<?php
session_start();
?>
<div class="modal-dialog">
    <div class="modal-content">
        <form method="POST" action="../scripts/dbAlteraSenha.php">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Alterar Senha</h4>
            <h6>A nova senha deve conter pelo menos 6 d&iacute;gitos</h6>
        </div>
        <div class="modal-body">
            
            <div class="form-group">
                <input type="password" placeholder="Senha Atual" name="senhaatual" class="form-control"><br>
                <input type="password" placeholder="Nova Senha" name="senhanew" class="form-control"><br>
                <input type="password" placeholder="Confirme a Senha" name="senhanew2" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary pull-right">Alterar</button>  
        </div>
        </form>
    </div>
</div>
