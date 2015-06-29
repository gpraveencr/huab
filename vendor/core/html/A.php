<?php
namespace core\html;

class A{
	
	/**
	 * Specifies that the target will be downloaded when a user clicks on the hyperlink
	 * @param filename $download
	 * @return array
	 */
	public function download( $download ){
		return self::$attributes[] = array( __FUNCTION__ => $download );
	}
	
	/**
	 * Specifies the URL of the page the link goes to
	 * @param string $href
	 * @return array
	 */
	public function href( $href ){
		return self::$attributes[] = array( __FUNCTION__ => $href );
	}
	
	/**
	 * Specifies the language of the linked document
	 * @param language_code $hreflang
	 * @return array
	 */
	public function hreflang( $hreflang ){
		return self::$attributes[] = array( __FUNCTION__ => $hreflang );
	}
	
	/**
	 * 
	 * @param string $media
	 * @return array
	 */
	public function media( $media ){
		return self::$attributes[] = array( __FUNCTION__ => $media );
	}
	
	/**
	 * Specifies the relationship between the current document and the linked document
	 * @param string $rel
	 * valores aceitos
	 * <li> alternate
	 * <li> author
	 * <li> bookmark
	 * <li> help
	 * <li> license
	 * <li> next
	 * <li> nofollow
	 * <li> noreferrer
	 * <li> prefetch
	 * <li> prev
	 * <li> search
	 * <li> tag
	 * @return array
	 */
	public function rel( $rel ){
		return self::$attributes[] = array( __FUNCTION__ => $rel );
	}
	
	/**
	 * Specifies where to open the linked document
	 * @param string $target
	 * _blank
	 * _parent
	 * _self
	 * _top
	 * framename
	 * @return array
	 */
	public function target( $target ){
		return self::$attributes[] = array( __FUNCTION__ => $target );
	}
	
	/**
	 * Specifies the media type of the linked document
	 * @param media_type $type (ver: http://www.iana.org/assignments/media-types/media-types.xhtml)
	 * @return array
	 */
	public function type( $type ){
		return self::$attributes[] = array( __FUNCTION__ => $type );
	}
	
	/**
	 * Cria um objeto do tipo ancora
	 * @param string $download
	 * @return array
	 */
	public function add( $label, $href, $target ){
		$a  = '<a href="'.$href.'" target="'.$target.'" ';
		$a .= $this->addAttributes();//Adição de atributos
		$a .= $this->addEvents();//Adição de eventos
		$a .= '>'.$label."</a>";
		return $a;
	}
}

?>