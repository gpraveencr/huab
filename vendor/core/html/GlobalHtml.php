<?php

namespace core\html;

/**
 * A classe abstrata GlobalHtml contém todos os atributos globais e eventos
 * compatíveis com os objetos html. Essa classe também possui os métodos para
 * a inserção desses atributos e eventos no corpo do objeto.
 * @author elson
 * @version 8 Set 14
 */
abstract class GlobalHtml{
	
	/**
	 * armazena os atributos da tag html
	 * @var array
	 */
	protected static $attributes = array();
	
	/**
	 * armazena os eventos das tags html
	 * @var array
	*/
	protected static $events = array();
	
	/**
	 * valida e adiciona os atributos na tag html
	 * @param string $browser
	 * @return array/null
	*/
	protected function addAttributes( $browser = null ){
		$output = null;
		foreach( self::$attributes as $kAttributes => $vAttributes ){
			foreach( $vAttributes as $kvAttributes => $vvAttributes )
				if( is_null( $vvAttributes ) ){
					$output .= ' '.$kvAttributes;
				}else{
					$output .= ' '.$kvAttributes.'="'.$vvAttributes.'"';
				}
		}
		self::$attributes = array(); #zera o aray de atributos na escrita do método
		return $output;
	}
	
	/**
	 * implementa o método para inserção de eventos
	 * nas tags html
	 * @param mixed $param
	 */
	protected function addEvents( $browser = null ){
		$output = null;
		foreach( self::$events as $kEvents => $vEvents ){
			foreach( $vEvents as $kvEvents => $vvEvents )
				$output .= ' '.$kvEvents.'="'.$vvEvents.'"';
		}
		self::$events = array(); #zera o aray de eventos na escrita do método
		return $output;
	}
	
	/**
	 * Método genérico para recuperar os atributos da classes HTML.
	 * Usado no modulo de construção automática de formulários.
	 * @param string $attribute
	 */
	public static function get( $attribute ){
		return self::${$attribute};
	}
	
	/**
	 * Método genérico para alterar o valor de um atributo das classes HTML.
	 * Usado no modulo de construção automática de formulários
	 * @param string $attribute
	 * @param string $value
	 */
	public static function set( $attribute, $value ){
		self::$attributes[] = array( $attribute => $value );
	}
	
#========================================================================
# GLOBAL ATRIBUTES
# Atributos aplicados a todos os elementos HTML
# http://www.w3schools.com/html5/html5_ref_globalattributes.asp
	
	/**
	 * Especifica uma tecla de atalho para ativar / focar um elemento
	 * <br/>valores aceitos: character
	 * @param string $accesskey
	 * @return array
	 */
	public function accesskey( $accesskey ){
		return self::$attributes[] = array( __FUNCTION__ => $accesskey );
	}
	
	/**
	 * Especifica um ou mais nomes de classes para um elemento (refere-se a uma classe em uma folha de estilo)
	 * <br/>valores aceitos: classname
	 * @param string $class
	 * @return array
	 */
	public function _class( $class ){
		return self::$attributes[] = array( __FUNCTION__ => $class );
	}
	
	/**
	 * Especifica se o conteúdo de um elemento é editável ou não
	 * <br/>valores aceitos:
	 * <li>true
	 * <li>false
	 * <li>inherit
	 * @param string
	 * @return array
	 * @version html5
	 */
	public function contenteditable( $contenteditable ){
		return self::$attributes[] = array( __FUNCTION__ => $contenteditable );
	}
	
	/**
	 * Especifica um menu de contexto para um elemento. O menu de contexto aparece quando um usuário clica com direito sobre o elemento
	 * <br/>valores aceitos:
	 * <li>ltr  Da esquerda para a direita direção do texto
	 * <li>rtl  Da direita para a esquerda direção do texto
	 * <li>auto Deixe a figura do navegador a direção do texto, com base no conteúdo (recomendada apenas se a direção do texto é desconhecido)
	 * @param string $contextmenu
	 * @return array
	 * @version html5
	 */
	public function contextmenu( $contextmenu ){
		return self::$attributes[] = array( __FUNCTION__ => $contextmenu );
	}
	
	/**
	 * Used to store custom data private to the page or application
	 * @param string $data
	 * @return NULL
	 * @version html5
	 */
	public function data( $data ){
		return null;
	}
	
	/**
	 * Especifica a direção de texto para o conteúdo de um elemento
	 * <br/>valores aceitos: menu_id
	 * @param string $dir
	 * @return array
	 */
	public function dir( $dir ){
		return self::$attributes[] = array( __FUNCTION__ => $dir );
	}
	
