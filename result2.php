<?php
require_once("header.php");
require_once("db_connection.php");
require_once("functions.php");
// GET QUERY ID

$human_convart_id = $_REQUEST["human"];
$mouse_convart_id = $_REQUEST["mouse"];
$worm_convart_id = $_REQUEST["worm"];

$convart_id_list = array($human_convart_id, $mouse_convart_id, $worm_convart_id);
$convart_id_list = array_filter($convart_id_list);
sort($convart_id_list);

if ($human_convart_id == "" && $mouse_convart_id == "" && $worm_convart_id == "")
    exit;

$str_convart_ids = implode(",", $convart_id_list);

#Get MSA
mysqli_query($db_connection, "SET profiling = 1;");

#
# SELECT CONCAT(t1.convart_gene_id, ",", t2.convart_gene_id) AS ids, t1.msa_id FROM msa_gene t1 CROSS JOIN msa_gene t2 WHERE t1.msa_id=t2.msa_id AND t1.convart_gene_id!=t2.convart_gene_id AND t1.convart_gene_id < t2.convart_gene_id HAVING ids='$str_convart_ids' LIMIT 1
#

$msaIdQuery = mysqli_query($db_connection, "SELECT CONCAT(t1.convart_gene_id, \",\" , t2.convart_gene_id) AS ids, t1.msa_id FROM msa_gene t1 CROSS JOIN msa_gene t2 WHERE t1.msa_id=t2.msa_id AND t1.convart_gene_id!=t2.convart_gene_id AND t1.convart_gene_id < t2.convart_gene_id HAVING ids='$str_convart_ids' LIMIT 1");

if (mysqli_num_rows($msaIdQuery) == 0) {

    $msaIdQuery = mysqli_query($db_connection, "SELECT GROUP_CONCAT(convart_gene_id) AS ids, msa_id FROM msa_gene GROUP BY msa_id HAVING ids = '$human_convart_id' LIMIT 1");


    if (mysqli_num_rows($msaIdQuery) == 0) {
    # Burayı sonra düzenle!!
    echo '<div class="center-align card-panel blue "> <span class="white-text">The MSA could not be found! </span><br> <br><a href="'.$GLOBALS['base_url'].'" class="btn white blue-text">Go Back to Search Page</a> </div>';
    exit();
	}
}

$msa_id = (int) mysqli_fetch_assoc($msaIdQuery)["msa_id"];
$msa = getMSAById($msa_id);

$transcriptId = getTranscriptIdByConvartGeneId($human_convart_id);
$geneDetails = getGeneDetailsById($transcriptId);

$transcriptIdMouse = getProteinIdByConvartGeneIdMouse($mouse_convart_id);
$geneDetailsMouse = getGeneDetailsById($transcriptIdMouse);
$dbIds_mouse = explode(',', str_replace('"', '', $geneDetailsMouse['dbs']['NP']))[0];
$enstIdMouse = explode(',', str_replace('"', '', $geneDetailsMouse['dbs']['ENSMUST']))[0];

//$enstIdMouse = end(array_filter($dbIds, function ($x) {
//    return strstr($x, 'ENS') !== FALSE;
//}));

//getGeneDetailsByENSTIdFromAPI($geneDetailsMouse, $enstIdMouse);
//$geneDetailsMouse['species_id'] = "Mus musculus";
//$ensembleIdMouse = $geneDetailsMouse['ENSG'];
//$geneDetailsMouse = getGeneDetailsById($ensembleIdMouse);
//$geneDetailsMouse['other_id'] = $ensembleIdMouse;
$geneIdMouse =  $geneDetailsMouse['dbs']['NCBI'];
//$geneDetailsMouse = getGeneDetailsById($dbIds_mouse);


//if (!isset($geneDetailsMouse['gene_symbol']) or empty($geneDetailsMouse['gene_symbol'])) {
//    $geneDetailsMouse = getGeneDetailsByENSTIdFromAPI($geneDetailsMouse, $enstIdMouse);
//    $geneDetailsMouse['species_id'] = "Mus musculus";
//}
$transcriptIdWorm = getTranscriptIdByConvartGeneId($worm_convart_id);
$geneDetailsWorm = getGeneDetailsById($transcriptIdWorm);	

$gnomADResult = "";
$ClinVarStatisticResult = "";

$geneInfo = [];

if ($geneDetails['species_id'] == 'Homo sapiens') {
    $humanGeneDetails = $geneDetails;
    $geneInfo['human_gene_id'] = $geneDetails['dbs']['NCBI'];
} else if (!empty($geneDetails['dbs']['NCBI'])) {
    $geneInfo = getHumanHomolog($geneDetails['dbs']['NCBI']);

    $humanGeneDetails = getGeneDetailsByConvartId($msa['human_convart_gene_id'], $geneInfo['human_gene_id']);
} else if ((empty($geneDetails['dbs']['NCBI']) || $geneDetails['dbs']['NCBI'] == '""')
    && strstr($transcriptId, 'ENST') !== false
) {
    getGeneDetailsByENSTIdFromAPI($geneDetails, $transcriptId);

    $newGeneDetails = getNCBIDetailsById($geneDetails['ENSG']);
    $geneDetails['dbs']['ENST'] = explode('.', $transcriptId)[0];
    $geneDetails = array_merge_recursive($geneDetails, $newGeneDetails);
    $geneInfo['human_gene_id'] = $geneDetails['dbs']['NCBI'];

    $humanGeneDetails = $geneDetails;
}

$geneDetails['dbs']['NCBI'] = @str_replace('"', '', $geneDetails['dbs']['NCBI']);
// $humanGeneVariants = searchProteinNumbers($geneInfo['human_gene_id'])['Homo sapiens'];

#echo microtime(true)-$start;
#$humanGeneVariants = array_filter($humanGeneVariants, function($x) {global $msa; return $x['transcript_id'] != $msa['human_convart_gene_id']; }); 

$geneId = str_replace("\"", "", $geneDetails['dbs']['NCBI']);
if (!isset($geneIdMouse) or empty($geneIdMouse)) {
    $geneIdMouse = $geneDetailsMouse['ENSG'];
} else {
    $geneIdMouse = str_replace("\"", "", $geneDetailsMouse['dbs']['NCBI']);
}

$geneIdWorm = str_replace("\"", "", $geneDetailsWorm['dbs']['NCBI']);

#Gene Other IDs for Gene Ontology Annotations
$other_idsHuman = explode(',', $geneDetails['other_id']);
$other_idHuman = $other_idsHuman[key(preg_grep('/ENSG/i', $other_idsHuman))];

$other_idsMouse = explode(',', $geneDetailsMouse['other_id']);
$other_idMouse = $other_idsMouse[key(preg_grep('/ENSMUSG/i', $other_idsMouse))];

$other_idsWorm = explode(',', $geneDetailsWorm['other_id']);
$other_idWorm = $other_idsWorm[key(preg_grep('/WB/i', $other_idsWorm))];


if ($msa == null) {
    header("Location: index.php?err=no_result");
    exit();
}

#ClinVar
#$clinVarQuery = getClinvarData(@$humanGeneDetails['dbs']['NM'], 'nm_id');

