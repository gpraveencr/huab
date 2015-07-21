<?php

namespace core\html;

class Html{

#========================================================================
# META INFO
#------------------------------------------------------------------------
	public static function doctype(){
		return "<DOCTYPE html>";
	}
	
	public static function title( $title ){
		return "<title> $title </title>";
	}
	
	public static function body(){
		return "";
	}
	
	public static function h(){
		return "";
	}
	
	public static function p(){
		return "";
	}
	
	public static function br(){
		return "";
	}
	
	public static function hr(){
		return "";
	}
#------------------------------------------------------------------------
	
#========================================================================
# FORMATING
	public static function abbr(){
		return "";
	}
	
	public static function address(){
		return "";
	}
	
	public static function b(){
		return "";
	}
	
	public static function bdi(){
		return "";
	}
	
	public static function bdo(){
		return "";
	}
	
	public static function blockquote(){
		return "";
	}
	
	public static function cite(){
		return "";
	}
	
	public static function code(){
		return "";
	}
	
	public static function del(){
		return "";
	}
	
	public static function dfn(){
		return "";
	}
	
	public static function em(){
		return "";
	}
	
	public static function i(){
		return "";
	}
	
	public static function ins(){
		return "";
	}
	
	public static function kdb(){
		return "";
	}
	
	public static function mark(){
		return "";
	}
	
	public static function meter(){
		return "";
	}
	
	public static function pre(){
		return "";
	}
	
	public static function progress(){
		return "";
	}
	
	public static function q(){
		return "";
	}
	
	public static function rp(){
		return "";
	}
	
	public static function rt(){
		return "";
	}
	
	public static function ruby(){
		return "";
	}
	
	public static function s(){
		return "";
	}
	
	public static function samp(){
		return "";
	}
	
	public static function small(){
		return "";
	}
	
	public static function strong(){
		return "";
	}
	
	public static function sub(){
		return "";
	}
	
	public static function time(){
		return "";
	}
	
	public static function u(){
		return "";
	}
	
	public static function _var(){
		return "";
	}
	
	public static function wbr(){
		return "";
	}
#------------------------------------------------------------------------	

#========================================================================
# FORMS AND INPUT

	public static function form(){
		return "";
	}
	
	public static function input(){
		return new Input();
	}
	
	public static function textarea(){
		return new Textarea();
	}
	
	public static function button(){
		return new Button();
	}
	
	public static function select(){
		return new Select();
	}
	
	public static function optgroup(){
		return "";
	}
	
	public static function option(){
		return "";
	}
	
	public static function label( $label, $for = "" ){
		return '<label for="'.$for.'">'.$label.'</label>';
	}
	
	public static function fildset(){
		return "";
	}
	
	public static function legend(){
		return "";
	}
	
	public static function datalist(){
		return "";
	}
	
	public static function keygen(){
		return "";
	}
	
	public static function output(){
		return "";
	}
#------------------------------------------------------------------------

#========================================================================
# FRAMES
	public static function iframe(){
		return "";
	}
#------------------------------------------------------------------------
	
#========================================================================
# IMAGES
	public static function img(){
		return "";
	}
	
	public static function map(){
		return "";
	}
	
	public static function area(){
		return "";
	}
	
	public static function canvas(){
		return "";
	}
	
	public static function figcaption(){
		return "";
	}
	
	public static function figure(){
		return "";
	}
#------------------------------------------------------------------------

#========================================================================
# ÁUDIO / VÍDEO
	public static function audio(){
		return "";
	}
	
	public static function source(){
		return "";
	}
	
	public static function track(){
		return "";
	}
	
	public static function video(){
		return "";
	}
#------------------------------------------------------------------------	

	
#========================================================================
# LINKS
	/**
	 * The <a> tag defines a hyperlink, which is used to link from one page to another.
	 * The most important attribute of the <a> element is the href attribute, which indicates the link's destination.
	 * attributes
	 * <li> download
	 * <li> hreflang
	 * <li> media
	 * <li> rel
	 * <li> type (ver: http://www.iana.org/assignments/media-types/media-types.xhtml)
	 * @param string $label
	 * @param url $href
	 * @param string $target (_blank, _parent, _self, _top, framename)
	 * @return string
	 */
	public static function a(){
		return $a = !isset( $a ) ? new \A() : $a;
	}
	
	public static function link(){
		return "";
	}
	
	public static function nav(){
		return "";
	}
#------------------------------------------------------------------------
	
#========================================================================
# LISTS
	public static function ul(){
		return "";
	}
	
	public static function ol(){
		return "";
	}
	
	public static function li(){
		return "";
	}
	
	public static function dl(){
		return "";
	}
	
	public static function dt(){
		return "";
	}
	
	public static function dd(){
		return "";
	}
	
	public static function menu(){
		return "";
	}
	
	public static function menuitem(){
		return "";
	}
#------------------------------------------------------------------------
	
#========================================================================
# TABLES
	public static function table(){
		return $table = !isset( $table ) ? new Table() : $table;
	}
	
	/* FUNÇÕES SUBSTITUIDAS PELA CLASSE TABLE
	public static function caption(){
		return "";
	}
	
	public static function th(){
		return "";
	}
	
	public static function tr(){
		return "";
	}
	
	public static function td(){
		return "";
	}
	
	public static function thead(){
		return "";
	}
	
	public static function tbody(){
		return "";
	}
	
	public static function tfoot(){
		return "";
	}
	
	public static function col(){
		return "";
	}
	
	public static function colgroup(){
		return "";
	}
	*/
#------------------------------------------------------------------------

	#========================================================================
	# STYLES AND SEMANTICS
	public static function style(){
		return "";
	}
	
	public static function div(){
		return "";
	}
	
	public static function span(){
		return "";
	}
	
	public static function header(){
		return "";
	}
	
	public static function footer(){
		return "";
	}
	
	public static function section(){
		return "";
	}
	
	public static function article(){
		return "";
	}
	
	public static function aside(){
		return "";
	}
	
	public static function details(){
		return "";
	}
	
	public static function dialog(){
		return "";
	}
	
	public static function summary(){
		return "";
	}
#------------------------------------------------------------------------
	

#========================================================================
# META INFO
	public static function head(){
		return "";
	}
	
	public static function meta(){
		return "";
	}
	
	public static function base(){
		return "";
	}
#------------------------------------------------------------------------	
	
#========================================================================
# PROGRAMMING
	public static function script(){
		return "";
	}
	
	public static function noscript(){
		return "";
	}
	
	public static function embed(){
		return "";
	}
	
	public static function object(){
		return "";
	}
	
	public static function param(){
		return "";
	}
#------------------------------------------------------------------------

}

?>