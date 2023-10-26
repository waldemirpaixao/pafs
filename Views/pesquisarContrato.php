
<script>
       $('li').eq(15).addClass('stiloFixo');
</script>
<div class="margem">
<br/>
<input type="text" placeholder="CPF do titular do contrato..." class="campoTexto" id="pesquisarCPF">

<br/>

<div class="tirinhas">   


<div  class="subtirinhas">Nome do titular</div>
<div class="subtirinhas">CPF</div>
<div class="subtirinhas">Dependentes</div>
<div class="subtirinhas">Nº do Contrato</div>
<div class="subtirinhas">Status</div>


</div>

<div id="conteudo" class="tirinhas">   
</div>

 
<div  class="subtirinhas"></div>
<div  class="subtirinhas"></div>



<!--MOdeal-->
<div class="modal" role="dialog" id="dependentes">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">

                    <button class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title estiloBorda">Dependentes</h2>
                </div>

                <div class="modal-body">

                    <form id="form" method="Post" action="<?php echo BASE_URL; ?>Clientes/registerClientes">

                        <br>
                        <br>
                        <br>
                        <label class="rotulo">Nome Completo</label>
                        <input class="campoTexto" type="text" name="nome" />


                        <label class="rotulo">Data de Nascimento</label>
                        <input class="campoTexto" type="date" name="dataNascimento" />


                        <label class="rotulo">RG</label><br>
                        <input class="campoTexto" type="text" name="rg" />

                        <label class="rotulo">CPF</label><br>
                        <input class="campoTexto" type="text" name="cpf" />


                        <br>
                        <label class="rotulo" for="telephone">Telefone</label>
                        <input class="campoTexto" maxlength="11" id="telephone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" type="tel" name="telefone" /><br>

                        <script type="text/javascript">
                            $('#telephone').mask("(00) 0000-00009");
                        </script><!--Mascara telefone-->


                        <label class="rotulo">E-m@il</label>
                        <input class="campoTexto" type="email" name="email" />



                        <label class="rotulo">Endereço</label>
                        <input class="campoTexto" id="endereco" type="text" name="endereco" />

                        <label class="rotulo">CEP</label>
                        <input class="campoTexto" id="CEP" type="text" name="cep" />


                        <label class="rotulo">Complemento</label>
                        <input class="campoTexto" id="complemento" type="text" name="complemento" />

                        <label class="rotulo">Ponto de referência</label>
                        <input class="campoTexto" type="text" name="pontoreferencia" />



                        <label class="rotulo">Bairro</label>
                        <input class="campoTexto" id="bairro" type="text" name="bairro" />

                        <label class="rotulo">Cidade</label>
                        <input class="campoTexto" id="cidade" type="text" name="cidade" />


                        <label class="rotulo">Estado</label>
                        <input class="campoTexto" id="estado" type="text" name="estado" />

                        <input class="botao" type="submit" value="Salvar" />

                    </form>
                    <div class="modal-footer">

                        <br />
                        <h3 class="modal-title estiloBorda">PAFS</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<!--modal-->

