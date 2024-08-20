<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $acao = $_POST['acao'];
    $chave = escapeshellarg($_POST['chave']);
    $frase = escapeshellarg($_POST['frase']);

    if ($acao === 'criptografar') {
        $comando = "echo $frase | openssl enc -aes-256-cbc -base64 -pbkdf2 -iter 100000 -pass pass:$chave";
    } elseif ($acao === 'descriptografar') {
        $comando = "echo $frase | openssl enc -aes-256-cbc -d -base64 -pbkdf2 -iter 100000 -pass pass:$chave";
    } else {
        echo "Ação inválida!";
        exit;
    }

    // Executa o comando
    $resultado = shell_exec($comando);

    echo "Resultado: $resultado";
}
?>
