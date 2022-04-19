<?php

    namespace App\Controllers;

    //os recursos do miniframework
    use MF\Controller\Action;
    use MF\Model\Container;


    class AppController extends Action {
        public function timeline() {
            
            $this->validadeSession();

            $tweet = Container::getModel('Tweet');

            $tweet->__set('id_usuario', $_SESSION['id']);

            $tweets = $tweet->getAll();

            $this->view->tweets = $tweets;
            
            $this->render('timeline', 'layout');
        }

        public function tweet() {

            $this->validadeSession();
                
            $tweet = Container::getModel('Tweet');

            $tweet->__set('tweet',  $_POST['text_tweet']);
            $tweet->__set('id_usuario',  $_SESSION['id']);

            $tweet->salvar();

            header('Location: /timeline');
        }

        public function validadeSession() {

            session_start();

            if(
                !isset($_SESSION['id']) ||
                $_SESSION['id'] == '' ||
                !isset($_SESSION['nome']) ||
                $_SESSION['nome'] == ''
            ) {
                header('Location: /?login=erroSession');
            }
        }
    }

?>