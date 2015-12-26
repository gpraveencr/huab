<?php
namespace app;

use core\url\Url;

/** CONTROLADOR DA APLICAÇÃO
 * - define qual controlador deve ser acionado para tratamento da requisição
 * A classe Init é responsável por definir e instanciar o controlador do módulo, também
 * passa a esse controlador o action que deve ser executado. O action define o método do controlador.
 * @author elson
 */
class Init
{
    
    public function __construct( $route )
    {
        $this->run( $route );
    }
    
    /**
     * Método responsável pela instância do controlador
     * associado a uma deterinada rota. Todo controlador
     * recebe como parâmetro uma action, que é o gatilho
     * para determinar o método do controlador dará
     * tratamento da requisição.
     * @param array $route
     */ 
    public function run(array $route)
    {
        # recupera o action da tabela de rotas
        /* Recupera o action definido na tabela de rotas, essa tabela
         * tem precedência sobre o URL, pois são mutuamente exclusivas.
         */
        if(key_exists('action', $route)){
            # recupera o action definido na rota da aplicação: Array ( [route] => app [controller] => Index [action] => home )
            $action = $route['action'];
        }elseif(key_exists('a', Url::parseURL())){ #pode apresentar problemas em múltiplas instâncias?? classe estática!!
            $a = Url::parseURL();
            $action = $a['a'];
        }else{
            $action = null;
        }
    
        # define o namespace do controlador
        $Controller = '\\app\\'.$route['module'].'\\'.ucfirst($route['controller']);
        
        # cria uma instância do controlador e passa como parâmetro o action da aplicação (método)
        new $Controller( $action );
    }# run
    
}# Init

?>