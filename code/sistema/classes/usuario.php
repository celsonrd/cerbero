<?php
require_once '../includes/conexao.php';

class usuario {
    //atributos
    public $id;
    public $nome;
    public $cpf;
    public $login;
    public $senha;
    public $fone;
    public $funcao;
            
    
    function dadosUser($id) {
        
        $pdo= conectar();
        
        $i = addslashes($id);
        
        $select = $pdo->prepare("SELECT * FROM usuario WHERE id=:id");
        $select->bindValue(":id", $i);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);
        
        return $row;
        
    }
    
    function inseriUser($nome,$email,$funcao){
        $pdo= conectar();
        
        $nome = strtoupper(addslashes($nome));
        $funcao = (int)$funcao;
        $senha = md5($email);
        $email = addslashes($email);
        
        if(strlen($nome) > 5 and $funcao > 0 ){
        
            $inseri = $pdo->prepare("INSERT INTO usuario (nome,email,senha,funcao,status)VALUES(:nome,:email,:senha,:funcao,:status)");
            $inseri->bindValue(":nome",$nome);
            $inseri->bindValue(":email",$email);
            $inseri->bindValue(":senha",$senha);
            $inseri->bindValue(":funcao",$funcao);
            $inseri->bindValue(":status",1);
            $inseri->execute();
            
            return TRUE;
        }else{
            
            return FALSE;
        }    
    }
            
    function listarUser(){
        $pdo= conectar();
        
        
        $select = $pdo->prepare("SELECT * FROM usuario");
        $select->execute();
        $row = $select->fetchAll(PDO::FETCH_ASSOC);
        
        return $row;
    }
    
    function resetaSenha($id){
        
        $pdo= conectar();
        
        $id = addslashes($id);
        
        $select = $pdo->prepare("SELECT * FROM usuario WHERE id=:id");
        $select->bindValue(":id", $id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);
        
        $update = $pdo->prepare("UPDATE usuario SET senha=:senha WHERE id=:id");
        $update->bindValue(":senha", md5($row[email]));
        $update->bindValue(":id", $id);
        $update->execute();
        
    }
    
    
    function alteraSenha($id,$senhaant,$senhanew,$confSenha){
        $pdo= conectar();
        
        $id=(int)$id;
        $senhaant = addslashes($senhaant);
        $senhaant = md5($senhaant);
        $senhanew = addslashes($senhanew);
        $confSenha = addslashes($confSenha);
        
        //busca usuario para realizar teste de senha
        $select = $pdo->prepare("SELECT * FROM usuario WHERE id=:id");
        $select->bindValue(":id", $id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);
        
        if(($senhaant == $row[senha]) and ($senhanew == $confSenha) and (strlen($senhanew) > 5)){
            
            $update = $pdo->prepare("UPDATE usuario SET senha=:senha WHERE id=:id");
            $update->bindValue(":senha", md5($senhanew));
            $update->bindValue(":id", $id);
            $update->execute();
            
            return TRUE;
        }else{
            return FALSE;
        }
    }
                   
    function valida(){
        
        $pdo= conectar();
        
        
        $select = $pdo->prepare("SELECT * FROM usuario WHERE email=:login and senha=:senha");
        $select->bindValue(":login", $this->getLogin());
        $select->bindValue(":senha", $this->getSenha());
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);
        
        return $row;
        
               
    }
    function mudaStatus($idUser,$status){
        $pdo= conectar();
        
        $idUser = (int)$idUser;
        $status = (int)$status;
         
        $update = $pdo->prepare("UPDATE usuario SET status=:status WHERE id=:id");
        $update->bindValue(":status", $status);
        $update->bindValue(":id", $idUser);
        $update->execute();
        
    }
    

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getFone() {
        return $this->fone;
    }

    public function getFuncao() {
        return $this->funcao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setFone($fone) {
        $this->fone = $fone;
    }

    public function setFuncao($funcao) {
        $this->funcao = $funcao;
    }




        
    
    
}
