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

class AreceberController extends Controller
{



  public function teste()
  {



    $ano = intval(date("Y"));
    echo $ano;
  }



  private const ULTIMO = "último";
  private const PENDENTE = "Pendente";
  private const BOLETO = "boleto";
  private const ASSUNTO = "Geração de boleto";
  private const ASSUNTOERRO = "Erro ao gerar o boleto";

  public function aReceber()
  {

    $venda = new Venda();
    $arrayVenda = $venda->getAllVenda();








    //A RECEBER - OK
    //verificar se existe idvenda, na tabela de pagamentos_receber - ok

    foreach ($arrayVenda as $vendaArray) {

      $pagamentosReceber = new PagamentosReceber();


      $idCliente = $vendaArray['clientes_idClientes'];
      $idEmpresa = $vendaArray['empresa_idEmpresa'];


      $anoSistema = intval(date("Y"));


      //ano 

      //verificar se existe cliente na tabela pagamento_receber
      $existe = $pagamentosReceber->existeIdCliente($idCliente);

      //caso exista
      if ($existe) {

        //pegar o nome do cliente pelo id do cliente
        $cliente = new Clientes();
        $clienteArray = $cliente->getClientById($idCliente);


        //pegar o nome do cliente para adicionar na mansagem de e-mail
        $nomeCliente = $clienteArray['nomeClientes'];

        $mensagem = "Foi criado o boleto para o cliente " . $nomeCliente;

        //pegar o e-mail de cada empresa
        $empresa = new Empresa();
        $empresaArray = $empresa->getEmpresaById($idEmpresa);
        $para = $empresaArray['nomeEmpresa'];




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
        $formPagamentoArray = $formaDePagamento->getFormaPagamento($this::BOLETO, $_SESSION['idEmpresa']);
        $formaPagamento = $formPagamentoArray['nomeformaPagamento'];

        //pegar o último boleto gerado OBS: adicionar o campo chamado anteriorultimo que terá o valor:último ou anterior - OK
        $ultimoBoleto = $pagamentosReceber->ultimoBoletoCliente($this::ULTIMO, $idCliente); //ultimo boleto do cliente

        $numeroParcelas = intval($ultimoBoleto['numeroParcelas']);
        $numeroParcelas = $numeroParcelas + 1;

        // diferença do dia atual até o dia de vencimento
        //fazer a diferença com o dia atual e ver se faltam 10  dias para o vencimento

        $anoBoleto = intval($ultimoBoleto['ano']);


        if (isset($ultimoBoleto)) {

          //verificar se o último boleto é igual do ano corrente
          if ($anoSistema == $anoBoleto) {
            //Caso falte 10 dias para o vencimento adicionar na tabela pagamentos_receber pegar o idEmpresa
            //OBS:Adicinar no menu configuração a quantidade de dias que o cliente  deseja para ser gerados o a receber 

            //$vendaArray['empresa_idEmpresa']

            $dataAtual = new DateTime("now");
            $dataDoUltimoBoleto = new DateTime($ultimoBoleto['dataVencimentoBoleto']);
            $diferenca = $dataDoUltimoBoleto->diff($dataAtual);
            $dias = intval($diferenca->format("%d"));

            $diaAreceber = new DiaAreceber();
            $diaConfiguradoDaEmpresa = intval($diaAreceber->getAllByEmpresa($idEmpresa));


            if ($dias == $diaConfiguradoDaEmpresa) {

              // o ultimo boleto serar anterior
              $atualizadoAnterior = $pagamentosReceber->atualizarAnterior($this::ULTIMO, $idCliente); //atualizado o ultimo boleto para anterior

              if($atualizadoAnterior){
              //inserir o último boleto atual
              $inserido = $pagamentosReceber->inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimento, $valor, $desconto, $idStatusPagamento, $formaPagamento, $idVenda, $idVendedor, $anoSistema);

              //liberando a variável para não haver acúmulo de parcelas
              //enviar e-mail
              $email = new Email();
              $enviado = $email->sendEmail($para, $this::ASSUNTO, $mensagem);
              unset($numeroParcelas);
              }else{
                
                $mensagem = "Não foi possível criar o boleto para o cliente " . $nomeCliente . ",por favor, Entre encontato com o Desenvolvedor do sistema! ";

                $email = new Email();
              $enviado = $email->sendEmail($para, $this::ASSUNTOERRO, $mensagem);
              }

              
            } //endif


          } /*endif*/ {

            //caso não exista
            //Gerar todos os boletos possíveis a partir da contagem da quantidade de meses passados


            $numeroParcelas = 1;
          }


          //resetar a parcela para um
        }/*endif*/ else {
        } //endelse
      } else {

        //inserir os dados
      }
    } //end foreaach


    //adicionar o log do sistema para este processo se ocorreu tudo certo

    // se ano do sistema igual ao ano do boleto-> continue caso contrário resete a contagem da parcela para um




    //ATRASADO


    //RECEBIDOS

    foreach ($arrayVenda as $vendaArray) {


      print("[vendedores_idVendedores] = " . $vendaArray['vendedores_idVendedores']);
      echo "<br/>";
      print("[dataVenda] = " . $vendaArray['dataVenda']);
      echo "<br/>";
      print("[valorPlanos] = " . $vendaArray['valorPlanos']);
      echo "<br/>";
      print("[valorExtraDependente] = " . $vendaArray['valorExtraDependente']);
      echo "<br/>";
      print("[adesaoVenda] = " . $vendaArray['adesaoVenda']);
      echo "<br/>";
      print("[dataVencimentoVenda] = " . $vendaArray['dataVencimentoVenda']);

      $dataAntiga  = new DateTime($vendaArray['dataVencimentoVenda']);
      $dataAgora = new DateTime("now");
      $intervalo = $dataAntiga->diff($dataAgora);
      echo "<br/>";
      echo "Intervalo de dias entre as datas " . $intervalo->days;
      echo "<br/>";
      echo "Intervalo de Dias = " . $intervalo->format("%d dias");
      echo "<br/>";
      echo "Intervalo de Anos = " . $intervalo->format("%y ano");
      echo "<br/>";
      echo "Intervalo de Meses = " . $intervalo->format("%m mês");

      echo "<br/>";
      print("[clientes_idClientes] = " . $vendaArray['clientes_idClientes']);
      echo "<br/>";
      print("[idVenda] = " . $vendaArray['idVenda']);
      echo "<br/>";
      print("[planos_idPlanos] = " . $vendaArray['planos_idPlanos']);
      echo "<br/>";
      print("[empresa_idEmpresa] = " . $vendaArray['empresa_idEmpresa']);
      echo "<br/>";
      print("[dataAdesao] = " . $vendaArray['dataAdesao']);
      echo "<br/>";
      print("[desconto] = " . $vendaArray['desconto']);
      echo "<br/>";
      print("[complementoPlano_idComplementoPlano] = " . $vendaArray['complementoPlano_idComplementoPlano']);
      echo "<hr/>";
    }
  }

  oi
}
