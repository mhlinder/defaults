
<?php

$shortcourse = $_POST['shortcourse'];
$scpay = $_POST['scpay'];
$sconly = $_POST['sconly'];
$registration = $_POST['registration'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$org = $_POST['org'];
$dept = $_POST['dept'];
$reception = $_POST['reception'];
$dinner = $_POST['dinner'];
$donation = $_POST['donation'];
$comments = $_POST['comments'];

$email = strtolower($email);
$comments = stripslashes($comments);

if (empty($fname) || empty($lname) || empty($email) || empty($org)) { ?>

    <h2>Registration unsuccessful!</h2>
    <p><span class="red">Please fill in all required fields.</span></p>
    <p>
      <b>Missing fields: </b>
      <ul>
        <?php if (empty($fname)) { echo("<li>First name</li>"); } ?>
        <?php if (empty($lname)) { echo("<li>Last name</li>"); } ?>
        <?php if (empty($email)) { echo("<li>Email</li>"); } ?>
        <?php if (empty($org)) { echo("<li>Organization</li>"); } ?>
      </ul>
    </p>
    <p><input name="Back" type="button" class="text" value="Back"
	      onClick="javascript:history.back()" /></p>

<?php } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { ?>

    <h2>Registration unsuccessful!</h2>
    <p><span class="red">The email provided is invalid.</span></p>
    <p><input name="Back" type="button" class="text" value="Back"
	      onClick="javascript:history.back()" /></p>

<?php } elseif (!is_numeric($donation) || (int)$donation < 0) { ?>

    <h2>Registration unsuccessful!</h2>
    <p><span class="red">The donation must be a positive value.</span></p>
    <p><input name="Back" type="button" class="text" value="Back"
	      onClick="javascript:history.back()" /></p>

<?php } elseif (strcmp($registration, "None") == 0 && strcmp($sconly, "No") == 0) { ?>

    <h2>Registration unsuccessful!</h2>
    <p><span class="red">CONFERENCE Registration cannot be "None".</span></p>
    <p><input name="Back" type="button" class="text" value="Back"
	      onClick="javascript:history.back()" /></p>

<?php } elseif ((strcmp($shortcourse, "None") == 0 && strcmp($scpay, "0") !== 0) || (strcmp($shortcourse, "None") !== 0 && strcmp($scpay, "0") == 0)) { ?>

    <h2>Registration unsuccessful!</h2>
    <p><span class="red">To register for a short course, you must both
    select a short course, and a short course registration
    type.</span></p> 
    <p><input name="Back" type="button" class="text" value="Back"
	      onClick="javascript:history.back()" /></p>

<?php } elseif (strcmp($sconly, "Yes") == 0 && strcmp($shortcourse, "None") == 0) { ?>

    <h2>Registration unsuccessful!</h2>
    <p><span class="red">Please register for CONFERENCE or a short course (or both!).</span></p>
    <p><input name="Back" type="button" class="text" value="Back"
	      onClick="javascript:history.back()" /></p>

<?php } else {

    $charge = 0;
    if ($registration == 'Non-Student ($40)') {
	$charge += 40;
    } elseif ($registration == 'Student ($20)') {
	$charge += 20;
    }

    $charge += (int)$donation;

    $name = $fname . " " . $lname;

    if ($scpay == "0") {
        $sclabel = "None";
    } elseif ($scpay == "250") {
        $sclabel = "Non-student ($250)";
    } elseif ($scpay == "150") {
        $sclabel = "Non-student CT employee ($150)";
    } else {
        $sclabel = "Student ($50)";
    }
    $charge += (int)$scpay;

    if ($dinner == "Yes") {
        $charge += 40;
    }

?>

    <table>
	<tr><td><b>Short Course</b></td><td><?php echo $shortcourse; ?></td></tr>
	<tr><td><b>Short Course Registration Type</b></td><td><?php echo $sclabel; ?></td></tr>
	<tr><td><b>Short Course Only</b></td><td><?php echo $sconly; ?></td></tr>
	<tr><td><b>Registration</b></td><td><?php echo $registration; ?></td></tr>
	<tr><td><b>Name</b></td><td><?php echo $name; ?></td></tr>
	<tr><td><b>Email</b></td><td><?php echo $email; ?></td></tr>
	<tr><td><b>Reception</b></td><td><?php echo $reception; ?></td></tr>
	<tr><td><b>Dinner</b></td><td><?php
                                      echo $dinner;
                                      if (strcmp($dinner, "Yes") == 0) {
                                          echo " (\$40)";
                                      }
                                      ?></td></tr>
	<tr><td><b>Donation</b></td><td>$<?php echo $donation; ?></td></tr>
	<tr><td><b>Comments</b></td><td><?php echo $comments; ?></td></tr>
	<tr class="total">
	    <td class="total"><b>Total charge</b></td>
	    <td class="total">$<?php echo $charge; ?></td>
	</tr>
    </table>

    <p>
	<form id="data" name="data" method="post" enctype="multipart/form-data" action="regsend">
	    <input type="hidden" name="shortcourse" value="<?php echo $shortcourse; ?>">
	    <input type="hidden" name="sclabel" value="<?php echo $sclabel; ?>">
	    <input type="hidden" name="sconly" value="<?php echo $sconly; ?>">
	    <input type="hidden" name="registration" value="<?php echo $registration; ?>">
	    <input type="hidden" name="name" value="<?php echo $name; ?>">
	    <input type="hidden" name="email" value="<?php echo $email; ?>">
	    <input type="hidden" name="org" value="<?php echo $org; ?>">
	    <input type="hidden" name="dept" value="<?php echo $dept; ?>">
	    <input type="hidden" name="reception" value="<?php echo $reception; ?>">
	    <input type="hidden" name="dinner" value="<?php echo $dinner; ?>">
	    <input type="hidden" name="donation" value="<?php echo $donation; ?>">
	    <input type="hidden" name="comments" value="<?php echo $comments; ?>">
	    <input type="hidden" name="charge" value="<?php echo $charge; ?>">

	    <input name="Back" type="button" class="text" value="Back"
		   onClick="javascript:history.back()" />
	    <input type="submit" name="Submit" value="Submit registration" />
	</form>
    </p>

<?php }

?>

