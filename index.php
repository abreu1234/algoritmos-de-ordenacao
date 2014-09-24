<?php 
echo "<h1>Vetor Inicial</h1>";

$vetor = criaVetor();
imprimeVetor($vetor);
echo "<br/><br/><br/>";

echo "<h2>BubbleSort</h2>";
$bubble = bubbleSort($vetor);
imprimeVetor($bubble['vetor']);
echo " em ".$bubble['tempo']." segundos";

echo "<h2>SelectionSort</h2>";
$selection = selectionSort($vetor);
imprimeVetor($selection['vetor']);
echo " em ".$selection['tempo']." segundos";

echo "<h2>QuickSort</h2>";
$quick = quicksort($vetor);
imprimeVetor($quick['vetor']);
echo " em ".$quick['tempo']." segundos";





function criaVetor($ini = 1, $fim = 100){
    $vetor = range($ini, $fim);
    shuffle($vetor);
    
    return $vetor;
}

function imprimeVetor($vetor){
    foreach ($vetor as $vet){
        echo $vet.", ";
    }
}

function bubbleSort($vetor){
    $inicio = microtime(true);
    
    for ( $i = 0; $i < count($vetor); $i++){
        
        for ($j = 0; $j < count($vetor); $j++){
            
            if($vetor[$i] < $vetor[$j]){
                $aux = $vetor[$i];
                $vetor[$i] = $vetor[$j];
                $vetor[$j] = $aux;
            }
            
        }
        
    }
    
    $fim = microtime(true);    
    $tempo = round($fim - $inicio , 4);
    
    $result['vetor'] = $vetor;
    $result['tempo'] = $tempo;
    
    return $result;    
}

function selectionSort($vetor){
    $inicio = microtime(true);
    
    for($i = 0; $i < count($vetor); $i++) {
        $menor = $i;

        for($j = ($i + 1); $j < count($vetor); $j++){

            if($vetor[$j] < $vetor[$menor])
                $menor = $j;

        }

        $aux = $vetor[$menor];
        $vetor[$menor] = $vetor[$i];
        $vetor[$i] = $aux;
    }

    $fim = microtime(true);    
    $tempo = round($fim - $inicio , 4);
    
    $result['vetor'] = $vetor;
    $result['tempo'] = $tempo;
    
    return $result;
}

function quicksort($vetor, $esquerda, $direita){
    $inicio = microtime(true);
    
    $meio = $vetor[ (int) ( ($esquerda + $direita) / 2) ];
    $e = $esquerda;
    $d = $direita;

    while ($e <= $d) {
        while ($vetor[$e] < $meio){
            $e++;
        }

        while($vetor[$d] > $meio){
            $d--;
        }

        if ($e <= $d){
            $aux = $vetor[$e];
            $vetor[$e] = $vetor[$d];
            $vetor[$d] = $aux;
            $e++;
            $d--;
        }
    }

    if ($esquerda < $d)
        $vetor = quicksort($vetor, $esquerda, $d);    

    if ($direita > $e)
        $vetor = quicksort($vetor, $e, $direita);

    $fim = microtime(true);    
    $tempo = round($fim - $inicio , 4);
    
    $result['vetor'] = $vetor;
    $result['tempo'] = $tempo;
    
    return $result;
}
 