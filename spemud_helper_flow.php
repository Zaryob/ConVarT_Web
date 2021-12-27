<?php     
    define('IGNORE_HEADER', 'asd');
    require_once("config.php");
    require("header.php");
?>

<script type="text/javascript">
    function errorView() {
        return '<a href="#" class="btn waves-effect waves-light preResultBtnEmpty">No finding for this gene</a> ';
    }

    function speciesView(transcriptsBySpecies) {
        html = "";
        for(species in transcriptsBySpecies){
            transcripts = transcriptsBySpecies[species];
            if (transcripts.length == 0)
                continue;
            
            html += `<div class="row"> <div class="pageTitle">Results in <i> ${species} </i> <hr></div>`;
            html += transcriptView(transcripts);
            html += `</div>`;
        }

        return html;

    }
    function transcriptView(transcripts) {
        htmlTranscripts = ""
        usedHumanGeneSymbols = {};

        for(transcript of transcripts){
            humanGeneSymbol = transcript['human_homolog']['human_gene_symbol']
            if( humanGeneSymbol in usedHumanGeneSymbols)
                continue
            else
                usedHumanGeneSymbols[humanGeneSymbol] = true;

            htmlTranscript = `<a target="_blank" 
                    href="<?php echo $GLOBALS['base_url']; ?>/current_project/search?spemud=${transcript['human_homolog']['human_gene_symbol']}"
                    class="btn waves-effect waves-light preResultBtn">
                    <i>${transcript['gene_symbol']}</i> (${transcript['ncbi_gene_id']}) |
                     HUMAN  ${transcript['human_homolog']['human_gene_symbol']} 
                     - (${transcript['human_homolog']['human_gene_id']})
                     
                     </a>`;
            
            htmlTranscripts += htmlTranscript;
            
        }

        return htmlTranscripts;
    }

    $(function () {
        $('form').on('submit', function () { 
            $.get('api.php?action=humansearch&query='+$('input[name=query]').val(), function (data) {
                data = JSON.parse(data);
                if(data == null || data.length == 0) {
                    content = errorView();
                    
                } else {
                    content = speciesView(data);
                }

                $('#transcripts').html(content);
                    
            });
            return false;
        })
    });

</script>

<!-- api.php?action=humansearch&query=<GENE SEARCH TEXT> -->
  <!-- Human Homolog Searching Form -->
<div id="human-homolog-search">
<div class="row">
    <form action="API" method="get" class="mainForm" autocomplete="off">
        <div class="col s1 m1 l3"></div>
        <div class="col s9 m9 l5">
            <input name="query" id="query" type="text" class="searchbox" style="background:#1976d2 !important;" placeholder="Search a gene, GeneID, Ensembl ID or protein number" required>
        </div>
        <div class="col s1 m1 l1"><button class="btn waves-effect waves-light waves-white sb" type="submit"><i class="material-icons">search</i></button></div>
        <div class="col s1 m1 l3"></div>
    </form>
</div>
</div>


<hr>

<div class="container pageBox">
<div class="col s12 m12 l12" id="transcripts">
</div>
</div>
