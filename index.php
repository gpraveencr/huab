<?php
//namespace index;

//include_once 'vendor/core/url/Url.class.php';
include_once 'vendor/init/Bootstrap.php';
include_once 'vendor/db.php';
require 'vendor/autoload.php';
include_once 'vendor/config.php';  

use core\url\Url;
use vendor\init\Bootstrap;

function debug( $file, $line, $dados, $titulo = "" ){
    
    echo "<br><font color=\"#FF0033\">  <strong>".$titulo."</strong>: (file): ".$file." - (line): ".$line."</font>";
    
	if( is_array( $dados ) or (is_object($dados))){
		echo "<pre><font color=\"#0000FF\">";
		print_r( $dados );
		echo "</font></pre>";
	}else{
		echo "<br><font color=\"#0000FF\">".$dados."</font><br>";
	}
}


class Main
{
    
    public function __construct()
    {
        session_start();
        
        $this->charset();
        
        $this->timezone();
                
        $this->set_time_limit();
        
        $this->displayerrors();
        
        # Definição do diretório de instalação
        define("BASEDIR", dirname(__FILE__));
        
        # -------------------------------------------------------------------
        # TRATAMENTO DA URL DA APLICAÇÃO
        
        # Definição da URL base do sistema
        define("BASEURL", Url::urlBase() );
        
        # Definir o tipo de URL do sistema
        Url::setTipoURL( 2 ); # 1 - URL padrão; 2 - URL amigável; 3 - URL criptografada
        
        # Analisar e recuperar os elementos da URL
        $parseUrl = Url::parseURL();
        
        # -------------------------------------------------------------------
        
        
        /* SEGURANÇA
         * Variável para controle de acesso aos scripts do projeto.
         * Os scritps devem ser acessados apenas pela index, caso 
         * contrário devem ser bloqueados.
         */
        define("ACESSO", true);
        # -------------------------------------------------------------------
        # INCLUSÃO DOS CONTROLADORES DA APLICAÇÃO
        
        /*
         * A classe bootstrap inicializa as rotas da aplicação, as rotas contém
         * o diretório e o inicializador (Init) a ser instanciado. Os diretórios
         * app e admin possuem uma classe Init que gerenciam o acesso aos controladores
         * 
         * A classe Bootstrap recebe como parâmetro o módulo da aplicação e 
         * através deste seleciona a rota.
         */
        $bootstrap = new Bootstrap( $parseUrl['m'] );
        
        # inicializa as rotas da aplicação
        $route = $bootstrap->getRoute();
        
        # define o caminho da classe a ser instanciada
        $init = '\\'.$route['route'].'\\Init';
        
        # Instância do controlador Init
        # app/Init ou admin/Init
        new $init( $route );
        # -------------------------------------------------------------------
        
    }# __construct
    
    public function charset($charset = "utf-8")
    {
        return header("Content-Type: text/html; charset=$charset",true);
    }
    
    public function set_time_limit($time_limit = 2000)
    {
        # define o tempo limite de carregamento da página
        return set_time_limit($time_limit);
        
    }
    
    public function displayerrors()
    {
        if( ($_SERVER['SERVER_NAME'] == "localhost") or ($_SERVER['SERVER_NAME'] == "127.0.0.1") ){
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            ini_set('html_errors', true);
        }else{
            # Define o valor de uma opção de configuração
            # fonte: http://php.net/manual/pt_BR/function.ini-set.php
            ini_set('display_errors', 0);
            
            # 0 - desliga todas as mensagens de erro
            # fonte: http://php.net/manual/pt_BR/function.error-reporting.php
            error_reporting(0);
        }
    }#displayerros
    
    /**
     * Configura a timezone padrão a ser utilizada por todas as funções de data e hora em um script
     * 
     * @return bool
     * @link http://php.net/manual/pt_BR/function.date-default-timezone-set.php
     * @link http://php.net/manual/pt_BR/timezones.php
     */
    public function timezone($timezone = 'America/Recife')
    {
        # fonte: http://php.net/manual/pt_BR/function.date-default-timezone-set.php
        return date_default_timezone_set($timezone);
    }# timezone
    
    /** VERIFICAR
     * Define quais erros serão suportados
     * A função error_reporting() define a diretiva error_reporting em tempo de execução. O PHP tem vários níveis de erros, usando esta função você pode definir o nível durante a execução do seu script.
     * @param array $value E_ERROR E_WARNING E_PARSE E_NOTICE E_CORE_ERROR E_CORE_WARNING E_COMPILE_ERROR E_COMPILE_WARNING
     * E_USER_ERROR E_USER_WARNING E_USER_NOTICE E_ALL E_STRICT E_RECOVERABLE_ERROR
     * <li>
     * <li>
     * <li>
     * <li>
     * <li>
     * <li>
     */
    public function error_reporting( array $value = array(0) ){
        
        if( $_SERVER['SERVER_NAME'] != "localhost" ){
            # Define o valor de uma opção de configuração
            # fonte: http://php.net/manual/pt_BR/function.ini-set.php
            ini_set('display_errors', 0);
        
            # 0 - desliga todas as mensagens de erro
            # fonte: http://php.net/manual/pt_BR/function.error-reporting.php
            error_reporting(0);
        }else{
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            ini_set('html_errors', true);
        }
    
    }# error_reporting
    
    # =======================================================
    # MEDIÇÃO DO TEMPO DE PROCESSAMENTO DA PÁGINA
    public static function getmicrotime() {
        list ( $usec, $sec ) = explode ( " ", microtime () );
        return (( float ) $usec + ( float ) $sec);
    }
    
    public function baseDir(){
        return dirname(__FILE__);
    }# baseDir
    
    # -------------------------------------------------------
    
    /**
     * Função para proteger o sistema de inclusão de código malicioso,
     * faz a análise das funções POST E GET do http e altera os dados
     * usando um método do html que substitui tags html por "entidades HTML",
     * assim protegendo o sistema de forma dinâmica;
     * @param string $dados
     * @return string
     * @tutorial A função protege deve ser extendida para analisar todos os níveis
     * do array de dados do GET e POST, pois alguns formulários que possuem os
     * nomes das variáveis como array não são validadas pela função. Essa função
     * deve ser mais especializada.
     */
    public static function protege( &$dados ){
        if( !is_array( $dados ) )
            $dados = htmlentities( $dados, ENT_NOQUOTES, "UTF-8" );
        return $dados;
    }# protege
    
}

//$start = Main::getmicrotime();

new Main();

//$end = Main::getmicrotime();

//$time = $end - $start;

//echo "<p>".$time;

?>