
<script type="text/javascript">

    $('li').eq(9).addClass('stiloFixo');
    $("#submenuVendas").fadeToggle("slow");
   


</script>   
<div class="margem">
  <br>
    <br>
    <h1 class="estiloBorda">Produtos Funerários</h1>
 
    <form id="form" method="Post" action="<?php echo BASE_URL; ?>">

        <br>
        <br>
        <br>
        
        <label class="rotulo">Nome do Produto</label>
        <input class="campoTexto" id="endereco" type="text" name="nomePlano" />

        <label class="rotulo">Valor do Produto</label>
        <input class="campoTexto"  type="number"name="valorPlano" />


        <label class="rotulo">Comissão do Produto</label>
        <input class="campoTexto" type="number"name="comissoaPlano" />

      
        <input class="botao" type="submit" value="Salvar"/>

    </form>


</div>