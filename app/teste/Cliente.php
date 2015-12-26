<?php
#CONTROLADOR
namespace app\teste;

class Cliente
{
    
    public function __construct( $action )
    {
        # é necessário validar o action da aplicação (importante)
        if( is_null( $action ) ){
            $this->main();
        }else{
            $this->$action();
        }
    }
    
    public function main()
    {
        echo "não foi definido valor para o action";    
    }
    
    public function frm()
    {
        echo " aqui fica o formulário de inserção de dados";
    }
    
    public function add()
    {
        
    }
    
    public function edt()
    {
        
    }
    
    public function rm()
    {
        
    }
    
    public function lista()
    {
        echo "aqui fica a lista de clientes cadastrados";
    }
    
    public function show()
    {
        
    }
}

?>