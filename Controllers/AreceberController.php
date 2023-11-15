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
    $dataVenda = new DateTime('2023-09-11');
    $diferenca = $dataVenda->diff($dataAtual);
    $mes = intval($diferenca->format("%m"));
    echo $mes;

    echo "\n";
    $ano = intval(date("Y"));
    echo $ano;
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


    //A RECEBER - OK
    //verificar se existe idvenda, na tabela de pagamentos_receber - ok


    //Verificando se existe vendas na recuperação de vendas
    if (isset($arrayVenda)) {
      foreach ($arrayVenda as $vendaArray) {

        $pagamentosReceber = new PagamentosReceber(); //instanciar pagamento a receber


        $idCliente = $vendaArray['clientes_idClientes']; //idCliente
        $idEmpresa = $vendaArray['empresa_idEmpresa']; //idEmpresa


        //ano 
        $anoSistema = intval(date("Y"));

        //verificar se existe cliente na tabela pagamento_receber
        $existe = $pagamentosReceber->existeIdCliente($idCliente);




        //pegar o nome do cliente pelo id do cliente
        $cliente = new Clientes();
        $clienteArray = $cliente->getClientById($idCliente);


        //pegar o nome do cliente para adicionar na mansagem de e-mail
        $nomeCliente = $clienteArray['nomeClientes'];

        $mensagem = "Foi criado o boleto para o cliente " . $nomeCliente;

        //pegar o e-mail de cada empresa
        $empresa = new Empresa();
        $empresaArray = $empresa->getEmpresaById($idEmpresa);
        $para = $empresaArray['emailEmpresa'];


        // A data de pagamento e vencimento serão as mesmas por padrão depois o usuário muda
        $dataPagamento = $vendaArray['dataVencimentoVenda'];
        $dataVencimento = $vendaArray['dataVencimentoVenda'];


        $valor = $vendaArray['valorPlanos'];
        $desconto = $vendaArray['desconto'];

        $idVenda = $vendaArray['idVenda'];
        $idVendedor = $vendaArray['vendedores_idVendedores'];

        //Por padrão o estatus pagamento será pendente
        $estatusPagamento = new EstatusPagamento();
        $idStatusPagamentoArray = $estatusPagamento->getIdStatusPagamentoByName($this::PENDENTE);
        $idStatusPagamento = $idStatusPagamentoArray['idestatusPagamento'];


        //Por padrão a forma de pagamento será boleto 
        $formaDePagamento = new FormaDePagamento();
        $formPagamentoArray = $formaDePagamento->getFormaPagamento($this::BOLETO, $idEmpresa);
        $formaPagamento = $formPagamentoArray['nomeformaPagamento'];

        //pegar o último boleto gerado OBS: adicionar o campo chamado anteriorultimo que terá o valor:último ou anterior - OK
        $ultimoBoleto = $pagamentosReceber->ultimoBoletoCliente($this::ULTIMO, $idCliente); //ultimo boleto do cliente

        $numeroParcelas = intval($ultimoBoleto['numeroParcelas']);
        $numeroParcelas = $numeroParcelas + 1;

        // diferença do dia atual até o dia de vencimento
        //fazer a diferença com o dia atual e ver se faltam 10  dias para o vencimento

        $anoBoleto = intval($ultimoBoleto['ano']);

        //neste cado de e para são iguais
        $de = $para;


        //caso exista
        if ($existe) {


          if (isset($ultimoBoleto)) {


            //verificar se o último boleto é igual do ano corrente
            if ($anoSistema == $anoBoleto) {
              //Caso falte 10 dias para o vencimento adicionar na tabela pagamentos_receber pegar o idEmpresa
              //OBS:Adicinar no menu configuração a quantidade de dias que o cliente  deseja para ser gerados o a receber - ok

              //$vendaArray['empresa_idEmpresa']

              $dataAtual = new DateTime("now");
              $dataDoUltimoBoleto = new DateTime($ultimoBoleto['dataVencimentoBoleto']);
              $diferenca = $dataDoUltimoBoleto->diff($dataAtual);
              $dias = intval($diferenca->format("%d"));

              $diaAreceber = new DiaAreceber();
              $diaConfiguradoDaEmpresa = intval($diaAreceber->getAllByEmpresa($idEmpresa));


              if ($dias == $diaConfiguradoDaEmpresa) {

                // o ultimo boleto será anterior
                $atualizadoAnterior = $pagamentosReceber->atualizarAnterior($this::ULTIMO, $idCliente); //atualizado o ultimo boleto para anterior

                if ($atualizadoAnterior) {
                  //inserir o último boleto atual
                  $inserido = $pagamentosReceber->inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimento, $valor, $desconto, $idStatusPagamento, $formaPagamento, $idVenda, $idVendedor, $anoSistema);

                  //liberando a variável para não haver acúmulo de parcelas
                  unset($numeroParcelas);

                  //enviar e-mail

                  if (isset($para)) {

                    $email = new Email();
                    $enviado = $email->sendEmail($para, $this::ASSUNTO, $mensagem);
                    $saida = new Saida();
                    $saida->envidados($de, $para, $this::ASSUNTO, $mensagem, $idEmpresa);
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
              //recomeçar a contagem de parcelas
              $numeroParcelas = 1;
              //inserir novo pagamento_receber

              $inserido = $pagamentosReceber->inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimento, $valor, $desconto, $idStatusPagamento, $formaPagamento, $idVenda, $idVendedor, $anoSistema);

              if ($inserido) {

                $mensagem = "Criado um novo boleto para o Cliente " . $nomeCliente;

                $email = new Email();
                $enviado = $email->sendEmail($para, $this::ASSUNTONOVO, $mensagem);
                $saida = new Saida();
                $saida->envidados($de, $para, $this::ASSUNTONOVO, $mensagem, $idEmpresa);
              }
            }
          }/*endif*/ else {
            //inserir boleto
            $numeroParcelas = 1;
            $inserido = $pagamentosReceber->inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimento, $valor, $desconto, $idStatusPagamento, $formaPagamento, $idVenda, $idVendedor, $anoSistema);

            if ($inserido) {

              $mensagem = "Criado um novo boleto para o Cliente " . $nomeCliente;

              $email = new Email();
              $enviado = $email->sendEmail($para, $this::ASSUNTONOVO, $mensagem);
              $saida = new Saida();
              $saida->envidados($de, $para, $this::ASSUNTONOVO, $mensagem, $idEmpresa);
            }
          } //endelse
        } else {
          //Gerar todos os boletos possíveis a partir da contagem da quantidade de meses passados
          $dataAtual = new DateTime("now");
          $dataVenda = new DateTime($vendaArray['dataVencimentoBoleto']);
          $diferenca = $dataVenda->diff($dataAtual);
          $mes = intval($diferenca->format("%m"));


          for ($m = 0; $m < $mes; $m++) {
            $numeroParcelas = 1;

              //se m maior do que dois para atualizar e seguir na sequência dos outros boletos
              //adicionei o zero no m para que tenha atraso pois o último item não precisa atualizar agora somente com 10 antes de começar o próximo mês
              if ($mes >= 2) {//caso tem dois ou maia meses sem ter gerado o boleto no sistema
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

    }
  }
  