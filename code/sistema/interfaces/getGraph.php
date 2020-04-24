<?php
session_start();
// requisição da classe PHPlot
require_once '../classes/phplot.php';


//$pdo = new PDO("mysql:host=localhost;dbname=atendimento","atendimento","atendimentomaanaim379");
$pdo = new PDO("mysql:host=localhost;dbname=atendimento","root","");

$select = $pdo->prepare("SELECT DISTINCT i.idProduto FROM item_pedido as i LEFT OUTER JOIN pedido as p ON i.idPedido=p.id WHERE p.idEstabe=:id and p.situacao > :sit");
$select->bindValue(":id", $_SESSION[estabelecimento]);
$select->bindValue(":sit", 1);
$select->execute();
$row = $select->fetchAll(PDO::FETCH_ASSOC);

for($i=0;$i<count($row);$i++){
    
    $select = $pdo->prepare("SELECT i.qtd,pr.vVenda,pr.nome FROM item_pedido as i LEFT OUTER JOIN produtos as pr ON i.idProduto=pr.id LEFT OUTER JOIN pedido as pe ON i.idPedido=pe.id WHERE i.idProduto=:id and pe.situacao > :sit ");
    $select->bindValue(":id", $row[$i][idProduto]);
    $select->bindValue(":sit", 1);
    $select->execute();
        
    $row2 = $select->fetchAll(PDO::FETCH_ASSOC);
    
    $soma = 0;
    $valor = 0;
    $nome = NULL;
        
    for($j=0;$j<count($row2);$j++){
            
        $soma = $soma + $row2[$j][qtd];
        $valor = $valor + ($row2[$j][qtd] * $row2[$j][vVenda]);
        $nome = $row2[$j][nome];
    }
        
    $return[] = array(
        'produto' => $nome,
        'qtd' => $soma,       
    );
    
}
///função de ordenar array
function cmp($a, $b) {
    return $a['qtd'] < $b['qtd'];
}

usort($return, 'cmp');
/////////////////////////////////

//pegar apenas os 5 mais vendidos
if(count($return) > 3){
    for($k=0;$k<3;$k++){
        $data[$k] = $return[$k];
    }   
}else{
    $data = $return;
}



// Array com dados de Ano x Índice de fecundidade Brasileira 1940-2000
    
# Cria um novo objeto do tipo PHPlot com 500px de largura x 350px de altura                 
$plot = new PHPlot(600 , 350);     
  
// Organiza Gráfico -----------------------------
#$plot->SetTitle('CONTROLE DE VENDAS NO EVENTO ATUAL');
# Precisão de uma casa decimal
$plot->SetPrecisionY(1);
# tipo de Gráfico em barras (poderia ser linepoints por exemplo)
$plot->SetPlotType("bars");
# Tipo de dados que preencherão o Gráfico text(label dos anos) e data (valores de porcentagem)
$plot->SetDataType("text-data");
# Adiciona ao gráfico os valores do array
$plot->SetDataValues($data);
// -----------------------------------------------
  
// Organiza eixo X ------------------------------
# Seta os traços (grid) do eixo X para invisível
$plot->SetXTickPos('none');
# Texto abaixo do eixo X
$plot->SetXLabel("Hank dos 3 produtos mais vendidos em todos os eventos");
# Tamanho da fonte que varia de 1-5
$plot->SetXLabelFontSize(2);
$plot->SetAxisFontSize(2);
// -----------------------------------------------
  
// Organiza eixo Y -------------------------------
# Coloca nos pontos os valores de Y
#$plot->SetYDataLabelPos('plotin');
// -----------------------------------------------
  
// Desenha o Gráfico -----------------------------
$plot->DrawGraph();
// -----------------------------------------------
?>

