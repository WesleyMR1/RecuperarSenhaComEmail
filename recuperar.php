<?php
    include('Conexao.php');
    include('conexaoEmail.php');
    $pdo = conectar();

    if (isset($_GET['linkCodigo'])) {
        $codigo = $_GET['linkCodigo'];
        //descriptografaremail

        $res = $pdo->query("SELECT * from codigolink where codigo = '$codigo' AND data > Now();");
        $resul = $res->fetch(PDO::FETCH_ASSOC);

        $emailCriptografado = base64_decode($resul['emailCriptografado']);

        if (isset($resul['codigo'])) {
            //
            if (isset($_POST['acao']) && $_POST['acao'] == "mudar") {
                $novaSenha = $_POST['novaSenha'];

                $atualizar = $pdo->query("UPDATE contas set senha = '$novaSenha' where email = '$emailCriptografado' ;");
                if ($atualizar) {
                    enviarEmail("testandoophpmaile@gmail.com", "Senha modificada!", "Senha modificada com sucesso!");
                    $pdo->query("DELETE from codigolink where codigo = '$codigo';");
                    echo "Senha modificada!";
                    header("Location: 1.php");
                }
            }

?>
    <h1>Digite a senha nova</h1>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="novaSenha">
    
    <input type="hidden" name="acao" value="mudar">

    <input type="submit" name="submit">
</form>


<?PHP
}else {
    echo "<h1>\"Link Expirado\"</h1>";
}
}

?>