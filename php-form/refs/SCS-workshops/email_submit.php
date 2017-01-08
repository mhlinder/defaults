
<html>
<head>
<title>SCS Mailing List</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="main">
<h1>SCS Mailing List</h1>
<img class="header" src="../BeSignificant.png" />
<hr />
<br />
Thank you for adding your email to the SCS interest mailing list.
<br />
<br />
<hr />
<br />
<br />
<br />

<?php

  $email = $_POST['email'];

  $mail_body = "The email address " . $email . " should be added to the SCS interest mailing list.";
  $headers = "From: \"UConn Statistical Consulting Services\"\r\n";
  $headers .= "Reply-To: \"".$name."\" <".$email.">\r\n";
  $recipients .= ', "M. Henry Linder" <m.henry.linder@uconn.edu>';

  $mail_subject = 'SCS interest mailing list';
  $hash = md5(uniqid(time()));
  $headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"".$hash."\"\r\n\r\n";
  $headers .= "--".$hash."\r\n";
  $headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
  $headers .= "Content-Transfer-Encoding: 7bit\r\n\r\n\r\n";

  $headers .= str_replace("\n", "<br />", $mail_body)."\r\n\r\n";
  $headers .= "--".$hash."\r\n";
 
  mail($recipients, $mail_subject, "", $headers);
?>

</div>
</body>
</html>
