<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<script type="text/javascript">
    $('li').eq(8).addClass('stiloFixoSubmenu');
    $('li').eq(3).addClass('stiloFixo');
    $("#submenuCadastros").fadeToggle("slow");
</script>
<br>
<br>
<br>
<section class="planosTotal">

    <div class="margem">


        <div class="conteudo">


            <?php if (isset($mensagem) == "Atualizado com sucesso!" || isset($mensagem) == "Deletado com sucesso!") : ?>
                <div class="success alinhamentoCentro"><?php echo $mensagem; ?></div>
            <?php elseif (isset($mensagem) == "Não foi possível atualizar!" || isset($mensagem) == "Não foi possivel deletar!") : ?>
                <div class="danger alinhamentoCentro"><?php echo $mensagem; ?></div>
            <?php endif; ?>
            <br />
        </div>

        <h1 class="estiloBorda"> Atualização de Vendedores</h1>



        <?php


        use \Models\Vendedor;

        $venda = new Vendedor();
        $vendedor = $venda->getVendedorById($id);



        ?>
        <form method="POST" action="<?php echo BASE_URL; ?>Vendedores/atualizarVendedor">

            <input type="hidden" value="<?php echo $vendedor['idVendedores']; ?>" name="id"><br />
            <label class="rotulo">Nome do vendedor</label><br>
            <input class="campoTexto" type="text" name="nomeVendedor" value="<?php echo $vendedor['nomeVendedores']; ?>" required />


            <label class="rotulo">E-mail</label><br>
            <input class="campoTexto" type="email" name="emailVendedor" value="<?php echo $vendedor['emailVendedores']; ?>" required />

            <label class="rotulo">Telefone</label><br>
            <input id="telefoneAtual" class="campoTexto" type="tel" name="telefoneVendedor" value="<?php echo $vendedor['telefoneVendedores']; ?>" required />
            <script>
                $("#telefoneAtual").mask("(99) 99999-9999");
            </script>

            <input class="botao" type="submit" value="Salvar" />
        </form>


    </div>


</section>