<?php 
require_once "src/conexao.php"; // Inclui a conexão

$mensagem = "Preencha o formulário";
$usu = $sen = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usu = htmlspecialchars(trim($_POST['usu']), ENT_QUOTES, 'UTF-8');
    $sen = htmlspecialchars(trim($_POST['sen']), ENT_QUOTES, 'UTF-8');

    if (!$usu || !$sen) {
        echo "Usuário ou senha inválidos!";
    } else {
        $stmt = $conexao->prepare("INSERT INTO usuarios (usuario, senha) VALUES (:usu, :sen)");
        $stmt->bindParam(":usu", $usu);
        $stmt->bindParam(":sen", $sen);
        $stmt->execute();

        $mensagem = "Cadastro realizado com sucesso!";
        $usu = $sen = "";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form action="" method="post" autocomplete="off">
        <p>
            <label for="iusu">Usuário:</label>
            <input type="text" name="usu" id="iusu" required minlength="5" maxlength="15">
        </p>
        <p>
            <label for="isen">Senha:</label>
            <input type="password" name="sen" id="isen" required minlength="8" maxlength="20">
        </p>
        <p>
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
        </p>
    </form>
    <p><?php echo $mensagem; ?></p>
</body>
</html>
