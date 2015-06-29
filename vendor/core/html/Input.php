<?php
namespace core\html;
/*
 * A tag <input> especifica um campo de entrada onde o usuário pode inserir dados.
 * <input> elementos são usados ​​dentro de um elemento <form> para declarar controles de entrada que permitem aos usuários inserir dados.
 * Um campo de entrada pode variar de muitas formas, dependendo do tipo de atributo.
 */

use \core\html\GlobalHtml;

class Input extends GlobalHtml{
	
#========================================================================
# ATRIBUTOS	
	/**
	 * Especifica os tipos de arquivos que o servidor aceita (apenas para type = "file")
	 * <li>valores aceitos: array(0 =>"audio/*",1 => "video/*",2 => "image/*",3 => "MIME_type" );
	 * @param int $indice
	 * @return array
	 */
	public function accept( int $indice ){
		$accept = array("audio/*", "video/*","image/*","MIME_type" );
		return self::$attributes[] = array( __FUNCTION__ => $accept[$indice] );
	}
	
	/**
	 * Especifica um texto alternativo para imagens (somente para type = "imagem")
	 * <br/>valores aceitos: texto
	 * @param string $alt
	 * @return array
	 */
	public function alt( $alt ){
		return self::$attributes[] = array( __FUNCTION__ => $alt );
	}
	
	/**
	 * Especifica se um elemento &lt;input> deve ter autocomplete ativado
	 * <br/>valores aceitos:
	 * <li>on
	 * <li>off
	 * @param string $autocomplete
	 * @return array
	 */
	public function autocomplete( $autocomplete ){
		return self::$attributes[] = array( __FUNCTION__ => $autocomplete );
	}
	
