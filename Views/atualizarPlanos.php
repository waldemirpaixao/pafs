<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<script type="text/javascript">
    $('li').eq(7).addClass('stiloFixoSubmenu');
    $('li').eq(3).addClass('stiloFixo');
    $("#submenuCadastros").fadeToggle("slow");
</script>
<div class="margem">
  <div id="atualizarPlanos">
      
      <?php 

    use \Models\Planos;
    use \Models\ComplementoPlano;
use Models\Plano_has_complementoPlano;

      if(isset($mensagem)):
      if($mensagem == "Atualizado com sucesso!") :?>
      
      <div class="success alinhamentoCentro"><?php echo $mensagem; ?></div>
          
        <?php elseif ($mensagem == "Problema ao atualizar!"):?></div>
    
      <div class="danger alinhamentoCentro"><?php echo $mensagem;?></div>
          <?php endif;
          endif;?>
          <h1 class=" estiloBorda">Atualizar Planos PAFS</h1>
          
    
          
        
                    <form id="formPlanos" method="Post" action="<?php echo BASE_URL; ?>Planos/atualizar">

                        <br>
                        <br>
                        <br>
                        
                        <?php 
                        
                        $plano = new Planos();
                        $planos = $plano->getPlanosById($idPlanos)
                        
                        ?>
                        <input type="hidden" value="<?php echo $planos['idPlanos']; ?>" name="idPlanos"><br/>
                        <label class="rotulo">Nome do plano</label>
                        <input class="campoTexto" id="endereco" type="text" name="nomePlano" value="<?php echo $planos['nomePlanos'];?>"/>

                        <label class="rotulo">Valor do Plano</label>
                        <input class="campoTexto"  type="number"name="valorPlano" value="<?php echo $planos['valorPlanos'] ;?>"/>

                      
                        <label class="rotulo">Descrição</label>
                        <textarea class="campoTexto" name="descricao" rows="5"><?php echo $planos['descricao']  ?></textarea>


                        <label class="rotulo">Comissão do Plano</label>
                        <input class="campoTexto" type="number"name="comissaoPlano" value="<?php echo $planos['comissaoPlanos'] ;?>"/>


                        <?php
                        //pegar os dados do pcomplemento do seguro

                        $complemento = new ComplementoPlano();
                        $complementoPlan = $complemento->getComplementoPlano($_SESSION['idEmpresa']);


                     
                        

                        ?>


                        

                        <?php 
                        if(isset($complementoPlan)):
                        ?>
                        <h3 class="rotulo">Seguro: Complemento do plano</h3>

                        <?php 
                        foreach ($complementoPlan as $complementPlan) : 
                        
                          $idPlano =  $planos['idPlanos'];
                          $idComplemento = $complementPlan['idComplementoPlano'];
                        
                          $plano_has_complemento = new Plano_has_complementoPlano();
                          $todosMatchPlanosArray = $plano_has_complemento->getMatchPlanoHasComplemento($idPlano, $idComplemento,$_SESSION['idEmpresa']);

                         
                        
                        
                        ?>

                            



                            <input id="<?php echo $complementPlan['idComplementoPlano'];?>" type="radio" name="comSemSeguro[]" <?php if(isset($todosMatchPlanosArray)) {echo $complementPlan['idComplementoPlano'] == $todosMatchPlanosArray[0]['complementoPlano_idComplementoPlano']?'checked':'' ;}?> value="<?php echo $complementPlan['idComplementoPlano']; ?>">
                            <label style="cursor: pointer;" for="<?php echo $complementPlan['idComplementoPlano'];?>" class="rotulo"><?php echo $complementPlan['nomeComplementoPlano']; ?></label><br>
                        <?php
                        endforeach;
                        endif;
                        unset($plano_has_complemento);
                        unset($todosMatchPlanosArray);
                        ?>


                        <input class="botao" type="submit" value="Atualizar"/>

                    </form>





                </div>
</div>
                
        
        