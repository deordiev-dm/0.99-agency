<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('en', 'phpmailer/language/');
	$mail->IsHTML(true);

	
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'dimadeordiev2002@gmail.com';                     //SMTP username
	$mail->Password   = 'jtkimombppzotiiy';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 


	//Від кого лист
	$mail->setFrom('dimadeordiev2002@gmail.com', '0.99agency'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('dimadeordiev2002@gmail.com'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'Звернення з сайту агенції';

	//Тіло листа
  $body = '<h1>Надішла нова заявка на консультацію!</h1>';

	if(trim(!empty($_POST['form_name']))){
		$body.="<p><strong>Ім'я особи:</strong> " . $_POST["form_name"] . "</p>";
	}	

  if(trim(!empty($_POST['form_tel']))){
		$body.="<p><strong>Номер телефону:</strong> " . $_POST["form_tel"] . "</p>";
	}	

  if(trim(!empty($_POST['form_email']))){
		$body.="<p><strong>Електронна пошта:</strong> " . $_POST["form_email"] . "</p>";
	}	

  if(trim(!empty($_POST['form_service']))){
		$body.="<p><strong>Обрана послуга:</strong> " . $_POST["form_service"] . "</p>";
	}	

  if(trim(!empty($_POST['form_message']))){
		$body.="<strong>Повідомлення:</strong> : " . $_POST["form_message"] . "</p>";
	}

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Помилка';
	} else {
		$message = 'Дані надіслані!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>