<!DOCTYPE html>
<?php require_once("config.php"); ?>
<link rel="icon" href="<?= $GLOBALS['base_url']; ?>files/img/convart_black.png">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?= $GLOBALS['base_url']; ?>files/css/style.css" media="screen" />

<?php require_once "functions.php"; ?>


<style>
	body {
		padding: 0;
		margin: 0;
		height: max-content;
	}

	span {
		color: #1976D2;
	}

	row {
		margin: 0;
		padding: 0;
	}

	hrx {
		display: block;
		width: 100%;
		align-items: center;
		border-top: 1px solid #2196F3;
		text-align: center;
		padding: 0;
		margin: 0;
	}

	html * {
		text-align: center;
	}

	table {
		margin-top: 4em;
		width: 100%;
		border-collapse: collapse;
		font-size: 0.9em;
		font-family: sans-serif;
		padding: 2vh auto 0vh auto;
	}

	td {
		padding: 2px 4px !important;
		line-height: 20px !important;
		overflow: hidden !important;
	}

	h5 {
		color: #1976D2;
		margin: 0em auto;
		position: fixed;
		width: 100%;
		line-height: 2em;
		background-color: white !important;
		padding: 3em auto 3em auto;
	}
</style>
<div class="row" style="background-color: white;">
	<h5>Community Contributions
		<hrx />
	</h5>
	<hrx />
	<div id="contribution_table"></div>
</div><br>

<script>
	function addTable() {
		var TableDiv = document.getElementById("contribution_table");

		var table = document.createElement('table');
		table.style.border = '1px!important';

		var tableBody = document.createElement('tbody');
		table.appendChild(tableBody);

		var data = <?php echo json_encode(getCommunityVariations(0)); ?>;
		console.log(data);

		for (var i = 0; i < data.length; i++) {
			var tr = document.createElement('tr');
			tableBody.appendChild(tr);

			for (var j = 0; j < 1; j++) {
				var td = document.createElement('td');
				if (data[i]['is_admin_submission'] === false) {
					var span = document.createElement('span');
					span.style.color = 'rgb(255, 69,96)';
					span.appendChild(document.createTextNode(data[i]['sended_by']));
					td.appendChild(span);
					
					span = document.createElement('span');
					span.appendChild(document.createTextNode(' (' + data[i]['organization'] + ')'));
					td.appendChild(span);

					span = document.createElement('span');
					span.appendChild(document.createTextNode(' submitted '));
					td.appendChild(span);
				} else {
					var span = document.createElement('span');
					span.style.color = 'rgb(255, 69,96)';
					span.appendChild(document.createTextNode('ConVarT'));
					td.appendChild(span);

					span = document.createElement('span');
					span.appendChild(document.createTextNode(' added: '));
					td.appendChild(span);
					
					span = document.createElement('a');
					span.href = data[i]['source'];
					span.target = '_blank';
					span.appendChild(document.createTextNode(' (' + data[i]['source'] + ') '));
					td.appendChild(span);
				}

				span = document.createElement('span');
				span.appendChild(document.createTextNode(
					data[i]['organism'] + ' (' +
					data[i]['protein_id'] + ')'
				));
				td.appendChild(span);

				span = document.createElement('a');
				span.style.color = 'rgb(255, 69,96)';
				span.href = <?php echo $GLOBALS['base_url']; ?> + 'search?spemud=' + data[i]['protein_id'];
				span.target = '_blank';
				span.appendChild(document.createTextNode(
					' p.' +
					data[i]['aa_change'].split('/')[0] +
					data[i]['protein_pos'] + '' +
					data[i]['aa_change'].split('/')[1]
				));
				td.appendChild(span);


				span = document.createElement('span');
				span.appendChild(document.createTextNode(' as ' + data[i]['phenotype']));
				td.appendChild(span);

				span = document.createElement('span');
				span.appendChild(document.createTextNode(' at ' + data[i]['submission_date'].split(" ",1)));
				td.appendChild(span);

				td.appendChild(span);

				hr = document.createElement("hrx");
				td.appendChild(hr);
				tr.appendChild(td);
			}
		}
		TableDiv.appendChild(table);

	}

	addTable();
</script>