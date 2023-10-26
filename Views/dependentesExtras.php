<script type="text/javascript">
    $('li').eq(1).addClass('stiloFixo');
    $('li').eq(2).addClass('stiloFixoSubmenu');
    $("#submenuConfiguracoes").fadeToggle("slow");
</script>

<div class="margem">

    <br>
    <br>




    <?php
  
    use Models\DependentesExtras;

    if (isset($mensagem)) :

        if ($mensagem == "Dependente extras configurado com sucesso!" || $mensagem == "Dependentes extras atualizado com suceso!") :


    ?>

            <div class="success alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Erro ao cadastrar dependentes extras!" || $mensagem = "Erro ao  atualizar dependentes extras!") :


        ?>


            <div class="danger alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Erro ao cadastrar dependentes extras!" || $mensagem = "Erro ao  atualizar dependentes extras!") :

        ?>
            <div class="warning alinhamentoCentro"><?php echo $mensagem; ?> </div>
    <?php endif;
    endif;
    ?>



<?php
$dependenteExtra = new DependentesExtras();
$dependenteExtraArray = $dependenteExtra->getAllDependentesExtras();

//print_r($dependenteExtraArray);
?>

  

<?php
    if(!isset($dependenteExtraArray)):


    ?>


  <!--Configuração de dependentes extras-->
  <h1 class="estiloBorda">Configuração de Dependentes Extras</h1>
    <br />
    <br />
    <br />
    <br />

    <form id="configurarDependentesExtras" method="POST" action="<?php echo BASE_URL;?>DependentesExtras/cadastrar">

   

    <label class="rotulo">Quantidade máxima de dependentes</label>
    <input form="configurarDependentesExtras" class="campoTexto" type="text" name="quantidadeMaxima">

    <label class="rotulo">Preço por dependentes extras</label>
    <input form="configurarDependentesExtras" class="campoTexto" type="text" name="preco" id="preco">
    <script>


    //$('.dinheiro').mask('#.##0,00', {reverse: true});
    $('#preco').mask('#.##0,00',{reverse:true});
    
    </script>

    <input form="configurarDependentesExtras" type="submit" class="botao" value="Configurar">


    </form>


<?php 

    else:




?>



      <!--Configuração de dependentes extras-->
      <h1 class="estiloBorda">Atualizar Configuração de Dependentes Extras</h1>
    <br />
    <br />
    <br />
    <br />

    

    <form id="atualizarDependentesExtras" method="POST" action="<?php echo BASE_URL;?>DependentesExtras/atualizar">

  

    <label class="rotulo">Quantidade máxima de dependentes</label>


    <input type="hidden" name="idDependenteExtra"  value="<?php echo $dependenteExtraArray[0]['iddependenteExtra'];?>">
    <input form="atualizarDependentesExtras" class="campoTexto" type="text" name="quantidadeMaximaAtualizar" value="<?php echo $dependenteExtraArray[0]['quatidadeMaxima'];?>"/>

    <label class="rotulo">Preço por dependentes extras</label>
    <input form="atualizarDependentesExtras" class="campoTexto" type="text" name="precoAtualizar" id="precoAtualizar" value="<?php echo $dependenteExtraArray[0]['valor'];?>">
    <script>


    //$('.dinheiro').mask('#.##0,00', {reverse: true});
    $('#precoAtualizar').mask('#.##0,00',{reverse:true});
    
    </script>

    <input form="atualizarDependentesExtras" type="submit" class="botao" value="Atualizar Configuração">


    </form>
    

<?php 


    endif;
?>


</div>