#gnomAD
if (isset($humanGeneDetails['dbs']['ENST'])) {
    #$gnomadQuery = getGnomADData($humanGeneDetails['dbs']['ENST']);
}
#Domains
if (isset($convart_id_list)) {
	$domain_list = $human_convart_id;
	if (isset($mouse_convart_id)) {
		$domain_list .= "," . $mouse_convart_id;
	}
	if (isset($worm_convart_id)) {
		$domain_list .= "," . $worm_convart_id;
	}
    $domainsQuery = getProteinDomains($domain_list);
}
#AlphaFold2
if (isset($convart_id_list)) {
	$uniprot_list['human'] = getUniprotIdByConvartId($human_convart_id);
	if (isset($mouse_convart_id)) {
		$uniprot_list['mouse'] = getUniprotIdByConvartId($mouse_convart_id);
	}
	if (isset($worm_convart_id)) {
		$uniprot_list['worm'] = getUniprotIdByConvartId($worm_convart_id);
	}
}

#Statistics ClinVar
if (isset($humanGeneDetails['dbs']['NP'])) {
    $clinVarCounts = getClinvarStatsBySignificance($humanGeneDetails['dbs']['NP'], 'np_id');
} else {
    $clinVarCounts = [];
}

#Statistics gnomAD
if (isset($humanGeneDetails['dbs']['ENST'])) {
    $gnomADCounts = getgnomADStats($humanGeneDetails['dbs']['ENST']);
} else {
    $gnomADCounts = [];
}

#Statistics PTM
if (isset($humanGeneDetails['dbs']['UNIPROT'])) {
    $ptmCounts = getPTMStats($humanGeneDetails['dbs']['UNIPROT']);
} else {
    $ptmCounts = [];
}

#Statistics dbSNP
if (isset($humanGeneDetails['dbs']['ENST'])) {
    $dbSNPCounts = getdbSNPStats(@$humanGeneDetails['dbs']['ENST']);
} else {
    $dbSNPCounts = [];
}

#Statistics TopMed 
if (isset($humanGeneDetails['dbs']['ENST'])) {
    $TopMedCounts = getTopMedStats(@$humanGeneDetails['dbs']['ENST']);
} else {
    $TopMedCounts = 0;
}

#Statistics COSMIC
if (isset($humanGeneDetails['dbs']['ENST'])) {
    $cosmicCounts = getCosmicStats(@$humanGeneDetails['dbs']['ENST']);
} else {
    $cosmicCounts = [];
}

if (!empty($clinVarCounts)) {
    $dynamicChartTitle = 'ClinVar Pathogenicity of Variations';
    $dynamicChart = 'clinvar';
} elseif (!empty($ptmCounts)) {
    $dynamicChartTitle = 'Post translational modifications (PTM) by Type';
    $dynamicChart = 'ptm';
} elseif (!empty($gnomADCounts)) {
    $dynamicChartTitle = 'gnomAD Variants By Annotation';
    $dynamicChart = 'gnomad';
} elseif (!empty($cosmicCounts)) {
    $dynamicChartTitle = 'COSMIC Variants By Annotation';
    $dynamicChart = 'cosmic';
} elseif (!empty($dbSNPCounts)) {
    $dynamicChartTitle = 'dbSNP Variants By Annotation';
    $dynamicChart = 'dbSNP';
}


#Disease Finder

if (isset($humanGeneDetails['dbs']['NCBI'])) {
    $DiseaseQuery = diseaseFind(str_replace('"', '', $humanGeneDetails['dbs']['NCBI']));
} else {
    $DiseaseQuery = [];
}
$query = mysqli_query($db_connection, "SHOW PROFILES;");
if ($_GET['test']) {
    while ($row = mysqli_fetch_assoc($query)) {
        print_R($row);
        echo "<br>";
    }
}
?>


<!-- Current Project | Tables and Other Components -->
<div class="row TablesContainer" style="position:relative; margin-left: 15%;">
<div class="col s1 m1 l1" style="
    position: fixed;
    left: 15px;
    height:75%;
    width: 13.5%;
    overflow: scroll;
    /* top: 0; */
" id="table-of-contents">

    

</div>
    <!-- Current Project Tool  -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">format_align_center</i>ConVarT</div>

        <div class="collapsible-body">
            <div class="row resultGeneBox">
                <!-- Current Project | Result Box - Gene Card -->
                <div class="col s12 m12 l6" style="overflow: auto;">
                    <div class="result_title blue_color"><i><?= $geneDetails['gene_symbol'] ? printify($geneDetails['gene_symbol']) : $transcriptId; ?></i> (GeneID: <?= $geneId; ?>) | <?= ucfirst($geneDetails['species_id']); ?></div>
                    <table class="gene_info_table">
                        <?php if (isset($geneDetails['gene_description'])) : ?>
                            <tr>
                                <td><b>Description:</b></td>
                                <td><?= printify($geneDetails['gene_description']); ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td><b>Synonyms:</b></td>
                            <td><i> <?= printify($geneDetails['gene_synonym']); ?></i></td>
                        </tr>
                        <tr>
                            <td><b>Other ID(s):</b></td>
                            <td><?= linkify(@$geneDetails['other_id']); ?></td>
                        </tr>
                        <tr>
                            <td><b>Protein Accession Numbers:</b></td>
                            <td><?= linkify(@$geneDetails['protein_number']); ?></td>
                        </tr>
                        <tr>
                            <td><b>Statistics: </b> </td>
                            <td><?php if (array_sum($clinVarCounts)) : ?> ClinVar(<b><?= array_sum($clinVarCounts); ?></b>)<?php endif; ?>
                                    <?php if (array_sum($gnomADCounts) > 0) : ?> gnomAD(<b><?= array_sum($gnomADCounts); ?></b>)<?php endif; ?>
                                        <?php if (array_sum($cosmicCounts) > 0) : ?> COSMIC(<b><?= array_sum($cosmicCounts); ?></b>)<?php endif; ?>
                                            <?php if (array_sum($dbSNPCounts) > 0) : ?> dbSNP(<b><?= array_sum($dbSNPCounts); ?></b>)<?php endif; ?>
                                                <?php if (array_sum($ptmCounts) > 0) : ?> PTM(<b><?= array_sum($ptmCounts); ?></b>)<?php endif; ?>
													<?php if ($TopMedCounts > 0) : ?> TopMed(<b><?= $TopMedCounts; ?></b>)<?php endif; ?>
                            </td>
                        </tr>

                    </table>
                </div>
                <!-- Current Project | Statistics -->
                <div class="col s12 m12 l6">
                    <div class="result_title blue_color">
                        <b><?= $dynamicChartTitle; ?></b>
                        <?php if ($dynamicChart == 'clinvar') : ?>
                            <a href="#clinical_significance_classification_help" class="modal-trigger tooltipped" data-position="right" data-delay="10" data-tooltip="Classification of Clinicial Significance of ClinVar Data"><i class="material-icons blue-text text-darken-1">help</i></a>
                        <?php endif; ?>

                    </div>


                    <div id="dynamic_chart"></div>
                </div>
            </div> <!-- end of gene card -->
            <iframe id="CurrentProjectTool2" src="tool.php?msa_id=<?= $msa_id; ?>&human=<?= $_GET['human']; ?>&mouse=<?= $_GET['mouse']; ?>&worm=<?= $_GET['worm']; ?>&version=2" width="96%" style="min-height:430px; height:auto !important" frameborder="0"></iframe>
            <p>
  ∙ Conservation scores are calculated by (number of aminoacids that matches between Human & the compared species ) / (aminoacid count in the human gene)
