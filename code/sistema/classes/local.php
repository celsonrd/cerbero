<?php

require_once '../includes/conexao.php';

class local {
    private $id;
    private $local;
    private $responsavel;
    private $idPai;
    private $nomePai;
    private $filhas;
    
    function listaLocal(){
       $pdo = conectar();
       
       $select = $pdo->prepare("SELECT * FROM local ORDER BY local ASC");
       $select->execute();
       $row = $select->fetchAll(PDO::FETCH_ASSOC);
       
       return $row;
    }
    
    function listaLocalporPai($pai){
        $pdo = conectar();
        
        if($pai){
            $pai = $pai;
            
            $select = $pdo->prepare("SELECT * FROM local WHERE id_pai=:pai");
            $select->bindValue(":pai", $pai);
            $select->execute();
            $row = $select->fetchAll(PDO::FETCH_ASSOC);
            
            
        }else{
            
            $select = $pdo->prepare("SELECT * FROM local WHERE id_pai is NULL");
            $select->execute();
            $row = $select->fetchAll(PDO::FETCH_ASSOC);
            
        }
       
        
       
        return $row;
    }
            
    function novoLocal($local,$responsavel,$idPai){
        $pdo = conectar();
        
        $local = strtoupper(addslashes($local));
        $responsavel = strtoupper(addslashes($responsavel));
        
        if($idPai){
            $idPai = (int)$idPai;
        }else{
            $idPai = NULL;
        }
        
        
        if(strlen($local) > 3 and strlen($responsavel)>5){
            
            $inseri = $pdo->prepare("INSERT INTO local (local,responsavel,id_pai)VALUES(:nome,:resp,:idPai)");
            $inseri->bindValue(":nome",$local);
            $inseri->bindValue(":resp",$responsavel);
            $inseri->bindValue(":idPai",$idPai);
            $inseri->execute();
            
            return TRUE;
        }else{
            return FALSE;
        }
    }


    //metodos especiais
    function getId() {
        return $this->id;
    }

    function getLocal() {
        return $this->local;
    }

    function getResponsavel() {
        return $this->responsavel;
    }

    function getIdPai() {
        return $this->idPai;
    }

    function getNomePai() {
        return $this->nomePai;
    }

    function getFilhas() {
        return $this->filhas;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLocal($local) {
        $this->local = $local;
    }

    function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }

    function setIdPai($idPai) {
        $this->idPai = $idPai;
    }

    function setNomePai($nomePai) {
        $this->nomePai = $nomePai;
    }

    function setFilhas($filhas) {
        $this->filhas = $filhas;
    }


}
