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
	$admin_key = $_POST["admin_key"];

	$validation_code =  sha1('');

	if (strcmp($validation_code, $validation_code) == 0) {
		// INSERT
		mysqli_query($db_connection, "INSERT INTO community_variants (sended_by,email,organization, organism,protein_id,biotype,protein_pos,aa_change,phenotype,impact,consequence,source,validation_code,validation) 
		VALUES('$sended_by', '$email', '$organization', '$organism','$protein_id', '$biotype', '$protein_pos', '$aa_change', '$phenotype', '$impact', '$consequence', '$source', '$validation_code',1)");

		// mysqli_query($db_connection, "INSERT INTO community_variants (sended_by, email) VALUES('$sended_by', '$email')");

		if (mysqli_error($db_connection)) {
			// echo mysqli_error($db_connection);
			echo '<h3 class="red-text text-darken-1 center">Some problems occured in our database. </h3>';
			exit;
		} else {
			echo '<br><br><h3 class="green-text text-darken-1 center">Your submission has been received. Thanks!</h3> <br><br>';
		};
	} else {
		echo '<h3 class="red-text text-darken-1 center">Wrong Admin Key!</h3>';
	}

	
};

?>

<div class="container pageBox white z-depth-2">
	<div class="row specialTextBox">
		<h4 class="blue-text text-darken-1 center">Submit a variant</h4><br>
		<h5 class="center"> !!! Only For Admin Usage !!!</h5>
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

			<div class="row">
				<div class="input-field col s12">
					<input name="admin_key" type="password" required class="validate">
					<label for="admin_key">Admin Key</label>
				</div>
			</div>

			<input class='btn waves-effect waves-light blue center' type="submit" name="submit" value="Submit A New Variant to ConVarT"><br>

			<br>
		</form>


	</div>
</div>

<br>


<?php require("../footer.php"); ?>