<script type="text/javascript">

$('li').eq(4).addClass('stiloFixoSubmenu');
    $('li').eq(3).addClass('stiloFixo');
    $("#submenuCadastros").fadeToggle("slow");

   


</script>   



<?php

use \Models\Empresa;

$empresa = new Empresa();
$empresas = $empresa->getEmpresaById($_SESSION['idEmpresa']);   


if(isset($_SESSION['idEmpresa']) && !empty($_SESSION['idEmpresa'])):
    
           
 ?>

<div class="margem">
    
  
<?php

if(isset($mensagem)):
if ($mensagem == "Atualizado com Sucesso!"):?>
    <div class="success alinhamentoCentro"><?php echo $mensagem;?></div>
    <?php elseif($mensagem == "Não foi possivel atualizar!"):?>
    <div class=" danger alinhamentoCentro"><?php echo $mensagem;?></div>
    <?php endif;
    endif;
    ?>
    
    <br>
    <br>
    <h1 class="estiloBorda">Atualizar  Empresa</h1>

    <form id="form" method="Post" action="<?php echo BASE_URL; ?>Empresa/atualizarEmpresa" enctype="multipart/form-data">

        <br>
        <br>
        <br>
        
        <label class="rotulo alinhamentoCentro"><h4>Logo marca da empresa</h4></label> 
         <br/>
         <br/>
        <?php if(isset($_SESSION['logoEmpresa']) && !empty($_SESSION['logoEmpresa'])):?>
         
         <div class="imagemLogo"><img  alt="Logo" title="logo"  id="img"  class="imagemLogoTamanho" src="<?php echo BASE_URL;?>assets/profile/<?php echo $_SESSION['logoEmpresa'];?>"/></div>
         <?php else:?>
         
         <div class="imagemLogo"><img   alt="Logo" title="logo" id="img"  class="imagemLogoTamanho"src="<?php echo BASE_URL;?>assets/imagens/company.png"/></div>
         <?php endif;?>
        <br/>
        <br/>
        
        <div style="text-align:center;"><input id="foto" type="file" name="foto"></div>
        <br/>
        <br/>
        <label for="cnpjcpf" class="rotulo">CNPJ</label> 
        <input class="campoTexto"type="text" size="25" maxlength="25" id="cnpj" name="cnpjEmpresa" value="<?php echo $empresas['cnpjEmpresa'] ;?>"required/> &nbsp;

        <label class="rotulo">Nome da empresa</label><br>
        <input class="campoTexto" type="text" name="nomeEmpresa"  value="<?php echo $empresas['nomeEmpresa'] ;?>"  required />
        
          <label class="rotulo">Sigla</label><br>
        <input class="campoTexto" type="text" name="siglaEmpresa"  value="<?php echo $empresas['siglaEmpresa'] ;?>" required/>

        <br>
        <label class="rotulo" for="telephone">Telefone</label>
        <input  value="<?php echo $empresas['telefoneEmpresa'] ;?>" class="campoTexto" id="telephone"  type="tel" name="telefoneEmpresa" required/><br>

        <script type="text/javascript">$('#telephone').mask("(00) 00000-0000");</script><!--Mascara telefone-->


        <label class="rotulo">CEP</label>
        <input value="<?php echo $empresas['cepEmpresa'] ;?>" class="campoTexto" onkeypress="return SomenteNumero(event)"id="cep" maxlength="8"type="text"name="cepEmpresa" required/>

        <label class="rotulo">Endereço</label>
        <input class="campoTexto" id="endereco" type="text" name="enderecoEmpresa" value="<?php echo $empresas['enderecoEmpresa'] ;?>" required/>

        <label class="rotulo">Número</label>
        <input class="campoTexto"  type="text" name="numeroEmpresa" value="<?php echo $empresas['numeroEmpresa'] ;?>" required/>


        <label class="rotulo">Complemento</label>
        <input value="<?php echo $empresas['complementoEmpresa'] ;?>"  class="campoTexto" id="complemento" type="text" name="complementoEmpresa"required />

        <label class="rotulo">Ponto de referência</label>
        <input class="campoTexto" type="text"name="pontoReferenciaEmpresa" value="<?php echo $empresas['pontoReferencia'] ;?>" required/>

        <label class="rotulo">Bairro</label>
        <input class="campoTexto" id="bairro" type="text"name="bairroEmpresa" value="<?php echo $empresas['bairroEmpresa'] ;?>" required/>

        <label class="rotulo">Cidade</label>
        <input class="campoTexto" id="cidade" type="text"name="cidadeEmpresa" value="<?php echo $empresas['cidadeEmpresa'] ;?>" required/>



        <label class="rotulo">Estado</label>
        <input class="campoTexto" id="estado"type="text"name="estadoEmpresa" value="<?php echo $empresas['estadoEmpresa'] ;?> "required />







        <label class="rotulo">E-m@il</label>
        <input class="campoTexto" type="email" name="emailEmpresa" value="<?php echo $empresas['emailEmpresa'] ;?>" required/>


        <input class="botao" type="submit" value="Atualizar"/>

    </form>