	/**
	 * Especifica se é um elemento arrastável ou não
	 * <br/>valores aceitos:
	 * <li>true [especifica que o elemento é arrastável]
	 * <li>false [especifica que o elemento não arrastável]
	 * <li>auto [usa o comportamento padrão do navegador]
	 * @param string $draggable
	 * @return array
	 * @version html5
	 */
	public function draggable( $draggable ){
		return self::$attributes[] = array( __FUNCTION__ => $draggable );
	}
	
	/**
	 * Especifica se os dados arrastado é copiado, movido ou ligados, quando caiu
	 * <br/>valores aceitos:
	 * <li>copy	[Soltando os dados resultará em uma cópia dos dados arrastados]
	 * <li>move	[Soltando os dados irão resultar em que os dados arrastado é movido para a nova localização]
	 * <li>link	[Soltando os dados resultará em um link para os dados originais]
	 * @param string $dropzone
	 * @return array
	 * @version html5
	 */
	public function dropzone( $dropzone ){
		return self::$attributes[] = array( __FUNCTION__ => $dropzone );
	}
	
	/**
	 * Especifica que um elemento não é ainda, ou já não é relevante
	 * <br/>valores aceitos: hidden
	 * @param string $hidden
	 * @return array
	 * @version html5
	 */
	public function hidden( $hidden ){
		return self::$attributes[] = array( __FUNCTION__ => $hidden );
	}
	
	/**
	 * Especifica um ID único para um elemento
	 * <br/>valores aceitos: id
	 * <p> [Especifica um id único para o elemento. Regras de nomenclatura:
	 * Deve conter pelo menos um caractere
	 * Não deve conter caracteres de espaço
	 * Em HTML, todos os valores são insensíveis ao caso]
	 * @param string $id
	 * @return array
	 */
	public function id( $id ){
		return self::$attributes[] = array( __FUNCTION__ => $id );
	}
	
	/**
	 * Especifica o idioma do conteúdo do elemento
	 * <br/>valores aceitos:language_code [Especifica o código de idioma para o conteúdo do elemento]
	 * @param string $lang
	 * @return array
	 */
	public function lang( $lang ){
		return self::$attributes[] = array( __FUNCTION__ => $lang );
	}
	
	/**
	 * Especifica se o elemento tem a sua ortografia e gramática marcada ou não
	 * <br/>valores aceitos:
	 * <li>true [O elemento de verdade tem a sua ortografia e gramática marcada]
	 * <li>false [O elemento falso não é para ser verificado]
	 * @param string $spellcheck
	 * @return array
	 * @version html5
	 */
	public function spellcheck( $spellcheck ){
		return self::$attributes[] = array( __FUNCTION__ => $spellcheck );
	}
	
	/**
	 * Especifica um estilo CSS inline para um elemento
	 * <br/>valores aceitos: style_definitions [uma ou mais propriedades CSS e valores separados por vírgula (por exemplo style = "color: blue; text-align: center")]
	 * @param string $style
	 * @return array
	 */
	public function style( $style ){
		return self::$attributes[] = array( __FUNCTION__ => $style );
	}
	
	/**
	 * Especifica a ordem de tabulação de um elemento
	 * <br/>valores aceitos: number [Especifica o número da ordem de tabulação do elemento (1 é em primeiro lugar)]
	 * @param string $tabindex
	 * @return array
	 */
	public function tabindex( $tabindex ){
		return self::$attributes[] = array( __FUNCTION__ => $tabindex );
	}
	
	/**
	 * Especifica informações adicionais sobre um elemento
	 * <br/>valores aceitos: text [Um texto dica de ferramenta para um elemento]
	 * @param string $title
	 * @return array
	 */
	public function title( $title ){
		return self::$attributes[] = array( __FUNCTION__ => $title );
	}
	
