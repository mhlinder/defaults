
<?php

$session     = $_POST['session'];
$presenter   = $_POST['presenter'];
$email       = $_POST['email'];
$affiliation = $_POST['affiliation'];
$title       = $_POST['title'];
$authors     = $_POST['authors'];
$abstract    = $_POST['abstract'];

$email = strtolower($email);
$presenter = filter_var($presenter, FILTER_SANITIZE_STRING);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$affiliation = filter_var($affiliation, FILTER_SANITIZE_STRING);
$title = filter_var($title, FILTER_SANITIZE_STRING);
$authors = filter_var($authors, FILTER_SANITIZE_STRING);
$abstract = filter_var($abstract, FILTER_SANITIZE_STRING);

if (empty($presenter) || empty($email) || empty($affiliation) || empty($title) || empty($authors) || empty($abstract)) { ?>

    <h2>Registration unsuccessful!</h2>
    <p><span class="red">Please fill in all required fields.</span></p>
    <p>
      <b>Missing fields: </b>
      <ul>
        <?php if (empty($presenter)) { echo("<li>Presenting author</li>"); } ?>
        <?php if (empty($email)) { echo("<li>Presenter email</li>"); } ?>
        <?php if (empty($affiliation)) { echo("<li>Presenter affiliation</li>"); } ?>
        <?php if (empty($title)) { echo("<li>Title</li>"); } ?>
        <?php if (empty($authors)) { echo("<li>Full author list</li>"); } ?>
        <?php if (empty($abstract)) { echo("<li>Abstract body</li>"); } ?>
      </ul>
    </p>
    <p><input name="Back" type="button" class="text" value="Back"
	      onClick="javascript:history.back()" /></p>

<?php } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { ?>

    <h2>Registration unsuccessful!</h2>
    <p><span class="red">The email provided is invalid.</span></p>
    <p><input name="Back" type="button" class="text" value="Back"
	      onClick="javascript:history.back()" /></p>

<?php } else { ?>

    <p><strong class="red">Please review your submission carefully. The
      fields will be printed in the program booklet exactly as
      shown. (LaTeX will be rendered.)</strong></p>

    <p>
      <table>
        <tr><td><strong>Session</strong></td><td><?php echo $session; ?></td></tr>
        <tr><td><strong>Presenting author</strong></td><td><?php echo $presenter; ?></td></tr>
        <tr><td><strong>Presenter email</strong></td><td><?php echo $email; ?></td></tr>
        <tr><td><strong>Presenter affiliation</strong></td><td><?php echo $affiliation; ?></td></tr>
        <tr><td><strong>Title</strong></td><td><?php echo $title; ?></td></tr>
        <tr><td><strong>Full author list</strong></td><td><?php echo $authors; ?></td></tr>
        <tr><td><strong>Abstract text (raw LaTeX)</strong></td><td><code><?php echo $abstract; ?></code></td></tr>
      </table>
    </p>

    <p>
      <form id="data" name="data" method="post" enctype="multipart/form-data" action="abstractsend">
        <input type="hidden" name="session" value="<?php echo $session; ?>">
        <input type="hidden" name="preesenter" value="<?php echo $presenter; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="affiliation" value="<?php echo $affiliation; ?>">
        <input type="hidden" name="title" value="<?php echo $title; ?>">
        <input type="hidden" name="authors" value="<?php echo $authors; ?>">
        <input type="hidden" name="abstract" value="<?php echo $abstract; ?>">

	    <input name="Back" type="button" class="text" value="Back"
		   onClick="javascript:history.back()" />
	    <input type="submit" name="Submit" value="Submit abstract" />
	</form>
    </p>

<?php } ?>

