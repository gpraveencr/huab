<?php

namespace core\html;

use \core\html\GlobalHtml;

class Table extends GlobalHtml{
    
    /**
     * Armazena todas as tags do objeto na forma de array
     * @var array
     */
    private $tag = array();
    
    /**
     * Armazena o número de colunas da tabela (necessário?)
     * @var integer
     */
    private $columns;
    
    private $startTable = false;
    /**
     * Variável de controle para o fechamento da tab table,
     * se valor falso a tag está em aberto e necessita
     * fechamento
     * @var boolean
     */
    private $endTable = false;
    
    /**
     * Variável de controle para abertura da tag tbody
     * se o atributo for falso, significa que a tab não foi aberta,
     * se a variável for verdadeira a tab já esta aberta.
     * @var boolean
     */
    private $startTbody = false;
    
    /**
     * Variável de controle para fechamento da tag tbody
     * se o atributo for falso, significa que a tag não foi fechada.
     * @var boolean
     */
    private $endTbody = false;
    
    /**
     * Armazena os atributos de uma determinada tag 
     * do objeto tabela, a chave indica a tag (thead, tbody e th)
     * ou o índice para a tag td/th, o valor indica o atributo e o valor 
     * na forma de array chave => valor
     * @var array
     */
    private $atributos = array();
    
    /**
     * Armazena os eventos de uma determinada tag
     * do objeto tabela, a chave indica a tag (thead, tbody e tr)
     * ou o índice para a tag td/th, o valor indica o evento e a ação
     * na forma de array chave => valor (evento => ação)
     * @var array
     */
    private $eventos = array();
    
    /**
     * TODO refatorar o código e definir atributos e eventos da tabela;
     */
    public function __construct()
    {
        #abertura da tag <table>
        $table  = '<table ';

        $table .= '>';
        $this->addTag( $table );
    }
    
    /**
     * Método para adicionar valores ao cabeçalho da tabela.
     * Só pode haver um cabeçalho por tabela, chamada obrigatória
     * @param array $row
     * @example array(id, nome, cpf)
     */
    public function head( array $row ){
        # número de colunas da tabela
        $this->columns = count( $row );
        
        /*
        #abertura da tag <table>
        if( !$this->startTable ){
            $table  = '<table ';
            $table .= $this->atributos( "table" );
            $table .= $this->eventos( "table" );
            $table .= '>';
            $this->addTag( $table );
            $this->startTable = true;
        }
        */
        
        $head  = '<thead ';
        $head .= $this->atributos( "thead" );
        $head .= $this->eventos( "thead" );
        $head .= '>';
        $this->addTag( $head );
        
        $tr  = '<tr';
        $tr .= $this->atributos( "tr" );
        $tr .= $this->eventos( "tr" );
        $tr .= '>';
        $this->addTag( $tr );
        
        $contador = 1;
        foreach( $row as $column ){
            $th  = '<th';
            $th .= $this->atributos( "th", $contador );
            $th .= $this->eventos( "th", $contador );
            $th .= '>';
            $th .= $column;
            $th .= '</th>';
            $this->addTag( $th );
            
            $contador += 1;
        }
        
        $this->addTag('</tr>');
        $this->addTag('</thead>');
        $this->atributos = array();//reseta os atributos
        $this->eventos = array();//reseta os eventos
    }
    
    /**
     * Método para adicionar linhas ao corpo da tabela.
     * Cada chamada ao método adiciona uma linha
     * @param array $rows
     * @example array( 1, Elson Vinicius, 123.456.789-00);
     */
    public function body( array $rows ){
        
        if( !$this->startTbody ){
            $tbody  = '<tbody';
            $tbody .= $this->atributos( "tbody" );
            $tbody .= $this->eventos( "tbody" );
            $tbody .= '>';
            $this->addTag( $tbody );
            $this->startTbody = true;
        }
        
        $tr = '<tr';
        $tr .= $this->atributos( "tr" );
        $tr .= $this->eventos( "tr" );
        $tr .= '>';
        $this->addTag( $tr );
        
        $contador = 1;
        foreach( $rows as $column ){
            $td = '<td';
            $td .= $this->atributos( "td", $contador );
            $td .= $this->eventos( "td", $contador );
            $td .= '>';
            $td .= $column;
            $td .= '</td>';
            $this->addTag( $td );
        
            $contador += 1;
        }
        
        $this->addTag('</tr>');
        $this->atributos = array();//reseta os atributos
        $this->eventos = array();//reseta os eventos
    }
    
