<?php


namespace Controllers;

use Core\Controller;
use DateTime;
use Email\Email;
use Models\Clientes;
use Models\DiaAreceber;
use Models\Empresa;
use Models\EstatusPagamento;
use Models\FormaDePagamento;
use Models\PagamentosReceber;
use Models\Venda;
use Models\Saida;

class AreceberController extends Controller
{



  public function teste()
  {


    $dataAtual = new DateTime("now");
    $dataVenda = new DateTime('2023-09-13');
    $diferenca = $dataVenda->diff($dataAtual);
    $mes = intval($diferenca->format("%m"));
    //echo $mes;

    echo "Data Acrescida de um mês <br/>";
    echo date("Y-m-d", strtotime("+1 month", strtotime('2023-09-13')));

    //  echo "\n";
    //$ano = intval(date("Y"));
    //echo $ano;
  }



  private const ULTIMO = "último";
  private const PENDENTE = "Pendente";
  private const BOLETO = "boleto";
  private const ASSUNTO = "Geração de boleto";
  private const ASSUNTOERRO = "Erro ao gerar o boleto";
  private const ASSUNTONOVO = "Gerado um novo boleto";

  public function aReceber()
  {

    $venda = new Venda();
    $arrayVenda = $venda->getAllVenda(); //pegando todas as vendas na base de dados
    $arrayVenda = $venda->getAllVenda(); //pegando todas as vendas na base de dados


    //A RECEBER - OK
    //verificar se existe idvenda, na tabela de pagamentos_receber - ok


    //Verificando se existe vendas na recuperação de vendas
    //Verificando se existe vendas na recuperação de vendas
    if (isset($arrayVenda)) {
      echo "Tem dados na venda veja \n\n";
      echo "<br/>";
      print_r($arrayVenda);
      echo "<br/>";
      echo "<br/>";
      foreach ($arrayVenda as $vendaArray) {


        echo "Instanciando a classe Pagamentos a receber <br/>";
        $pagamentosReceber = new PagamentosReceber(); //instanciar pagamento a receber
        $pagamentosReceber = new PagamentosReceber(); //instanciar pagamento a receber



        $idCliente = $vendaArray['clientes_idClientes']; //idCliente
        echo "idCliente = " . $idCliente . "<br/>";
        $idEmpresa = $vendaArray['empresa_idEmpresa']; //idEmpresa
       


        //ano do sistema
        $anoSistema = intval(date("Y"));

        //verificar se existe cliente na tabela pagamento_receber
        $existe = $pagamentosReceber->existeIdCliente($idCliente);

        echo "Existe cliente dentro de pagamentos a receber? " . $existe . "<br/>";

        //pegar o nome do cliente pelo id do cliente
        $cliente = new Clientes();
        echo "Instancia a classe cliente <br/>";
        $clienteArray = $cliente->getClientById($idCliente);
        echo "Pegando todos os dados do cliente específico <br/>";
        print_r($clienteArray);


        echo "<br/>";
        //pegar o nome do cliente para adicionar na mansagem de e-mail
        $nomeCliente = $clienteArray['nomeClientes'];
        echo "Nome do cleiente = " . $nomeCliente . "<br/>";

        $mensagem = "Foi criado o boleto para o cliente " . $nomeCliente;

        //pegar o e-mail de cada empresa
        $empresa = new Empresa();
        echo "Instanciada a classe empresa <br/>";
        $empresaArray = $empresa->getEmpresaById($idEmpresa);
        echo "Pegou a empresa com o id específico <br/>";
        print_r($empresaArray);

        echo "<br/>";
        echo "<br/>";
        $para = $empresaArray['emailEmpresa'];

        echo "Para do email = " . $para . "\n";
        echo "<br/>";

        // A data de pagamento 

        $dataPagamento = $vendaArray['dataVencimentoVenda'];

        echo "Data pagamento = " . $dataPagamento . "\n";


        echo "<br/>";
        $valor = $vendaArray['valorPlanos'];
        echo "valor = " . $valor;
        echo "<br/>";
        $desconto = $vendaArray['desconto'];
        echo "desconto = " . $desconto . "\n";
        echo "<br/>";
        $idVenda = $vendaArray['idVenda'];
        echo "id da venda = " . $idVenda . "/n";
        echo "<br/>";
        $idVendedor = $vendaArray['vendedores_idVendedores'];
        echo "idVendedor = " . $idVendedor . "\n";
        echo "<br/>";

        //Por padrão o estatus pagamento será pendente
        echo "Instanciou Estatus Pagamento \n";
        echo "<br/>";
        $estatusPagamento = new EstatusPagamento();

        $idStatusPagamentoArray = $estatusPagamento->getIdStatusPagamentoByName($this::PENDENTE);
        echo "tudo do pagamento = " . print_r($idStatusPagamentoArray) . "\n";
        echo "<br/>";
        $idStatusPagamento = $idStatusPagamentoArray['idestatusPagamento'];
        echo "id estatus pagamento = " . $idStatusPagamento . "\n";
        echo "<br/>";

        //Por padrão a forma de pagamento será boleto 
        $formaDePagamento = new FormaDePagamento();
        echo "Instanciou a forma de pagamento";
        $formPagamentoArray = $formaDePagamento->getFormaPagamento($this::BOLETO, $idEmpresa);
        $idFormaPagamento = $formPagamentoArray['idformaPagamento'];
        echo "<br/>";
        echo "Todos os dados da forma de pagameneto \n";
        print_r($formPagamentoArray);
        echo "\n";

        $formaPagamento = $formPagamentoArray['nomeformaPagamento'];

        echo "Nome da forma de pagamento = " . $formaPagamento . "\n";

        //pegar o último boleto gerado OBS: adicionar o campo chamado anteriorultimo que terá o valor:último ou anterior - OK
        $ultimoBoleto = $pagamentosReceber->ultimoBoletoCliente($this::ULTIMO, $idCliente); //ultimo boleto do cliente
        echo "dados do último boleto \n";
        echo "<br/>";
        print_r($ultimoBoleto);
        echo "<br/>";

        //neste cado de e para são iguais
        $de = $para;



        //caso exista
        if ($existe) {



          if (isset($ultimoBoleto)) {

            $numeroParcelas = intval($ultimoBoleto['numeroParcelas']);
            $numeroParcelas = $numeroParcelas + 1;

            // diferença do dia atual até o dia de vencimento
            //fazer a diferença com o dia atual e ver se faltam 10  dias para o vencimento

            $anoBoleto = intval($ultimoBoleto['ano']);



            //verificar se o último boleto é igual do ano corrente
            if ($anoSistema == $anoBoleto) {

              echo "Ano igual a ano";
              //Caso falte 10 dias para o vencimento adicionar na tabela pagamentos_receber pegar o idEmpresa
              //OBS:Adicinar no menu configuração a quantidade de dias que o cliente  deseja para ser gerados o a receber - ok

              //$vendaArray['empresa_idEmpresa']

              $dataAtual = new DateTime("now");
              $dataDoUltimoBoleto = new DateTime($ultimoBoleto['dataVencimentoBoleto']);
              $diferenca = $dataDoUltimoBoleto->diff($dataAtual);
              $dias = intval($diferenca->format("%d"));

              echo 'Dias antes de vencimento do boleto = ' . $dias . '<br/>';

              $diaAreceber = new DiaAreceber();
              $diaConfiguradoDaEmpresa = intval($diaAreceber->getAllByEmpresa($idEmpresa));


              if ($dias == $diaConfiguradoDaEmpresa) {

                // o ultimo boleto será anterior
                $atualizadoAnterior = $pagamentosReceber->atualizarAnterior($this::ULTIMO, $idCliente); //atualizado o ultimo boleto para anterior

                if ($atualizadoAnterior) {
                  //inserir o último boleto atual
                  $inserido = $pagamentosReceber->inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimentoAcrescidoUmMes, $valor, $desconto, $idStatusPagamento, $formaPagamento, $idVenda, $idVendedor, $anoSistema);

                  //liberando a variável para não haver acúmulo de parcelas
                  unset($numeroParcelas);

                  //enviar e-mail

                  if (isset($para)) {

                    /* $email = new Email();
                    $enviado = $email->sendEmail($para, $this::ASSUNTO, $mensagem);
                    $saida = new Saida();
                    $saida->envidados($de, $para, $this::ASSUNTO, $mensagem, $idEmpresa);*/
                  }
                } else {

                  $mensagem = "Não foi possível criar o boleto para o cliente " . $nomeCliente . ",por favor, Entre encontato com o Desenvolvedor do sistema! ";

                  $email = new Email();
                  $enviado = $email->sendEmail($para, $this::ASSUNTOERRO, $mensagem);
                  $saida = new Saida();
                  $saida->envidados($de, $para, $this::ASSUNTOERRO, $mensagem, $idEmpresa);
                }
              } //endif


            } /*endif*/ else {

              $dataVencimentoBoletoAcrescidoUmMes = date("Y-m-d", strtotime("+1 month", strtotime($ultimoBoleto['dataVencimentoBoleto'])));

              //Verificar se o últmo boleto pertene ao ano anterior ou ao ano corrente
              $ultimaDataDoBoleto = explode("-", $ultimoBoleto['dataVencimentoBoleto']);

              //pegar a diferença de dias 
              $dataAtual = new DateTime("now");
              $dataDoUltimoBoleto = new DateTime($ultimoBoleto['dataVencimentoBoleto']);
              $diferenca = $dataDoUltimoBoleto->diff($dataAtual);
              $meses = intval($diferenca->format("%m"));

              echo "meses" . $meses;

              //Checar se os meses maior do que 01
              if ($meses > 1) {

                for ($i = 1; $i <= $meses; $i++) {


                  $inserido = $pagamentosReceber->inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimentoBoletoAcrescidoUmMes, $valor, $desconto, $idStatusPagamento, $idFormaPagamento, $idVenda, $idVendedor, $anoSistema);
                  $dataVencimentoBoletoAcrescidoUmMes = date("Y-m-d", strtotime("+1 month", strtotime($ultimoBoleto['dataVencimentoBoleto'])));

                  //$numeroParcelas = $numeroParcelas + intval($ultimoBoleto['numeroParcelas']);
                  $numeroParcelas = $numeroParcelas + intval(1);

                }
              } else {




                echo "Ano diferente de ano";

                //realizar a soma de um mês
                //$dataVencimentoAcrescidoUmAno = date("Y-m-d", strtotime("+1 year", strtotime($dataVencimento)));



                //recomeçar a contagem de parcelas
                $numeroParcelas = 1;
                //inserir novo pagamento_receber

                //verificar quantos meses de atraso para fazer a atualização

                echo "idEmpre" . $idEmpresa . "<br/>";
                echo "idCliente" . $idCliente . "<br/>";
                echo "idNúmero de parcelas" . $numeroParcelas . "<br/>";
                echo "dataPagemento" . $dataPagamento . "<br/>";
                echo "dataVencimentoBoletoAcrescidoUmMes" . $dataVencimentoBoletoAcrescidoUmMes . "<br/>";
                echo "valor" . $valor . "<br/>";
                echo "desconto" . $desconto . "<br/>";
                echo "idestatus pagamento" . $idStatusPagamento . "<br/>";
                echo "formapagamento" . $formaPagamento . "<br/>";
                echo "idVenda" . $idVenda . "<br/>";
                echo "idVendedor" . $idVendedor . "<br/>";
                echo "Ano sistema" . $anoSistema . "<br/>";

                // $pagamentosReceber = new PagamentosReceber(); 

                $inserido = $pagamentosReceber->inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimentoBoletoAcrescidoUmMes, $valor, $desconto, $idStatusPagamento, $idFormaPagamento, $idVenda, $idVendedor, $anoSistema);


                if ($inserido) {

                  //o prnúltimo bolet fica com anterior
                  //verificar no ano corrente a soma da parelas
                  //verificar mesmo que tenha gerado em um ano posterior a parcela continua normalmente sem reiniciar

                  $mensagem = "Criado um novo boleto para o Cliente " . $nomeCliente;

                  echo $mensagem;

                  /*$email = new Email();
                $enviado = $email->sendEmail($para, $this::ASSUNTONOVO, $mensagem);
                $saida = new Saida();
                $saida->envidados($de, $para, $this::ASSUNTONOVO, $mensagem, $idEmpresa);*/
                }
              }
            }
          }/*endif*/ else { //se não tem o ultimo boleto adicionar o primeiro boleto novo
            //inserir boleto
            $numeroParcelas = 1;
            $inserido = $pagamentosReceber->inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimentoAcrescidoUmMes, $valor, $desconto, $idStatusPagamento, $formaPagamento, $idVenda, $idVendedor, $anoSistema);

            if ($inserido) {

              $mensagem = "Criado um novo boleto para o Cliente " . $nomeCliente;

              $email = new Email();
              $enviado = $email->sendEmail($para, $this::ASSUNTONOVO, $mensagem);
              $saida = new Saida();
              $saida->envidados($de, $para, $this::ASSUNTONOVO, $mensagem, $idEmpresa);
            }
          } //endelse



        } else {  //caso não exista cliente em pagamento



          echo "<br/>";
          echo "Entrou";
          echo "<br/>";
          //Gerar todos os boletos possíveis a partir da contagem da quantidade de meses passados
          $dataAtual = new DateTime("now");
          $dataVenda = new DateTime($dataVencimento);
          $diferenca = $dataVenda->diff($dataAtual);
          $mes = intval($diferenca->format("%m"));


            //se m maior do que dois para atualizar e seguir na sequência dos outros boletos
            //adicionei o zero no m para que tenha atraso pois o último item não precisa atualizar agora somente com 10 antes de começar o próximo mês
            if ($mes >= 2) { //caso tem dois ou maia meses sem ter gerado o boleto no sistema
              //inserir o último boleto atual
              $ultimoId = $pagamentosReceber->inserirRetornaId($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimento, $valor, $desconto, $idStatusPagamento, $formaPagamento, $idVenda, $idVendedor, $anoSistema);

                $m = +1;
                //se dierente continua se for igual não faz
                if ($m != $mes) {
                  //Atualizar o que acabou de inserir
                  $atualizadoAnterior = $pagamentosReceber->atualizarAnteriorUltimoId($this::ULTIMO, $idCliente, $ultimoId); //atualizado o ultimo boleto para anterior
                }

                //se mês maior do que um mês
                //caso tenha apenas um mês no sitema
              } else if($mes > 0){
                //inserir
                $ultimoId = $pagamentosReceber->inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimento, $valor, $desconto, $idStatusPagamento, $formaPagamento, $idVenda, $idVendedor, $anoSistema);
              }
              //liberar numero de parcelas
              unset($numeroParcelas);
            }
          }
        }
      } //end foreaach
    }//AreceberController 
  