<br>
                ∙ Please click the name of species for the protein accession number used in the alignment.
                <br>∙ A <span style="color:#52b5f1;font-weight:bold">p</span> letter used as a pointer to positions of post translational modifications in human.
                <br>∙ A <span style="color:black;font-weight:bold">⁑</span> double asterisk showing orthologous variants between human, mouse and C. elegans.
				<br>∙ A <span style="color:black;font-weight:bold">✳</span> single asterisk displaying phenotypic variants from mouse and C. elegans. 
                <br>∙ Protein domains illustrated above belong to <i>Homo sapiens</i> (Human).
                <!-- <br>∙ ClinVar stacked bar chart represents whole protein isoforms of the gene. Please, check the other protein isoforms of the gene: -->
                <br>
            </p>
        </div>
        <br>
    </div>
    <!-- Gene Info --->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">info</i>Gene Info</div>
        <div class="collapsible-body">
            <!-- Current Project | Result Box - Gene Card -->

            <table class="gene_info_table">
                <tr>
                    <td colspan="2">
                        <div class="result_title blue_color"><i><?= $geneDetails['gene_symbol'] ? printify($geneDetails['gene_symbol']) : $transcriptId; ?></i> (GeneID: <?= $geneId; ?>) | <?= ucfirst($geneDetails['species_id']); ?></div>
                    </td>
                </tr>
                <?php if (isset($geneDetails['gene_description'])) : ?>
                    <tr>
                        <td><b>Description:</b></td>
                        <td><?= printify($geneDetails['gene_description']); ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><b>Synonyms:</b></td>
                    <td><i> <?= printify($geneDetails['gene_synonym']); ?></i></td>
                </tr>
                <tr>
                    <td><b>Other ID(s):</b></td>
                    <td><?= linkify(@$geneDetails['other_id']); ?></td>
                </tr>
                <tr>
                    <td><b>Protein Accession Numbers:</b></td>
                    <td><?= linkify(@$geneDetails['protein_number']); ?></td>
                </tr>
				<tr>
                    <td><b>AlphaFold 3D Structure:</b></td>
					<td><?= linkifyUniprot(@$uniprot_list['human']); ?></td>
                </tr>
                <tr>
                    <td><b>Statistics: </b> </td>
                    <td><?php if (array_sum($clinVarCounts)) : ?> ClinVar(<b><?= array_sum($clinVarCounts); ?></b>)<?php endif; ?>
                            <?php if (array_sum($gnomADCounts) > 0) : ?> gnomAD(<b><?= array_sum($gnomADCounts); ?></b>)<?php endif; ?>
                                <?php if (array_sum($cosmicCounts) > 0) : ?> COSMIC(<b><?= array_sum($cosmicCounts); ?></b>)<?php endif; ?>
                                    <?php if (array_sum($dbSNPCounts) > 0) : ?> dbSNP(<b><?= array_sum($dbSNPCounts); ?></b>)<?php endif; ?>
                                        <?php if (array_sum($ptmCounts) > 0) : ?> PTM(<b><?= array_sum($ptmCounts); ?></b>)<?php endif; ?>
											<?php if ($TopMedCounts > 0) : ?> TopMed(<b><?= $TopMedCounts; ?></b>)<?php endif; ?>
                    </td>
                </tr>
                <?php if (!empty($geneDetailsMouse)): ?>
                <tr>
                    <td colspan="2">
                        <div class="result_title blue_color"><i><?= $geneDetailsMouse['gene_symbol'] ? printify($geneDetailsMouse['gene_symbol']) : $transcriptIdMouse; ?></i> (GeneID: <?= $geneIdMouse; ?>) | <?= ucfirst($geneDetailsMouse['species_id']); ?></div>
                    </td>
                </tr>
                <?php if (isset($geneDetailsMouse['gene_description'])) : ?>
                    <tr>
                        <td><b>Description:</b></td>
                        <td><?= printify($geneDetailsMouse['gene_description']); ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><b>Synonyms:</b></td>
                    <td><i> <?= printify($geneDetailsMouse['gene_synonym']); ?></i></td>
                </tr>
                <tr>
                    <td><b>Other ID(s):</b></td>
                    <td><?= linkify(@$geneDetailsMouse['other_id']); ?></td>
                </tr>
                <tr>
                    <td><b>Protein Accession Numbers:</b></td>
                    <td><?= linkify(@$geneDetailsMouse['protein_number']); ?></td>
                </tr>
				<tr>
                    <td><b>AlphaFold 3D Structure:</b></td>
                    <td><?= linkifyUniprot(@$uniprot_list['mouse']); ?></td>
                </tr>
                <?php endif; ?>

                <?php if (!empty($geneDetailsWorm)): ?>
                <tr>
                    <td colspan="2">
                        <div class="result_title blue_color"><i><?= $geneDetailsWorm['gene_symbol'] ? printify($geneDetailsWorm['gene_symbol']) : $transcriptIdWorm; ?></i> (GeneID: <?= $geneIdWorm; ?>) | <?= ucfirst($geneDetailsWorm['species_id']); ?></div>
                    </td>
                </tr>
                <?php if (isset($geneDetailsWorm['gene_description'])) : ?>
                    <tr>
                        <td><b>Description:</b></td>
                        <td><?= printify($geneDetailsWorm['gene_description']); ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><b>Synonyms:</b></td>
                    <td><i> <?= printify($geneDetailsWorm['gene_synonym']); ?></i></td>
                </tr>
                <tr>
                    <td><b>Other ID(s):</b></td>
                    <td><?= linkify(@$geneDetailsWorm['other_id']); ?></td>
                </tr>
                <tr>
                    <td><b>Protein Accession Numbers:</b></td>
                    <td><?= linkify(@$geneDetailsWorm['protein_number']); ?></td>
                </tr>
				<tr>
                    <td><b>AlphaFold 3D Structure:</b></td>
                    <td><?= linkifyUniprot(@$uniprot_list['worm']); ?></td>
                </tr>
                <?php endif; ?>

            </table>
        </div>
        <br>
    </div>

	<!-- GO Annotation Table -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">import_contacts</i>Gene Ontology Annotations</div>
        <div class="collapsible-body">
            <div id="go_annotation_chart"></div>
            <div class="table-wrapper">
                <table id="go_annotationTable" class="special_table hide">
                    <thead>
                        <tr>
                            <th>GO Term Accession <i class="material-icons right">filter_list</i></th>
                            <th>Organism <i class="material-icons right">filter_list</i></th>
                            <th>GO Domain <i class="material-icons right">filter_list</i></th>
                            <th>GO Term Name <i class="material-icons right">filter_list</i></th>
                            <th>Definition <i class="material-icons right">filter_list</i></th>
							<th>GO Term Evidence Code <i class="material-icons right">filter_list</i></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div><br>
    </div>
	

    <!-- ClinVar Table -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">import_contacts</i>ClinVar Data <a href="#clinical_significance_classification_help" class="modal-trigger tooltipped" data-position="right" data-delay="10" data-tooltip="Classification of Clinicial Significance of ClinVar Data"><i class="material-icons white-text text-darken-1">help</i></a></div>
        <div class="collapsible-body">
            <div id="clinvar_chart"></div>
            <div class="table-wrapper">
                <table id="ClinVarTable" class="special_table hide">
                    <thead>
                        <tr>
                            <th>Variation ID <i class="material-icons right">filter_list</i></th>
                            <th>Allele ID <i class="material-icons right">filter_list</i></th>
                            <th>RS Number <i class="material-icons right">filter_list</i></th>
                            <th>Variant Type <i class="material-icons right">filter_list</i></th>
                            <th>Record <i class="material-icons right">filter_list</i></th>
                            <th>Alteration <i class="material-icons right">filter_list</i></th>
                            <th>Clinicial Sig. <i class="material-icons right">filter_list</i></th>
                            <th>Phenotypes <i class="material-icons right">filter_list</i></th>
                            <th>Review Status <i class="material-icons right">filter_list</i></th>
                            <th>RCV Acc.N. <i class="material-icons right">filter_list</i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>

    <!-- gnomAD table -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">healing</i>gnomAD</div>
        <div class="collapsible-body">
            <div id="gnomad_chart"></div>
            <div class="table-wrapper">
                <table id="gnomADtable" class="special_table hide">
                    <thead>
                        <tr>
                            <th>Variant ID <i class="material-icons right">filter_list</i></th>
                            <th>Transcript ID <i class="material-icons right">filter_list</i></th>
                            <th>Alteration <i class="material-icons right">filter_list</i></th>
                            <th>Annotation <i class="material-icons right">filter_list</i></th>
                            <th>Allele C. <i class="material-icons right">filter_list</i></th>
                            <th>Allele N. <i class="material-icons right">filter_list</i></th>
                            <th>Allele F. <i class="material-icons right">filter_list</i></th>
                            <th>rsNumber <i class="material-icons right">filter_list</i></th>
                            <th>Flags<i class="material-icons right">filter_list</i></th>
                            <th>Filter <i class="material-icons right">filter_list</i></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div><br>
    </div>

    <!-- PTM table -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">place</i>Post-translational Modifications (PTMs)</div>
        <div class="collapsible-body">
            <div id="ptm_chart"></div>
            <div class="table-wrapper">
                <table id="ptmTable" class="special_table hide">
                    <thead>
                        <tr>
                            <th>Gene Name <i class="material-icons right">filter_list</i></th>
                            <th>ACC ID <i class="material-icons right">filter_list</i></th>
                            <th>PTM Type <i class="material-icons right">filter_list</i></th>
                            <th>Position <i class="material-icons right">filter_list</i></th>
                            <th>Mod-rsd <i class="material-icons right">filter_list</i></th>
                            <th>Site +/-7 Aa <i class="material-icons right">filter_list</i></th>
                            <th>Mw_kd <i class="material-icons right">filter_list</i></th>
                            <th>Site grpID <i class="material-icons right">filter_list</i></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div><br>
    </div>

    <!-- COSMIC table -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">blur_on</i>Catalogue of Somatic Mutations in Cancer (COSMIC)</div>
        <div class="collapsible-body">
            <div id="cosmic_chart"></div>
            <div class="table-wrapper">
                <table id="cosmicTable" class="special_table hide">
                    <thead>
                        <tr>
                            <th>Gene Name <i class="material-icons right">filter_list</i></th>
                            <th>Transcript ID <i class="material-icons right">filter_list</i></th>
                            <th>Sample name <i class="material-icons right">filter_list</i></th>
                            <th>Primary Site <i class="material-icons right">filter_list</i></th>
                            <th>Primary Histology <i class="material-icons right">filter_list</i></th>
                            <th>Mutation ID <i class="material-icons right">filter_list</i></th>
                            <th>Mutation CDS <i class="material-icons right">filter_list</i></th>
                            <th>Mutation Aa <i class="material-icons right">filter_list</i></th>
                            <th>Mutation Desc. <i class="material-icons right">filter_list</i></th>
                            <th>FATHMM Prediction <i class="material-icons right">filter_list</i></th>
                            <th>FATHMM Score <i class="material-icons right">filter_list</i></th>
                            <th>Mutation Somatic Status <i class="material-icons right">filter_list</i></th>
                            <th>PUBMED PMID <i class="material-icons right">filter_list</i></th>
                            <th>Tumor Origin <i class="material-icons right">filter_list</i></th>
                            <th>Position <i class="material-icons right">filter_list</i></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div><br>
    </div>

    <!-- Community Table -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">import_contacts</i>Community Data </div>
        <div class="collapsible-body">
            <div class="table-wrapper">
                <table id="CommunityTable" class="special_table hide">
                <thead>
                    <tr>
						<th>Contributor <i class="material-icons right">filter_list</i></th>
						<th>Organization <i class="material-icons right">filter_list</i></th>
                        <th>Organism <i class="material-icons right">filter_list</i></th>
                        <th>Protein ID <i class="material-icons right">filter_list</i></th>
                        <th>Position <i class="material-icons right">filter_list</i></th>
                        <th>Aa Change <i class="material-icons right">filter_list</i></th>
                        <th>Phenotype <i class="material-icons right">filter_list</i></th>
                        <th>Impact <i class="material-icons right">filter_list</i></th>
                        <th>Consequence <i class="material-icons right">filter_list</i></th>
                        <th>Source <i class="material-icons right">filter_list</i></th>
                    </tr>
                </thead>
                <tbody id="tbody">
                       
                </tbody>
                </table></div>
        </div>
    <br></div>