	/**
	 * Specifies whether the content of an element should be translated or not
	 * <br/>valores aceitos: yes/no
	 * @param string $translate
	 * @return NULL
	 * @version html5
	 */
	public function translate( $translate ){
		return null;
	}
#------------------------------------------------------------------------
	
#========================================================================
# GLOBAL EVENTS
#------------------------------------------------------------------------

#------------------------------------------------------------------------
#========================================================================
# WINDOW EVENT ATTIBUTES
# Events triggered for the window object (applies to the <body> tag)
	/**
	 * Script para ser executado depois que o documento é impresso
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onafterprint( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script script para ser executado antes de o documento é impresso
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onbeforeprint( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script to be run before the document is unloaded
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onbeforeunload( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando o documento foi alterado
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onhaschange( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * roteiro acionado depois que a página é terminar de carregar
	 * @param string $script
	 * @return array
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onload( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * script para ser executado quando a mensagem é acionado
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onmessage( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * script para ser executado quando o documento entra em modo offline
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onoffline( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * script para ser executado quando a janela está escondida
	 * @param unknown $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function ononline( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * script para ser executado quando o documento vem em linha
	 *
	 * @param string $script
	 * @example
	 *
	 */
	public function onpagehide( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * script para ser executado quando a janela torna-se visível
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onpageshow( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * script para ser executado quando as mudanças da janela de história
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onpopstate( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * script para ser executado quando o documento realiza uma redo
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onredo( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * roteiro é acionado quando a janela do navegador é redimensionada
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onresize( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * script para ser executado quando uma área de armazenamento na Web é atualizado
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onstorage( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * script para ser executado quando o documento realiza uma desfazer
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onundo( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );;
	}
	
	/**
	 * roteiro onunload dispara uma vez que uma página tenha descarregado (ou a janela do navegador foi fechado)
	 * @param string $script
	 * @return array
	 * @tutorial
	 * evento acionado para o objeto de janela (aplica-se a tag <body>)
	 */
	public function onunload( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
#------------------------------------------------------------------------	
#========================================================================
# FORM EVENTS
# Events triggered by actions inside a HTML form (applies to almost all HTML elements, but is most used in form elements)
# Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos os elementos HTML, mas é mais usado em elementos de formulário)
#------------------------------------------------------------------------
	/**
	 * Fires the moment that the element loses focus
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos <br>
	 * os elementos HTML, mas é mais usado em elementos de formulário)
	 */
	public function onblur( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Fires the moment when the value of the element is changed
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos <br>
	 * os elementos HTML, mas é mais usado em elementos de formulário)
	 */
	public function onchange( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script to be run when a context menu is triggered
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos <br>
	 * os elementos HTML, mas é mais usado em elementos de formulário)
	 */
	public function oncontextmenu( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	/**
	 * Fires the moment when the element gets focus
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos <br>
	 * os elementos HTML, mas é mais usado em elementos de formulário)
	 */
	public function onfocus( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script to be run when a form changes
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos <br>
	 * os elementos HTML, mas é mais usado em elementos de formulário)
	 */
	public function onformchange( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script to be run when a form gets user input
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos <br>
	 * os elementos HTML, mas é mais usado em elementos de formulário)
	 */
	public function onforminput( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script to be run when an element gets user input
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos <br>
	 * os elementos HTML, mas é mais usado em elementos de formulário)
	 */
	public function oninput( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script to be run when an element is invalid
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos <br>
	 * os elementos HTML, mas é mais usado em elementos de formulário)
	 */
	public function oninvalid( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Fires when the Reset button in a form is clicked
	 * (Not supported in HTML5)
	 * @return null
	 * @tutorial
	 * Not supported in HTML5
	 */
	public function onreset() {
		return null;
	}
	
	/**
	 * Fires after some text has been selected in an element
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos <br>
	 * os elementos HTML, mas é mais usado em elementos de formulário)
	 */
	public function onselect( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Fires when a form is submitted
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos desencadeadas por ações dentro de um formulário HTML (se aplica a quase todos <br>
	 * os elementos HTML, mas é mais usado em elementos de formulário)
	 */
	public function onsubmit( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
#------------------------------------------------------------------------
#========================================================================
# KEYBOARD EVENTS
#------------------------------------------------------------------------
	/**
	 * Acionado quando um usuário está pressionando uma tecla
	 * @param string $script
	 * @return array
	 * @tutorial
	 * keyboard events
	 */
	public function onkeydown( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Acionado quando um usuário pressiona uma tecla
	 * @param string $script
	 * @return array
	 * @tutorial
	 * keyboard events
	 */
	public function onkeypress( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Acionado quando um usuário solta uma tecla
	 * @param string $script
	 * @return array
	 * @tutorial
	 * keyboard events
	 */
	public function onkeyup( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
#------------------------------------------------------------------------
#========================================================================
# MOUSE EVENTS
# Eventos disparados por um mouse ou ações do usuário semelhantes
#------------------------------------------------------------------------
	/**
	 * dispara evento em um clique do mouse sobre o elemento
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function onclick( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Incêndios em um mouse clique duas vezes sobre o elemento
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function ondblclick( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando um elemento é arrastado
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function ondrag( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado no final de uma operação de arrasto
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function ondragend( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando um elemento foi arrastado para um destino de soltar válidas
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function ondragenter( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando um elemento deixa um destino de soltar válidas
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function ondragleave( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando um elemento está sendo arrastado sobre um destino de soltar válidas
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function ondragover( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado no início de operação de arrasto
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function ondragstart( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando o elemento arrastado está sendo descartado
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function ondrop( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Incêndios quando um botão do mouse é pressionado em um elemento
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function onmousedown( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Dispara quando o ponteiro do mouse se move sobre um elemento
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function onmousemove( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Dispara quando o ponteiro do mouse se move para fora de um elemento
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function onmouseout( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Dispara quando o ponteiro do mouse se move sobre um elemento
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function onmouseover( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Incêndios quando um botão do mouse é liberado sobre um elemento
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function onmouseup( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando a roda do mouse está sendo rodado
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function onmousewheel( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando um elemento da barra de rolagem está sendo rolada
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por um mouse ou ações do usuário semelhantes
	 */
	public function onscroll( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
#------------------------------------------------------------------------
#========================================================================
# MEDIA EVENTS
# Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a 
# todos os elementos HTML, mas é mais comum em elementos de mídia, como 
# <audio>, <embed>, <img>, <object> e <video>)

#------------------------------------------------------------------------
	/**
	 * Script para ser executado em abortar
	 * @param string $script
	 * @return array
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onabort( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando um arquivo está pronto para começar a jogar
	 * (quando tem amortecido o suficiente para começar)
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function oncanplay( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando um arquivo pode ser jogado por
	 * todo o caminho até o fim, sem parar para tamponamento
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function oncanplaythrough( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando o comprimento das mudanças de mídia
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function ondurationchange( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando algo de ruim acontece e é o arquivo
	 * de repente indisponíveis (como inesperadamente desconecta)
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onemptied( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando a mídia tem chegar ao fim (um evento útil para mensagens como "Obrigado por me ouvir")
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onended( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando um erro ocorre quando o arquivo está sendo carregado
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onerror( $script ){
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	
	/**
	 * Script para ser executado quando a mídia os dados são carregados
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onloadeddata( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * escrita	Script para ser executado quando os dados meta (como dimensões e duração) são carregados
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onloadedmetadata( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * escrita	Script para ser executado, assim como o arquivo começa a carregar antes de qualquer coisa é realmente carregado
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onloadstart( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando a mídia está em pausa ou pelo usuário ou programaticamente
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onpause( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando a mídia está pronto para começar a jogar
	 *
	 * @param string $script
	 * @example
	 *
	 */
	public function onplay( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando os meios de comunicação, na verdade, começou a ser reproduzido
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onplaying( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando o navegador está em processo de obtenção de dados de mídia
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onprogress( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado cada vez que as alterações na taxa de reprodução
	 * (como quando um usuário muda para um movimento lento ou modo de avanço rápido)
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>example
	 */
	public function onratechange( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado a cada vez que o estado pronto (o estado de pronto controla o estado dos dados de mídia)
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onreadystatechange( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando o atributo de busca é
	 * definido como falso indicando que a busca acabou
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onseeked( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando o atributo de busca é definido como true, indicando que a busca está ativo
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onseeking( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando o navegador é incapaz de buscar os dados de mídia para qualquer razão
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onstalled( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando a coleta de dados de mídia é
	 * interrompido antes que esteja completamente carregado por qualquer motivo
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onsuspend( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * Script para ser executado quando a posição de reprodução mudou
	 * (como quando o usuário avança rapidamente para um ponto diferente na mídia)
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function ontimeupdate( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * escrita	Script para ser executado cada vez que o volume é alterado que (inclui definir o volume para "mudo")
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onvolumechange( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
	
	/**
	 * escrita	Script para ser executado quando a mídia fez uma pausa, mas é
	 * esperado para retomar (como quando a mídia faz uma pausa para amortecer mais dados)
	 * @param string $script
	 * @return array
	 * @version html5
	 * @tutorial
	 * Eventos disparados por mídias como vídeos, imagens e áudio (aplica-se a <br>
	 * todos os elementos HTML, mas é mais comum em elementos de mídia, como <br>
	 * <audio>, <embed>, <img>, <object> e <video>) <br>
	 */
	public function onwaiting( $script ) {
		return self::$events[] = array( __FUNCTION__ => $script );
	}
#------------------------------------------------------------------------
	
}

?>