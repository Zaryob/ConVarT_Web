<?php
#ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

$seconds_to_cache = 3600 * 48;
$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
header("Expires: $ts");
header("Pragma: cache");
header("Cache-Control: max-age=$seconds_to_cache");

require_once("db_connection.php");
require_once("functions.php");

if(isset($_GET['validate'])){
  validateCommunityVariant($_GET['validate']);
  die();
}

$available_species = ["human", "chimp", "macaque", "rat", "mouse", "zebrafish", "frog", "fruitfly", "worm", "yeast"];
$msaId = (int) $_GET['msa_id'];
$human_1 = $_GET['human'];

$human = "";
$mouse = "";
$worm = "";

$orthovar = False;
if(isset($_GET['human'])){
  $human = $_GET['human'];
  $mouse = $_GET['mouse'];
  $worm = $_GET['worm'];
  $orthovar=True;
}

$msa = getMSAById($msaId);
$fasta = $msa['fasta'];

function computeConservationScore($fasta, $comparisonX, $comparisonY) {
  $fastaByGene = explode('>', $fasta);
  array_shift($fastaByGene);
  $processedFastas = [];
  foreach($fastaByGene as $fastaOfAGene) {
    $fastaByLines = explode("\n", $fastaOfAGene);
    array_shift($fastaByLines);
    $processedFastas[] = implode("", $fastaByLines);
  }

  $conservation = 0;
  for($i = 0; $i < strlen($processedFastas[0]); $i++){
    $currentAminoacids = [$processedFastas[$comparisonX][$i], $processedFastas[$comparisonY][$i]];
    if(count(array_unique($currentAminoacids)) == 1 & $currentAminoacids[0] !='-')
      $conservation++;
  }

  $humanAminoAcidLength = 0;
  for($i =0; $i < strlen($processedFastas[0]); $i++){

    if($processedFastas[0][$i] != '-')
      $humanAminoAcidLength++;

  }
  return $conservation / $humanAminoAcidLength;
}

if ($orthovar){
  $conservationScoreSecondSequence = round(computeConservationScore($fasta, 0, 1)*100, 2);
  $conservationScoreThirdSequence = round(computeConservationScore($fasta, 0, 2)*100, 2);
}

$mouse_transcript_id = $msa['mouse_transcript_id'];

//Mouse NP id

$transcriptIdMouse = getTranscriptIdByConvartGeneId($mouse);
$geneDetailsMouse = getGeneDetailsById($transcriptIdMouse);
$mouseNPid = explode(',', str_replace('"', '', $geneDetailsMouse['dbs']['NP']))[0];

//Human NP id
$transcriptId = getTranscriptIdByConvartGeneId($human);
$geneDetails = getGeneDetailsById($transcriptId);
$humanNPid = $geneDetails['dbs']['NP'];

//Worm NP id
$worm_transcript_id = $msa['worm_transcript_id'];
//$wormNPid = getTranscriptIdByConvartGeneId($worm);
$wormNPid = $worm_transcript_id;
$domainsResult = "";

#if (!isset())

#Gene Info
if (substr($msa['human_transcript_id'], 0, 4) == 'ENSP') {
	$msa['human_transcript_id'] =  $geneDetails['dbs']['ENST'];
}
$geneInfoHuman = getGeneDetailsById($msa['human_transcript_id']);
$geneId = $geneInfoHuman['dbs']['NCBI'];

if ($geneInfoHuman == null) {
  //exit;
} else {
  $geneSymbol = $geneInfoHuman['gene_symbol'];
}

