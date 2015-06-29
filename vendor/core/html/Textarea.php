<?php

namespace core\html;

use \core\html\GlobalHtml;

/*
 * - Deve haver alguns parametros obrigatorios na assinatura da funcao
 * - os parametros opcionais devem estar no formato de array: a classe verifica se o parametro existe, se
 * o valor esta correto (compara com os valores default se existirem) e coloca o atributo no objeto.
 * @author elson
 * @version 6 set 14
 */
class Textarea extends GlobalHtml{

	/**
	 * Specifies that a text area should automatically get focus when the page loads
	 * @return array
	 * @version html5
	 */
	public function autofocus(){
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Specifies the visible width of a text area
	 * @param integer $cols
	 * @return array
	 */
	public function cols( $cols ){
		return self::$attributes[] = array( __FUNCTION__ => $cols );
	}
	
	/**
	 * Specifies that a text area should be disabled
	 * @return array
	 */
	public function disabled(){
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Specifies one or more forms the text area belongs to
	 * @param string $form
	 * @return array
	 * @version html5
	 */
	public function form( $form ){
		return self::$attributes[] = array( __FUNCTION__ => $form );
	}
	
	/**
	 * Specifies the maximum number of characters allowed in the text area
	 * @param integer $maxlength
	 * @return array
	 * @version html5
	 */
	public function maxlength( $maxlength ){
		return self::$attributes[] = array( __FUNCTION__ => $maxlength );
	}
	
	/**
	 * Specifies a name for a text area
	 * @param string $name
	 * @return array
	 */
	public function name( $name ){
		return self::$attributes[] = array( __FUNCTION__ => $name );
	}
	
	/**
	 * Specifies a short hint that describes the expected value of a text area
	 * @param string $placeholder
	 * @return array
	 * @version html5
	 */
	public function placeholder( $placeholder ){
		return self::$attributes[] = array( __FUNCTION__ => $placeholder );
	}
	
	/**
	 * Specifies that a text area should be read-only
	 * @return array
	 */
	public function readonly(){
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Specifies that a text area is required/must be filled out
	 * @return array
	 * @version html5
	 */
	public function required(){
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Specifies the visible number of lines in a text area
	 * @var integer
	 * @return array
	 */
	public function rows( $rows ){
		return self::$attributes[] = array( __FUNCTION__ => $rows );
	}

	/**
	 * Especifica como o texto em uma área de texto deve ser ajustada quando apresentado de forma
	 * <br/>aceita os valores: soft/hard
	 * <li>soft: O texto no textarea não é ajustada quando apresentado em um formulário. Este é o padrão.
	 * <li>hard: O texto no textarea é envolvido (contém novas linhas), quando apresentado em um formulário. 
	 * Quando "hard" é usado, o atributo cols deve ser especificado
	 * @param string $wrap
	 * @return array
	 * @version html5
	 */
	public function wrap( $wrap ){
		return self::$attributes[] = array( __FUNCTION__ => $wrap );
	}

#========================================================================
# FUNÇÃO PRINCIPAL
	/**
	 * @param string $name
	 * @param integer $cols
	 * @param integer $rows
	 * @param mixed $value
	 * @return string
	 */
	public function add( $name, $cols, $rows, $value ){
		$textarea  = '<textarea name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'"';
		$textarea .= $this->addAttributes();
		$textarea .= $this->addEvents();
		$textarea .= '>'.$value.'</textarea>'.PHP_EOL;
		return $textarea;
	}
#------------------------------------------------------------------------
}# fim da classe

?>