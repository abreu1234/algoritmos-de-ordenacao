<?php 
echo "<h1>Vetor Inicial</h1>";

$vetor = criaVetor();
imprimeVetor($vetor);
echo "<br/><br/><br/>";

echo "<h2>BubbleSort</h2>";
$inicio = microtime(true);

$bubble = bubbleSort($vetor);

$fim = microtime(true);    
$tempo = round($fim - $inicio , 4);

imprimeVetor($bubble);
echo " em ".$tempo." segundos";

echo "<h2>SelectionSort</h2>";
$inicio = microtime(true);

$selection = selectionSort($vetor);

$fim = microtime(true);    
$tempo = round($fim - $inicio , 4);

imprimeVetor($selection);
echo " em ".$tempo." segundos";

echo "<h2>QuickSort</h2>";
$inicio = microtime(true);

$quick = quickSort($vetor, 0, (sizeof( $vetor ) -1) );

$fim = microtime(true);    
$tempo = round($fim - $inicio , 4);
    
imprimeVetor($quick);
echo " em ".$tempo." segundos";

//Merge
echo "<h2>MergeSort</h2>";
$inicio = microtime(true);

$merge = mergeSort($vetor);

$fim = microtime(true);    
$tempo = round($fim - $inicio , 4);
    
imprimeVetor($merge);
echo " em ".$tempo." segundos";




/**
 * Cria um vetor randomico
 * 
 * @param int $ini
 * @param int $fim
 * @return Array
 */
function criaVetor($ini = 1, $fim = 100){
    //Gera um vetor
    $vetor = range($ini, $fim);
    //Mistura o vetor
    shuffle($vetor);
    
    return $vetor;
}

/**
 * Imprime dados do vetores separado por vírgula
 * 
 * @param Array $vetor
 */
function imprimeVetor($vetor){
    
    foreach ($vetor as $vet)
        echo $vet.", ";
    
}

/**
 * Ordena vetor método Bubble sort
 * Complexidade de tempo: n^2
 * 
 * @param Array $vetor
 * @return Array
 */
function bubbleSort($vetor){
    
    $tam = sizeof($vetor);
    
    for ( $i = 0; $i < $tam; $i++){
        
        for ($j = 0; $j < $tam; $j++){
            //Se o índice anterior for menor que o atual trocam de lugar
            if($vetor[$i] < $vetor[$j]){
                $aux = $vetor[$i];
                $vetor[$i] = $vetor[$j];
                $vetor[$j] = $aux;
            }
            
        }
        
    }
        
    return $vetor;    
}

/**
 * Ordena vetor método Selection sort
 * Complexidade de tempo: O(n^2) 
 * 
 * @param Array $vetor
 * @return Array
 */
function selectionSort($vetor){
    
    $tam = sizeof($vetor);
            
    for($i = 0; $i < $tam; $i++) {
        $menor = $i;

        for($j = ($i + 1); $j < $tam; $j++){
            //Se encontrar um valor menor esse é eleito o menor
            if($vetor[$j] < $vetor[$menor])
                $menor = $j;

        }        
        //Coloca o menor valor em seu lugar
        $aux = $vetor[$menor];
        $vetor[$menor] = $vetor[$i];
        $vetor[$i] = $aux;
    }

    return $vetor;
}

/**
 * Ordena vetor método Quick sort
 * Complexidade de tempo:
 * O(n lg2 n) no melhor caso e caso médio 
 * e O(n2) no pior caso;
 * 
 * @param Array $vetor
 * @return Array
 */
function quickSort($vetor, $ini, $fim){
    //Elegendo o meio do vetor como pivô
    $pivo = $vetor[ (int) ( ($ini + $fim) / 2) ];
    $e = $ini;
    $d = $fim;
    
    //Enquanto os menores não cruzarem pelos maiores
    while ($e <= $d) {
        //Enquanto os menores for menor que o pivo 
        while ($vetor[$e] < $pivo){
            //continua incrementando os menores
            $e++;
        }
        //Enquanto os maiores for maior que o pivo 
        while($vetor[$d] > $pivo){
            //continua decrementando os maiores
            $d--;
        }
        //Se os menores cruzarem pelos maiores
        if ($e <= $d){
            //Trocam de lugar
            $aux = $vetor[$e];
            $vetor[$e] = $vetor[$d];
            $vetor[$d] = $aux;
            $e++;
            $d--;
        }
    }
    
    //Chama recursivamente o vetor de menores
    if ($ini < $d)
        $vetor = quickSort($vetor, $ini, $d);    

    //Chama recursivamente o vetor de maiores
    if ($fim > $e)
        $vetor = quickSort($vetor, $e, $fim);
        
    return $vetor;
}

/**
 * Ordena vetor método Merge Sort
 * Complexidade de tempo: O(n log2 n)
 * 
 * @param Array $vetor
 * @return Array
 */
function mergeSort($vetor){
    $tam = sizeof($vetor);
    
    if($tam > 1){
        
        $meio = (int) ( sizeof($vetor) / 2 );
        //Dividindo o vetor em 2 partes e chamando recursivamente a função
        $esquerda = mergesort( divideVetor($vetor, 0, $meio) );
        $direita = mergesort( divideVetor($vetor, $meio, $tam) );
        
        //Contadores para ve tamanho do vetor
        $x = 0; 
        $y = 0;
        
        for ($i=0; $i < $tam; $i++){
            //Se o vetor da esquerda tiver o mesmo tamanho que o primeiro 
            //contador, passa o índice do da direita
            if($x == sizeof($esquerda)){
                $vetor[$i] = $direita[$y];
                ++$y;
            
            //Se o vetor da direita tiver o mesmo tamanho que o segundo contador
            //ou maior que o vetor da esquerda, passa o índice do da esquerda
            }elseif ( ($y == sizeof($direita)) || ($esquerda[$x] < $direita[$y]) ){ 
                
                $vetor[$i] = $esquerda[$x];
                ++$x;
                
            }else{
                
                $vetor[$i] = $direita[$y];
                ++$y;
                
            }
            
        }
        
    }
    
    return $vetor;
}

/**
 * Divide um vetor e retorna um vetor menor de acordo os índices passados
 * 
 * @param Array $vetor
 * @param int $ini
 * @param int $fim
 * @return Array
 */
function divideVetor( $vetor, $ini, $fim){
    
    for($i = $ini; $i < $fim; $i++)
        $novoVet[] = $vetor[$i];    
    
    return $novoVet;
}