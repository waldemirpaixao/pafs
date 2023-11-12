<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<script type="text/javascript">
    $('li').eq(6).addClass('stiloFixoSubmenu');
    $('li').eq(3).addClass('stiloFixo');
    $("#submenuCadastros").fadeToggle("slow");
</script>


<div class="margem">





    <?php

    use Models\Clientes;
    use \Models\Dependentes;

    $dependente = new Dependentes();
    $dependentes = $dependente->getDependentesById($id);
    $idEmpresa = $_SESSION['idEmpresa'];

    $titular = new Clientes();
    $todosOsClientesArray = $titular->getAllCliente($idEmpresa)




    ?>
    <br />
    <br />

    <?php

    if (isset($mensagem)) :

        if ($mensagem == "Dependentes atualizado com sucesso!") { ?>
            <div class="success"><?php echo $mensagem; ?></div>
        <?php

        } elseif ($mensagem == "Não foi possível atualizar o dependente!") {

        ?>

            <div class="danger"><?php echo $mensagem; ?></div>

    <?php



        }
    endif;
    ?>

    <h1 class="estiloBorda">Atualização de dependentes</h1>



    <form id="form" method="Post" action="<?php echo BASE_URL; ?>Dependentes/atualizar">

        <br>
        <br>
        <br>
        <input type="hidden" name="id" value="<?php echo $id ?>">

        <label class="rotulo">Titular</label>

        <!--<select class="campoTexto" name="titular">-->
            <?php

           // foreach ($todosOsClientesArray as $todosOsClientes) :

            ?>
                <!--<option <?php //echo  $todosOsClientes['idClientes'] == $dependentes['clientes_idclientes']? 'selected' : '';?> value="<?php //echo $todosOsClientes['idClientes']; ?>"><?php //echo $todosOsClientes['nomeClientes']; ?></option>-->
            <?php //endforeach; ?>
        <!--</select>-->
        <label class="rotulo">Nome Completo</label>

        <input class="campoTexto" type="text" name="nome" value="<?php echo  $dependentes['nomeDependentes']; ?>" />

        <label class="rotulo">CPF</label><br>
        <input class="campoTexto" type="text" name="cpf" value="<?php echo $dependentes['cpfDependentes']; ?>" />

        <label class="rotulo">Data de Nascimento</label>
        <input class="campoTexto" type="date" name="dataNascimento" value="<?php echo  $dependentes['dataNascimentoDependentes']; ?>" />






        <input class="botao" type="submit" value="Atualizar" />

    </form>
    <div>