<!-- TopMed table --> 
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">chrome_reader_mode</i>TopMed</div>
        <div class="collapsible-body">
            <div id="TopMed_chart"></div>
            <div class="table-wrapper">
                <table id="TopMedTable" class="special_table hide">
                    <thead>
                        <tr>
                            <th>Gene ID <i class="material-icons right">filter_list</i></th>
                            <th>Transcript ID <i class="material-icons right">filter_list</i></th>
							<th>Variant Type <i class="material-icons right">filter_list</i></th>
                            <th>Position <i class="material-icons right">filter_list</i></th>
                            <th>Variation <i class="material-icons right">filter_list</i></th>
                            <th>SIFT <i class="material-icons right">filter_list</i></th>
							<th>PolyPhen <i class="material-icons right">filter_list</i></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div><br>
    </div>

    <!-- dbSNP table -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">chrome_reader_mode</i>dbSNP</div>
        <div class="collapsible-body">
            <div id="dbSNP_chart"></div>
            <div class="table-wrapper">
                <table id="dbSNPTable" class="special_table hide">
                    <thead>
                        <tr>
                            <th>Gene ID <i class="material-icons right">filter_list</i></th>
                            <th>Transcript ID <i class="material-icons right">filter_list</i></th>
                            <th>Consequence <i class="material-icons right">filter_list</i></th>
                            <th>Position <i class="material-icons right">filter_list</i></th>
                            <th>HGVSp <i class="material-icons right">filter_list</i></th>
                            <th>Impact <i class="material-icons right">filter_list</i></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div><br>
    </div>

    <!-- Mouse Variants table -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">healing</i>Mouse Variants</div>
        <div class="collapsible-body">
            <div id="mouseVariants_chart"></div>
            <div class="table-wrapper">
                <table id="mouseVariantsTable" class="special_table hide">
                    <thead>
                        <tr>
                            <th>Variation ID <i class="material-icons right">filter_list</i></th>
                            <th>Gene Name <i class="material-icons right">filter_list</i></th>
                            <th>Phenotype <i class="material-icons right">filter_list</i></th>
                            <th>Change <i class="material-icons right">filter_list</i></th>
                            <th>RefSeq ID <i class="material-icons right">filter_list</i></th>
                            <th>Position <i class="material-icons right">filter_list</i></th>
							<th>Phenotypic Significance <i class="material-icons right">filter_list</i></th>
							<th>Source <i class="material-icons right">filter_list</i></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div><br>
    </div>

    <!-- C.elegans variants table -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">healing</i>C elegans Variants</div>
        <div class="collapsible-body">
            <div id="cel_chart"></div>
            <div class="table-wrapper">
                <table id="celTable" class="special_table hide">
                    <thead>
                        <tr>
                            <th>Variation ID <i class="material-icons right">filter_list</i></th>
                            <th>Gene Name <i class="material-icons right">filter_list</i></th>
                            <th>Phenotypic Significance <i class="material-icons right">filter_list</i></th>
                            <th>RefSeq ID <i class="material-icons right">filter_list</i></th>
                            <th>Change <i class="material-icons right">filter_list</i></th>
                            <th>Position <i class="material-icons right">filter_list</i></th>
                            <th>Phenotype <i class="material-icons right">filter_list</i></th>
							<th>Source <i class="material-icons right">filter_list</i></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div><br>
    </div>

    <!-- Domains Table -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">format_align_center</i>Protein Domains (PFAM)</div>
        <div class="collapsible-body">
            <div class="table-wrapper">
                <table id="DomainTable" class="special_table">
                    <tbody>
                        <tr>
                            <th>Pfam Domain <i class="material-icons right">filter_list</i></th>
                            <th>Domain Name <i class="material-icons right">filter_list</i></th>
                            <th>Description <i class="material-icons right">filter_list</i></th>
                            <th>Positions <i class="material-icons right">filter_list</i></th>
                            <th>Clan <i class="material-icons right">filter_list</i></th>
                            <th>Clan Name <i class="material-icons right">filter_list</i></th>
                            <th>Organism <i class="material-icons right">filter_list</i></th>
                        </tr>
                        <tr id="noResultQS_domains" class="grey">
                            <td colspan="7"><span class="flow-text white-text center">NO RESULT FOUND</span></td>
                        </tr>
                        <?php if ($domainsQuery == null) : ?>
                            <tr>
                                <td colspan="7" class="grey"><span class="flow-text white-text center">NO DOMAINS EXIST</span></td>
                            </tr>
                            <?php
                        else :
                            while ($row = mysqli_fetch_array($domainsQuery)) : ?>
                                <tr class="list-domain">
                                    <td><a href="https://pfam.xfam.org/family/<?= $row['pfam_domain_id']; ?>" target="_blank">
                                            <?= $row['pfam_domain_id']; ?></a></td>
                                    <td><?= $row['domain_name']; ?></td>
                                    <td><?= $row['domain_desc']; ?></td>
                                    <td><?= $row['start_point'] . '-' . $row['end_point']; ?></td>
                                    <td><a href="https://pfam.xfam.org/clan/<?= $row['clan_id']; ?>" target="_blank"><?= $row['clan_id']; ?></a></td>
									<td><?= $row['clan_name']; ?></td>
									<td><?= $row['organism']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>

    <!-- Diseases and Genes Table -->
    <div class="col s12 m12 l12">
        <!-- <div class="collapsible-header active"><i class="material-icons">view_list</i>Diseases for Human Homolog (<?= strstr(printify($humanGeneDetails['gene_symbol']), ',', true); ?>) of the Gene (<?= printify($geneDetails['gene_symbol']); ?> - <?= ucfirst($geneDetails['species_id']); ?>)</div> -->
        <div class="collapsible-header active"><i class="material-icons">view_list</i>List of the diseases from DisGeNET</div>

        <div class="collapsible-body">
            <center><input type="text" class="quick_search" id="quick_search_diseases" placeholder="Search in the table "></center>
            <div class="table-wrapper">
                <table id="DiseasesTable" class="special_table">
                    <tbody>
                        <tr>
                            <!-- <th>Gene Symbol <i class="material-icons right">filter_list</i></th> -->
                            <th>Disease Name <i class="material-icons right">filter_list</i></th>
                            <th width="350">Disease Category <i class="material-icons right">filter_list</i></th>
                            <th>DSI* <i class="material-icons right">filter_list</i></th>
                            <th>DPI** <i class="material-icons right">filter_list</i></th>
                        </tr>
                        <?php if ($DiseaseQuery == null) : ?>
                            <tr>
                                <td class="grey" colspan="6"><span class="flow-text white-text center">NO RESULT FOUND</span></td>
                            </tr>
                            <?php
                        else :
                            while ($row = mysqli_fetch_array($DiseaseQuery)) :
                                $raw_category = $row['category'];
                                if (empty($raw_category) == false) {
                                    $array_raw_category = explode(";", $raw_category);
                                    $category = "";
                                    foreach ($array_raw_category as $cat_id) {
                                        $category .= $disease_cat_mapping[$cat_id] . "; ";
                                    }
                                } else {
                                    $category = "N/A";
                                }
                            ?>

                                <tr class="list-dis-gene">
                                    <!-- <td><?= strstr(printify($humanGeneDetails['gene_symbol']), ',', true); ?></td> -->
                                    <td><?= $row['disease_name']; ?></td>
                                    <td><?= $category; ?></td>
                                    <td><?= $row['dsi']; ?></td>
                                    <td><?= $row['dpi']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <tr id="noResultQS_diseases" class="grey">
                            <td colspan="6"><span class="flow-text white-text center">NO RESULT FOUND</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div> <!-- end of tables -->

