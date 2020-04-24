<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title></title>
    </head>
    <body>
        <?php
            include 'includes/conexao.php';

            $pdo = conectar();
            $nome = "jadsondias";
            $id = 3;
            /*    
            $inseri = $pdo->prepare("INSERT INTO usuario (nome)VALUES(:nome)");
            $inseri->bindValue(":nome",$nome);
            $inseri->execute();
            echo $inseri->rowCount();
            */
            /*
            $update = $pdo->prepare("UPDATE usuario SET nome=:nome WHERE id=:id");
            $update->bindValue(":nome", $nome);
            $update->bindValue(":id", $id);
            $update->execute();
            */
            /*
            $delete = $pdo->prepare("DELETE FROM usuario WHERE id=:id");
            $delete->bindValue(":id", $id);
            $delete->execute();
            */
            
            $select = $pdo->prepare("SELECT * FROM usuario WHERE id=:id");
            $select->bindValue(":id", $id);
            $select->execute();
            
            while ($row = $select->fetch(PDO::FETCH_ASSOC)){
                
                echo $row[nome] . "<br>";
                
            }
            
        ?>
    </body>
</html>
