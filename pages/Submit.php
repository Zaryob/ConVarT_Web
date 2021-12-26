<!DOCTYPE html>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../libs/PHPMailer/src/Exception.php');
require('../libs/PHPMailer/src/PHPMailer.php');
require('../libs/PHPMailer/src/SMTP.php');

require("../header.php");
require_once("../config.php");
require_once("../db_connection.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
	small {
		font-size: 1rem;
	}
</style> 
<script>
	$(document).ready(function() {
    $('select').material_select();
  });
 </script>

<?php
if (isset($_POST['submit'])) {
	$sended_by = $_POST["sended_by"];
	$email = $_POST["email"];
	$organization = $_POST["organization"];
	$organism = $_POST["organism"];
	$protein_id = $_POST["protein_id"];
	$biotype = $_POST["biotype"];
	$protein_pos = $_POST["protein_pos"];
	$aa_change = $_POST["aa_change"];
	$phenotype = $_POST["phenotype"];
	$impact = $_POST["impact"];
	$consequence = $_POST["consequence"];
	$source = $_POST["source"];
	$validation_code =  sha1($email . $sended_by . "AGU" . round(microtime(true) * 1000));

	// INSERT
	mysqli_query($db_connection, "INSERT INTO community_variants (sended_by,email,organization, organism,protein_id,biotype,protein_pos,aa_change,phenotype,impact,consequence,source, validation_code) 
	VALUES('$sended_by', '$email', '$organization', '$organism','$protein_id', '$biotype', '$protein_pos', '$aa_change', '$phenotype', '$impact', '$consequence', '$source', '$validation_code')");

	// mysqli_query($db_connection, "INSERT INTO community_variants (sended_by, email) VALUES('$sended_by', '$email')");

	if (mysqli_error($db_connection)) {
		//echo mysqli_error($db_connection);
		echo '<h3 class="red-text text-darken-1 center">Some problems occured in our database. </h3>';
		exit;
	} else {
		echo '<br><br><h3 class="green-text text-darken-1 center">Your submission has been received. Thanks!</h3> <br><br>';

		$mail = new PHPMailer(true);

		try {
			$mail->IsSMTP();
			$mail->Host = $GLOBALS['smtp_host'];
			$mail->Username = $GLOBALS['smtp_user'];

			$mail->Password = $GLOBALS['smtp_passwd'];
			$mail->Port = $GLOBALS['smtp_port'];
			#$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'ssl';
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);

			$mail->setFrom($GLOBALS['smtp_user'], 'Convart Org');
			$mail->addAddress($GLOBALS['smtp_cc']); // All related with CC. You can disable it

			// Content
			$mail->isHTML(true);
			$mail->Subject = "New Community Contributions";
			$main_body     = "<b>Variant Details</b><br>";
			$main_body    .= "<br><b>Sent By: </b> " .  $sended_by;
			$main_body    .= "<br><b>Email: </b> " .  $email;
			$main_body    .= "<br><b>Organization: </b> " .  $organization;
			$main_body    .= "<br><b>Organism: </b> " .  $organism;
			$main_body    .= "<br><b>Protein Id: </b> " .  $protein_id;
			$main_body    .= "<br><b>Biotype: </b> " . $biotype;
			$main_body    .= "<br><b>Protein Position: </b> " .  $protein_pos;
			$main_body    .= "<br><b>Aminoasit Change: </b> " .  $aa_change;
			$main_body    .= "<br><b>Phenotype: </b> " . $phenotype;
			$main_body    .= "<br><b>Impact: </b> " . $impact;
			$main_body    .= "<br><b>Consequence: </b> " . $consequence;
			$main_body    .= "<br><b>Source: </b> " . $source;
			$main_body    .= "<br><br>";
			$main_body    .= "<p><a href='https://convart.org/tool.php?validate=" . $validation_code . "'>Validate</a></p>";
			$mail->Body  = $main_body;
			$mail->MsgHTML = $main_body;
			$mail->AltBody = $main_body;
			$mail->send();
		} catch (Exception $e) {
			//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			echo '<h3 class="red-text text-darken-1 center">Some problems occured in our database. </h3>';
			exit;
		}
	};
};

?>

<div class="container pageBox white z-depth-2">
	<div class="row specialTextBox">
		<h4 class="blue-text text-darken-1 center">Submit a variant</h4><br>
		<h5> If you would like to contribute and improve ConVarT, do not hesitate to submit a new variant:</h5>
		<hr>
		<br>

		<form accept-charset="UTF-8" name="submitVariantForm" style="margin: 1em auto; max-width:800px" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

			<div class="row">
				<div class="input-field col s12">
					<input name="sended_by" placeholder="Name Surname" type="text" required class="validate">
					<label for="sended_by">Name Surname</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input name="email" placeholder="E-mail Adress" type="email" required class="validate">
					<label for="email">E-mail Adress</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input name="organization" placeholder="Organization" type="text" required class="validate">
					<label for="organization">Organization</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<select name="organism" required class="validate">
						<option value="" disabled selected>Choose your option</option>
						<option value="Homo Sapiens">Homo Sapiens</option>
						<option value="Mus Musculus">Mus Musculus</option>
						<option value="Caenorhabditis elegans">Caenorhabditis elegans</option>
					</select>
					<label for="organism">Organism Name available in ConVarT</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input name="protein_id" placeholder="(RefSeq)" type="text" required class="validate">
					<label for="protein_id">Protein ID </label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input name="biotype" placeholder=" (e.g. Protein coding)" type="text">
					<label for="biotype">Bio Type </label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input name="protein_pos" placeholder=" (e.g. 136)" type="text" required class="validate">
					<label for="protein_pos">Amino acid Position</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input name="aa_change" placeholder="(e.g. F/M)" type="text" required class="validate">
					<label for="aa_change">Amino acid Change </label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input name="phenotype" placeholder="Phenotype" type="text">
					<label for="phenotype">Phenotype</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input name="impact" placeholder="(e.g. Moderate)" type="text">
					<label for="impact">Impact</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input name="consequence" placeholder=" (e.g. Missense variant)" type="text" required class="validate">
					<label for="consequence">Consequence</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input name="source" type="text" placeholder="https://example.com" required class="validate"> <br>
					<label for="source">Source/Citation</label>
				</div>
			</div>

			<input class='btn waves-effect waves-light blue center' type="submit" name="submit" value="Submit A New Variant to ConVarT"><br>

			<br>
			<small>*Your submission will be listed after validation processes.</small>
		</form>


	</div>
</div>

<br>
<br>

<div class="container pageBox white z-depth-2">
	<div class="row specialTextBox">
		<h4 class="blue-text text-darken-1 center">Feedbacks</h4>
		<small class="flow-text"> User feedback is valuable to improve the ConVarT. Please send us any comment, suggestion or correction you may have.<br>
			E-mail:<a href="mailto:oktay.kaplan@agu.edu.tr">oktay.kaplan@agu.edu.tr</a></small> <br><br>
	</div>
</div><br>

<?php require("../footer.php"); ?>