<!-- Modal Structure -->
<div id="clinical_significance_classification_help" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Classification of Clinicial Significance of ClinVar Data</h4>
        <p>
            <?php
            foreach ($clinicalSignificanceMapping as $category => $significances) {
                echo "<b>" . $category . "</b><br>";

                foreach ($significances as $significance) {
                    echo $significance . "<br>";
                }
            }
            ?>
        </p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-white btn-flat blue white-text">Agree</a>
    </div>
</div>

<!-- Tool Pop-Up -->
<div id="PopUpTool" class="modal modal-fixed-footer" style="width: 90% !important; height: 60% !important">
    <div class="modal-content">
        <iframe id="CurrentProjectTool" src="<?= $GLOBALS['base_url']; ?>tool.php?msa_id=<?= $msa_id; ?>&human=<?= $_GET['human']; ?>&mouse=<?= $_GET['mouse']; ?>&worm=<?= $_GET['worm']; ?>" width="96%" style="min-height:390px; height:auto !important" frameborder="0"></iframe>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-white btn-flat blue white-text">CLOSE</a>
    </div>
</div>


<!-- Current Project | FeedBack -->
<div class="fixed-action-btn"> <a class="btn-floating btn-large waves-effect waves-light blue tooltipped modal-trigger" href="https://forms.gle/U5WwH4SdCsYSmi9C7" target="_blank" data-position="left" data-delay="0" data-tooltip="Send a feedback about the results."> <i class="large material-icons">feedback</i></a></div>

