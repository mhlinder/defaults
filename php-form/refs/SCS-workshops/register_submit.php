<html>
  <head>
<title>SCS Workshop Registration</title>
<link rel="stylesheet" type="text/css" href="style.css">
  </head>

<body>
<div class="main">
  <h1>SCS Workshop Registration</h1>
  <img class="header" src="../BeSignificant.png" />
<hr />
<br />
	   <?php

// Count people already registered
$infile = file('reg.csv');
$reg = array();
foreach ($infile as $line) {
  $reg[] = str_getcsv($line);
}

$c1 = 0;
$c2 = 0;
$c3 = 0;

$n = count($reg);
for ($i = 0; $i < $n; $i++) {
  $r = $reg[$i+1];

  if ($r[5] == 1) $c1 += 1;
  if ($r[6] == 1) $c2 += 1;
  if ($r[7] == 1) $c3 += 1;
}

// Read form data
  $name      = $_POST['name'];
  $user      = $_POST['email'];
  $host      = $_POST['host'];
  $affil     = $_POST['affiliation'];
  $dept      = $_POST['department'];
  $workshops = $_POST['workshops'];
  $lunch     = $_POST['lunch'];
  $diet      = $_POST['diet'];

$admin = $_GET['admin'];
if (!empty($admin) && strcmp($admin, "ness16") == 0) {
  echo "Workshop 1:&nbsp;&nbsp;" . $c1 . " registered.<br />\n";
  echo "Workshop 2:&nbsp;&nbsp;" . $c2 . " registered.<br />\n";
  echo "Workshop 3:&nbsp&nbsp;" . $c3 . " registered.<br />\n";
} else if (($c1 >=40 && $c2 >= 40 && $c3 >= 40) || !empty($_GET["closed"])) {
    echo "<h2 style=\"color:blue;\">All workshops are full.</h2>";
    echo "<h3>Thanks for your interest! Sign up for our interest mailing list below.</h3>\n";
    echo "<br /><form id=\"email_form\" method=\"post\" enctype=\"multipart/form-data\" action=\"email_submit.php\">";
    echo "Email: <input type=\"text\" name=\"email\" /> ";
    echo '<input type="submit" name="Submit" value="Sign up" />';
    echo "</form>";
} else if (!empty($name) && !empty($user) && !empty($affil)
           && !empty($dept) && !empty($workshops)) {

  $email = $user . "@" . $host . ".edu";
  $overbooked1 = 0;
  $overbooked2 = 0;
  $overbooked3 = 0;

  $w1 = 0;
  if (in_array("1", $workshops)) {
    if ($c1 < 40) $w1 = 1;
    else $overbooked1 = 1;
  }
  $w2 = 0;
  if (in_array("2", $workshops)) {
    if ($c2 < 40) $w2 = 1;
    else $overbooked2 = 1;
  }
  $w3 = 0;
  if (in_array("3", $workshops)) {
    if ($c3 < 40) $w3 = 1;
    else $overbooked3 = 1;
  }
  if (empty($diet)) {
    $diet = "NA";
  }

  if ($overbooked1 == 1)
    echo "<h2 style=\"color:blue;\">The Survey Design workshop is already full!</h2>";
  if ($overbooked2 == 1)
    echo "<h2 style=\"color:blue;\">The Survey Size workshop is already full!</h2>";
  if ($overbooked3 == 1)
    echo "<h2 style=\"color:blue;\">The Repeated Measures workshop is already full!</h2>";
  if ($overbooked1 == 1 || $overbooked2 == 1 || $overbooked3 == 1)
    echo "<hr />";

  // Write to CSV
  $fp = fopen('reg.csv', 'a');
  fputcsv($fp,
          array($name, $email, $host, $affil, $dept, $w1, $w2, $w3, $lunch, $diet));
  fclose($fp);

  echo '<h2>Registration successful</h2>';
  echo 'Thank you for registering for the SCS workshops on May 11, 2016.
    You will receive a confirmation email shortly.<br />';
  
  $d = date('D, d M Y H:i:s');
  $mail_body = "<h3>Registration Confirmation</h3>\n";
  $mail_body = $mail_body.'<b>Date:</b> '.$d."<br />\n";
  $mail_body = $mail_body.'<b>Name:</b> '.$name."<br />\n";
  $mail_body = $mail_body.'<b>Email:</b> '.$email."<br />\n";
  $mail_body = $mail_body.'<b>Affiliation:</b> '.$affil."<br />\n";
  $mail_body = $mail_body.'<b>Department:</b> '.$dept."<br />\n";
  $mail_body = $mail_body.'<b>Session(s):</b> <ul>';
  if ($w1 == 1) {
    $mail_body = $mail_body . "<li>Survey Design (9:30am&ndash;11:30am)</li>";
  }
  if ($w2 == 1) {
    $mail_body = $mail_body . "<li>Sample Size (1:00pm&ndash;3:00pm)</li>";
  }
  if ($w3 == 1) {
    $mail_body = $mail_body . "<li>Repeated Measures (3:30pm&ndash;5:30pm)</li>";
  }
  $mail_body = $mail_body.'</ul>';
  $mail_body = $mail_body . "<br /><b>Lunch</b>: ";
  if (strcmp($lunch, "yes") == 0) {
    $mail_body = $mail_body . "Yes";
    if (strcmp($diet, "NA") != 0) {
      $mail_body = $mail_body . "<br />";
      $mail_body = $mail_body . "<b>Dietary restrictions:</b> ";
      $mail_body = $mail_body . $diet;
    }
  } else {
    "No";
  }
  $mail_body = $mail_body."<br /><br /><b>Note:</b> Workshops will be held in AUST 163,
    and lunch will be held in AUST 326.<br /><br />";

  $headers = "From: \"UConn Statistical Consulting Services\"\r\n";
  $headers .= "Reply-To: \"".$name."\" <".$email.">\r\n";
  $recipients = '"'.$name.'" <'.$email.'>';
  $recipients .= ', "M. Henry Linder" <m.henry.linder@uconn.edu>';
//   $recipients .= ', "Ellis Shaffer" <ellis.shaffer@uconn.edu>';
//   $recipients .= ', "Brian Bader" <brian.bader@uconn.edu>';
//   $recipients .= ', "Ming-Hui Chen" <ming-hui.chen@uconn.edu>';
//   $recipients .= ', "Sarah Crothers" <sarah.crothers@uconn.edu>';
  $mail_subject = 'SCS Workshop Registration ('.$d.')';
  
  // http://stackoverflow.com/questions/22372084/how-to-attach-and-send-file-in-email-using-form-php
  $hash = md5(uniqid(time()));
  $headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"".$hash."\"\r\n\r\n";
  $headers .= "--".$hash."\r\n";
  $headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
  $headers .= "Content-Transfer-Encoding: 7bit\r\n\r\n\r\n";

  $headers .= str_replace("\n", "<br />", $mail_body)."\r\n\r\n";
  $headers .= "--".$hash."\r\n";
  
  echo '<br /><hr />'.$mail_body;

  mail($recipients, $mail_subject, "", $headers);
  
} else {
  echo '<h2>Submission unsuccessful</h2>';
  if (empty($name))
    echo '<b>The field "Name" is required.</b><br />';
  
  if (empty($user)) {
    echo '<b>The field "Email" is required.</b><br />';
  }

  if (empty($affil))
    echo '<b>The field "Affiliation" is required.</b><br />';

  if (empty($dept))
    echo '<b>The field "Department" is required.</b><br />';

  if (empty($workshops))
    echo '<b>Please select at least one workshop to attend.</b><br />';

  echo '<br />';
  echo 'Please go back and complete the submission form.';
  echo '<br /><br /><form><input name="Change" type="button" value="Back"
  onClick="javascript:history.back()"></form>';
}

?>

<hr />
<br />
Please direct inquiries to brian.bader@uconn.edu and m.henry.linder@uconn.edu.
<br /><br /><br />
    
</div> <!-- .main -->
</body>
</html>
