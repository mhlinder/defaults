<?php

$handle = fopen("reg.csv", "r");

$hdr = "invoice,name,email,shortcourse,sconly,registration,reception,dinner,donation,comments,charge";
$n_total = 0;
$n_dinner = 0;
$n_sc1 = 0;
$n_sc2 = 0;
$n_sc3 = 0;
$n_sc_only = 0;
$n_reception = 0;
$n_dinner = 0;
$total_donated = 0;
while ( ($data = fgetcsv($handle)) !== FALSE ) {

    // The first row is the CSV column names
    if (strcmp($data[0], "invoice") !== 0) {
        $n_total = $n_total + 1;

        // Number of short course attendees
        if (strcmp($data[3], "1") == 0) {
            $n_sc1 = $n_sc1 + 1;
        } elseif (strcmp($data[3], "2") == 0) {
            $n_sc2 = $n_sc2 + 1;
        } elseif (strcmp($data[3], "3") == 0) {
            $n_sc3 = $n_sc3 + 1;
        }
        
        // Short-course only?
        if (strcmp($data[4], "Yes") == 0) {
            $n_sc_only = $n_sc_only + 1;
        }

        // Reception
        if (strcmp($data[6], "Yes") == 0) {
            $n_reception = $n_reception + 1;
        }
        
        // Dinner
        if (strcmp($data[7], "Yes") == 0) {
            $n_dinner = $n_dinner + 1;
        }

        // Donation
        $total_donated = $total_donated + intval($data[8]);
    }
}


?>


<table>
  <tr style="border-bottom: 1px solid black;">
    <td>Total registrants</td>
    <td><?php echo $n_total; ?></td>
  </tr>

  <tr>
    <td style="padding-top: 12px;">Short course 1</td>
    <td style="padding-top: 12px;"><?php echo $n_sc1; ?></td>
  </tr>
  <tr>
    <td>Short course 2</td>
    <td><?php echo $n_sc2; ?></td>
  </tr>
  <tr>
    <td>Short course 3</td>
    <td><?php echo $n_sc3; ?></td>
  </tr>

  <tr style="border-bottom: 1px solid black;">
    <td>Number of short course-only</td>
    <td><?php echo $n_sc_only; ?></td>
  </tr>

  <tr>
    <td style="padding-top: 12px;">Reception attendees</td>
    <td style="padding-top: 12px;"><?php echo $n_reception; ?></td>
  </tr>

  <tr style="border-bottom: 1px solid black;">
    <td>Dinner attendees</td>
    <td><?php echo $n_dinner; ?></td>
  </tr>

  <tr>
    <td style="padding-top: 12px;">Total donated</td>
    <td style="padding-top: 12px;">$<?php echo $total_donated; ?></td>
  </tr>
</table>

