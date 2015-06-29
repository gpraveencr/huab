<?php

namespace core\html;

/*
 * Classe para implementar o elemnto select do html
 * @version 6 Set 14
 */
 
use \core\html\GlobalHtml;

class Select extends GlobalHtml{
	
	/**
	 * Specifies that the drop-down list should automatically get focus when the page loads
	 * @return array
	 */
	public function autofocus(){
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Specifies that a drop-down list should be disabled
	 * <br/>valores aceitos: disabled
	 * @return array
	 */
	public function disabled() {
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Defines one or more forms the select field belongs to
	 * <br/>valores aceitos: form id
	 * @param string $form
	 * @return array
	 */
	public function form( $form ) {
		return self::$attributes[] = array( __FUNCTION__ => $form );
	}
	
	/**
	 * Specifies that multiple options can be selected at once
	 * @param $multiple = "multiple" 
	 * @return array
	 */
	public function multiple( $multiple = "multiple" ) {
		return self::$attributes[] = array( __FUNCTION__ => $multiple );
	}
	
	/**
	 * Defines a name for the drop-down list
	 * @param string $name
	 * @return array
	 */
	public function name( $name ) {
		return self::$attributes[] = array( __FUNCTION__ => $name );
	}
	
	/**
	 * Specifies that the user is required to select a value before submitting the form
	 * @param string $required
	 * @return array
	 */
	public function required() {
		return self::$attributes[] = array( __FUNCTION__ => null );
	}
	
	/**
	 * Defines the number of visible options in a drop-down list
	 * @param number
	 * @return array
	 */
	public function size( $size ) {
		return self::$attributes[] = array( __FUNCTION__ => $size );
	}

	/**
	 * método para criar uma caixa de seleção. Aceita dados tipo array resultantes
	 * de uma consulta PDO ou no formato estabelecido no exemplo.
	 * @param string $name
	 * @param array $value
	 * <li>opção sem optgroup
	 * <li>$option[] = array( array( 0 => "fiat", 1 => "Siena"), array(0 => "ford", 1 => "Fiesta"));
	 * <li>$option2[][] = array(0 => "fiat", 1 => "Siena");
	 * <li>$option2[][] = array(0 => "ford", 1 => "Fiesta");
	 * <li>opção com optgroup
	 * <li>optgroup['nacional'] = array( array("ford","Fiesta"), array("fiat","Idea")); ou
	 * <li>$optgroup2['nacional'][] = array(0 => "ford", 1 => "Fiesta");
	 * <li>$optgroup2['nacional'][] = array(0 => "fiat", 1 => "Idea");
	 * @param array $selected
	 * @return string
	 * @tutorial
	 * <li>o tamanho máximo da string mostrada é de 50 caracteres
	 */
	public function add( $name, array $dados, $value, $label, $texto_inicial = null,  $selected = array() ){
		$select  = '<select name="'.$name.'"';//abertura da tag
		$select .= $this->addAttributes();//Adição de atributos
		$select .= $this->addEvents();//Adição de eventos
		$select .= '>'.PHP_EOL;//fechamento da tag
		
		$select .= !is_null( $texto_inicial ) ? '<option value="">'.$texto_inicial.'</option>' : '<option value="">Selecione</option>';
		
        foreach ( $dados as $optgroup => $atributos ){
            
            # nível 1: aqui é definido o optgroup
            if( !is_integer( $optgroup ) )
                $select .= '<optgroup label="'.$optgroup.'">'.PHP_EOL;//abertura do optgroup
            
            foreach( $atributos as $kAtributos => $vAtributos ){
                
                $select .= '<option value="'.$vAtributos[$value].'"';//abertura do option e definiçãodo valor
                if( in_array( $vAtributos[$value], $selected ) ){
                    $select .= ' selected';//verificação dos elementos pré-selecionados
                }
                $select .= strlen( $vAtributos[$label] ) > 50 ? '>'.substr( $vAtributos[$label], 0, 47 ).'(...)'.'</option>'.PHP_EOL : '>'.$vAtributos[$label].'</option>'.PHP_EOL;
                
            }
            
            if( !is_integer( $optgroup ) )
                $select .= '</optgroup>'.PHP_EOL;//fechamento do optgroup
            
        }
        
        $select .= '</select>'.PHP_EOL;//fechamento da tag select
        return $select;
	}#add
	
}# fim da classe select

?>