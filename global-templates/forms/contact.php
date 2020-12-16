<?php
if(isset($_POST['g-recaptcha-response']) and $_POST['g-recaptcha-response']) {
    $secret = '6LdSW88ZAAAAAHlf7qI_lkRgdG4c4LiA86BE8BGU';
    $captcha = $_POST['g-recaptcha-response'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha.'&remoteip='.$ip.'');
    $array = json_decode($result, TRUE);
}

// Contacto
$data_name = $_POST['data-name'];
$data_email = $_POST['data-email'];
$data_country = $_POST['data-country'];
$data_message = $_POST['data-message'];

require get_template_directory() . '/vendor/php/phpmailer/PHPMailerAutoload.php';

$mail1 = new PHPMailer;
$mail1->CharSet = 'UTF-8';

$meta_email_from = get_field( 'meta_email_sender', 'option' );
$meta_contacto = get_field( 'meta_email_recipient', 'option' );

$mail1->addReplyTo( $data_email, $data_name );

$mail1->setFrom( $meta_email_from, get_bloginfo('name') );

$mail1->addAddress($meta_contacto);

$mail1->isHTML(true);
$mail1->Subject = 'Contato do '. get_bloginfo('name').' - '.get_the_title();

$mail1->Body = '<ul><li>Nome e sobrenome: '.$data_name.'</li>';
$mail1->Body .= '<li>Correio eletrônico: '.$data_email.'</li>';
$mail1->Body .= '<li>País: '.$data_country.'</li>';
$mail1->Body .= '<li>Mensagem: '.$data_message.'</li></ul>';

if($mail1->send()) {
    $form_result = 1;
} else {
    $form_result = 0;
}
