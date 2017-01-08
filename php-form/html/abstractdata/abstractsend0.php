
<?php

$session     = $_POST['session'];
$presenter   = $_POST['presenter'];
$email       = $_POST['email'];
$affiliation = $_POST['affiliation'];
$title       = $_POST['title'];
$authors     = $_POST['authors'];
$abstract    = $_POST['abstract'];

$hash = rand(0, 10000);
$conf = strtoupper("ABSTRACT-$hash");

$fp = fopen('abstractdata/abstracts.csv', 'a');
$fpcheck1 = fputcsv($fp, array($session, $presenter, $email,
                               $affiliation, $title, $authors, $conf));
fclose($fp);

$fp = fopen('abstractdata/save/' . $conf . '.txt', 'w');
$fpcheck2 = fwrite($fp, $abstract);
fclose($fp);

if (!$fpcheck1 && !$fpcheck2) {
    echo("<p class=\"red\">There was an error and your registration was not saved!</p>");
} else {
    echo("<p class=\"red\">Your registration was successful.</p>");
}

?>

