<?php

require_once '../includes/conexao.php';

class militar {
    private $id;
    private $cpf;
    private $grd;
    private $nome;
    
    function setAtributos($idMil){
       $pdo= conectar();
       
       $idMil = (int)$idMil;
       
       $select = $pdo->prepare("SELECT * FROM militar WHERE id_mil=:idmil");
       $select->bindValue(":idmil",$idMil);
       $select->execute();
       $row = $select->fetch(PDO::FETCH_ASSOC);
       
       $this->setId($idMil);
       $this->setCpf($row['cpf']);
       $this->setGrd($row['grd']);
       $this->setNome($row['nome_mil']);
        
    }
            
    function inseriMilitar($grd,$cpf,$nome){
        $pdo= conectar();
        
        $nome = strtoupper(addslashes($nome));
        $grd = strtoupper(addslashes($grd));
        $cpf = addslashes($cpf);
        
        if(strlen($nome) > 5 and strlen($grd) > 1 and strlen($cpf)==14 ){
        
            $inseri = $pdo->prepare("INSERT INTO militar (cpf,grd,nome_mil)VALUES(:cpf,:grd,:nome)");
            $inseri->bindValue(":cpf",$cpf);
            $inseri->bindValue(":grd",$grd);
            $inseri->bindValue(":nome",$nome);
            $inseri->execute();
            
            return TRUE;
        }else{
            
            return FALSE;
        }    
    }
    
    function listarMilitar(){
        $pdo= conectar();
        
        
        $select = $pdo->prepare("SELECT * FROM militar");
        $select->execute();
        $row = $select->fetchAll(PDO::FETCH_ASSOC);
        
        return $row;
    }
    
    function pesquisaMilitar($nome){
        $pdo= conectar();
        
        $nome = addslashes($nome);
        
        $select = $pdo->prepare("SELECT * FROM militar WHERE nome_mil LIKE '%$nome%'");
        $select->execute();
        $row = $select->fetchAll(PDO::FETCH_ASSOC);
        
        return $row;
    }
    
    function listaDependente($idMil){
        $pdo= conectar();
        
        $idMil = (int)$idMil;
        
        $select = $pdo->prepare("SELECT * FROM visitantes WHERE idMilresp=:idmil");
        $select->bindValue(":idmil",$idMil);
        $select->execute();
        $row = $select->fetchAll(PDO::FETCH_ASSOC);
        
        return $row;
        
    }
    
    function editaMil($grd,$nome,$cpf,$idMil){
        $pdo= conectar();
        
        $id = (int)$idMil;
        $nome = strtoupper(addslashes($nome));
        $grd = strtoupper(addslashes($grd));
        $cpf = addslashes($cpf);
        
        if(strlen($nome) > 5 and strlen($grd) > 1 and strlen($cpf)==14 and $idMil>0 ){
            
            $update = $pdo->prepare("UPDATE militar SET cpf=:cpf, grd=:grd, nome_mil=:nome WHERE id_mil=:id");
            $update->bindValue(":cpf", $cpf);
            $update->bindValue(":grd", $grd);
            $update->bindValue(":nome", $nome);
            $update->bindValue(":id", $id);
            $update->execute();
            
            return TRUE;
            
        }else{
            
            return FALSE;
        }
    }
            
    
    
    
    function getId() {
        return $this->id;
    }

    function getGrd() {
        return $this->grd;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setGrd($grd) {
        $this->grd = $grd;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }


}