	/**
	 * Especifica que um elemento &lt;input> deve receber automaticamente o foco quando a página é carregada
	 * <br/>valores aceitos: autofocus
	 * @return array
	 */
	public function autofocus(){
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Especifica que um elemento &lt;input> deve ser pré-selecionado quando a página é carregada (por type = "checkbox" ou type = "radio")
	 * <br/>valores aceitos: checked
	 * @return array
	 */
	public function checked() {
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Especifica que um elemento &lt;input> deve ser desativado
	 * <br/>valores aceitos: disabled
	 * @return array
	 */
	public function disabled() {
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Especifica um ou mais forms a que o elemento &lt;input> pertence
	 * <br/>valores aceitos: form id
	 * @param string $form
	 * @return array
	 */
	public function form( $form ) {
		return self::$attributes[] = array( __FUNCTION__ => $form );
	}
	
	/**
	 * Especifica a URL do arquivo que irá processar o controle de entrada, quando o formulário é enviado (para type = "submit" e type = "imagem")
	 * <br/>valores aceitos: URL
	 * @param string $formaction
	 * @return array
	 */
	public function formaction( $formaction ) {
		return self::$attributes[] = array( __FUNCTION__ => $formaction );
	}
	
	/**
	 * Especifica como a forma-dados devem ser codificados quando enviá-lo para o servidor (por type = "submit" e type = "imagem")
	 * <br/>valores aceitos:
	 * <li>application/x-www-form-urlencoded
	 * <li>multipart/form-data
	 * <li>text/plain
	 * @param string $formenctype
	 * @return array
	 */
	public function formenctype( $formenctype ) {
		return self::$attributes[] = array( __FUNCTION__ => $formenctype );
	}
	
	/**
	 * Define o método HTTP para o envio de dados para o URL de ação (para type = "submit" e type = "imagem")
	 * <br/>valores aceitos:
	 * <li>get
	 * <li>post
	 * @param string $formmethod
	 * @return array
	 */
	public function formmethod( $formmethod ) {
		return self::$attributes[] = array( __FUNCTION__ => $formmethod );
	}
	
	/**
	 * Define que os elementos de formulário não deve ser validado quando submetidos
	 * <br/>valores aceitos: formvalidate
	 * @param string $formnovalidate
	 * @return array
	 */
	public function formnovalidate( $formnovalidate ) {
		return self::$attributes[] = array( __FUNCTION__ => $formnovalidate );
	}
	
	/**
	 * Especifica onde exibir a resposta que é recebido após enviar o formulário (para type = "submit" e type = "imagem")
	 * <br/>valores aceitos:
	 * <li>_blank
	 * <li>_self
	 * <li>_parent
	 * <li>_top
	 * <li>framename
	 * @param string $formtarget
	 * @return array
	 */
	public function formtarget( $formtarget ) {
		return self::$attributes[] = array( __FUNCTION__ => $formtarget );
	}
	
	/**
	 * Especifica a altura de um elemento &lt;input> (apenas para type = "imagem")
	 * <br/>valores aceitos: pixels
	 * @param string $height
	 * @return array
	 */
	public function height( $height ) {
		return self::$attributes[] = array( __FUNCTION__ => $height );
	}
	
	/**
	 * Refere-se a um elemento &lt;datalist> que contém opções pré-definidas para um elemento &lt;input>
	 * <br/>valores aceitos: datalist_id
	 * @param string $list
	 * @return array
	 */
	public function _list( $list ) {
		return self::$attributes[] = array( __FUNCTION__ => $list );
	}
	
	/**
	 * Especifica o valor máximo de um elemento &lt;input>
	 * <br/>valores aceitos:
	 * <li>number
	 * <li>date
	 * @param string $max
	 * @return array
	 */
	public function max( $max ) {
		return self::$attributes[] = array( __FUNCTION__ => $max );
	}
	
	/**
	 * Especifica o número máximo de caracteres permitidos em um elemento &lt;input>
	 * @param integer $maxlength
	 * @return array
	 */
	public function maxlength( $maxlength ) {
		return self::$attributes[] = array( __FUNCTION__ => $maxlength );
	}
	
	/**
	 * Especifica um valor mínimo para um elemento &lt;input>
	 * @param integer $min
	 * @return array
	 */
	public function min( $min ) {
		return self::$attributes[] = array( __FUNCTION__ => $min );
	}
	
	/**
	 * Especifica que um usuário pode inserir mais de um valor em um elemento &lt;input>
	 * @param $multiple = "multiple" 
	 * @return array
	 */
	public function multiple( $multiple = "multiple" ) {
		return self::$attributes[] = array( __FUNCTION__ => $multiple );
	}
	
	/**
	 * Especifica o nome de um elemento &lt;input>
	 * @param string $name
	 * @return array
	 */
	public function name( $name ) {
		return self::$attributes[] = array( __FUNCTION__ => $name );
	}
	
	/**
	 * Especifica uma expressão regular que o valor de um elemento &lt;input> é verificado contra
	 * @param regexp $pattern
	 * @return array
	 */
	public function pattern( $pattern ) {
		return self::$attributes[] = array( __FUNCTION__ => $pattern );
	}
	
	/**
	 * Especifica um toque curto que descreve o valor esperado de um elemento &lt;input>
	 * @param string $placeholder
	 * @return array
	 */
	public function placeholder( $placeholder ) {
		return self::$attributes[] = array( __FUNCTION__ => $placeholder );
	}
	
	/**
	 * Especifica que um campo de entrada é somente leitura
	 * @param string $readonly
	 * @return array
	 */
	public function readonly() {
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Especifica que um campo de entrada deve ser preenchido antes de enviar o formulário
	 * @param string $required
	 * @return array
	 */
	public function required() {
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Especifica a largura, em caracteres, de um elemento &lt;input>
	 * @param number
	 * @return array
	 */
	public function size( $size ) {
		return self::$attributes[] = array( __FUNCTION__ => $size );
	}
	
	/**
	 * Especifica o URL da imagem para usar como um botão de envio (somente para type = "imagem")
	 * @param url
	 * @return array
	 */
	public function src( $src ) {
		return self::$attributes[] = array( __FUNCTION__ => $src );
	}
	
	/**
	 * Especifica os intervalos de número legal para um campo de entrada
	 * @param number
	 * @return array
	 */
	public function step( $step ) {
		return self::$attributes[] = array( __FUNCTION__ => $step );
	}
	
	/**
	 * Especifica o elemento &lt;input> tipo para exibir
	 * @param string $type
	 * @return boolean
	 * @tutorial 
	 * função destinada apenas a validar o tipo de dado
	 */
	public function type( $type ) {
		$inputType = array("button", "checkbox", "color", "date", "datetime", "datetime-local", "email", "file",
				"hidden", "image", "month", "number", "password", "radio", "range", "reset", "search", "submit", "tel",
				"text", "time", "url", "week");
		if( in_array( $type, $inputType ) ){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * Especifica o valor de um elemento &lt;input>
	 * @var string $value
	 * @return array
	 */
	public function value( $value ) {
		return self::$attributes[] = array( __FUNCTION__ => $value );
	}
	
	/**
	 * Especifica a largura de um elemento &lt;input> (apenas para type = "imagem")
	 * @var pixel $width
	 * @return array
	 */
	public function width( $width ) {
		return self::$attributes[] = array( __FUNCTION__ => $width );
	}
#------------------------------------------------------------------------	
	
	/**
	 * Função genérica type, substitui todas as demais, permite a criação
	 * dinâmica dos objetos input definidos no parametro
	 * @param string $type = "button", "color", "date", "datetime", "datetime-local", "email", "file",
			"hidden", "image", "month", "number", "password", "range", "reset", "search", "submit", "tel",
			"time", "url", "week"
	 * @param string $name
	 * @param string $value
	 * @return string
	 */
	public function add( $type, $name, $value ){
		$input  = '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" id="'.$name.'" ';
		$input .= $this->addAttributes();
		$input .= $this->addEvents();
		$input .= '>'.PHP_EOL;
		return $input;
	}#fim do método add
	
	/**
	 * Cria um campo input do tipo text
	 * @param string $name
	 * @param mixed $value
	 * @param integer $size
	 * @param integer $tabindex
	 * @param integer $maxlength
	 * @return string
	 */
	public function text( $name, $value, $size, $tabindex, $maxlength ){
		$text  = '<input type="text" name="'.$name.'" value="'.$value.'" id="'.$name.'" size="'.$size.'" tabindex="'.$tabindex.'" maxlength="'.$value.'" ';
		$text .= $this->addAttributes();
		$text .= $this->addEvents();
		$text .= '>'.PHP_EOL;
		return $text;
	}

#========================================================================
# CHECKBOX

	/**
	 * define uma caixa de seleção. Caixas permitem que um usuário selecione uma ou mais opções de um número limitado de opções.
	 * Os dados de entrada são compatíveis como fetchArray e fetchObject da classe PDO
	 * @param array $dados [array de dados para montagem do checkbox, compativel com o formato de dados da PDO]
	 * <li>formato: $dados = array(array("pk"=>"value1", "label"=>"value1"), array("pk"=>"value2", "label"=>"value2"));
	 * @param string $name [nome da caixa de opção]
	 * @param string $value [value - valor da caixa de opção (chave primária para dados oriundos do BD)]
	 * @param string $label [nome do campo visível ao usuário]
	 * @param number $colunas [numero de colunas para visualização do resultado]
	 * @param array $arrayChecked [array de elementos que serão marcados na caixa de seleção]
	 * @return string
	 */
	public function checkbox( array $dados, $name, $value, $label, $colunas = 1, $arrayChecked = array() ){
		# Contador de ID
		$contadorId = 1;
		
		# Contador de colunas da tabela
		$col = 1;
		
		$checkbox = '<table>';
		foreach( $dados as $vDados ){
		    # aceita um conjunto de dados na forma de objeto
		    if( is_object( $vDados )){
		        if( $col == 1 )
		            $checkbox .= '<tr>'.PHP_EOL;
		        
		        $checkbox .= '<td>';
		        $checkbox .= '<label for="'.$name.$contadorId.'">';
		        $checkbox .= '<input type="checkbox" name="'.$name.'[]" value="'.$vDados->__get($value).'" id="'.$name.$contadorId.'"';
		        $checkbox .= $this->addAttributes();
		        $checkbox .= $this->addEvents();
		        if( in_array($vDados->__get($value), $arrayChecked) ){
		            $checkbox .= ' checked';
		        }
		        $checkbox .= '>'.$vDados->__get($label).'</label>';
		        $contadorId++;
		        $checkbox .= '</td>'.PHP_EOL;
		        $col++;
		        if( $col > $colunas ){
		            $checkbox .= '</tr>'.PHP_EOL;
		            $col = 1;
		        }
		    }elseif(is_array( $vDados ) ){
		        if( $col == 1 )
				$checkbox .= '<tr>'.PHP_EOL;
				
    			$checkbox .= '<td>';
    			$checkbox .= '<label for="'.$name.$contadorId.'">';
    			$checkbox .= '<input type="checkbox" name="'.$name.'[]" value="'.$vDados[$value].'" id="'.$name.$contadorId.'"';
    			$checkbox .= $this->addAttributes();
    			$checkbox .= $this->addEvents();
    			if( in_array($vDados[$value], $arrayChecked) ){
    				$checkbox .= ' checked';
    			}
    			$checkbox .= '>'.$vDados[$label].'</label>';
    			$contadorId++;
    			$checkbox .= '</td>'.PHP_EOL;
    			$col++;
    			if( $col > $colunas ){
    				$checkbox .= '</tr>'.PHP_EOL;
    				$col = 1;
    			}
		    }
			
		}#fim do foreach
			
			if( ( $col <= $colunas ) && ( $col > 1 ) ){
				for( $i=$col; $i<=$colunas; $i++ ){
					$checkbox .= "<td></td>".PHP_EOL;
				}
				$checkbox .= "<tr>".PHP_EOL;
			}
			$checkbox .= '</table>'.PHP_EOL;
			return $checkbox;
	}#fim do método checkbox
#------------------------------------------------------------------------	

	/**
	 * Os botões de rádio permitem que o usuário selecione apenas um de um número limitado de opções
	 * @param array $dados
	 * <li>formato: $dados = array(array("pk"=>"value1", "label"=>"value1"), array("pk"=>"value2", "label"=>"value2"));
	 * @param string $name [nome do campo, único para todos os campos]
	 * @param string $value [índice do array que representa o valor do dado - chave primária]
	 * @param string $label [índice do array que representa o valor visível ao usuário]
	 * @param number $colunas [número de colunas em que o elemento será organizado]
	 * @param string $checked [indice do array ou chave primária a ser previamente selecionada no elemnto]
	 * @return string
	 */
	public function radio( array $dados, $name, $value, $label, $colunas = 1, $checked = null ){
		# Contador de colunas da tabela
		$col = 1;
		
		$radio  = '<table>';
		
		foreach( $dados as $vDados ){
		    
		    if( is_object( $vDados )){
    		    if( $col == 1 )
    		        $radio .= '<tr>'.PHP_EOL;
    		    	
    		    $radio .= '<td>';
    		    $radio .= '<label for="'.$vDados->__get($value).'">';
    		    $radio .= '<input type="radio" name="'.$name.'" value="'.$vDados->__get($value).'" id="'.$vDados->__get($value).'"';
    		    $radio .= $this->addAttributes();
    		    $radio .= $this->addEvents();
    		    if( $vDados->__get($value) == $checked ){
    		        $radio .= ' checked';
    		    }
    		    $radio .= '>'.$vDados->__get($label).'</label>';
    		    $radio .= '</td>'.PHP_EOL;
    		    $col++;
    		    if( $col > $colunas ){
    		        $radio .= '</tr>'.PHP_EOL;
    		        $col = 1;
    		    }
		    }elseif( is_array( $vDados ) ){
		        if( $col == 1 )
		            $radio .= '<tr>'.PHP_EOL;
		        	
		        $radio .= '<td>';
		        $radio .= '<label for="'.$vDados[$value].'">';
		        $radio .= '<input type="radio" name="'.$name.'" value="'.$vDados[$value].'" id="'.$vDados[$value].'"';
		        $radio .= $this->addAttributes();
		        $radio .= $this->addEvents();
		        if( $vDados[$value] == $checked ){
		            $radio .= ' checked';
		        }
		        $radio .= '>'.$vDados[$label].'</label>';
		        $radio .= '</td>'.PHP_EOL;
		        $col++;
		        if( $col > $colunas ){
		            $radio .= '</tr>'.PHP_EOL;
		            $col = 1;
		        }
		    }
		}
	   
		if( ( $col <= $colunas ) && ( $col > 1 ) ){
			for( $i=$col; $i<=$colunas; $i++ ){
				$radio .= "<td></td>".PHP_EOL;
			}
			$radio .= "<tr>".PHP_EOL;
		}
		$radio .= '</table>'.PHP_EOL;
		return $radio;
	}#fim do método rádio

}//fim da classe

?>













