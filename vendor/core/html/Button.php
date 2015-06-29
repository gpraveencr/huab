<?php

namespace core\html;

use \core\html\GlobalHtml;

class Button extends GlobalHtml{
	
	/**
	 * Specifies that a button should automatically get focus when the page loads
	 * @param boolean $autofocus
	 * @return string
	 */
	public function autofocus(){
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Specifies that a button should be disabled
	 * @param string $disabled
	 * @return array
	 */
	public function disabled(){
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Specifies one or more forms the button belongs to
	 * @param string $form
	 * @return array
	 */
	public function form( $form ){
		return self::$attributes[] = array( __FUNCTION__ => $form );
	}
	
	/**
	 * Specifies where to send the form-data when a form is submitted. Only for type="submit"
	 * @param string $formaction
	 * <li>application/x-www-form-urlencoded
	 * <li>multipart/form-data
	 * <li>text/plain
	 * @return array
	 */
	public function formaction( $formaction ){
		return self::$attributes[] = array( __FUNCTION__ => $formaction );
	}
	
	/**
	 * Specifies how form-data should be encoded before sending it to a server. Only for type="submit"
	 * @param string $fomenctype
	 * @return array
	 */
	public function fomenctype( $fomenctype ){
		return self::$attributes[] = array( __FUNCTION__ => $fomenctype );
	}
	
	/**
	 * Specifies how to send the form-data (which HTTP method to use). Only for type="submit"
	 * valores aceitos
	 * <li>get
	 * <li>post
	 * @param string $formmethod
	 * @return array
	 */
	public function formmethod( $formmethod ){
		return self::$attributes[] = array( __FUNCTION__ => $formmethod );
	}
	
	/**
	 * Specifies that the form-data should not be validated on submission. Only for type="submit"
	 * @param string $formnovalidate
	 * @return array
	 */
	public function formnovalidate( $formnovalidate ){
		return self::$attributes[] = array( __FUNCTION__ => $formnovalidate );
	}
	
	/**
	 * Specifies where to display the response after submitting the form. Only for type="submit"
	 * valores aceitos
	 * <li>_blank
	 * <li>_self
	 * <li>_parent
	 * <li>_top
	 * <li>framename
	 * @param string $formtarget
	 * @return array
	 */
	public function formtarget( $formtarget ){
		return self::$attributes[] = array( __FUNCTION__ => $formtarget );
	}
	
	/**
	 * Specifies a name for the button
	 * @param string $name
	 * @return array
	 */
	public function name( $name ){
		return self::$attributes[] = array( __FUNCTION__ => $name );
	}
	
	/**
	 * Specifies the type of button
	 * valores aceitos
	 * <li>button
	 * <li>reset
	 * <li>submit
	 * @param string $type
	 * @return array
	 */
	public function type( $type ){
		return self::$attributes[] = array( __FUNCTION__ => $type );
	}
	
	/**
	 * Specifies an initial value for the button
	 * @param string $value
	 * @return array
	 */
	public function value( $value ){
		return self::$attributes[] = array( __FUNCTION__ => $value );
	}

	/**
	 * Cria um objeto do tipo button
	 * @param string $name
	 * @param string $value
	 * @return string
	 */
	public function add( $name, $value ){
		$button  = '<button type="button" name="'.$name.'" ';
		$button .= $this->addAttributes();//Adição de atributos
		$button .= $this->addEvents();//Adição de eventos
		$button .= '>'.$value.'</button>'.PHP_EOL;//fechamento da tag
		return $button;
	}
}# fim da classe button

?>