</div>


<?php 

else:

?>



<div class="margem">
    
  
<?php if ($mensagem == "Salvo com sucesso!"):?>
    <div class="success alinhamentoCentro"><?php echo $mensagem;?></div>
    <?php elseif($mensagem == "Erro ao salvar"):?>
    <div class=" danger alinhamentoCentro"><?php echo $mensagem;?></div>
    <?php endif;?>
    
    <br>
    <br>
    <h1 class="estiloBorda">Cadastro da Empresa</h1>

    <form id="form" method="Post" action="<?php echo BASE_URL; ?>Empresa/registerEmpresa" enctype="multipart/form-data">

        <br>
        <br>
        <br>
        
        <label class="rotulo alinhamentoCentro"><h4>Logo marca da empresa</h4></label> 
         <br/>
         <br/>
        
         <div class="imagemLogo"><img  id="img"  class="imagemLogoTamanho"src="<?php echo BASE_URL;?>assets/imagens/company.png"/></div>
        <br/>
        <br/>
        
        <div style="text-align:center;"><input id="foto" type="file" name="foto"></div>
        <br/>
        <br/>
        <label for="cnpjcpf" class="rotulo">CNPJ</label> 
        <input class="campoTexto"type="text" size="25" maxlength="25" id="cnpj" name="cnpjEmpresa" required/> &nbsp;

        <label class="rotulo">Nome da empresa</label><br>
        <input class="campoTexto" type="text" name="nomeEmpresa" required />
        
          <label class="rotulo">Sigla</label><br>
        <input class="campoTexto" type="text" name="siglaEmpresa" required/>

        <br>
        <label class="rotulo" for="telephone">Telefone</label>
        <input class="campoTexto" maxlength="11" id="telephone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" type="tel" name="telefoneEmpresa" required/><br>

        <script type="text/javascript">$('#telephone').mask("(00) 0000-00009");</script><!--Mascara telefone-->


        <label class="rotulo">CEP</label>
        <input class="campoTexto" onkeypress="return SomenteNumero(event)"id="cep" maxlength="8"type="text"name="cepEmpresa" required/>

        <label class="rotulo">Endereço</label>
        <input class="campoTexto" id="endereco" type="text" name="enderecoEmpresa" required/>

        <label class="rotulo">Número</label>
        <input class="campoTexto"  type="text" name="numeroEmpresa" required/>


        <label class="rotulo">Complemento</label>
        <input class="campoTexto" id="complemento" type="text" name="complementoEmpresa"required />

        <label class="rotulo">Ponto de referência</label>
        <input class="campoTexto" type="text"name="pontoReferenciaEmpresa" required/>

        <label class="rotulo">Bairro</label>
        <input class="campoTexto" id="bairro" type="text"name="bairroEmpresa" required/>

        <label class="rotulo">Cidade</label>
        <input class="campoTexto" id="cidade" type="text"name="cidadeEmpresa" required/>



        <label class="rotulo">Estado</label>
        <input class="campoTexto" id="estado"type="text"name="estadoEmpresa" required />







        <label class="rotulo">E-m@il</label>
        <input class="campoTexto" type="email" name="emailEmpresa" required/>


        <input class="botao" type="submit" value="Salvar"/>

    </form>


</div>

<?php endif; ?>
