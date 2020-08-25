<?php

class Renderizador{


    public function montar($view, $alvo, $texto_alvo){

        $enderecos = Renderizador::atualizar();

        //var_dump($enderecos);

        $pagina = file_get_contents($view);

        //echo('alvo: '.$alvo." texto_alvo: ".$texto_alvo);

        $tamanho_alvo=sizeof($alvo);

        if($tamanho_alvo == sizeof($texto_alvo) && $tamanho_alvo>0){
            for($i=0; $i<$tamanho_alvo; $i++){
                $pagina = str_replace($alvo[$i], $texto_alvo[$i], $pagina);
            }
        }
              
        $acumulado="";
        foreach ($enderecos as $endereco){

            $variavel = implode("",array_keys($endereco));
            $valor = implode("",array_values($endereco));

            /*echo('variavel: '.$variavel);
            echo('valor: '.$valor);
            echo('<br><br>');
            */

            

            if(strpos($pagina,$variavel)>0){

                $acumulado .=$variavel.'<br>';

                $pagina = str_replace($variavel, $valor, $pagina);
            }  
        }

        /*echo($acumulado);

        die();*/

        echo($pagina);

    }
    public static function atualizar(){

        $retorno = [];

        //inserir as partials no início do vetor, e as variáveis no final.
        
        array_push($retorno, ["{{meta}}" => file_get_contents('app/View/Template/Partial/meta.php')]);
        array_push($retorno, ["{{nova_postagem}}" => file_get_contents('app/View/Template/Partial/nova_postagem.php')]);
        array_push($retorno, ["{{url}}" => $GLOBALS['url']]); 
        array_push($retorno, ["{{respostas}}" => '']);

        
        return $retorno;
    }
}