    /**
     * Método para adicionar um rodape ao objeto tabela.
     * Não é obrigatório.
     * @param array $row
     * @example array(col1, col2, col3)
     */
    public function foot( array $row ){
        
        if( !$this->endTbody ){
            $this->addTag('</tbody>');
            $this->endTbody = true;
        }
        
        # abertura da tag thead
        $tfoot  = '<tfoot';
        $tfoot .= $this->atributos( "tfoot" );
        $tfoot .= $this->eventos( "tfoot" );
        $tfoot .= '>';
        $this->addTag( $tfoot );
        
        $tr = '<tr';
        $tr .= $this->atributos( "tr" );
        $tr .= $this->eventos( "tr" );
        $tr .= '>';
        $this->addTag( $tr );
        
        $contador = 1;
        foreach( $row as $column ){
            $td = '<td';
            $td .= $this->atributos( "td", $contador );
            $td .= $this->eventos( "td", $contador );
            $td .= '>';
            $td .= $column;
            $td .= '</td>';
            $this->addTag( $td );
        
            $contador += 1;
        }
        
        $this->addTag('</tr>');
        $this->addTag('</tfoot>');
        $this->atributos = array();//reseta os atributos
        $this->eventos = array();//reseta os eventos
    }
    
    /**
     * Método para adicionar atributos as tags do objeto tabela.
     * @param string $tag - tags da tabela que podem receber atributos
     * &lt;table>
     * &lt;thead>
     * &lt;tbody>
     * &lt;tfoot>
     * &lt;tr>
     * &lt;th>
     * &lt;td>
     * @param array $atributo
     * @param $coluna - para as tags th e td especificar qual coluna que
     * receberá o atributo
     * @example Ex. para as tags thead, tbody e tr
     * <li>array('thead'=>array('id'=>'thead', 'class'=>'classHead');
     * <li>array('tbody'=>array('id'=>'tbody', 'class'=>'classTbody');
     * <li>array('tr'=>array('id'=>'tr', 'class'=>'classtr');
     * @example Ex. para as tags td e th (usar o ídnce da coluna como tag)
     * <li>array(2=>array('id'=>'coluna2', 'class'=>'classColuna2');
     */
    public function addAtributos( $tag, array $atributo, $coluna = null ){
        $atributo["coluna"] = $coluna;
        $this->atributos[$tag] = $atributo;
    }
    
    /**
     * Método para adicionar eventos as tags do objeto tabela.
     * @param string $tag
     * @param array $evento
     * @example para as tags thead, tbody e th
     * <li>array("thead"'=>array("'onclick"=>"alert('thead')", "onkeyup"'=>"alert('onkeyup')");
     * <li>array("tbody"=>array("onclick"=>"alert('tbody')", "onkeyup"=>"alert('onkeyup')");
     * <li>array("th"=>array("onclick"=>"alert('th')", "onkeyup"=>"alert('onkeyup')");
     * @example Ex. para as tags td (usar o ídnce da coluna como tag)
     * <li>array(2=>array("onclick"=>"alert('td e th')", "onkeyup"=>"alert('onkeyup')");
     */
    public function addEventos( $tag, array $evento, $coluna = null ){
        $evento["coluna"] = $coluna;
        $this->eventos[$tag] = $evento;
    }
    
    /**
     * Método para recuperar o objeto tabela
     * @return string
     */
    public function getTable(){
    
        if( !$this->endTbody )
            $this->addTag('</tbody>');
    
        if( !$this->endTable )
            $this->addTag('</table>');
    
        return implode(" ", $this->tag );
    }
    
