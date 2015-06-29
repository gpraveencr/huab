<?php

namespace core\html;

use \core\html\GlobalHtml;

class Img extends GlobalHtml{

	public function align( $align ){
		return self::$attributes[] = array( __FUNCTION__ => $align );
	}
	
	public function alt( $alt ){
		return self::$attributes[] = array( __FUNCTION__ => $alt );
	}
	
	public function border( $border ){
		return self::$attributes[] = array( __FUNCTION__ => $border );
	}
	
	public function crossorigin( $crossorigin ){
		return self::$attributes[] = array( __FUNCTION__ => $crossorigin );
	}
	
	public function height( $height ){
		return self::$attributes[] = array( __FUNCTION__ => $height );
	}
	
	public function hspace( $hspace ){
		return self::$attributes[] = array( __FUNCTION__ => $hspace );
	}
	
	public function ismap( $ismap ){
		return self::$attributes[] = array( __FUNCTION__ => $ismap );
	}
	
	public function longdesc( $longdesc ){
		return self::$attributes[] = array( __FUNCTION__ => $longdesc );
	}
	public function src( $src ){
		return self::$attributes[] = array( __FUNCTION__ => $src );
	}
	
	public function usemap( $usemap ){
		return self::$attributes[] = array( __FUNCTION__ => $usemap );
	}
	public function vspace( $vspace ){
		return self::$attributes[] = array( __FUNCTION__ => $vspace );
	}
	
	public function width( $width ){
		return self::$attributes[] = array( __FUNCTION__ => $width );
	}
	
	public function add( $name, $src, $alt ){
		$img  = '<img src="'.$src.'" name="'.$name.'" alt="'.$alt.'"';
		$img .= $this->addAttributes();//Adição de atributos
		$img .= $this->addEvents();//Adição de eventos
		$img .= '>'.PHP_EOL;//fechamento da tag
		return $img;
	}
}# fim da classe button

?>