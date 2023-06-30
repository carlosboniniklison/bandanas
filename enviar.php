
    <?php
    
    error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
    ini_set("include_path", '/home/qsxgxtsm/php:' . ini_get("include_path") );
    
    require_once "Mail.php";
    
    // parametros SMTP - repasar puerto según Raiola y captcha
    $host = "localhost";
    $port = "25";
    /* $auth = true;
    lo siguiente tomado de https://pear.php.net/manual/en/package.mail.mail.factory.php 
    en lugar de la linea anterior*/
    $auth = "PLAIN";
    $socket_options = array('ssl' => array('verify_peer_name' => false));
    $username = "desdelaweb@coastcolors.es";
    $password = "hy2Mr75!z78Y";
    $smtpinfo = array ('host' => $host, 'port' => $port, 'auth' => $auth, 'socket_options' => $socket_options, 'username' => $username, 'password' => $password);

    // destinatario
    $recipiente = "formularioweb@coastcolors.es";

    // parametros HEADER
    $email_from = $_POST["remite"].' <'.$_POST["email"].'>';
    $email_to = "Bandanas CoastColors <formularioweb@coastcolors.es>";
    $email_subject = "Pedido de Información comercial - bandanas" ;
    $email_reply = $_POST["email"];
    $email_cc = $_POST["email"];
    $email_bcc = "cboni@axartec.com";
    $headers = array ('From' => $email_from, 'To' => $email_to, 'Subject' => $email_subject, 'Cc' => $email_cc, 'Bcc' => $email_bcc, 'Reply-To' => $email_reply);
    
    // cuerpo del mensaje
    $email_body = $_POST["msg"];
    
    // conecto y envio el mensaje
    $smtp = Mail::factory('smtp', $smtpinfo);
    $mail = $smtp->send($recipiente, $headers, $email_body);
    
    // valido exito del envio
    if (PEAR::isError($mail)) {
       $msgerror = $mail->getMessage();
       echo "<script>alert('".$msgerror."Mensaje Enviado');</script>";
    } else {
       echo "<script>alert('Mensaje Enviado');</script>";
    };

    header("refresh: 1; url = ./index.html");
    exit;
    
    ?>
    