<!-- Linking from Table to Viewer -->
<script type="text/javascript">
    $('.modal').modal({
        inDuration: 0,
        outDuration: 0,
        fadeDuration: 100
    });
    $('select').material_select();
    var event = new Event('mouseover');

    if (!Element.prototype.scrollIntoViewIfNeeded) {
        Element.prototype.scrollIntoViewIfNeeded = function(centerIfNeeded) {
            centerIfNeeded = arguments.length === 0 ? true : !!centerIfNeeded;

            var parent = this.parentNode,
                parentComputedStyle = window.getComputedStyle(parent, null),
                parentBorderTopWidth = parseInt(parentComputedStyle.getPropertyValue('border-top-width')),
                parentBorderLeftWidth = parseInt(parentComputedStyle.getPropertyValue('border-left-width')),
                overTop = this.offsetTop - parent.offsetTop < parent.scrollTop,
                overBottom = (this.offsetTop - parent.offsetTop + this.clientHeight - parentBorderTopWidth) > (parent.scrollTop + parent.clientHeight),
                overLeft = this.offsetLeft - parent.offsetLeft < parent.scrollLeft,
                overRight = (this.offsetLeft - parent.offsetLeft + this.clientWidth - parentBorderLeftWidth) > (parent.scrollLeft + parent.clientWidth),
                alignWithTop = overTop && !overBottom;

            if ((overTop || overBottom) && centerIfNeeded) {
                parent.scrollTop = this.offsetTop - parent.offsetTop - parent.clientHeight / 2 - parentBorderTopWidth + this.clientHeight / 2;
            }

            if ((overLeft || overRight) && centerIfNeeded) {
                parent.scrollLeft = this.offsetLeft - parent.offsetLeft - parent.clientWidth / 2 - parentBorderLeftWidth + this.clientWidth / 2;
            }

            if ((overTop || overBottom || overLeft || overRight) && !centerIfNeeded) {
                this.scrollIntoView(alignWithTop);
            }
        };
    }

    function goToVariation(protein, position) {
        $('#PopUpTool').modal('open');
        var iframe = document.getElementById("CurrentProjectTool");
        iframe.scrollIntoViewIfNeeded();

        var iframeWindow = iframe.contentWindow;
        var iframeDocument = iframe.contentDocument;
        var viewportPosition = iframeWindow.viewer.getAminoacidPositionInViewport(protein, position - 1);
        //$(iframeDocument).find('#CurrentProjectTool').scrollLeft(viewportPosition*20 - iframe.clientWidth/2);
        $(iframeDocument).find('input[name=position]').val(position);
        iframe.contentWindow.document.getElementById("CurrentProjectTool-species-select").selectedIndex = protein;
        $(iframeDocument).find("CurrentProjectTool-species-select").selectedIndex = protein;
        iframeWindow.viewer.positionKeyUp();
        setTimeout(function() {
            iframeWindow.viewer.showVariation(protein, position - 1);
        }, 125);
    }
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/scroller/2.0.0/css/scroller.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Tables -->
<script type="text/javascript">
    $(document).ready(function() {
        <?php if (isset($humanGeneDetails['dbs']['NP'])) : ?>
            // ClinVar Table
            $('#ClinVarTable').DataTable({
                "processing": true,
                "serverSide": true,
                "searchable": true,
                "pageLength": 20,
                "searchDelay": 600,

                <?php if (isset($humanGeneDetails['dbs']['NP'])) : ?> "ajax": {
                        "url": "<?= $GLOBALS['base_url']; ?>/api.php?action=clinvar&id=<?= urlencode(normalizeIds($humanGeneDetails['dbs']['NP'])); ?>",
                        "type": "GET"
                    },
                <?php endif; ?> "deferRender": true,
                "columnDefs": [{
                    "targets": 5,
                    "render": function(data, type, row) {
                        var position = data.split('---')[1];
                        data = data.split('---')[0];
                        return '<a class="variation-link" onclick="goToVariation(0, ' + position + ')">' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }, {
                    "targets": 2,
                    "render": function(data, type, row) {
                        if (data == "N/A") {
                            rs_link = "#";
                            rs_target = "_top";
                        } else {
                            rs_link = "https://www.ncbi.nlm.nih.gov/clinvar/?term=" + data;
                            rs_target = "_blank";
                        }
                        return '<a class="variation-link" href="' + rs_link + '" target="' + rs_target + '">' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }],
                language: {
                    searchPlaceholder: "Search in the table",
                    search: "",
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                }
            });

            $('#ClinVarTable').removeClass('hide');
        <?php else : ?>
            $('#ClinVarTable').parent().parent().parent().hide();
        <?php endif; ?>

        //gnomAD Table
        $('#gnomADtable').DataTable({
            "processing": false,
            "serverSide": false,
            "pageLength": 20,

            <?php if (isset($humanGeneDetails['dbs']['ENST'])) : ?> "ajax": "<?= $GLOBALS['base_url']; ?>/api.php?action=gnomad&id=<?= urlencode(normalizeIds($humanGeneDetails['dbs']['ENST'])); ?>",
            <?php endif; ?> "columnDefs": [{
                "targets": 0,
                "render": function(data, type, row) {
                    return '<a class="variation-link" target="_blank"  href="https://gnomad.broadinstitute.org/variant/' + data + '">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }, {
                "targets": 1,
                "render": function(data, type, row) {
                    return '<a class="variation-link" target="_blank" href="https://www.ensembl.org/id/' + data + '">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }, {
                "targets": 2,
                "render": function(data, type, row) {
                    var position = data.split('---')[1];
                    data = data.split('---')[0];
                    return '<a class="variation-link" onclick="goToVariation(0, ' + position + ')">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }],
            "deferRender": true,
            language: {
                searchPlaceholder: "Search in the table",
                search: ""
            }
        });
        $('#gnomADtable').removeClass('hide');
		
		
		//GO Annotation Table 
        $('#go_annotationTable').DataTable( {
            "processing": false,
            "serverSide": false,
            "pageLength": 20,

            
			<?php if (isset($other_idHuman) || isset($other_idMouse) || isset($other_idWorm)) : ?>
			"ajax": "<?= $GLOBALS['base_url']; ?>/api.php?action=go_annotation&id=<?= "%22",urlencode($other_idHuman),"%22,%22", urlencode($other_idMouse), "%22,%22",urlencode($other_idWorm),"%22"; ?>",
            <?php endif; ?>
            "columnDefs": [{
				"targets": 0,
				"render": function(data,type,row) {
					return '<a class="go-accession-link" target="_blank" href="http://amigo.geneontology.org/amigo/term/' + data + '">' + data + '</a>';
				},
				"defaultContent": "<button>Click!</button>"
			}, {
                "targets": 2,
                "render": function(data, type, row) {
					data = data.split('_')
					data = data[0] + " " + data[1];
					return '<p class="go-domain">' + data + '</p>';
				},
				//"defaultContent": "<button>Click!</button>"
            }], 
            "deferRender": true,
            language: {
                searchPlaceholder: "Search in the table",
                search: ""
            }
        } );
        $('#go_annotationTable').removeClass('hide');
		
        //Community Table 
         $('#CommunityTable').DataTable( {
            "processing": false,
            "serverSide": false,
            "pageLength": 20,

            
			<?php if (isset($humanGeneDetails['dbs']['NP']) || isset($dbIds_mouse) || isset($transcriptIdWorm)) : ?>
			"ajax": "<?= $GLOBALS['base_url']; ?>/api.php?action=community&id=<?= urlencode($humanGeneDetails['dbs']['NP']),",%22", urlencode($dbIds_mouse), "%22,%22",urlencode($transcriptIdWorm),"%22"; ?>",
            <?php endif; ?>
            "columnDefs": [{
                "targets": 3,
                "render": function(data, type, row) {
                    return '<a class="variation-link" target="_blank" href="http://www.ncbi.nlm.nih.gov/protein/' + data + '">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }, {
                "targets": 4,
                "render": function(data, type, row) {
					var position = 0;
					if (row[2] === "Caenorhabditis elegans") {
						position = 2;
					} else if (row[2] === "Mus Musculus") {
						position = 1;
					}
                    return '<a class="variation-link" onclick="goToVariation('+ position +', ' + data + ')">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }, {
                "targets": 9,
                "render": function(data, type, row) {
                    return '<a class="variation-link" target="_blank" href="' + data + '">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }], 
            "deferRender": true,
            language: {
                searchPlaceholder: "Search in the table",
                search: ""
            }
        } );
        $('#CommunityTable').removeClass('hide');
        //Mouse Variants Table
        $('#mouseVariantsTable').DataTable({
            "processing": false,
            "serverSide": false,
            "pageLength": 20,

            <?php if (isset($dbIds_mouse)) : ?> "ajax": "<?= $GLOBALS['base_url']; ?>/api.php?action=mouseVariants&id=<?= urlencode(normalizeIds($dbIds_mouse)); ?>",
            <?php endif; ?> 
			"columnDefs": [{
                "targets": 4,
                "render": function(data, type, row) {
                    return '<a class="variation-link" target="_blank" href="http://www.ncbi.nlm.nih.gov/protein/' + data + '">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }, {
                "targets": 5,
                "render": function(data, type, row) {
                    return '<a class="variation-link" onclick="goToVariation(1, ' + data + ')">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }, {
				"targets": 0,
				"render": function(data, type, row) {
					if (row[7] === "APF") {
						return '<a class="variation-link" target="_blank" href="https://databases.apf.edu.au/mutations/snpRow/show/' + data + '?assembly=GRCm38">' + data + '</a>';
					}
					if (row[7] === "Mutagenetix") {
						if (row[6] === "phenotypic") {
							return '<a class="variation-link" target="_blank" href="https://mutagenetix.utsouthwestern.edu/phenotypic/phenotypic_rec.cfm?pk=' + data + '">' + data + '</a>';
						}
						else if (row[6] === "incidental") {
							return '<a class="variation-link" target="_blank" href="https://mutagenetix.utsouthwestern.edu/incidental/incidental_rec.cfm?mid=' + data + '&rn=4&rl=523150&so=&ac=1&r0=0&nr=100">' + data + '</a>';
						}
					}
				},
				"defaultContent": "<button>Click!</button>"
			}],
            "deferRender": true,
            language: {
                searchPlaceholder: "Search in the table",
                search: ""
            }
        });
        $('#mouseVariantsTable').removeClass('hide');

        //Celegans Variants Table
        $('#celTable').DataTable({
            "processing": false,
            "serverSide": false,
            "pageLength": 20,

            <?php if (isset($transcriptIdWorm)) : ?> "ajax": "<?= $GLOBALS['base_url']; ?>/api.php?action=celVariants&id=<?= urlencode(normalizeIds($transcriptIdWorm)); ?>",
            <?php endif; ?> "columnDefs": [{
                "targets": 3,
                "render": function(data, type, row) {
                    return '<a class="variation-link" target="_blank" href="http://www.ncbi.nlm.nih.gov/protein/' + data + '">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }, {
                "targets": 5,
                "render": function(data, type, row) {
                    //var position = data.split('---')[0];
                    return '<a class="variation-link" onclick="goToVariation(2, ' + data + ')">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }, {
                "targets": 0,
                "render": function(data, type, row) {
                    return '<a class="variation-link" target="_blank" href="https://wormbase.org/species/c_elegans/variation/' + data + '">' + data + '</a>';
                },
                "defaultContent": "<button>Click!</button>"
            }],
            "deferRender": true,
            language: {
                searchPlaceholder: "Search in the table",
                search: ""
            }
        });
        $('#celTable').removeClass('hide');

        <?php if (array_sum($ptmCounts) > 0) : ?>
            //PTM Table
            $('#ptmTable').DataTable({
                "processing": false,
                "serverSide": false,
                "pageLength": 20,
                <?php if (isset($humanGeneDetails['dbs']['UNIPROT'])) : ?> "ajax": "<?= $GLOBALS['base_url']; ?>/api.php?action=ptm&id=<?= urlencode(normalizeIds($humanGeneDetails['dbs']['UNIPROT'])); ?>",
                <?php endif; ?> "columnDefs": [{
                    "targets": 3,
                    "render": function(data, type, row) {
                        return '<a class="variation-link" onclick="goToVariation(0, ' + data + ')">' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }],
                "deferRender": true,
                language: {
                    searchPlaceholder: "Search in the table",
                    search: ""
                }
            });
            $('#ptmTable').removeClass('hide');
        <?php else : ?>
            $('#ptmTable').parent().parent().parent().hide();
        <?php endif; ?>
		
		<?php if ($TopMedCounts > 0) : ?>
            //TopMed Table
            $('#TopMedTable').DataTable({
                "processing": false,
                "serverSide": false,
                "pageLength": 20,
                <?php if (isset($humanGeneDetails['dbs']['ENST'])) : ?> "ajax": "<?= $GLOBALS['base_url']; ?>/api.php?action=TopMed&id=<?= urlencode(normalizeIds($humanGeneDetails['dbs']['ENST'])); ?>",
                <?php endif; ?> "columnDefs": [{
                    "targets": 1,
                    "render": function(data, type, row) {
                        return '<a class="variation-link" target="_blank" href="https://www.ensembl.org/id/' + data + '">' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }, {
                    "targets": 3,
                    "render": function(data, type, row) {
                        //var position = data.split('---')[1];
                        //data = position.split('---')[0].split(":")[1];
                        return '<a class="variation-link" onclick="goToVariation(0, ' + data + ')">' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }],
                "deferRender": true,
                language: {
                    searchPlaceholder: "Search in the table",
                    search: ""
                }
            });
            $('#TopMedTable').removeClass('hide');
        <?php else : ?>
            $('#TopMedTable').parent().parent().parent().hide();
        <?php endif; ?>
		
        <?php if (array_sum($dbSNPCounts) > 0) : ?>
            //dbSNP Table
            $('#dbSNPTable').DataTable({
                "processing": false,
                "serverSide": false,
                "pageLength": 20,
                <?php if (isset($humanGeneDetails['dbs']['ENST'])) : ?> "ajax": "<?= $GLOBALS['base_url']; ?>/api.php?action=dbSNP&id=<?= urlencode(normalizeIds($humanGeneDetails['dbs']['ENST'])); ?>",
                <?php endif; ?> "columnDefs": [{
                    "targets": 1,
                    "render": function(data, type, row) {
                        return '<a class="variation-link" target="_blank" href="https://www.ensembl.org/id/' + data + '">' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }, {
                    "targets": 3,
                    "render": function(data, type, row) {
                        //var position = data.split('---')[1];
                        //data = position.split('---')[0].split(":")[1];
                        return '<a class="variation-link" onclick="goToVariation(0, ' + data + ')">' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }],
                "deferRender": true,
                language: {
                    searchPlaceholder: "Search in the table",
                    search: ""
                }
            });
            $('#dbSNPTable').removeClass('hide');
        <?php else : ?>
            $('#dbSNPTable').parent().parent().parent().hide();
        <?php endif; ?>

        <?php if (array_sum($cosmicCounts) > 0) : ?>
            //COSMIC Table
            $('#cosmicTable').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 20,
                <?php if (isset($humanGeneDetails['dbs']['ENST'])) : ?> "ajax": {
                        "url": "<?= $GLOBALS['base_url']; ?>/api.php?action=cosmic&id=<?= urlencode(normalizeIds($humanGeneDetails['dbs']['ENST'])); ?>",
                        "type": "GET"
                    },
                <?php endif; ?> "deferRender": true,
                "columnDefs": [{
                    "targets": 1,
                    "render": function(data, type, row) {
                        return '<a class="variation-link" target="_blank" href="https://www.ensembl.org/id/' + data + '">' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }, {
                    "targets": 5,
                    "render": function(data, type, row) {
                        var cosmicID = data.substring(4);
                        return '<a class="variation-link" target="_blank" href="https://cancer.sanger.ac.uk/cosmic/mutation/overview?id=' + cosmicID + '">' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }, {
                    "targets": 7,
                    "render": function(data, type, row) {
                        var position = data.split('---')[1];
                        data = data.split('---')[0];
                        return '<a class="variation-link" onclick="goToVariation(0, ' + position + ')">' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }, {
                    "targets": 12,
                    "render": function(data, type, row) {
                        if (data == "") {
                            data = "N/A";
                            pmid_link = "#";
                            target = "_top";
                        } else {
                            pmid_link = "https://www.ncbi.nlm.nih.gov/pubmed/" + data;
                            target = "_blank";
                        }
                        return '<a class="variation-link" target="' + target + '" href="' + pmid_link + '">PMID: ' + data + '</a>';
                    },
                    "defaultContent": "<button>Click!</button>"
                }],
                language: {
                    searchPlaceholder: "Search in the table",
                    search: ""
                }
            });

            $('#cosmicTable').removeClass('hide');
        <?php else : ?>
            $('#cosmicTable').parent().parent().parent().hide();
        <?php endif; ?>

    });
</script>
<!-- Stats -->
<script type="text/javascript">
    // ClinVar Stats
    var options_clinvar = {
        chart: {
            animations: {
                enabled: false
            },
            height: 150,
            type: 'bar',
            stacked: true,
            stackType: '100%'
        },
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        series: [
            <?php foreach ($clinVarCounts as $category => $numberOfVariations) : ?> {
                    name: '<?= $category; ?>',
                    data: [<?= $numberOfVariations; ?>]
                },
            <?php endforeach; ?>

        ],
        xaxis: {
            categories: [""]
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " Variants"
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: 40
        }
    }

    // gnomAD Stats
    var options_gnomad = {
        chart: {
            animations: {
                enabled: false
            },
            height: 150,
            type: 'bar',
            stacked: true,
            stackType: '100%'
        },
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        series: [
            <?php foreach ($gnomADCounts as $key => $value) : ?> {
                    name: '<?= ucwords(str_replace("_", " ", $key));; ?>',
                    data: [<?= $value; ?>]
                },
            <?php endforeach; ?>
        ],
        xaxis: {
            categories: [""]
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " Variants"
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: 40
        }
    }

    // PTM Stats
    var options_ptm = {
        chart: {
            animations: {
                enabled: false
            },
            height: 150,
            type: 'bar',
            stacked: true,
            stackType: '100%'
        },
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        series: [
            <?php foreach ($ptmCounts as $key => $value) : ?> {
                    name: '<?= ucwords(str_replace("_", " ", $key));; ?>',
                    data: [<?= $value; ?>]
                },
            <?php endforeach; ?>
        ],
        xaxis: {
            categories: [""]
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " Variants"
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: 40
        }
    }

    // dbSNP Stats
    var options_dbSNP = {
        chart: {
            animations: {
                enabled: false
            },
            height: 150,
            type: 'bar',
            stacked: true,
            stackType: '100%'
        },
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        series: [
            <?php foreach ($dbSNPCounts as $key => $value) : ?> {
                    name: '<?= ucwords(str_replace("_", " ", $key));; ?>',
                    data: [<?= $value; ?>]
                },
            <?php endforeach; ?>
        ],
        xaxis: {
            categories: [""]
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " Variants"
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: 40
        }
    }

    // COSMIC Stats
    var options_cosmic = {
        chart: {
            animations: {
                enabled: false
            },
            height: 150,
            type: 'bar',
            stacked: true,
            stackType: '100%'
        },
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        series: [
            <?php foreach ($cosmicCounts as $key => $value) : ?> {
                    name: '<?= ucwords(str_replace("_", " ", $key));; ?>',
                    data: [<?= $value; ?>]
                },
            <?php endforeach; ?>
        ],
        xaxis: {
            categories: [""]
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " Variants"
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: 40
        }
    }


    try {
        var chart_clinvar = new ApexCharts(document.querySelector("#clinvar_chart"), options_clinvar);
        chart_clinvar.render();

    } catch {

    }
    try {
        var chart_dynamic = new ApexCharts(document.querySelector("#dynamic_chart"), options_<?= $dynamicChart; ?>);
        chart_dynamic.render();

    } catch {

    }
    try {
        var chart_gnomad = new ApexCharts(document.querySelector("#gnomad_chart"), options_gnomad);
        chart_gnomad.render();

    } catch {

    }
    try {
        var chart_ptm = new ApexCharts(document.querySelector("#ptm_chart"), options_ptm);
        chart_ptm.render();

    } catch {

    }
    try {
        var chart_dbSNP = new ApexCharts(document.querySelector("#dbSNP_chart"), options_dbSNP);
        chart_dbSNP.render();

    } catch {

    }
    try {

        var chart_cosmic = new ApexCharts(document.querySelector("#cosmic_chart"), options_cosmic);
        chart_cosmic.render();

    } catch {

    }
    function createTableOfContents() {
    all_follibles = $('.col.s12:visible .collapsible-header.active')
    all_text = "<table class='special_table'><tr><th>Table of Contents</th></tr>";
    for ( i in all_follibles){ 
        if (all_follibles[i].innerHTML == undefined )
            break;
        title= all_follibles[i].innerHTML.replace(/<i class=\"(.*?)\">(.*?)<\/i>/i, '').replace(/<a (.*?) class=\"(.*?)\">(.*?)<\/i>/i, '').replace('  ', '');
        id = title.toLowerCase().replace(' ', '-').replace("'", '').replace('"', '')
        $(all_follibles[i]).parent().attr('id', 'content-'+id);
        all_text += '<tr><td><a href="#content-'+id+'"">'+title + '</td></tr>';
    }
    all_text += '</table>';
    $('#table-of-contents').html(all_text);
    }
    createTableOfContents();
    setTimeout(createTableOfContents, 1500);
    function offsetAnchor() {
       if(location.hash.length !== 0) {
            window.scrollTo(window.scrollX, window.scrollY - 200);
        }
    }
    // This will capture hash changes while on the page
    window.addEventListener("hashchange", offsetAnchor);

// This is here so that when you enter the page with a hash,
// it can provide the offset in that case too. Having a timeout
// seems necessary to allow the browser to jump to the anchor first.
window.setTimeout(offsetAnchor, 1); // The delay of 1 is arbitrary and may not always work right (although it did in my testing).


</script>

<?php require("footer.php"); ?>
