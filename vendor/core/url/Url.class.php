<?php 

namespace vendor\core\url;
/**
 * Componente url
 * - Função geral: gerenciar as URLs as variáveis passadas via método get e compor as URLs dos links do sistema
 * - Função: 
 *          - analisar, decompor e montar um conjunto de variáveis com base na URL do sistema
 *          - receber um conjunto de variáveis e compor uma URL
 * @example 
 * - Modelo de URL adotado pelo sistema
 *  - tipo 1: URL sem tratamento, padrão PHP (protocol://host/index.php?query#fragment)
 *    <li>Ex: http://dominio/index.php?m=modulo&a=acao&id=1&paginador&page=2&modelo=SUV&ano=2012
 *  - tipo 2: URL amigável (protocol://host/path/?query#fragment)
 *    <li>Ex: http://domínio/modulo/ação/?:1-profissionais-de-TI-estao-em-alta-no-mercado/paginador/page=2/usuario=publico/materia=especial/ano=2012
 *  - tipo 3: URL criptografada
 *    <li>Ex: http://domínio/bW9kdWxvL2FjYW8vPzEtY29uY3Vyc28tcGFyYS1hYmluL3BhZ2luYWRvci9wYWdlPTIvdXN1YXJpbz1wdWJsaWNvL21hdGVyaWE9ZXNwZWNpYWwvYW5vPTIwMTI=
 * 
 * - Modelo padrão de URL: protocolo://host/path/query#fragment
 * 
 * Elementos bases de um path/query
 * - módulo
 * - ação
 * - id (para as ações de recuperação de dados)
 * - paginador
 * - recursos (demais recursos solicitados pela aplicação no formato de array)
 * 
 * ANOTAÇÕES
 * - A URL não pode ter o símbolo #, esse símbolo é indicativo de fragmento
 * @author Elson Vinicius
 * @version 14 Set 14
 */
class Url{
	# atributos da URL
	/**
	 * Protocolo de comunicação com o servidor
	 * @var string
	 */
	private static $scheme 		= null;
	
	/**
	 * Usuário
	 * @var string
	 */
	private static $user 		= null;
	
	/**
	 * Senha
	 * @var string
	 */
	private static $pass 		= null;
	
	/**
	 * Domínio da aplicação
	 * @var string
	 */
	private static $host 		= null;
	
	/**
	 * Porta
	 * @var integer
	 */
	private static $port 		= null;
	
	/**
	 * Contém os elementos a serem analisados
	 */
	private static $path 		= null;
	
	/**
	 * Contém os elementos a serem analisados
	 * @var $query
	 */
	private static $query 		= null;
	
	/**
	 * Fragmento
	 * @var string
	 */
	private static $fragment	= null;#Fragmento
	
	# Outros atributos
	/**
	 * Separador padrão dos termos da URL
	 * @var string
	 */
	private static $separador = "-";
	
	/**
	 * URL base do sistema, engloba o diretório atual.
	 * @var string
	 */
	private static $baseURL;
	
	/**
	 * Tipo de URL do sistema
	 * @example
	 * - 1: para URL padrão
	 * - 2: para url amigável
	 * - 3: para URL criptografada
	 * @var integer
	 */
	private static $tipoURL;
	
	/**
	 * Armazena o nível do diretório para separar o diretório
	 * de instalação dos componentes da URL
	 * @var integer
	 */
	private static $nivelDiretorio;

