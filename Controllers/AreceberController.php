<?php


namespace Controllers;

use Core\Controller;
use DateTime;
use Models\DiaAreceber;
use Models\EstatusPagamento;
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
  private const BOLETO = "boleto" ;

  public function aReceber()
  {

    $venda = new Venda();
    $arrayVenda = $venda->getAllVenda();



    $pagamentosReceber = new PagamentosReceber();




    //A RECEBER - OK
    //verificar se existe idvenda, na tabela de pagamentos_receber - ok

    foreach ($arrayVenda as $vendaArray) {

      $anoBoleto = intval($vendaArray['ano']);
      $anoSistema = intval(date("Y"));

      //ano 


      //adicionar o log do sistema para este processo se ocorreu tudo certo

      // se ano do sistema igual ao ano do boleto-> continue caso contrário resete a contagem da parcela para um
      if ($anoSistema == $anoBoleto) {


        $idCliente = $vendaArray['clientes_idClientes'];
        $idEmpresa = $vendaArray['empresa_idEmpresa'];

        // A data de pagamento e vencimento serão as mesmas por padrão depois o usuário muda
        $dataPagamento = $vendaArray['dataVencimentoVenda'];
        $dataVencimento = $vendaArray['dataVencimentoVenda'];

        
        $valor = $vendaArray['valorPlanos'];
        $desconto = $vendaArray['desconto'];




        //Por padrão o estatus pagamento será pendente
        $estatusPagamento = new EstatusPagamento();
        $idStatusPagamentoArray = $estatusPagamento->getIdStatusPagamentoByName($this::PENDENTE);
        $idStatusPagamento = $idStatusPagamentoArray['idestatusPagamento'];


        //Por padrão a forma de pagamento será boleto - CONTINUAR AQUI


        parei aqui também



        $existe = $pagamentosReceber->existeIdCliente($idCliente);

        //caso exista
        //pegar o último boleto gerado OBS: adicionar o campo chamado anteriorultimo que terá o valor:último ou anterior - OK

        if ($existe) {

          $ultimoBoleto = $pagamentosReceber->ultimoBoletoCliente($this::ULTIMO, $idCliente); //ultimo boleto do cliente

          $numeroParcelas = intval($ultimoBoleto['numeroParcelas']);

          // diferença do dia atual até i dia de vencimento
          //fazer a diferença com o dia atual e ver se faltam 10  dias para o vencimento

          if (isset($ultimoBoleto)) {

            $dataAtual = new DateTime("now");
            $dataDoUltimoBoleto = new DateTime($ultimoBoleto['dataVencimentoBoleto']);
            $diferenca = $dataDoUltimoBoleto->diff($dataAtual);
            $dezDias = intval($diferenca->format("%d"));

            $diaAreceber = new DiaAreceber();
            $diaConfiguradoDaEmpresa = intval($diaAreceber->getAllByEmpresa($idEmpresa));


            if ($dezDias == $diaConfiguradoDaEmpresa) {

              // o ultimo boleto serar anterior

              $atualizadoAnterior = $pagamentosReceber->atualizarAnterior($this::ULTIMO, $idCliente); //atualizado o ultimo boleto para anterior


              //inserir o último boleto atual


              $inserido = $pagamentosReceber->inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimento, $valor, $desconto, $idStatusPagamento, $formaPagamento, $banco, $idVenda, $idVendedor, $anoSistema);

              //liberando a variável para não haver acúmulo de parcelas
              unset($numeroParcelas);
            } //endif




            //resetar a parcela para um
          }/*endif*/ else {
          } //endelse
        } //endif


        //Caso falte 10 dias para o vencimento adicionar na tabela pagamentos_receber pegar o idEmpresa
        //OBS:Adicinar no menu configuração a quantidade de dias que o cliente  deseja para ser gerados o a receber 

        //$vendaArray['empresa_idEmpresa']






        //caso não exista
        //Gerar todos os boletos possíveis a partir da contagem da quantidade de meses passados




      } //endif
    } //enforeach



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
}
