<?php 
    class Mensagem {
        private $para = null;
        private $assunto = null;
        private $mensagem = null;

        public function __get($name)
        {
            return $this->$name;
        }

        public function __set($name, $value)
        {
            $this->$name = $value;
        }

        public function mensagemValida(){
            if(empty($this->para) or empty($this->assunto) or empty($this->mensagem)){
                return false;
            }

            return true;
        }

    }

    $mensagem = new Mensagem();

    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    if ($mensagem->mensagemValida()){
        echo 'Mensagem válida';
    }else{
        echo 'Mensagem inválida';
    }
?>