	/**
	 * Realiza a retirada de caracteres especias ddd
	 * Enter description here ...
	 * @param unknown_type $string
	 */
	private static function normaliza( $string ){
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùüúûýýþÿŔŕ/?';
		$b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr__';
	
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($a), $b); //substitui letras acentuadas por "normais"
		$string = str_replace(" ",self::$separador,$string); // substitui o espaço pelo separador padrão
		$string = strtolower($string); // passa tudo para minúsculo
		return utf8_encode($string); //finaliza, gerando uma saída para a função
	}
	
	/**
	 * Criptografa os componentes path e query da URL
	 * @param string $url
	 * @return string
	 */
	private static function criptografar( $url ){
		return base64_encode( $url );
	}
	
	/**
	 * Descriptografa a URL
	 * @param string $url_criptografada
	 * @return string
	 */
	private static function descriptografar( $url_criptografada ){
		return base64_decode( $url_criptografada );
	}
	
	/**
	 * Recupera variáveis de ambiente do sistema
	 * @param string $name
	 * @return string
	 */
	private static function safe_get_env( $name ) {
		if (isset ( $_SERVER [$name] )) {
			return $_SERVER [$name];
		# mb_stringpos: Find position of first occurrence of string in a string
		# php_sapi_name: Retorna o tipo de interface entre o servidor web e o PHP
		} else if (mb_strpos ( php_sapi_name (), 'apache' ) === false) {
			# getenv — Obtém uma variável de ambiente
			getenv ( $name );
		} else {
			return '';
		}
	}# Font: dotProjetct
	
	/**
	 * Recupera o nível do diretório de instalação a partir da raiz www/.
	 * - Se instalado na raiz retorna 1.
	 * - Se instalado na dentro do diretório /www/sistema/ retorna 2.
	 * É usado para compensar a formação de array de dados do path.
	 */
	private static function getNivelDiretorioInstalacao(){
		return self::$nivelDiretorio = count(explode("/",dirname(getenv('SCRIPT_NAME'))));
	}
	
	/**
	 * Método genérico para recuperar os atributos da URL
	 * @param string $attribute
	 */
	public static function get( $attribute ){
		return self::${$attribute};
	}
	
	/**
	 * Método genérico para alterar o valor
	 * de um atributo da classe URL
	 * @param string $attribute
	 * @param string $value
	 */
	public static function set( $attribute, $value ){
		self::${$attribute} = $value;
	}
	
	/**
	 * Analisa a URL e retorna um conjunto de variáveis passados via método get
	 * @param string $url
	 */
	public static function parseURL(){
		$output = array();
		
		# passo 1: decompor a URL nos respectivos componentes
		$componentes = parse_url( self::getURL() );
		
		# passo 2: configurar os atributos da classe
		foreach( $componentes as $kComponentes => $vComponentes ){
			self::${$kComponentes} = $vComponentes;
		}
		
		# Testar o tipo de URL definida pelo sistema
		switch ( self::$tipoURL ){
			#URL modelo 1 (com a definição da query)
			case 1:# http://host/diretorio/?m=modulo&a=acao&id=1&paginador&page=2&modelo=SUV&ano=2012
				
				# separa os elementos do componente query na forma de array 
				$query = explode( "&",self::$query );
				# configura as variáveis definidas no componente query
				foreach( $query as $kQuery => $vQuery ){
					$var = explode( "=", $vQuery );
					
					if( isset( $var[1] ) )
					    $output[$var[0]] = $var[1];
					
					#$output[$var[0]] = isset( $var[1] )? $var[1] : null;
					unset($var);
				}#fim do foreach
				
				if( !key_exists("m", $output))
				    $output['m'] = '/';
				
				
			break;
			
			case 2:# http://localhost/diretorio/modulo/editar/?1-profissionais de TI estao em alta no mercado/paginador/page=2/usuario=publico/materia=especial/ano=2012
				
				# separa os elementos na forma de array e retira o diretório de instalação do componente path
				$path  = array_slice( explode( "/",self::$path ), self::getNivelDiretorioInstalacao() );
				# inicializa a variável $query
				$query = array();
				
				# se o compenente path foi definido, recupear o módulo e a acao
				if( !empty( $path ) ){
					# recupera a variável "módulo"
					if ( key_exists(0, $path) ){
						if( $path[0] != "" ){
						    $output['m'] = $path[0];
						}else{
				            $output['m'] = '/';
                        }
					}
					# recupera a variável "acao"
					if (key_exists(1, $path))
						$output['a'] = $path[1];
				}
				
				/*
				 * O componente path contém apenas o módulo e a acao. As demais
				 * variáveis são configuradas no compoente query e inicializadas
				 * pelo simbolo ?
				 */
				if( !is_null( self::$query ) )
					$query = explode( "/", self::$query );
				
				foreach ( $query as $kQuery => $vQuery  ){
					
					# identifica o id inicializado pelo ":"
					if( $vQuery[0] === ":" ){
						# retira os : da string
						$vQuery = substr( $vQuery, 1 );
						
						# separa a string em array de dois elementos
						$var = explode( "-", $vQuery, 2 );
							
						#recupera a posição do id
						$output["id"] = $var[0];
							
						unset($var);
				
						continue;
					}
					# identifica a variável paginador
					if( $vQuery == "paginador" ){
						$output[$vQuery] = true;
						continue;
					}
					# identifica as demais variáveis definidas na URL
					$var = explode( "=", $vQuery );
					$output[$var[0]] = $var[1];
					
					unset($var);
				}
			break;
			
			case 3:
				# descriptografa o componente query
				$query = self::descriptografar( self::$query );
				
				# monta um array com os elementos do componente query
				$query = explode( "&", $query );
				
				# monta um array com os elementos definidos na URL
				foreach( $query as $kQuery => $vQuery ){
					$var = explode( "=", $vQuery );
					
					if( isset( $var[1] ) )
					    $output[$var[0]] = $var[1];
					
					#$output[$var[0]] = isset( $var[1] )? $var[1] : "";
					unset($var);
				}#fim do foreach
				
				if( !key_exists("m", $output))
				    $output['m'] = '/';
				
			break;
		}
		#output retorna um array de variáveis indexadas
		return $output;
	}# fim parseURL
	
	/**
	 * A função estática ancora tem a responsabilidade de montar as URLs da aplicação
	 * que estão definidas nos links da aplicação, tem função de receber as variáveis,
	 * analisá-las e montar o link.
	 * @param integer $tipo
	 * @param string $_modulo
	 * @param string $_acao
	 * @param array $_id
	 * @param integer $_paginador
	 * @param array $_recursos ex: 
	 * @example
	 */
	
	/**
	 * 
	 * @param string $_modulo - ex: cliente
	 * @param string $_acao - ações padronizadas ou não, ex: show, add, rm, list, edt, <outras ações
	 * @param array $_id - identificador único, ex: array( elson, Elson Vinicius Paulo );
	 * @param integer $_page - número da página quando o paginador estiver ativado
	 * @param array $_recursos - ex: array("marca"=>"ford", "modelo"=>"fiesta")
	 * @return string
	 */
	public static function setURL( $_modulo = null, $_acao = null, $_id = array(), $_page = 0, $_recursos = array() ){
		$contador = 0;
		$output = "";
		
		# array das variáveis módulo e ação
		$path = array();
		
		# array das demais variáveis
		$query = array();
		
		if( !is_null( $_modulo ) )
			$path['m'] = $_modulo;
		
		if( !is_null( $_acao ) )
			$path["a"] = $_acao;
		
		if( !empty( $_id ))
			$query["id"] = $_id[0];
		
		if( $_page > 0 ){
			$query['paginador&page'] = $_page;
		}
		
		switch ( self::$tipoURL ){
	
			case 1:# http://host/diretorio/?m=modulo&a=acao&id=1&paginador&page=2&modelo=SUV&ano=2012
				
				foreach( $_recursos as $kRecursos => $vRecursos )
					$query[$kRecursos] = $vRecursos;
				
				$componente = array_merge( $path, $query );
				
				if( !empty( $componente ) ){
					$output .= "/?";
					foreach ( $componente as $kComponente => $vComponente )
						$output .= $contador++ ? "&".$kComponente."=".$vComponente : $kComponente."=".$vComponente;
				}
			break;
					
			case 2: # http://host/diretorio/modulo/acao/?id-<texto>/paginador/page=1/marca=ford/modelo=fiesta
				
				foreach( $_recursos as $kRecursos => $vRecursos )
					$query[$kRecursos] = $kRecursos."=".$vRecursos;
				
				if( !empty( $_id )){
					$id = ":".$_id[0];
				
					if( $_id[1] != "" ){
						# retirar acentos e caracteres especiais: / e ?
						# montagem da string com o separador padrão
						$id .= "-".self::normaliza( $_id[1] );						
					}
					
					$query["id"] = $id;
				}
				
				if( $_page > 0 )
					$query['paginador&page'] = "paginador/page=".$_page;
				
				if( key_exists( "m", $path ))
					$output .= "/".$path['m'];
				
				if( key_exists( "a", $path ))
					$output .= "/".$path['a'];
				
				if( !empty( $query ) ){
					foreach ( $query as $kQuery => $vQuery ){
						if ( $contador++ ){
							$output .= "/".$vQuery;
						}else{
							$output .= "/?".$vQuery;
						}
					}
				}
			break;
					
			case 3:# http://dominio/diretorio/Lz9tPWZvcmQmYT1maWVzdGEmaWQ9MTIzNCZwYWdpbmFkb3ImcGFnZT0y
				
				foreach( $_recursos as $kRecursos => $vRecursos )
					$query[$kRecursos] = $vRecursos;
				
				$componente = array_merge( $path, $query );
				
				if( !empty( $componente ) ){
					foreach ( $componente as $kComponente => $vComponente )
						$output .= $contador++ ? "&".$kComponente."=".$vComponente : $kComponente."=".$vComponente;
					
					$output = "/?".self::criptografar( $output );
				}

			break;
		}
		
		return self::$baseURL.$output;
	}#fim do método ancora
	
	/**
	 * Configura o tipo de URL do sistema, é possível haver apenas um dos:
	 * <li>tipo 1: http://dominio/index.php?m=modulo&a=acao&id=1&paginador&page=2&modelo=SUV&ano=2012
	 * <li>tipo 2: http://domínio/modulo/ação/?1-profissionais-de-TI-estao-em-alta-no-mercado/paginador/page=2/usuario=publico/materia=especial/ano=2012
	 * <li>tipo 3: http://domínio/bW9kdWxvL2FjYW8vPzEtY29uY3Vyc28tcGFyYS1hYmluL3BhZ2luYWRvci9wYWdlPTIvdXN1YXJpbz1wdWJsaWNvL21hdGVyaWE9ZXNwZWNpYWwvYW5vPTIwMTI=
	 * @param integer $tipo
	 * @return integer
	 */
	public static function setTipoURL( $tipoURL ){
		return self::$tipoURL = $tipoURL;
	}
	
	/**
	 * Diretório base URL base do sistema. Ex: http://localhost.
	 * (sempre retorna o mesmo valor)
	 * @var string
	 * @author dotProjetct
	 */
	public static function urlBase(){
		$baseUrl = (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') 
		             || getenv('HTTP_X_FORWARDED_PROTO') == 'https') 
		             ? 'https://' : 'http://');
		             
		$baseUrl .= self::safe_get_env('HTTP_HOST');
		
		$pathInfo = self::safe_get_env('PATH_INFO');
		
		if ( @$pathInfo ) {
			$baseUrl .= str_replace('\\','/',dirname( $pathInfo ) );
		} else {
			$baseUrl .= str_replace('\\','/', dirname(self::safe_get_env('SCRIPT_NAME')));
		}
		$baseUrl = preg_replace( '#/$#D', '', $baseUrl );
		return self::$baseURL = $baseUrl;
	}#fim metodo urlBase
	
	/**
	 * Recupera a URL atual do sistema
	 * @return string $url
	 */
	private static function getURL(){
		$url  = (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
		|| getenv('HTTP_X_FORWARDED_PROTO') == 'https')
		? 'https://' : 'http://');
		$url .= $_SERVER['SERVER_NAME'];
		$url .= $_SERVER['REQUEST_URI'];
		return $url;
	}
	
	/**
	 * Método construtor de URL para conexão a host específico
	 * @param string $scheme (http, ftp, sftp)
	 * @param string $host (IP ou domínio)
	 * @param string $path (localização do recurso)
	 * @param string $query (parâmetros do recurso)
	 * @return string url
	 */
	public static function connect( $scheme, $host, $path = null, $query = null ){
		$url  = $scheme."://";
		$url .= ( !is_null(self::$user) and !is_null(self::$pass) ) ? self::$user.":".self::$pass."@" : "";
		$url .= $host;
		$url .= (!is_null( self::$port )) ? ":".self::$port : "";
		$url .= (!is_null( $path )) ? "/".$path : "";
		$url .= (!is_null( $query )) ? "/".$query : "";
		$url .= (!is_null( self::$fragment )) ? "#".self::$fragment : "";
		return $url;
	}
}#fim da classe
?>