
<?php

$shortcourse = $_POST['shortcourse'];
$sclabel = $_POST['sclabel'];
$sconly = $_POST['sconly'];
$registration = $_POST['registration'];
$name = $_POST['name'];
$email = $_POST['email'];
$org = $_POST['org'];
$dept = $_POST['dept'];
$reception = $_POST['reception'];
$dinner = $_POST['dinner'];
$donation = $_POST['donation'];
$charge = $_POST['charge'];
$comments = $_POST['comments'];

$hash = rand(0, 10000);
$conf = strtoupper("CONFERENCE17-$hash");

if (strcmp($dinner, "Yes") == 0) {
    $dinner_string = "Yes (\$40)";
} else {
    $dinner_string = "No";
}

$table =  "<table>
    <tr><td><b class=\"red\">Invoice #</b></td><td class=\"red\">$conf</td></tr>
    <tr style=\"border-bottom: 1px solid black;\">
	<td class=\"red\"><b>Total charge</b></td>
	<td class=\"red\">$$charge</td>
    </tr>
    <tr><td style=\"padding-top: 12px;\"><b>Short Course</b></td><td style=\"padding-top: 12px;\">$shortcourse</td></tr>
    <tr><td><b>Short Course Registration Type</b></td><td>$sclabel</td></tr>
    <tr><td><b>Short Course Only</b></td><td>$sconly</td></tr>
    <tr><td><b>Registration</b></td><td>$registration</td></tr>
    <tr><td><b>Name</b></td><td>$name</td></tr>
    <tr><td><b>Email</b></td><td>$email</td></tr>
    <tr><td><b>Reception</b></td><td>$reception</td></tr>
    <tr><td><b>Dinner</b></td><td>$dinner_string</td></tr>
    <tr><td><b>Donation</b></td><td>$$donation</td></tr>
    <tr><td><b>Comments</b></td><td>$comments</td></tr>
</table>";

$date = date("F j, Y");

$msg = "<h2>Your registration for the 31st New England Statistical
Symposium was received on $date.</h2>

<p>CONFERENCE will be hosted on DATE,
by the Department of Statistics at the University of Connecticut.</p>

<p>$table</p>

<p><span class=\"red\">You may pay with a credit card <a
href=\"http://bursar.uconn.edu/statistics-payment-store/\"
target=\"_blank\" class=\"red\">here</a>.</span> Please use the invoice number listed
above and in your confirmation email, and enter the description \"CONFERENCE\".</p>

<p>For payment with check, please send a check made payable to \"Department of Statistics, University of Connecticut\" with your invoice
number to</p>

<p>
CONFERENCE c/o Megan Petsa<br />
Department of Statistics<br />
Room 323, Philip E. Austin Building<br />
University of Connecticut<br />
215 Glenbrook Rd. U-4120<br />
Storrs, CT 06269-4120
</p>

";

// Send email confirmation
$cc = "mhlinder@gmail.com";
/* $cc = "matthew.linder@uconn.edu";
 * $cc .= ",jun.yan@uconn.edu";
 * $cc .= ",haim.bar@uconn.edu";
 * $cc .= ",ming-hui.chen@uconn.edu";
 * $cc .= ",tracy.burke@uconn.edu";
 * $cc .= ",megan.petsa@uconn.edu";*/

$subject = "CONFERENCE 2017: Confirmation";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: CONFERENCE 2017<mhlinder@gmail.com>' . "\r\n";
$headers .= "Cc: $cc" . "\r\n";

$fp = fopen('reg.csv', 'a');
$fpcheck = fputcsv($fp, array($conf,$name, $email, $shortcourse, $sconly,
			      $registration, $reception, $dinner,
			      $donation, $comments, $charge));
fclose($fp);

if (!$fpcheck) {
    echo "<p class=\"red\">There was an error and your registration was not saved!</p>";
} else {
    echo $msg;
    $success = mail($emails, $subject, $msg, $headers);
    echo "<p class=\"red\">A confirmation will be sent to $email.</span></p>";
}

?>

