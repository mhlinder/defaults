<?php

$handle = fopen("regdata/reg.csv", "r");

$n = 0;
while ( ($data = fgetcsv($handle)) !== FALSE ) {

    // The first row is the CSV column names
    if (strcmp($data[0], "invoice") !== 0) {
        // Number of dinner attendees
        if (strcmp($data[7], "Yes") == 0) {
            $n = $n + 1;
        }
    }
}

?>

<form id="registration" name="registration" method="post" enctype="multipart/form-data" action="regconf">
  <table>
    <tr>
      <td>
        Short Course:<br />
        <small>Click <a href="short-courses">here</a>
          for a full description of each short course.</small>
      </td>
      <td>
	<select name="shortcourse">
	  <option value="None" selected="selected">No short course</option>
	  <option value="1">Short Course 1</option>
	  <option value="2">Short Course 2</option>
	  <option value="3">Short Course 3</option>
	</select>
      </td>
    </tr>

    <tr>
      <td>Short course registration type:<br />
        <small>Must be non-"None" if a short course is selected.</small></td>

      <td>
        <select name="scpay">
          <option value="0" selected="select">None</option>
          <option value="250">Non-student ($250)</option>
          <option value="150">Non-student CT employee ($150)</option>
          <option value="50">Student ($50)</option>
        </select>
      </td>
    </tr>


    <tr>
	<td>Short course only<span class="red">*</span></td>
	<td>
	    <input type="radio" name="sconly" value="No" checked> No
	    <input type="radio" name="sconly" value="Yes"> Yes
	</td>
    <tr>
      <td>CONFERENCE Registration<span class="red">*</span></td>
      <td>
	<select name="registration">
	  <option value="Non-Student ($40)" selected="selected">Non-Student ($40)</option>
	  <option value="Student ($20)">Student ($20)</option>
	  <option value="Student Presenter ($0)">Student Presenter ($0)</option>
	  <option value="None">None</option>
	</select>
      </td>
    </tr>

    <tr>
      <td>First name<span class="red">*</span></td>
      <td><input type="text" name="fname" /></td>
    </tr>

    <tr>
      <td>Last name<span class="red">*</span></td>
      <td><input type="text" name="lname" /></td>
    </tr>

    <tr>
      <td>Email<span class="red">*</span></td>
      <td><input type="text" name="email" /></td>
    </tr>

    <tr>
      <td>Organization / Institution<span class="red">*</span></td>
      <td><input type="text" name="org" /></td>
    </tr>

    <tr>
      <td>Departmental affiliation</td>
      <td><input type="text" name="dept" /></td>
    </tr>

    <tr>
      <td>Reception<br />
        <small>Saturday evening. Included with registration.</small></td>
      <td>
	<input type="radio" name="reception" value="No" checked> No
	<input type="radio" name="reception" value="Yes"> Yes
      </td>
    </tr>

    <?php // Only this number of people may register for dinner
    if ($n < 40) { ?>

      <tr>
        <td>Dinner<br /><small>Saturday evening. Cost $40. Max 40 seats.</small></td>
        <td>
	  <input type="radio" name="dinner" value="No" checked> No
	  <input type="radio" name="dinner" value="Yes"> Yes
        </td>
      </tr>

    <?php } else { ?>

      <input type="hidden" name="dinner" value="No">

    <?php }; ?>

    <tr>
      <td>Donation to CONFERENCE fund</td>
      <td>$<input type="text" name="donation" value="0" size="3" /></td>
    </tr>

    <tr>
      <td>Comments</td>
      <td>
	<textarea name="comments" rows="2" cols="25"></textarea>
      </td>
    </tr>

    <tr>
      <td>
	<input type="submit" name="Submit" value="Submit registration" />
      </td>
      <td></td>
    </tr>

  </table>

  <span class="red">Items marked with * are required.</span>

</form>
