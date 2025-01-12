


<div class="boxLogin">


 
 
    <div class="box">

        
        
        <div class="logoLogin"> 

            <img  src="<?php echo BASE_URL;?>assets/imagens/logosemfundo.png">   
        </div>
        
        <?php 
        if(isset($mensagem)):
            if($mensagem == "Usuário ou senha incorretos!"):?>
        <div class="danger alinhamentoCentro"><?php echo $mensagem ;?></div>
        <?php endif;
        endif;
        ?>
        <br/>
           <form method="POST" id="login" action="<?php echo BASE_URL;?>Home/doLogin">
            <label class="rotulo">Login</label>
            <input class="campoTexto" type="email" name="login" autofocus>

            <label class="rotulo">Senha</label>
            <input id="senha" class="campoTexto" type="password" name="senha">

            <input id="mostraSenha" onclick="mostrarSenha()" type="checkbox"> <label class="labelAzulMaisClaro" for="mostraSenha"> Mostrar a senha</label>
              <br>
              <br>
            <input class="botao" type="submit" value="Entrar">
          
        </form>
        <br>
        <div style="width: 100%; text-align: right;">Versão 1.0 - beta</div>
       
   
</div>
