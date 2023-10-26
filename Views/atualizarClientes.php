<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<script type="text/javascript">
   
$('li').eq(5).addClass('stiloFixoSubmenu');
    $('li').eq(3).addClass('stiloFixo');
    $("#submenuCadastros").fadeToggle("slow");
</script> 


<div class="margem">
    
    
    
    
    
    <?php

    use \Models\Clientes;
    
    $cliente = new Clientes();
    $clientes = $cliente->getClientById($id);
    
    
    
    
    ?>
    <br/>
    <br/>
    
    <?php
    
    if(isset($mensagem)):
    
    if($mensagem == "Cliente atualizado com sucesso!"){ ?>
    <div class="success"><?php echo $mensagem ;?></div>
    <?php 
    
    }elseif($mensagem == "Não foi possível atualizar o cliente!"){

    ?>
    
     <div class="danger"><?php echo $mensagem ;?></div>
    
    <?php 
    
    
    
    }
endif;
    ?>
    
     <h1 class="estiloBorda">Atualização de clientes</h1>
    

                    <form id="form" method="Post" action="<?php echo BASE_URL; ?>Clientes/atualizar">

                        <br>
                        <br>
                        <br>
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <label  class="rotulo">Nome Completo</label> 
                        <input class="campoTexto"type="text" name="nome" value="<?php echo  $clientes['nomeClientes'];?>"/>
                        
                        
                        <label  class="rotulo">Data de Nascimento</label> 
                        <input class="campoTexto"type="date" name="dataNascimento" value="<?php echo  $clientes['dataNascimentoClientes'];?>" /> 
                        

                        <label class="rotulo">RG</label><br>
                        <input class="campoTexto" type="text" name="rg"  value="<?php echo $clientes['rgClientes'] ;?>"/>

                        <label class="rotulo">CPF</label><br>
                        <input class="campoTexto" type="text" name="cpf" value="<?php echo $clientes ['cpfClientes'];?>" />


                        <br>
                        <label class="rotulo" for="telephone">Telefone</label>
                        <input class="campoTexto" maxlength="11" id="telephone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" type="tel" name="telefone"  value="<?php echo $clientes['telefoneClientes'];?>"/><br>

                        <script type="text/javascript">$('#telephone').mask("(00) 0000-00009");</script><!--Mascara telefone-->


                        <label class="rotulo">E-m@il</label>
                        <input class="campoTexto" type="email" name="email" value="<?php echo $clientes['emailClientes'];?>"/>



                        <label class="rotulo">Endereço</label>
                        <input class="campoTexto" id="endereco" type="text" name="endereco" value="<?php echo $clientes['enderecoClientes'];?>"/>

                        
                        <label class="rotulo">CEP</label>
                        <input class="campoTexto" id="CEP" type="text" name="cep" value="<?php echo $clientes['cepClientes'];?>"/>

                        <label class="rotulo">Complemento</label>
                        <input class="campoTexto" id="complemento" type="text"name="complemento" value="<?php echo $clientes['complementoClientes'];?>" />

                        <label class="rotulo">Ponto de referência</label>
                        <input class="campoTexto" type="text"name="pontoreferencia"  value="<?php echo $clientes['pontoReferenciaClientes'];?>" />



                        <label class="rotulo">Bairro</label>
                        <input class="campoTexto" id="bairro" type="text"name="bairro"  value="<?php echo $clientes['bairroClientes'];?>"/>

                        <label class="rotulo">Cidade</label>
                        <input class="campoTexto" id="cidade" type="text"name="cidade"  value="<?php echo $clientes['cidadeClientes'];?>" />


                        <label class="rotulo">Estado</label>
                        <input class="campoTexto" id="estado"type="text"name="estado"  value="<?php echo $clientes['estadoClientes'];?>" />
                        
                        <label class="rotulo">Estatus</label><br>
                        <input id="ativo" type="radio" name="situacao" value="<?php echo $clientes['situacao']=='ativo'?'ativo':'inativo';?>" <?php echo $clientes['situacao']=='ativo'?'checked':'unchecked'; ?>> <label class="rotulo">Ativo</label><br>
                        <input id="inativo" type="radio" name="situacao" value="<?php echo $clientes['situacao']=='inativo'?'ativo':'inativo';?>" <?php echo $clientes['situacao']=='inativo'?'checked':'unchecked'; ?>> <label class="rotulo">Inativo</label>
                        
                         <input class="botao" type="submit" value="Atualizar"/>
                         
                    </form>
     <div>