    /**
     * Método para formatar os atributos de uma tag, encapsula
     * a rotina que se repete em todas as fases.
     * @param string $tag -- tag do objeto table que receberá o atributo
     * @param string $thtd -- recebe os valores th ou td para validação de atributos exclusivos
     * @return string
     */
    private function atributos( $tag, $contador = -1 ){
        
        $output = null;
        
        if ( key_exists( $tag, $this->atributos) ){
            
            $colunaAtributo = (int) $this->atributos[$tag]['coluna'];
            
            foreach( $this->atributos[$tag] as $atributo => $valor ){
                
                if( method_exists( $this, $atributo ) or ( $atributo == "class" ) ){
                    if( $tag == "th" or $tag == "td" ){
                        if( $colunaAtributo == $contador ){
                            if( is_null( $valor ) ){
                                $output .= ' '.$atributo;
                            }else{
                                $output .= ' '.$atributo.'="'.$valor.'"';
                            }
                        }
                    }else{
                        if( is_null( $valor ) ){
                            $output .= ' '.$atributo;
                        }else{
                            $output .= ' '.$atributo.'="'.$valor.'"';
                        }
                    }
                    
                }else{
                    # conjunto de atributos exclusivos da tag th
                    if( ( $tag == "th" ) and ( in_array( $atributo, array('abbr','colspan','headers','rowspan','scope','cell','sorted') ) ) ){
                        if( $colunaAtributo == $contador ){
                            if( is_null( $valor ) ){
                                $output .= ' '.$atributo;
                            }else{
                                $output .= ' '.$atributo.'="'.$valor.'"';
                            }
                        }
                    }
                    
                    # conjunto de atributos exclusivos da tag 
                    if( ( $tag == "td" ) and ( in_array( $atributo, array('colspan','headers') ) ) ){
                        if( $colunaAtributo == $contador ){
                            if( is_null( $valor ) ){
                                $output .= ' '.$atributo;
                            }else{
                                $output .= ' '.$atributo.'="'.$valor.'"';
                            }
                        }
                    }#if
                }#else
                    
            }#foreach
        }#if
        return $output;
    }#atributos
    
    /**
     * Método para formatar os atributos de uma tag, encapsula
     * a rotina que se repete em todas as fases.
     * @param string $tag
     * @return string
     */
    private function eventos( $tag, $contador = -1 ){
        $output = null;
        if ( key_exists( $tag, $this->eventos ) ){
            
            $colunaAtributo = (int) $this->eventos[$tag]['coluna'];
        
            foreach( $this->eventos[$tag] as $evento => $acao ){
                if( method_exists( $this, $evento ) ){
                    if( $tag == "th" or $tag == "td" ){
                        if( $colunaAtributo == $contador )
                            $output .= ' '.$evento.'="'.$acao.'"';
                    }else{
                        $output .= ' '.$evento.'="'.$acao.'"';
                    }
                }
                    
            }
        }    
        return $output;
    }#eventos
    
    
    /**
     * Armazena todas as tags para construção da tabela
     * no template
     * @param string $tag
     */
    private function addTag( $tag ){
        $this->tag[] = $this->tab($tag).$tag.$this->newline();
    }
    
    /**
     * Formata a tabulação da tabela
     * @param string $tag
     * @return string
     */
    private function tab( $tag ){
        if( strpos( $tag, "table" ) ){
            return "\t";
        }
    
        if( strpos( $tag, "thead" ) ){
            return "\t\t";
        }
    
        if( strpos( $tag, "tbody" ) ){
            return "\t\t";
        }
    
        if( strpos( $tag, "tfoot" ) ){
            return "\t\t";
        }
    
        if( strpos( $tag, "tr" ) ){
            return "\t\t\t";
        }
    
        if( strpos( $tag, "th" ) ){
            return "\t\t\t\t";
        }
    
        if( strpos( $tag, "td" ) ){
            return "\t\t\t\t";
        }
    }
    
    /**
     * Método para adicionar uma nova linha
     * as tags da tabela
     * @return string
     */
    private function newline(){
        return "\n";
    }
}

#############################################################
		################ EXEMPLO ################
#############################################################
/*
$table = new table();

#deve ser colocado antes da tag head
$table->addAtributos('table', array('class'=>'tableclass'));

$table->addEventos("th", array("onclick"=>"alert('mouse sobre o nome')"), 1);
$table->addAtributos('th', array('id'=>'nome', 'class'=>'color'), 2);
$table->head(array('codigo','nome','idade'));

$table->addAtributos('tbody', array('id'=>'tbody', 'class'=>'color'));

$table->body(array('1','Elson','38'));

$table->addAtributos('tr', array('id'=>'idrow', 'class'=>'rowclass'));

$table->body(array('2','Renata','28'));

$table->addAtributos('td', array('colspan'=>'2'), 2);

$table->addEventos("td", array("onclick"=>"alert('VInicius')"), 2);

$table->body(array('3','Vinicius','8'));

$table->addEventos("td", array("onclick"=>"alert('foot')"), 3);
$table->foot(array('col1','col2','col3'));

echo $table->getTable();
*/
?>