<!DOCTYPE html>
<?php require_once("header.php"); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div class="container pageBox white z-depth-2">
<div class="row specialTextBox">
    <h4 class="blue-text text-darken-1 center">Search a sequence</h4> <br>
    <span class="flow-text"> ConVarT systematically enumerates and visualizes the comparability of human genetic variations and post-translational modifications (PTMs) on protein-encoding genes across the 8 non-human species. ConVarT, however, enables researchers to search any protein sequence and rapidly visualize with human sequence performing pairwise sequence alignment.</span><br><br>
    <hr> <br>
</div>

<center>
	<form action="<?= $GLOBALS['base_url']; ?>blast_query.php" method="post" name="seqSearch" autocomplete="off">
        <div class="col l10 m10 s10">
        <textarea id="sequenceArea" name="sequence"  placeholder=">NP_035941.2 phenylalanine--tRNA ligase beta subunit [Mus musculus]&#x0a;MPTVSVKRDLLFQALGRTYTDEEFDELCFEFGLELDEITSEKQIISKEQGHGKAQGASDVVLYKIDVPANRYDLLCLEGLARGLQVFKERIKAPVYKRVMPKGDIQKLVITEETAKVRPFAVAAVLRNIKFTKDRYDSFIELQEKLHQNICRKRALVAIGTHDLDTLSGPFTYTAKRPSDIKFKPLNKTKEYTACELMNIYKTDNHLKHYLHIIESKPLYPVIYDSNGVVLSMPPIINGNHSKITVNTRNIFIECTGTDFTKAKIVLDIIVTMFSEHCENQFTVEAVEVVSPNGKSSTFPELPYRKEMVRADLINKKVGIRETPANLAKLLTRMCLKSEVIGDGNQIEVEIPPTRADVIHACDIVEDAAIAYGYNNIQMTLPKTYTIANQFPLNKLTELLRLDMAAAGFTEALTFALCSQEDIADKLGLDISATKAVHISNPKTAEFQVARTTLLPGLLKTIAANRKMPLPLKLFEISDVVVKDSGKDVGAKNYRHLCAVYYNKTPGFEIIHGLLDRIMQLLDVPPGEESGGYMIKASAGSAFFPGRCAEIFVGGQSIGKLGVLHPDVITKFELTMPCSSLEINIEPFL" class="materialize-textarea sequenceArea"></textarea>
       
        <!-- <br><p class="center center-align">Select your organism:</p> 
		<input type="radio" name="species" id="mouse" value="mouse"/>
		<label for="mouse">M. musculus</label>
		<input type="radio" name="species" id="rat" value="rat"/>
		<label for="rat">R. norvegicus</label>
		<input type="radio" name="species" id="chimp" value="chimp"/>
		<label for="chimp">P. troglodytes</label>
		<input type="radio" name="species" id="macaque" value="macaque"/>
		<label for="macaque">M. mulatta</label> 
		<input type="radio" name="species" id="zebrafish" value="zebrafish"/>
		<label for="zebrafish">D. rerio</label>
		<input type="radio" name="species" id="frog" value="frog"/>
		<label for="frog">X. tropicalis</label>
		<input type="radio" name="species" id="fruitfly" value="fruitfly"/>
		<label for="fruitfly">D. melanogaster</label>
		<input type="radio" name="species" id="worm" value="worm"/>
		<label for="worm">C. elegans</label>
		<br><br> -->
		<div class="g-recaptcha" data-sitekey="6LdZMaMUAAAAAAJdY4SpK0vOHHFnf-Ff5iVOp1K4"></div>
		<button class="btn waves-effect waves-light waves-white sb seqSearchButton" type="submit"><i class="material-icons">search</i>SEARCH</button>
    </form>
</center>
<br>
</div><br>

<!-- 
	Codes:
	site key: 6LdZMaMUAAAAAAJdY4SpK0vOHHFnf-Ff5iVOp1K4
	secret key: 6LdZMaMUAAAAAG9OsWBShn5P1ykVd1f3EAIYbWt4 -->

<?php require("footer.php"); ?>
