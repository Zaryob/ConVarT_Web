<?php
    require_once("db_connection.php");
    require_once("functions.php");
    require_once("config.php");
    #Capture the term searched for spemud
    $spemud_searchText = trim($_GET['spemud']);
error_log("line 7 - spemud_searchText: ". $spemud_searchText);

$spemud_searchText = preg_replace("#[^0-9a-z_\-.:]i#","", $spemud_searchText);
error_log("line 10 - spemud_searchText: ". $spemud_searchText);

#Capture the term searched for other search
    $searchText = trim($_GET['q']);
error_log("line 14 - searchText: ". $searchText);

$searchText = preg_replace("#[^0-9a-z_\-.:]i#","", $searchText);
error_log("line 17 - searchText: ". $searchText);

    if($searchText == ""  && $spemud_searchText == ""){
        exit;
    }
    if(!isset($searchText) && !isset($spemud_searchText)) {
        exit;
    }
        #Human Search Block
        #$queryForHuman = mysqli_query($db_connection, "SELECT gene_id, gene_symbol, protein_numbers FROM mapping_human WHERE gene_id='$searchText' OR gene_symbol='$searchText' OR FIND_IN_SET('$searchText', gene_synonyms) OR FIND_IN_SET('$searchText', protein_numbers) OR FIND_IN_SET('$searchText', other_ids)") or die ("Could not search");
    
    // Select the path: Spemud or Gene search 
    if ($spemud_searchText != "") {
        $active = "active_spmud";
        $orthoId = $spemud_searchText;

        #$proteinsBySpemud = search_spemud_proteins($spemud_searchText);
        if(strstr($spemud_searchText, 'NM_')){
            $orthoId = getGeneIdbyDBId(explode('.', $spemud_searchText)[0]);
            
        } else if (strstr($spemud_searchText, 'NP_')) { //&& hasMSA($spemud_searchText)){ PERFORMANS İYİLEŞTİRMESİ İÇİN KALDIRDIM. iLERDE SORUN OLABİLİR
            $orthoId = $spemud_searchText;
        }else if (substr($spemud_searchText, 0, 2) == 'rs'){
            
            $query = getClinvarData("'$spemud_searchText'", 'rs_number');
            if($query == null){
                $query = getGnomadData("'$spemud_searchText'", 'rs_number');
            }
            
            $row = @mysqli_fetch_assoc($query);
            if(isset($row['nm_id'])){
                $orthoId = $row['np_id']; 
                
            } else if (isset($row['canonical_transcript'])) {
                $orthoId = $row['canonical_transcript'];    
            }
        }else if (substr($spemud_searchText, 0, 4) == 'ENST'){
            $query = getGnomadData("'$spemud_searchText'", 'canonical_transcript');
            $row = @mysqli_fetch_assoc($query);
            if (isset($row['canonical_transcript'])) {
                $orthoId = $row['canonical_transcript'];    
            }
        }
        $spemud_searchText = $orthoId;
        error_log("line 61 - searchText: ". $spemud_searchText);

    }

    else {
        $geneId = null;
        
        if(strstr($searchText, 'NM_')){
            $geneId = getGeneIdbyDBId(explode('.', $searchText)[0]);
            
        } else if (strstr($searchText, 'NP_')) { //&& hasMSA($searchText)){ PERFORMANS İYİLEŞTİRMESİ İÇİN KALDIRDIM. iLERDE SORUN OLABİLİR
            $geneId = $searchText;
        } else if (substr($searchText, 0, 2) == 'rs'){
            
            $query = getClinvarData("'$searchText'", 'rs_number');
            if($query == null){
                $query = getGnomadData("'$searchText'", 'rs_number');
            }
            
            $row = @mysqli_fetch_assoc($query);
            if(isset($row['nm_id'])){
                $geneId = $row['np_id']; 
                
            } else if (isset($row['canonical_transcript'])) {
                $geneId = $row['canonical_transcript'];    
            }
        }
        
        if($geneId != NULL){
            header("location:{$GLOBALS['base_url']}msa?id={$geneId}");
            exit;
        }
        
        $proteinsBySpecies = searchProteinNumbers($searchText);
        
        #$countForHuman = mysqli_num_rows($queryForHuman);
        #if($countForHuman == 0) {$preResultForHuman='<a href="#" class="btn waves-effect waves-light preResultBtnEmpty">No finding for "'.$searchText.'"</a>';}
        #$searchText="INS";
        #SELECT DISTINCT gnomad.canonical_transcript,mapping_human.gene_symbol, mapping_human.gene_id, mapping_human.protein_numbers FROM mapping_human INNER JOIN genes_unique ON mapping_human.gene_id=genes_unique.gene_id INNER JOIN gnomad ON genes_unique.canonical_transcript=gnomad.canonical_transcript WHERE FIND_IN_SET('HEL-S-87p', mapping_human.gene_synonyms)
        #
    }
        
    require("header.php"); 
