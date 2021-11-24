<?php

    Class PostController{

        public function index($params){

            try {
                
                $post = Postagem::selecionaPorId($params); //seleciona os comentarios pelo id no banco de dados

                $loader = new \Twig\Loader\FilesystemLoader('mvc/view');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('postagem.html');

                $parametro = array();
                $parametro['id'] = $post->id_post; //sorry essa parte nao lembro kkk

                $parametro['titulo'] = $post->titulo;

                $parametro['conteudo'] = $post->conteudo;

                $parametro['comentario'] = $post->comentario;


                $conteudo = $template->render($parametro);
                echo $conteudo;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            
        }

        public function addComent(){ //funcao para adicionar um momentario no banco de dados

            try {
                
                Comentario::inserir($_POST); //chama o metodo inserir na model comentario
                echo '<script>alert("Comentario adicionado com sucesso!! :)");</script>'; //se estiver tudo ok ele mostra a msg de sucesso

                echo '<script>location.href="http://localhost/startbootstrap-sb-admin-2-master/post/index/'.$_POST['id'].'"</script>'; //e redireciona para a pagina postagem.html a postagem selecionada e o comentario relacionado a ela(caso exista)



            } catch (Exception $e) { //se nao 
                
                echo '<script>alert("'.$e->getMessage().'");</script>'; //ele pega o erro e armazena na variavel $e->getMessage e mostra pro usuario

                echo '<script>location.href="http://localhost/startbootstrap-sb-admin-2-master/home"</script>'; //e redireciona pra pagina dos posts

            }

        }

    }

?>