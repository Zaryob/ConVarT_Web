<?php
define('IGNORE_HEADER', 'asd');
require ("header.php");
require_once("config.php");
$spm_iframe = trim($_GET['spm']);


?>
	<script type="text/javascript">
	function errorView() {
		return '<div class="card-panel blue"> <span class="white-text">Non-coding Ensembl transcripts (ENST) will not show up. For example, non-coding transcript ENST00000504290 (ENST) (such as TP53; ) will not appear in the ConVarT v.1.0 version.  The ConVarT v.1.0 currently shows human variants from gnomAD, TOPMed, COSMIC, and ClinVar, all of which are mapped to the GRCh37/hg19 reference sequence. So those Ensembl transcripts (ENST) that are not available in GRCh37/hg19 will not show up. We will be moving to GRCh38 in the future.</span> </div><a href="#" class="btn waves-effect waves-light preResultBtnEmpty">No finding for this gene</a>';
	}

	function speciesView(transcriptsBySpecies) {
		html = "";

        for(species in transcriptsBySpecies) {
			transcripts = transcriptsBySpecies[species];
			if(transcripts.length == 0) continue;
			html += `<div class="row"> <div class="pageTitle">Results in <i> ${species} </i> <hr></div> `;
			html += transcriptView(transcripts);
			html += `</div>`;
		}
		return html;
	}

	function transcriptView(transcripts) {
		htmlTranscripts = ""
		usedHumanGeneSymbols = {};
		for(transcript of transcripts) {
			humanGeneSymbol = transcript['human_homolog']['human_gene_symbol']
			if(humanGeneSymbol in usedHumanGeneSymbols) continue
			else usedHumanGeneSymbols[humanGeneSymbol] = true;

			htmlTranscript = `<a target="_blank"
                    href="<?php echo $GLOBALS['base_url']; ?>search?spemud=${transcript['human_homolog']['human_gene_symbol']}"
                    class="btn waves-effect waves-light preResultBtn"
                    style="max-width:100%!important" >
                    <i>${transcript['gene_symbol']}</i> (${transcript['ncbi_gene_id']}) |
                     HUMAN  ${transcript['human_homolog']['human_gene_symbol']}
                     - (${transcript['human_homolog']['human_gene_id']})

                     </a>`;
			htmlTranscripts += htmlTranscript;
		}
		return htmlTranscripts;
	}
	$(document).ready ( function(){
			$.get('api.php?action=orthovarhelp&query=' + "<?php echo $spm_iframe; ?>", function(data) {
			data = JSON.parse(data);
			if(data == null || data.length == 0) {
				content = errorView();
			} else {
				content = speciesView(data);
			}
			$('#transcripts').html(content);
		});
		return false;
	});
	</script>
	<!-- api.php?action=humansearch&query=<GENE SEARCH TEXT> -->
	<!-- Human Homolog Searching Form -->
	<div id="human-homolog-search">
		<div class="row">
			<form action="API" method="get" class="mainForm" autocomplete="off">
				<div class="col s0 m0 l3"></div>
			</form>
		</div>
	</div>
	<hr>
	<div class="container">
		<div class="col s12 m12 l12" id="transcripts"> </div>
	</div>