?>

<!-- CurrentProject PreResult Page -->
<div class="container pageBox">

    <!-- Select the path : Spemud or Gene search -->
    
    <!-- Spemud -->
    <?php if ($spemud_searchText != ""): ?>
        <?php $proteinsBySpemud = search_spemud_proteins($spemud_searchText); ?>
        <form action="<?php echo $GLOBALS['base_url']; ?>orthovar" method="get">
            <?php if($proteinsBySpemud == ""): ?>
                <!-- <a href="#" class="btn waves-effect waves-light preResultBtnEmpty">No finding for "<?= $spemud_searchText; ?>"</a> -->

                <iframe src="<?php echo $GLOBALS['base_url']."spemud_helper_flow_orthovar.php?spm=".$spemud_searchText ?>" title="description" width="100%" height="100%" frameborder="0">
            <?php else: ?>
                <div class="card-panel blue">
                    <span class="white-text">1) Pick a human transcript for a gene of your interest (Note: Sometimes gene names are used as a synonym for the others, so it might end up several different genes, which are highlighted in different colors)
						<br>2) Once you pick a human transcript, the homolog genes in other species will be listed. One transcript for each organism should be selected. 
						<br>3) Click Analyse button
						<br>4) The numbers at the end show the total number of variants reported for that transcript (ClinVar, gnomAD, COSMIC, and TOPMed).
						<br>Non-coding Ensembl transcripts (ENST) will not show up. For example, non-coding transcript ENST00000504290 (ENST) (such as TP53; ) will not appear in the ConVarT v.1.0 version.  The ConVarT v.1.0 currently shows human variants from gnomAD, TOPMed, COSMIC, and ClinVar, all of which are mapped to the GRCh37/hg19 reference sequence. So those Ensembl transcripts (ENST) that are not available in GRCh37/hg19 will not show up. We will be moving to GRCh38 in the future.
                    </span>
                </div>
                <?php print($proteinsBySpemud); ?>
                <center><br><button class="btn waves-effect waves-light waves-white sb seqSearchButton" id="startAnalyse" type="submit"><i class="material-icons">search</i>ANALYSE</button></center>
        </form>
    <?php endif;?>


    <!-- Gene search  -->
    <?php else: ?>
        <!-- <p class="purple-text text-lighten-1">*Select an organism to continue. If they are homolog, they will be demonstrated on the same page.</p>-->
        <?php if(empty($proteinsBySpecies)):?>
            <a href="#" class="btn waves-effect waves-light preResultBtnEmpty">No finding for "<?= $searchText; ?>"</a>
        <?php endif;?>
            
            

            <?php foreach($proteinsBySpecies as $species=>$proteinsInSpecies): ?>
                <div class="row">
                    <div class="pageTitle">Results for '<i><?php echo $searchText; ?></i> ' in <i> <?= $species; ?> </i>
                        <?php if ($species=="Homo sapiens") {echo '<a href="#preResult_help" class="modal-trigger tooltipped" data-position="right" data-delay="0" data-tooltip="Searching Result and Alignments"><i class="material-icons blue-text text-darken-1">help</i></a>';} ?>
                        <hr></div>
                    <div class="col s12 m12 l12">
                        <?php foreach($proteinsInSpecies as $data): ?>
                            <a target="_blank" href="<?= $GLOBALS['base_url']; ?>msa?id=<?= $data['transcript_id']; ?>" class="btn waves-effect waves-light preResultBtn"><?= $data['transcript_id']; ?> | GeneID: <?= $data['ncbi_gene_id']; ?> | <i><?= $data['gene_symbol']; ?></i></a>
                        <?php endforeach;?>
                    </div>
                    
                    <div class="col s12 m12 l2"></div>
                </div>
            <?php endforeach;?>
    <?php endif; ?>

