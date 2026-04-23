<?php

// Mini sistema bancário  ©Gustavo Casetta
echo "Qual seu nome de usuário?\n";  // Pede o nome do usuário
$nome = (string) trim(fgets(STDIN));  // Grava o nome na variável
$saldo = 0; // variável inicia em 0 (zero)
$extrato = [];

function exibeMenu($nome){ // Função para exibir o menu
echo "\n------------------------\n";
echo "Bem-vindo(a) " . $nome . "!\n";
echo "------------------------\n";
}

function saldoBancario($saldo){ // Função para exibir o saldo atual
    echo "Seu saldo é de: R$ " . number_format($saldo, 2, ",", ".") . "\n";
    return $saldo;
}

function depositoBancario($saldo, $extrato){ // Função para realizar depósitos
    echo "Digite o valor que deseja depositar:\n";
    $valorDeposito = (float) trim(fgets(STDIN));
    if($valorDeposito <= 0){
        echo "Erro! O valor não pode ser negativo!\n";
    } else {
    $saldo += $valorDeposito;
    echo "Deposito realizado com sucesso!\n";
    $extrato[] = "+ R$ " . number_format($valorDeposito, 2, ",", ".") . " (Depósito)";
    }
    return [$saldo, $extrato];
   
    }

function saqueBancario($saldo, $extrato){ // Função para realizar saques
    echo "Digite o valor que deseja sacar:\n";
    $valorSaque = (float) trim(fgets(STDIN));
    if($valorSaque > $saldo || $valorsaque < 0){
        echo "Erro! Saque inválido!\n";
    } else {
        $saldo -= $valorSaque;
        echo "Saque realizado! Aguarde o dinheiro está sendo contado!\n";
        $extrato[] = "- R$ " . number_format($valorSaque, 2, ",", ".") . " (Saque)";
    }
    return [$saldo, $extrato];
}

function limparTela(){  // Função que limpa a tela após o usuário digitar uma opção
    if (PHP_OS_FAMILY === 'Windows') {
        system('cls');
    } else {
        system('clear');
    }
}

do{ // Loop principal
    exibeMenu($nome); // Chama a função para exibir o menu

    echo "Opções:\n"; // Mostra as opções
    echo "1 - Saldo\n2 - Depositar\n3 - Sacar\n4 - Ver extrato\n5 - Sair\nDigite a opção: ";
    $opcao = (int) trim(fgets(STDIN)); // Grava a opção escolhida na variável
    limparTela(); // Chama a função para limpar a tela

    switch($opcao){ // Switch das opções
        case 1:
            saldoBancario($saldo); // Chama a função para mostrar o saldo
        break;

        case 2:
            list ($saldo, $extrato) = depositoBancario($saldo, $extrato); // Chama a função para realizar o depósito
        break;

        case 3:
            list ($saldo, $extrato) = saqueBancario($saldo, $extrato); // Chama a função para realizar o saque
        break;

        case 4: // Mostra o extrato bancário
            echo "\n------------------------\n";
            echo "EXTRATO\n";
            echo "-------------------------\n";
            if(empty($extrato)){
                echo "Nenhuma movimentação foi realizada!\n";
            } else {
                foreach($extrato as $mov){
                    echo $mov . "\n";
                }
                echo "Saldo autal: R$ " . number_format($saldo, 2, ",", ".") . "\n";
            }
        break;

        case 5: // Sai do programa
            echo "Saindo...";
        break;

        default:
            echo "Opção inválida/inexistente! Verifique!\n"; // Caso uma opção inválida seja enviada
        break;
    }

} while ($opcao != 5);  // o loop para quando o usuário digitar 0 (zero)

?>