#Domains
$domainsQuery = mysqli_query($db_connection, "SELECT * FROM domains_new WHERE domains_new.uniprot_id IN (SELECT db_id FROM convart_gene_to_db WHERE db = 'UNIPROT' AND convart_gene_id IN ({$human}))");
$countForDomains = mysqli_num_rows($domainsQuery);
$domains = [];
if ($countForDomains == 0) {
  $domainsResult = "";
} else {
  while ($row = mysqli_fetch_array($domainsQuery)) {
    $domains[] = [
      'domain_id' => $row['pfam_domain_id'],
      'domain_name' => $row['pfam_domain_id'],
      'domain_external_link' => "https://pfam.xfam.org/family/" . $row['pfam_domain_id'],
      'domain_start_point'  => $row['start_point'],
      'domain_end_point' => $row['end_point']
    ];
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ConVarT</title>
  <meta name="description" content="ConVarT">
  <meta name="title" content="ConVarT">
  <meta name="keywords" content="ConVarT" />
  <meta name="author" content="ConVarT">
  <meta name="copyright" content="ConVarT">
  <link rel="icon" href="<?= $GLOBALS['base_url']; ?>files/img/convart_black.png">
  <style type="text/css">
    .material-tooltip {
      padding: 10px 8px;
      font-size: 1rem;
      z-index: 2000;
      background-color: transparent;
      border-radius: 2px;
      color: #fff;
      min-height: 24px;
      line-height: 120%;
      opacity: 0;
      position: absolute;
      text-align: center;
      max-width: calc(100% - 4px);
      overflow: hidden;
      left: 0;
      top: 0;
      pointer-events: none;
      visibility: hidden;
      background-color: #323232;
    }

    .backdrop {
      position: absolute;
      opacity: 0;
      height: 7px;
      width: 14px;
      border-radius: 0 0 50% 50%;
      background-color: #323232;
      z-index: -1;
      transform-origin: 50% 0%;
      visibility: hidden;
    }
    .progress {
  margin: 0;
  padding:0;
  width:90%;
  height:30px;
  overflow:hidden;
  background:#e5e5e5;
  border-radius:6px;
}

.bar {
	position:relative;
  float:left;
  min-width:1%;
  height:100%;
  background:cornflowerblue;
}

.percent {
	position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
  margin:0;
  font-family:tahoma,arial,helvetica;
  font-size:12px;
  color:white;
}
  </style>

  <link type="text/css" rel="stylesheet" href="<?= $GLOBALS['base_url']; ?>files/css/tool.css?id=<?php echo uniqid(); ?>" media="screen" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="<?= $GLOBALS['base_url']; ?>files/js/js.js"></script>
  <script type="text/javascript">
    $('.tooltipped').tooltip();
  </script>
  <script type="text/javascript" src="libs/msa_viewer.js?id=<?= rand(); ?>"></script>
</head>

<body>

  <!-- Current Project Tool -->
  <section id="CurrentProjectTool">

  </section><!-- end of Current Project tool -->
  <?php if($orthovar && ($mouse || $worm)): ?>
    <section style="float:left; width:300px">
    <div style="margin: 10px;"><b>Conservation Score for <?= $mouse ? "M. musculus" : "C. elegans"; ?>:</b> </div>
    <div class="progress" style="width: 250px;margin-left: 10px;">
      <div class="bar" style="width:<?= $conservationScoreSecondSequence; ?>%">
        <p class="percent"><?= $conservationScoreSecondSequence; ?>%</p>
      </div>
    </div>
    </section>
  <?php endif; ?>
  <?php if($orthovar && $mouse && $worm): ?>
    <section style="float:left;">
    <div style="margin-top:10px; margin-bottom:10px;"><b>Conservation Score for C. elegans:</b> </div>
    <div class="progress" style="width: 250px;">
      <div class="bar" style="width:<?= $conservationScoreThirdSequence; ?>%">
        <p class="percent"><?= $conservationScoreThirdSequence; ?>%</p>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <?php if($orthovar  && ($mouse || $worm)): ?>
 <div style ="clear:both"></div>
  <?php endif; ?>

  <!-- Current Project Tool -->
  <script type="text/javascript">
    var id = 'CurrentProjectTool';
    var fasta = '<?= str_replace("\n", "\\n", $fasta); ?>';
    var geneSymbol = '<?= @$geneSymbol; ?>';
    var domains = <?= json_encode($domains); ?>;
    var variations = [

    ]

    var viewer = new MSAViewer(id, fasta, geneSymbol, variations, domains);

    // TODO: Load these things from AJAX
    /* List the viewer.addVariation Data */
    <?php

    if (isset($geneInfoHuman['dbs']['NP'])) :
      $ClinVarQuery = getClinvarData($geneInfoHuman['dbs']['NP'], 'np_id');

      while ($row = @mysqli_fetch_array($ClinVarQuery)) :
        $position = $row['position'];
        if ($position == "" || $position == NULL) {
          $position  = 0;
        }
        $variation = $row['variation'];
        $rs_number = $row['rs_number'];
        if ($rs_number == "rs-1") {
          $rs_number = "N/A";
        }
        $new_variation = str_replace(array('(', ')'), '', $variation);
        $clinvarnote = 'Variation ID: ' . $row['variation_id'] . ' <br> rsNumber: ' . $rs_number . '<br> ' . $new_variation . ' <br> ' . $row['variant_type'] . ' <br> ' . $row['clinical_significance'] . '<br>' . $row['phenotypes'] . '<br>';;
    ?>
        viewer.addVariation(0, <?php echo $position; ?>, ' <?php echo str_replace("'", "\\'", $clinvarnote); ?>', 'ClinVar');
      <?php endwhile; ?>
    <?php endif; ?>

    /* List the gnomAD Data */
    <?php
    if (isset($geneDetails['dbs']['ENST'])) :

      $gnomADQuery = getGnomADData($geneDetails['dbs']['ENST'], 'canonical_transcript', 'position, variation, variant_id' .
        ',rs_number,consequence, allele_count, allele_number');

      while ($row = @mysqli_fetch_array($gnomADQuery)) :
        $position = $row['position'];
        if ($position == "" || $position == NULL) {
          $position  = 0;
        }
        $variation = $row['variation'];
        $new_variation = str_replace(array('(', ')'), '', $variation);

        if ($row['allele_count'] == 0) {
          $freq = 0;
        } else {
          $freq = round(($row['allele_count'] / $row['allele_number']), 6);
        }

        $gnomADnote = 'Variation ID:<a style="color:#1976D2 !important; font-size:15px !important;" href="https://gnomad.broadinstitute.org/variant/' . $row['variant_id'] . '" target="_blank"> ' . $row['variant_id'] . '</a> <br> Frequency: ' . $freq . ' <br> rsNumber: ' . $row['rs_number'] . '<br> ' . $new_variation . ' <br> ' . $row['consequence'] . '<br>';
    ?>
        viewer.addVariation(0, <?php echo $position; ?>, ' <?php echo $gnomADnote; ?>', 'gnomAD');
      <?php endwhile; ?>
    <?php endif; ?>

    /* List the PTM Data */
    <?php

    if (isset($geneDetails['dbs']['UNIPROT'])) :
      $ptmQuery = getPtmData($geneDetails['dbs']['UNIPROT'], 'acc_id', 'mod_rsd, ptm_type, position');

      while ($row = @mysqli_fetch_array($ptmQuery)) :
        $position = $row['position'];
        if ($position == "" || $position == NULL) {
          $position  = 0;
        }
        $PTMnote = 'Mod_rsd: ' . $row['mod_rsd'] . '<br>PTM Type: ' . $row['ptm_type'] . '<br>';;
    ?>
        viewer.addVariation(0, <?php echo $position; ?>, '<?php echo $PTMnote; ?>', 'PTM');
      <?php endwhile; ?>
    <?php endif; ?>

    // get orth data
    <?php
      $HMQuery = getHMOrthologData($human, $mouse, $worm);
      while ($row = @mysqli_fetch_array($HMQuery)) :
        $position = $row['Human_Variation'];
        $significance = $row['Mouse_Significance'];
//        if(strcasecmp($significance, "phenotypic") == 0) {
//          $significance = "PHE";
//        }
        if ($position == "" || $position == NULL) {
          $position  = 0;
        } else {
          $position = preg_replace("/[^0-9]/", "", $position);
        }
      ?>
      viewer.addVariation(0, <?php echo $position; ?>, '<?php echo $significance; ?>', 'HM');
    <?php endwhile; ?>

    <?php
      $HCQuery = getHCOrthologData($human, $mouse, $worm);
      while ($row = @mysqli_fetch_array($HCQuery)) :
        $position = $row['Human_Variation'];
        $significance = $row['C_elegans_Significance'];
//        if(strcasecmp($significance, "phenotypic") == 0) {
//          $significance = "PHE";
//        }
        if ($position == "" || $position == NULL) {
          $position  = 0;
        } else {
          $position = preg_replace("/[^0-9]/", "", $position);
        }
      ?>
      viewer.addVariation(0, <?php echo $position; ?>, '<?php echo $significance; ?>', 'HC');
    <?php endwhile; ?>

	/* List Community Data */
	<?php
    if (isset($humanNPid) || isset($mouseNPid) || isset($wormNPid)) :
	  $NPids = "$humanNPid,\"$mouseNPid\",\"$wormNPid\"";
      $communityQuery = getCommunityData($NPids);
      while ($row = @mysqli_fetch_array($communityQuery)) :
		$indexID = 0;
        $position = $row['protein_pos'];
		$organism = $row['organism'];
        if ($position == "" || $position == NULL) {
          $position  = 0;
        }
		if ($organism == "Homo Sapiens") {
          $indexID  = 0;
        } else if ($organism == "Mus Musculus") {
          $indexID  = 1;
        } else if ($organism == "Caenorhabditis elegans"){
          $indexID  = 2;
        }
        $CommunityNote = 'Mutation: ' . $row['aa_change'] . ' at ' . $position . '<br> Sended by: ' . $row['sended_by'] . '<br> Phenotype: ' . $row['phenotype'] . '<br> Source: ' . $row['source'] .  '<br>';;
    ?>
        viewer.addVariation(<?php echo $indexID; ?>, <?php echo $position; ?>, '<?php echo $CommunityNote; ?>', 'Community');
      <?php endwhile; ?>
    <?php endif; ?>

  /* List the COSMIC Data */
    <?php
    if (isset($geneDetails['dbs']['ENST'])) :
      $cosmicQuery = getCosmicData($geneDetails['dbs']['ENST'], 'accession_number', 'position, mutation_aa, mutation_id' . ',fathmm_prediction, fathmm_score, primary_site');

      while ($row = @mysqli_fetch_array($cosmicQuery)) :
        $position = $row['position'];
        if ($position == "" || $position == NULL) {
          $position  = 0;
        }
        $COSMICnote = 'Mutation: ' . $row['mutation_aa'] . '<br>' . $row['mutation_id'] . ' <br>' . $row['primary_site'] . '<br>Fathmm:' . $row['fathmm_prediction'] . '|' . $row['fathmm_score'] . '<br>';
    ?>
        viewer.addVariation(0, <?php echo $position; ?>, '<?php echo str_replace("'", "\\'", $COSMICnote); ?>', 'COSMIC');
      <?php endwhile; ?>
    <?php endif; ?>

    /* List the dbSNP Data */
    <?php
    if (isset($geneDetails['dbs']['ENST'])) :
      $dbSNPQuery = getdbSNPData($geneDetails['dbs']['ENST'], 'Feature', 'Protein_position, HGVSp, Impact, Consequence');

      while ($row = @mysqli_fetch_array($dbSNPQuery)) :
        $position = $row['Protein_position'];
        if ($position == "" || $position == NULL || $position == "-") {
          $position  = 0;
        }
        $proteinChanges = $row['HGVSp'];
        $clearProteinChange = explode(":", $proteinChanges)[1];
        $dbSNPnote = 'Mutation: ' . $clearProteinChange . '<br>' . $row['Consequence'] . ' <br> Impact: ' . $row['Impact'] . '<br>';
    ?>
        viewer.addVariation(0, <?php echo $position; ?>, '<?php echo $dbSNPnote; ?>', 'dbSNP');
      <?php endwhile; ?>
    <?php endif; ?>

	/* List the TopMed Data */
    <?php
    if (isset($geneDetails['dbs']['ENST'])) :
      $TopMedQuery = getTopMedData($geneDetails['dbs']['ENST'], 'ensm_transcript_id', 'position, variation, variant_type, variant_ids');

      while ($row = @mysqli_fetch_array($TopMedQuery)) :
        $position = $row['position'];
        if ($position == "" || $position == NULL || $position == "-") {
          $position  = 0;
        }
        $proteinChanges = $row['variation'];
        $TopMednote = 'Mutation: ' . $row['variation'] . '<br> Variant IDs: ' . $row['variant_ids'] . ' <br> Type: ' . $row['variant_type'] .  '<br>';
    ?>
        viewer.addVariation(0, <?php echo $position; ?>, '<?php echo $TopMednote; ?>', 'TopMed');
      <?php endwhile; ?>
    <?php endif; ?>

	/* List the Mouse Variants */
    <?php
    $mouseQuery = getMouseVariantsData($mouseNPid);

    while ($row = @mysqli_fetch_array($mouseQuery)) :
      $position = $row['pos'];
	  $significance = $row['variant_type'];
      if(strcasecmp($significance, "phenotypic") == 0) {
         $significance = "PHE_mouse";
		}
      if ($position == "" || $position == NULL) {
        $position  = 0;
      }
      $mouseNote = 'Mutation: ' . $row['aa_change'] . ' at ' . $position . '<br> Variant Type: ' . $row['variant_type'];

    ?>
      viewer.addVariation(1, <?php echo $position; ?>, '<?php echo $mouseNote; ?>', 'Mouse Variant');
	  viewer.addVariation(1, <?php echo $position; ?>, '<?php echo $significance; ?>', 'PHE_mouse');
    <?php endwhile; ?>

    /* List the Celegans Variants */
    <?php
    $celQuery = getCelVariantsData($worm_transcript_id);

    while ($row = @mysqli_fetch_array($celQuery)) :
      $position = $row['pos'];
	  $significance = $row['variant_type'];
      if(strcasecmp($significance, "Phenotypic") == 0) {
         $significance = "PHE_celegans";
		}
      if ($position == "" || $position == NULL) {
        $position  = 0;
      }
      $celNote = 'Mutation: ' . $row['aa_change'] . ' at ' . $position . '<br> Variant Type: ' . $row['variant_type'] . '<br>WormBase Var.ID: ' . $row['ids'] . '<br> Source: ' . $row['source'] . '<br>';
    ?>
      viewer.addVariation(2, <?php echo $position; ?>, '<?php echo $celNote; ?>', 'C. elegans Variant');
	  viewer.addVariation(2, <?php echo $position; ?>, '<?php echo $significance; ?>', 'PHE_celegans');
    <?php endwhile; ?>

    viewer.loadDivsInViewport(true);
  </script>

</body>

</html>