</div> <!-- end of preResult page -->

<!-- Modal Structure -->
<div id="preResult_help" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Searching Result and Alignments</h4>
      <p>
        When a human gene was assigned to multiple orthologs in other organisms, protein sequences from other organisms with higher levels of sequence identity were displayed in multiple species alignment of orthologs. For example, <i>H3F3A</i> has multiple orthologs in <i>C. elegans</i> which are <i>his-69, his-70, his-71, his-72, his-73, cpar-1, his-74,</i> and <i>F20D6.9</i>. <i>C. elegans</i> his-71 possessing the higher levels of sequence identity with H3F3A among other <i>C. elegans</i> H3F3A orthologs will be displayed when you enter H3F3A. However,  you can also enter <i>his-69, his-70, his-72,his-73, cpar-1, his-74, or F20D6.9 </i> genes  individually for multiple species alignment with H3F3A.  
      </p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat blue white-text">Agree</a>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    var mouse_radio_buttons = document.getElementsByName("mouse");
    var worm_radio_buttons = document.getElementsByName("worm");

    document.getElementById('mouse').style.display = 'none';
    document.getElementById('worm').style.display = 'none';

    for (mouse_radio of mouse_radio_buttons) {
        mouse_radio.parentNode.style.display = 'none';
    };

    for (worm_radio of worm_radio_buttons) {
        worm_radio.parentNode.style.display = 'none';
    };

	$('.modal').modal();
    $("#startAnalyse").addClass("disabled");
    $("form :input").change(function() {
        $("#startAnalyse").addClass("disabled");

        var paras = document.getElementsByClassName('alert');

        while(paras[0]) {
            paras[0].parentNode.removeChild(paras[0]);
        };
        
        speciesList = ['human', 'mouse', 'worm'];
        selectedSpeciesCount = 0; //must be 3 for the analysis
        availableSpeciesCount = 0;

        if($(this).attr('id').startsWith('human')) {
            for (mouse_radio of mouse_radio_buttons) {
                mouse_radio.parentNode.style.display = 'none';
                mouse_radio.checked = false;
            };

            for (worm_radio of worm_radio_buttons) {
                worm_radio.parentNode.style.display = 'none';
                worm_radio.checked = false;
            };
        }

        selected_cb = $(this).attr('id');
        selected_cb_color = $('label[for=' + selected_cb +']').css('color');

        document.getElementById('mouse').style.display = 'block';
        document.getElementById('worm').style.display = 'block';

        all_radio_buttons = document.getElementsByClassName('convart-radio');

        available_mouse = 0;
        available_worm = 0;

        selected_first_mouse = true;
        selected_first_worm = true;

        first_available_mouse = -1
        first_available_worm = -1

        for (radio_button of all_radio_buttons) {
            radio_button_input = $(radio_button.childNodes[0]);
            radio_button_label = $(radio_button.childNodes[2]);

            if (radio_button_label.css('color') === selected_cb_color) {
                radio_button.style.display = 'block';
                if(radio_button_input.attr('id').startsWith('mouse')){
                    if (selected_first_mouse) {
                        first_available_mouse = radio_button_input.attr('id')
                    }
                    selected_first_mouse = false;
                    available_mouse++;
                }
                if(radio_button_input.attr('id').startsWith('worm')){
                    if (selected_first_worm) {
                        first_available_worm = radio_button_input.attr('id')
                    }
                    selected_first_worm = false;
                    available_worm++;
                }
            }
        };


        if (available_mouse === 0) {
            document.getElementById('mouse').insertAdjacentHTML('afterend','<h5 class="alert" >No homolog transcript found for this species.<br><br></h5>');
        }

        if (available_worm === 0) {
            document.getElementById('worm').insertAdjacentHTML('afterend','<h5 class="alert" >No homolog transcript found for this species.<br><br></h5>');
        }

        if($(this).attr('id').startsWith('human')) {

            if (first_available_mouse !== -1) {
                document.getElementById(first_available_mouse).checked = true;
            }

            if (first_available_worm !== -1) {
                document.getElementById(first_available_worm).checked = true;
            }
        }

        $("#startAnalyse").removeClass("disabled");
    });
    
});
// setTimeout(function() {
//    $("form :input").trigger('change');
// }, 100);
</script>


<?php require("footer.php"); ?>
