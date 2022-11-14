<?php

include('Conexao.php');
include('conexaoEmail.php');

function enviaLinkEmail($email){

    date_default_timezone_set("America/Sao_Paulo");
    
    $pdo = conectar();

    $res = $pdo->prepare("select * from contas where email = :email limit 1");
        $res->bindValue(':email', $email);
        $res->execute();
        $cadastroExistente = $res->fetch(PDO::FETCH_ASSOC);
        //se não existir retornar mensagem
        if (!isset($cadastroExistente['email'])) {
           echo "Não existe";
        }else{

   
    $now = date("d/m/Y H:i:s"); 
    $emailCrip = base64_encode($email);
    $linkCodigo = password_hash(base64_encode($now), PASSWORD_DEFAULT);
    $dataExpirar = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $res = $pdo->query("insert into codigolink values (0,'$linkCodigo','$dataExpirar', '$emailCrip');");
    //manda email
    // echo "<a href=\"recuperar.php?linkCodigo=$linkCodigo\">Recuperar Senha</a>";
    try {
        enviarEmail("testandoophpmaile@gmail.com", "Link para recuperar", "<a href=\"http://localhost/workspace4/recuperar.php?linkCodigo=$linkCodigo\">Recuperar Senha</a>");
    }catch (Exception $e) {
        echo $e->getMessage();
    }


}

}