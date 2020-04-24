<?php

require_once '../includes/conexao.php';

class visitante {
    private $id;
    private $nome;
    private $cpf;
    private $idMil;
    private $rg;
    private $dn;
    private $fone;
    private $omOrigem;
    private $idMilResp;
    private $nomeMilRespRes;
    private $acessoLivre;
    private $tipoAcesso; //nome do local de acesso livre
    private $alerta;
    private $motivoAlerta;
    private $foto;
    private $veiculos;
    private $validade;
    private $sexo;
            
    function setAtributos($id){
        $pdo = conectar();
        
        $id = (int)$id;
        
        if($id > 0){
            
            $select = $pdo->prepare("SELECT v.nome,v.cpf,v.sexo,v.idMil,v.rg,v.dn,v.fone,v.foto,v.omOrigem,v.idMilResp,v.acessoLivre,v.id_local_acesso,v.fim_acesso_livre,v.alerta,v.motivoAlerta,l.local FROM visitantes as v LEFT JOIN local as l ON v.id_local_acesso=l.id WHERE v.id=:id");
            $select->bindValue(":id", $id);
            $select->execute();
            $row = $select->fetch(PDO::FETCH_ASSOC);
            
            //busca veiculos cadastrados no nome do visitante
            $select2 = $pdo->prepare("SELECT * FROM veiculos WHERE id_visitante=:id and status=:status");
            $select2->bindValue(":id", $id);
            $select2->bindValue(":status", 1);
            $select2->execute();
            $row2 = $select2->fetch(PDO::FETCH_ASSOC);
            
            $this->setId($id);
            $this->setNome($row['nome']);
            $this->setCpf($row['cpf']);
            $this->setFoto($row['foto']);
            $this->setRg($row['rg']);
            $this->setDn($row['dn']);
            $this->setFone($row['fone']);
            $this->setAcessoLivre($row['acessoLivre']);
            $this->setAlerta($row['alerta']);
            $this->setMotivoAlerta($row['motivoAlerta']);
            $this->setVeiculos($row2);
            $this->setValidade($row['fim_acesso_livre']);
            $this->setTipoAcesso($row['local']);
            $this->setSexo($row['sexo']);
            $this->setIdMil($row['idMil']);
            
            //verifica se é dependente de militar e colhe os dados dele no sisbol
            if($row['idMilResp']){
                
                $select3 = $pdo->prepare("SELECT * FROM militar WHERE id_mil=:id");
                $select3->bindValue(":id", $row['idMilResp']);
                $select3->execute();
                $row3 = $select3->fetch(PDO::FETCH_ASSOC);
                
                
                
                $this->setNomeMilRespRes($row3['nome_mil']);
            }
        
        }
        
    }
    function salvaVeiculo($idVisitante,$tipo,$marca,$modelo,$cor,$placa){
        $pdo = conectar();
        
        $idVisitante = (int)$idVisitante;
        $tipo = (int)$tipo;
        $marca = strtoupper(addslashes($marca));
        $modelo = strtoupper(addslashes($modelo));
        $cor = strtoupper(addslashes($cor));
        $placa = str_replace("-", "", $placa);
        $placa = str_replace("/", "", $placa);
        $placa = str_replace(" ", "", $placa);
        $placa = strtoupper(addslashes($placa));
        
        if($idVisitante > 0 and $tipo > 0 and strlen($marca) > 2 and strlen($modelo) > 2 and strlen($cor)>2 and strlen($placa) == 7){
            
            //verifica se placa não está cadastrada
            $select3 = $pdo->prepare("SELECT * FROM veiculos WHERE placa=:placa");
            $select3->bindValue(":placa", $placa);
            $select3->execute();
            $row3 = $select3->fetch(PDO::FETCH_ASSOC);
            
            if(!$row3){
                
                $inseri = $pdo->prepare("INSERT INTO veiculos (tipo,id_visitante,marca,modelo,cor,placa,status)VALUES(:tipo,:id,:marca,:modelo,:cor,:placa,:status)");
                $inseri->bindValue(":tipo",$tipo);
                $inseri->bindValue(":id",$idVisitante);
                $inseri->bindValue(":marca",$marca);
                $inseri->bindValue(":modelo",$modelo);
                $inseri->bindValue(":cor",$cor);
                $inseri->bindValue(":placa",$placa);
                $inseri->bindValue(":status",1);
                $inseri->execute();

                return TRUE;    
                
            }else{
                
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    
    function bloqueiaVeiculo($idVeiculo){
        $pdo = conectar();
        
        $idVeiculo = (int)$idVeiculo;
        
        if($idVeiculo > 0){
            
            $update = $pdo->prepare("UPDATE veiculos SET status=0 WHERE id_veiculo=:id");
            $update->bindValue(":id", $idVeiculo);
            $update->execute();
            
            return TRUE;
        }
        
    }
    
    function salvaAlerta($idVisitante,$motivo){
        $pdo = conectar();
        
        $idVisitante = (int)$idVisitante;
        $motivo = strtoupper(addslashes($motivo));
        
        if($idVisitante >0 and strlen($motivo)> 5){
            
            $update = $pdo->prepare("UPDATE visitantes SET alerta=:alerta, motivoAlerta=:motivo WHERE id=:id");
            $update->bindValue(":alerta", 1);
            $update->bindValue(":motivo", $motivo);
            $update->bindValue(":id", $idVisitante);
            $update->execute();
            
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    function encerraAlerta($idVisitante){
        $pdo = conectar();
        
        $idVisitante = (int)$idVisitante;
        
        if($idVisitante >0){
            
            $update = $pdo->prepare("UPDATE visitantes SET alerta=:alerta, motivoAlerta=:motivo WHERE id=:id");
            $update->bindValue(":alerta", 0);
            $update->bindValue(":motivo", NULL);
            $update->bindValue(":id", $idVisitante);
            $update->execute();
            
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
            
    function salvaCartaoAcesso($idVisitante,$ac,$idLocal,$validade){
        $pdo = conectar();
        
        $id = (int)$idVisitante;
        
        if($ac){
            $ac = (int)$ac;
        }
        if($idLocal){
            $idLocal = (int)$idLocal;
        }
        if($validade){
            $validade = addslashes($validade);
        }
        
        if($id>0){
            
            $update = $pdo->prepare("UPDATE visitantes SET acessoLivre=:ac,fim_acesso_livre=:validade,id_local_acesso=:local WHERE id=:id");
            $update->bindValue(":ac", $ac);
            $update->bindValue(":validade", $validade);
            $update->bindValue(":local", $idLocal);
            $update->bindValue(":id", $id);
            $update->execute();
            
            return TRUE;
        }
        
    }
            
    function novoVisitante($nome,$cpf,$sexo,$idMil,$rg,$dn,$fone,$img,$omOrigem,$idMilResp,$nomeMilRespRes){
        
        $pdo = conectar();
        
        //tratamento de variaveis
        $nome = addslashes($nome);
        $cpf = addslashes($cpf);
        $sexo = addslashes($sexo);
        
        if($dn){
            $dn = addslashes($dn);
        }
        if($fone){
           $fone = addslashes($fone); 
        }
        if($rg){
            $rg = addslashes($rg);
        }
        if($idMil){
            $idMil = addslashes($idMil);
        }
        if($omOrigem){
            $omOrigem = addslashes($omOrigem);
        }
        if($nomeMilRespRes){
            $nomeMilRespRes = addslashes($nomeMilRespRes);
        }
        if($idMilResp){
            $idMilResp = addslashes($idMilResp);
        }
        if($img){
            $img = str_replace ( 'data:image/jpeg;base64,','',$img); 
            $img = str_replace (' ','+',$img ); 
            $data = base64_decode ($img); 
            $file = '../fotos/'.uniqid().'.jpeg' ; 
            $success = file_put_contents($file , $data);
        }    
        
        if(filter_var($nome, FILTER_SANITIZE_STRING) and filter_var($cpf, FILTER_SANITIZE_STRING) and strlen($fone)>13 and strlen($sexo)==1 ){
            
            //testa se cpf ja está cadastrado
            $select = $pdo->prepare("SELECT v.id FROM visitantes as v WHERE cpf=:cpf");
            $select->bindValue(":cpf", $cpf);
            $select->execute();
            $row = $select->fetch(PDO::FETCH_ASSOC);
            
            if(!$row){
            
                $inseri = $pdo->prepare("INSERT INTO visitantes (nome,cpf,sexo,idMil,rg,dn,fone,foto,omOrigem,idMilResp,nomeMilRespRes)VALUES(:nome,:cpf,:sexo,:idMil,:rg,:dn,:fone,:foto,:omOrigem,:idMilResp,:nomeMilRespRes)");
                $inseri->bindValue(":nome",$nome);
                $inseri->bindValue(":cpf",$cpf);
                $inseri->bindValue(":sexo",$sexo);
                $inseri->bindValue(":idMil",$idMil);
                $inseri->bindValue(":rg",$rg);
                $inseri->bindValue(":dn",$dn);
                $inseri->bindValue(":fone",$fone);
                $inseri->bindValue(":foto",$file);
                $inseri->bindValue(":omOrigem",$omOrigem);
                $inseri->bindValue(":idMilResp",$idMilResp);
                $inseri->bindValue(":nomeMilRespRes",$nomeMilRespRes);
                $inseri->execute();
                
                return TRUE;
            }else{
                return FALSE;
            }    
            
        }else{
            
            return FALSE;
        }     
    }
    
    function pesquisaVisitante($nome,$cpf,$rg,$dn,$fone,$omOrigem,$idMil,$sexo,$idLocal,$acessoLivre,$alerta){
        $pdo = conectar();
        
        $nome = addslashes($nome);
        $cpf = addslashes($cpf);
        $rg = addslashes($rg);
        $dn = addslashes($dn);
        $fone = addslashes($fone);
        $omOrigem = addslashes($omOrigem);
        $idMil = addslashes($idMil);
        $sexo = addslashes($sexo);
        $idLocal = (int)$idLocal;
        $acessoLivre = (int)$acessoLivre;
        $alerta = (int)$alerta;
        
        $select = $pdo->prepare("SELECT * FROM visitantes WHERE nome LIKE '%$nome%' AND cpf LIKE '%$cpf%' AND sexo LIKE '%$sexo%' AND idMil LIKE '%$idMil%' AND rg LIKE '%$rg%' AND dn LIKE '%$dn%' AND fone LIKE '%$fone%' AND omOrigem LIKE '%$omOrigem%'");
        $select->execute();
        $row = $select->fetchAll(PDO::FETCH_ASSOC);
        
        return $row;
        
    }
            
    function pesquisaVisitanteCheckin($nome,$cpf){
        $pdo = conectar();
        
        $nome = addslashes($nome);
        $cpf = addslashes($cpf);
        
        if(strlen($nome) > 1 OR strlen($cpf)> 3){
        
        $select = $pdo->prepare("SELECT * FROM visitantes WHERE nome LIKE '%$nome%' AND cpf LIKE '%$cpf%'");
        $select->execute();
        $row = $select->fetchAll(PDO::FETCH_ASSOC);
        
        return $row;
        }
        
        
    }
    
    function visitasAbertas(){
       $pdo = conectar(); 
       
       $select = $pdo->prepare("SELECT v.id_visita,vt.nome,vt.cpf,l.local,v.stamp_entrada,v.placa FROM visitas as v LEFT JOIN visitantes as vt ON v.id_visitante=vt.id LEFT JOIN local as l ON v.id_local=l.id  WHERE v.stamp_saida is NULL");
       $select->execute();
       $row = $select->fetchAll(PDO::FETCH_ASSOC);
       
       return $row;
    }
    
    function checkin($idVisitante,$idLocal,$modelo,$cor,$placa){
        $pdo = conectar();
        
        $idVisitante = (int)$idVisitante;
        $idLocal = (int)$idLocal;
        $modelo = strtoupper(addslashes($modelo));
        $cor = strtoupper(addslashes($cor));
        
        if($placa){
            
            $placa = str_replace("-", "", $placa);
            $placa = str_replace("/", "", $placa);
            $placa = str_replace(" ", "", $placa);
            $placa = strtoupper($placa);
        }    
        
        
        if($idLocal >0 and $idVisitante > 0){
         
            $inseri = $pdo->prepare("INSERT INTO visitas (id_visitante,stamp_entrada,id_local,modelo,cor,placa)VALUES(:idVisitante,:entrada,:idLocal,:modelo,:cor,:placa)");
            $inseri->bindValue(":idVisitante",$idVisitante);
            $inseri->bindValue(":entrada",time());
            $inseri->bindValue(":idLocal",$idLocal);
            $inseri->bindValue(":cor",$cor);
            $inseri->bindValue(":modelo",$modelo);
            $inseri->bindValue(":placa",$placa);
            $inseri->execute();
            
            return TRUE;
            
        }else{
            return FALSE;
        }
        
    }        
    function checkout($idVisita){
        $pdo = conectar();
        
        $idVisita = (int)$idVisita;
        
        if($idVisita>0){
            
            $update = $pdo->prepare("UPDATE visitas SET stamp_saida=:stamp WHERE id_visita=:id");
            $update->bindValue(":stamp", time());
            $update->bindValue(":id", $idVisita);
            $update->execute();
        }
        
    }
    
    function historicoVisitante($id){
        $pdo = conectar();
        
        $idVisitante = (int)$id;
        
        $select = $pdo->prepare("SELECT vi.nome,v.stamp_entrada,v.stamp_saida,l.local,v.modelo,v.cor,v.placa FROM visitas as v LEFT JOIN visitantes as vi ON v.id_visitante=vi.id LEFT JOIN local as l ON v.id_local=l.id WHERE v.id_visitante=:id");
        $select->bindValue(":id", $idVisitante);
        $select->execute();
        $row = $select->fetchAll(PDO::FETCH_ASSOC);
        
        return $row;
    }
    
    function relatorioVisitas($inicio, $termino, $local, $modelo, $cor, $placa){
        $pdo = conectar();
        
        $in = explode("-", $inicio);
        $timeIn = $in[2]."-".$in[1]."-".$in[0];
        $inicio = (int)strtotime($timeIn);
        
        $ter = explode("-", $termino);
        $timeTer = $ter[2]."-".$ter[1]."-".$ter[0];
        $termino = (int)strtotime($timeTer);
        $termino = $termino + 86400; //soma o equivaente a 1 dia para pegar o stamp do fim do dia e não do inicio
        
        $local = (int)$local;
        $modelo = addslashes($modelo);
        $cor = addslashes($cor);
        $placa = str_replace("/", "", $placa);
        $placa = str_replace("-", "", $placa);
        $placa = str_replace(" ", "", $placa);
        $placa = addslashes($placa);
        
        
        
        $select = $pdo->prepare("SELECT vi.nome,v.id_visitante,v.stamp_entrada,v.stamp_saida,v.id_local,l.local,v.modelo,v.cor,v.placa FROM visitas as v LEFT JOIN visitantes as vi ON v.id_visitante=vi.id LEFT JOIN local as l ON v.id_local=l.id WHERE (v.stamp_entrada > $inicio OR v.stamp_entrada = $inicio) AND (v.stamp_entrada < $termino OR v.stamp_entrada = $termino) AND v.modelo LIKE '%$modelo%' AND v.cor LIKE '%$cor%' AND v.placa LIKE '%$placa%' ");
        $select->execute();
        $row = $select->fetchAll(PDO::FETCH_ASSOC);
        
        //se local for indicado pesquisa por possiveis locais filhos
        if($local > 0){
        
            
            $select2 = $pdo->prepare("SELECT id FROM local WHERE id_pai=$local ");
            $select2->execute();
            $row2 = $select2->fetchAll(PDO::FETCH_ASSOC);

            for($i=0;$i<count($row);$i++){

                if($row[$i]['id_local'] == $local){

                        //cria array que será retornado pela função
                        $array[]= array(

                            "nome" => $row[$i]['nome'],
                            "id_visitante" => $row[$i]['id_visitante'],
                            "stamp_entrada" => $row[$i]['stamp_entrada'],
                            "stamp_saida" => $row[$i]['stamp_saida'],
                            "local" => $row[$i]['local'],
                            "modelo" => $row[$i]['modelo'],
                            "cor" => $row[$i]['cor'],
                            "placa" => $row[$i]['placa']

                        );

                    }

                for($j=0;$j<count($row2);$j++){
                    
                    //compara com os locais filhos em 1º nivel
                    if($row[$i]['id_local'] == $row2[$j]['id']){

                        //cria array que será retornado pela função
                        $array[]= array(

                            "nome" => $row[$i]['nome'],
                            "id_visitante" => $row[$i]['id_visitante'],
                            "stamp_entrada" => $row[$i]['stamp_entrada'],
                            "stamp_saida" => $row[$i]['stamp_saida'],
                            "local" => $row[$i]['local'],
                            "modelo" => $row[$i]['modelo'],
                            "cor" => $row[$i]['cor'],
                            "placa" => $row[$i]['placa']

                        );

                    }
                    $idLFilho = $row2[$j]['id'];
                    //compara com o filhos em nivel 2
                    $select3 = $pdo->prepare("SELECT id FROM local WHERE id_pai= $idLFilho");
                    $select3->execute();
                    $row3 = $select3->fetchAll(PDO::FETCH_ASSOC);
                    
                    for($k=0;$k<count($row3);$k++){
                        
                        if($row[$i]['id_local'] == $row3[$k]['id']){
                            $array[]= array(

                                "nome" => $row[$i]['nome'],
                                "id_visitante" => $row[$i]['id_visitante'],
                                "stamp_entrada" => $row[$i]['stamp_entrada'],
                                "stamp_saida" => $row[$i]['stamp_saida'],
                                "local" => $row[$i]['local'],
                                "modelo" => $row[$i]['modelo'],
                                "cor" => $row[$i]['cor'],
                                "placa" => $row[$i]['placa']

                            );    
                            
                        }
                        
                    }

                }
            }
            
        }else{
            
            $array = $row;
            
        }
        
        return $array;
        
        
        
    }
    
    function editaVisitante($idVis,$nome,$cpf,$idtMil,$rg,$dn,$fone,$sexo){
        $pdo= conectar();
        
        $id = (int)$idVis;
        $nome = strtoupper(addslashes($nome));
        $cpf = addslashes($cpf);
        $idtMil = addslashes($idtMil);
        $rg = addslashes($rg);
        $dn = addslashes($dn);
        $fone = addslashes($fone);
        $sexo = addslashes($sexo);
        
        if(strlen($nome) > 5 and strlen($dn) == 10 and strlen($cpf)==14 and strlen($rg) > 4 and strlen($sexo)==1 and strlen($fone)== 14 and $id>0 ){
            
            $update = $pdo->prepare("UPDATE visitantes SET nome=:nome, cpf=:cpf, sexo=:sexo, idMil=:idtMil, rg=:rg, dn=:dn, fone=:fone WHERE id=:id");
            $update->bindValue(":nome", $nome);
            $update->bindValue(":cpf", $cpf);
            $update->bindValue(":sexo", $sexo);
            $update->bindValue(":idtMil", $idtMil);
            $update->bindValue(":rg", $rg);
            $update->bindValue(":dn", $dn);
            $update->bindValue(":fone", $fone);
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

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getIdMil() {
        return $this->idMil;
    }

    function getRg() {
        return $this->rg;
    }

    function getDn() {
        return $this->dn;
    }

    function getFone() {
        return $this->fone;
    }

    function getOmOrigem() {
        return $this->omOrigem;
    }

    function getIdMilResp() {
        return $this->idMilResp;
    }

    function getNomeMilRespRes() {
        return $this->nomeMilRespRes;
    }

    function getAcessoLivre() {
        return $this->acessoLivre;
    }

    function getTipoAcesso() {
        return $this->tipoAcesso;
    }

    function getAlerta() {
        return $this->alerta;
    }

    function getMotivoAlerta() {
        return $this->motivoAlerta;
    }
    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setIdMil($idMil) {
        $this->idMil = $idMil;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setDn($dn) {
        $this->dn = $dn;
    }

    function setFone($fone) {
        $this->fone = $fone;
    }

    function setOmOrigem($omOrigem) {
        $this->omOrigem = $omOrigem;
    }

    function setIdMilResp($idMilResp) {
        $this->idMilResp = $idMilResp;
    }

    function setNomeMilRespRes($nomeMilRespRes) {
        $this->nomeMilRespRes = $nomeMilRespRes;
    }

    function setAcessoLivre($acessoLivre) {
        $this->acessoLivre = $acessoLivre;
    }

    function setTipoAcesso($tipoAcesso) {
        $this->tipoAcesso = $tipoAcesso;
    }

    function setAlerta($alerta) {
        $this->alerta = $alerta;
    }

    function setMotivoAlerta($motivoAlerta) {
        $this->motivoAlerta = $motivoAlerta;
    }
    function getFoto() {
        return $this->foto;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }
    function getVeiculos() {
        return $this->veiculos;
    }

    function setVeiculos($veiculos) {
        $this->veiculos = $veiculos;
    }

    function getValidade() {
        return $this->validade;
    }

    function setValidade($validade) {
        $this->validade = $validade;
    }
    function getSexo() {
        return $this->sexo;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }




}



