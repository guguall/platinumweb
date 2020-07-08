<?php

class Util {

    static public function session_existe() {
        session_start();
        // pegando a hora do ultimo acesso do usuario na sessao.
        $ultimo_acesso = $_SESSION['hora_ultimo_acesso']; //14:10:40
        date_default_timezone_set('America/Sao_Paulo');
        $agora = date("Y-n-j H:i:s");

        $TEMPO_TRANSCORRIDO = (strtotime($agora)) - (strtotime($ultimo_acesso));
        if ($TEMPO_TRANSCORRIDO >= $_SESSION['TEMPO_DA_SESSAO']) {
            session_destroy();
            return FALSE;
        } else {
            return TRUE;
            $_SESSION['hora_ultimo_acesso'] = $agora;
        }
    }

    static public function format_data_AAAA_MM_DD($data_brasil) {
        list($dia, $mes, $ano) = explode('/', $data_brasil);
        $data_americana = $ano . '-' . $mes . '-' . $dia;
        return $data_americana;
    }

    static public function format_data_DD_MM_AAAA($data_americana) {
        list($ano, $mes, $dia) = explode('-', $data_americana);
        $data_brasileira = $dia . '/' . $mes . '/' . $ano;
        return $data_brasileira;
    }

    static public function format($data_str) {
        $data_real = explode(" ", $data_str);
        $data_formatada = $data_real[0];
        $hora_formatada = $data_real[1];
        $data = explode("-", $data_formatada);
        $d = $data[2] . "/" . $data[1] . "/" . $data[0];
        $sdata = $d . " " . $hora_formatada;
        return $sdata;
    }

    static public function calcula_magem($valor, $margem) {

        $percentual = 8.0 / 100.0; // 8%
        $valor_final = $valor + ($percentual * $valor);

        return $valor_final;
    }

    static public function func() {

        $valor = 178.00; // valor original
        $percentual = 15.0 / 100.0; // 15%
        $valor_final = $valor + ($percentual * $valor);

        echo "O valor final do produto é: " . $valor_final;

        // O resultado será 204,70 
//Ex: 2 - Um produto, cujo valor original era de R$ 250,00, teve um desconto de 8%. Qual foi seu valor final? Veja o código em PHP:

        $valor = 250.00; // valor original
        $percentual = 8.0 / 100.0; // 8%
        $valor_final = $valor - ($percentual * $valor);

        echo "O valor final do produto é: " . $valor_final;

        // O resultado será 230,00 
//Ex: 3 - Em um concurso de perguntas e respostas, um jovem acertou 72 das 90 perguntas apresentadas. 
//Qual foi a porcentagem de acertos? E a porcentagem de erros? Veja o código em PHP:

        $perguntas = 90;
        $acertos = 72;

        echo "Porcentagem de acertos: " .
        (($acertos / $perguntas) * 100) . "%" . "<br>";

        echo "Porcentagem de erros: " .
        ((($perguntas - $acertos) / $perguntas) * 100) . "%";

        // Os resultados serão 80% e 20%
//Ex: 4 - Um aparelho de CD foi adquirido por R$ 300,00 e revendido por R$ 240,00.
// Qual foi a porcentagem de lucro na transação? Veja o código em PHP:

        $v_ant = 300; // valor anterior
        $v_nov = 340; // valor novo
        $p_lucro = 0; // porcentagem de lucro

        while ($v_ant + (($p_lucro / 100) * $v_ant) < $v_nov) {
            $p_lucro = $p_lucro + 0.1;
        }

        echo "A porcentagem de lucro foi de: " .
        $p_lucro . "%";

        // O resultado será 13,39
    }

}