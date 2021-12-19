<?php require_once("config.php"); ?>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ConVarT</title>
    <meta name="description" content="ConVarT (Conserved clinical Variation visualization Tool) is a specialized tool that facilitates consistent and rapid visualization of cross-species conservation of human genetic variants and post-translational modifications (PTMs) with minimal effort.">
    <meta name="title" content="ConVarT">
    <meta name="keywords" content="ConVarT" />
    <meta name="author" content="ConVarT">
    <meta name="copyright" content="ConVarT">
    <link rel="icon" href="files/img/convart_black.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="files/css/style.css" media="screen" />
    <link type="text/css" rel="stylesheet" href="files/css/CurrentProject.css?id=<?= rand(); ?>" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        html {
            overflow: scroll;
            overflow-x: hidden;
            -ms-overflow-style: none;
            /* Internet Explorer 10+ */
            scrollbar-width: none;
            /* Firefox */
            min-height: 100vh;
            min-width: 100vw;
        }

        ::-webkit-scrollbar {
            width: 0px;
            /* Remove scrollbar space */
            background: transparent;
            /* Optional: just make scrollbar invisible */
            display: none;
        }

        /* Optional: show position indicator in red */
        ::-webkit-scrollbar-thumb {
            background: #FF0000;
        }

        @media only screen and (max-width: 1000px) {
            #last_submissions_frame {
                display: none;
            }
        }

        input {
            padding: 0 16px;
        }

        input,
        input::-webkit-input-placeholder {
            font-size: 16px!important;
        }
    </style>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        ym(53359828, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true
        });
    </script> <noscript>
        <div><img src="https://mc.yandex.ru/watch/53359828" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
</head>

<body id="CurrentProjectHomePage">
    <div style="min-height: calc(100vh - 90px);overflow:hidden;display: block;">
        <!-- Header -->
        <ul id="info-menu" class="dropdown-content">
            <li><a href="pages/About.php">About</a></li>
            <li><a href="pages/Help.php">Help</a></li>
            <li><a href="pages/Faq.php">FAQs</a></li>
            <li><a href="pages/Database.php">Database Schema</a></li>
            <li><a onclick="Materialize.toast('Coming Soon!', 4000)">API</a></li>
            <li><a href="pages/Contact.php">Contact</a></li>
            <li><a href="pages/Terms.php">Terms</a></li>
        </ul>

        <ul id="explore-menu" class="dropdown-content">
            <li><a href="pages/DiseaseStatistics.php">Disease Statistics</a></li>
            <li><a href="pages/ClinVarStatistics.php">ClinVar Statistics</a></li>
            <li><a href="pages/PTM_gnomAD_COSMIC.php">PTM, gnomAD and COSMIC Statistics</a></li>
            <li><a href="pages/ClinVarGeneHomology.php">ClinVar and Gene Homology</a></li>
            <li><a href="pages/Downloads.php">Download Data</a></li>
        </ul>

        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper sitemenu">
                    <a href="https://convart.org" class="brand-logo sitelogo"><img src="files/img/convart.png" class="sitelogoimg"></a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse white-text"><i class="mobilbuton material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down menulinks">
                        <li><a href="index.php">Home</a></li>
                        <li><a class="dropdown-button" href="#!" data-activates="info-menu">Info<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a class="dropdown-button" href="#!" data-activates="explore-menu">Explore<i class="material-icons right">arrow_drop_down</i></a></li>
						<li><a href="<?= $GLOBALS['base_url']; ?>pages/Citation.php" data-activates="citation">Cite ConVarT</a></li>
                        <li><a href="pages/Submit.php">Submit</a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="pages/About.php">About</a></li>
                        <li><a href="pages/Help.php">Help</a></li>
                        <li><a href="pages/Faq.php">FAQs</a></li>
                        <li><a href="pages/Citation.php">How to cite ConVarT</a></li>
                        <li><a href="pages/Experiments.php">Experimental Validation</a></li>
                        <li><a href="pages/Database.php">Database Schema</a></li>
                        <li><a onclick="Materialize.toast('Coming Soon!', 4000)">API</a></li>
                        <li><a href="pages/Contact.php">Contact</a></li>
                        <li><a href="pages/Terms.php">Terms</a></li>
                        <li><a href="pages/DiseaseStatistics.php">Disease Statistics</a></li>
                        <li><a href="pages/ClinVarStatistics.php">ClinVar Statistics</a></li>
                        <li><a href="pages/PTM_gnomAD_COSMIC.php">PTM, gnomAD and COSMIC Statistics</a></li>
                        <li><a href="pages/ClinVarGeneHomology.php">ClinVar and Gene Homology</a></li>
                        <li><a href="pages/Downloads.php">Download Data</a></li>
                        <li><a href="pages/Submit.php">Submit</a></li>
                    </ul>
                </div>
            </nav>
        </div> <!-- end of header -->

        <!-- ConVarT -->

        <div style="display:block;position:absolute;z-index:1;">
            <iframe id=last_submissions_frame src="last_submissions.php" frameborder="0" allowtransparency="no" scrolling="yes" style="width:280px; top:0; height: calc(100% - 180px); position:fixed; right:1vh; margin: 75px 0 0 0; padding:0"></iframe>
        </div>
        <div class="container pageBox home">

            <div class="row"><br>
                <div class="col s12 l12 m12"><img src="./files/img/convart.png" alt="Current Project" class="homePageLogo center"></div>
            </div>
            <div class="row">

                <ul class="tabs searching-tabs" style='margin-top:4vh;'>
                    <li class="tab searching-tab col s0 m0 l3" style="z-index: 0;"></li>
                    <li class="tab searching-tab col s4 m4 l2"><a class="active" href="#spemud-search">MatchVar</a></li>
                    <li class="tab searching-tab col s4 m4 l2"><a href="#gene-search">Gene Search</a></li>
                    <li class="tab searching-tab col s4 m4 l2"><a href="#disease-search">Disease Search</a></li>
                    <li class="tab searching-tab col s0 m0 l3" style="z-index: 0;"></li>
                </ul>

            </div>

            <!-- Spemud search -->
            <div id="spemud-search" class="col s12">
                <!-- <br><p class="center-align"><b>Select your proteins and visualize them with variants:</b></p> -->
                <form action="<?= $GLOBALS['base_url']; ?>search" method="get" class="spemudForm" autocomplete="off">
                    <div class="row">
                        <div class="col s12 m12 l3"></div>
                        <div class="col s12 m12 l6">
                            <input name="spemud" id="spemud" type="text" class="searchbox" placeholder="Search a gene, GeneID, Ensembl ID or protein number" required>
                        </div>
                        <div class="col s12 m12 l3"></div>
                    </div>
                    <div class="row">
                        <div class="col s0 m0 l3"></div>
                        <div class="col s12 m12 l6 center-align">
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>search?spemud=HGNC:10537">HGNC:10537</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>search?spemud=rs191391414">rs191391414</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>search?spemud=Farslb">Farslb</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>search?spemud=MGI:108087">MGI:108087</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>search?spemud=WBGene00003373">WBGene00003373</a>
                            <a href="#identifier_types_help" class="modal-trigger tooltipped" data-position="right" data-delay="10" data-tooltip="Explore the catalog of the gene identifiers you can search"><i class="material-icons white-text text-darken-1">help</i></a>
                            </p>
                        </div>
                        <div class="col s0 m0 l3"> </div>
                        <div class="col s12 m12 l12">
                            <center>
                                <button class="btn waves-effect waves-light waves-white sb seqSearchButton" type="submit"><i class="material-icons">search</i>ANALYSE</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>


            <!-- gene search -->
            <div id="gene-search" class="col s12">
                <form action="<?= $GLOBALS['base_url']; ?>search" method="get" class="mainForm" autocomplete="off">
                    <div class="row">
                        <div class="col s1 m1 l3"></div>
                        <div class="col s9 m9 l5">
                            <input name="searchText" id="searchTerm" type="text" class="searchbox" placeholder="Search a gene, GeneID, Ensembl ID or protein number" required>
                        </div>
                        <div class="col s1 m1 l1"><button style="width: 40px; height: 35px;" class="btn waves-effect waves-light waves-white sb" type="submit"><i class="material-icons">search</i></button></div>
                        <div class="col s1 m1 l2"></div>
                    </div>
                    <div class="row">
                        <div class="col s0 m0 l3"> </div>
                        <div class="col s12 m12 l6 center-align">
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>msa?id=NP_006504.2">HGNC:10537</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>msa?id=NP_002100">rs191391414</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>msa?id=NP_001004252">Farslb</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>msa?id=NP_032240">MGI:108087</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>msa?id=NP_001007769">ZDB-GENE-021206-2</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>msa?id=NP_524366">FBgn0026634</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>msa?id=NP_001005694.1">XB-GENE-1000989</a>,
                            <a class="home_link" href="<?= $GLOBALS['base_url']; ?>msa?id=NP_499796.2">WBGene00003373</a>
                            <a href="#identifier_types_help" class="modal-trigger tooltipped" data-position="right" data-delay="10" data-tooltip="Explore the catalog of the gene identifiers you can search"><i class="material-icons white-text text-darken-1">help</i></a>
                            </p>
                        </div>
                        <div class="col s0 m0 l3"> </div>
                    </div>
                </form>


                <!-- Sequence Search in gene search -->
                <h4 class="center-align" style="text-align:center; margin-top:0.8em; margin-bottom:0.5em; padding: 0">OR</h4>
                <div class="row">
                    <form action="<?= $GLOBALS['base_url']; ?>blast_query.php" method="post" name="seqSearch" autocomplete="off">
                        <div class="col l12 m12 s12">
                            <center>
                                <textarea id="sequenceArea" name="sequence" class="materialize-textarea sequenceArea" placeholder=">NP_592921.1 putative AP-2 adaptor complex subunit Apm4 [S. pombe]&#x0a;MISGLFIFNLKGDTLICKTFRHDLKKSVTEIFRVAILTNTDYRHPIVSIGSSTYIYTKHEDLYVVAITKGNPNVMIVLEFLESLIQDLTHYFGKLNENTVKDNVSFIFELLDEMIDYGIIQTTEPDALARSVSITAVKKKGNALSLKRSHSSQLAHTTSSEIPGSVPWRRAGIKYRKNSIYIDIVERMNLLISSTGNVLRSDVSGVVKMRAMLSGMPECQFGLNDKLDFKLKQSESKSKSNNSRNPSSVNGGFVILEDCQFHQCVRLPEFENEHRITFIPPDGEVELMSYRSHENINIPFRIVPIVEQLSKQKIIYRISIRADYPHKLSSSLNFRIPVPTNVVKANPRVNRGKAGYEPSENIINWKIPRFLGETELIFYAEVELSNTTNQQIWAKPPISLDFNILMFTSSGLHVQYLRVSEPSNSKYKSIKWVRYSTRAGTCEIRI" required></textarea>
                                <div class="g-recaptcha" data-sitekey="6LdZMaMUAAAAAAJdY4SpK0vOHHFnf-Ff5iVOp1K4"></div>
                                <div class="row"><button class="btn waves-effect waves-light waves-white sb seqSearchButton" type="submit"><i class="material-icons">search</i>SEARCH</button>
                            </center>
                        </div>
                    </form>
                    <center>
                        <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large" data-text="Here is ConVarT (Conserved clinical Variation visualization Tool)! Check it out on " data-url="https://www.convart.org/" data-hashtags=" ConVarT,ModelOrganismCommunity" data-show-count="true" data-via="CiliopathyLab" data-lang="en"> Tweet </a>
                    </center>
                    <!--<div class="chip"> Our work will be presented at <a href="eshg2019">#ESHG2019</a> on 17th June. <i class="close material-icons">close</i> </div>
                        <a href="<?= $GLOBALS['base_url']; ?>seqSearch.php" class="btn waves-effect waves-light waves-blue white blue-text center seqSearchButtonHome"><i class="material-icons left">format_align_center</i> Search with protein sequence</a><br> -->
                </div>

            </div>

            <!-- disease search -->
            <div id="disease-search" class="col s12">
                <div class="row">
                    <form action="<?= $GLOBALS['base_url']; ?>disease" method="get" class="mainForm" autocomplete="off">
                        <div class="col s1 m1 l3"></div>
                        <div class="col s9 m9 l5">
                            <input name="searchText" id="searchTerm" type="text" class="searchbox" placeholder="Search a disease name" required>
                        </div>
                        <div class="col s1 m1 l1"><button style="width: 40px; height: 35px;" class="btn waves-effect waves-light waves-white sb" type="submit"><i class="material-icons">search</i></button></div>
                        <div class="col s1 m1 l2"></div>
                        <br>
                    </form>
                    <div class="col s12 m12 l12 center-align" style='margin-top: 18px'>
                        <a class="home_link" href="diseases.php?q=Joubert+Syndrome">Joubert Syndrome</a>, <a class="home_link" href="diseases.php?q=Alzheimer">Alzheimer</a>, <a class="home_link" href="diseases.php?q=Acute+Myeloid+Leukemia">Acute Myeloid Leukemia</a>
                    </div>
                </div>
            </div>
        </div>


    </div> <!-- ConVarT -->

    <!-- Human Homolog Modal -->
    <div id="findHumanHomolog" class="modal modal-fixed-footer">
        <div class="row">
            <div class="modal-content" style="padding-left: 0; padding-right: 0">
                <h4>Find human homolog of your gene</h4>
                <iframe src="spemud_helper_flow.php" id="spemud-helper-flow" frameborder="0" width="100%" height="500"></iframe>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat blue white-text">Close</a>
            </div>
        </div>
    </div>


    <!-- Modal Structure -->
    <div id="identifier_types_help" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>List of the Searching Identifiers</h4>
            <p>
                <table class="special_table">
                    <th>Identifier Name</th>
                    <th>Description</th>
                    <tr>
                        <td>NCBI Gene ID</td>
                        <td>NCBI Gene ID (e.g. 6301)</td>
                    </tr>
                    <tr>
                        <td>Gene Symbol</td>
                        <td>Current Gene Symbol (e.g. <i>SARS</i>, <i>sars-1</i>)</td>
                    </tr>
                    <tr>
                        <td>Gene Synonmys</td>
                        <td>Previous Gene Symbols (e.g. <i>SERRS</i>)</td>
                    </tr>
                    <tr>
                        <td>HGNC</td>
                        <td>HUGO Gene Nomenclature Committee (e.g. HGNC:10537)</td>
                    </tr>
                    <tr>
                        <td>ENSEMBL GENE ID</td>
                        <td>ENSEMBL Gene IDs for any specie in our database <br> (e.g. ENSG00000031698, ENSMUSG00000068739, ENSRNOG00000020255,<br> ENSDARG00000008237, ENSPTRG00000001043, ENSMMUG00000021837)</td>
                    </tr>
                    <tr>
                        <td>RS Number</td>
                        <td>Reference SNP ID (e.g. rs191391414)</td>
                    </tr>
                    <tr>
                        <td>Protein Acc. Number</td>
                        <td>NCBI Protein Accession Numbers (e.g. NP_006504.2, XP_006233198.1)</td>
                    </tr>
                    <tr>
                        <td>MGI ID</td>
                        <td>MGI-Mouse Genome Informatics (e.g. MGI:102809)</td>
                    </tr>
                    <tr>
                        <td>ZFIN ID</td>
                        <td>ZFIN The Zebrafish Information Network (e.g. ZDB-GENE-040831-1)</td>
                    </tr>
                    <tr>
                        <td>FB Gene ID</td>
                        <td>FlyBase Gene ID (e.g. FBgn0031497)</td>
                    </tr>
                    <tr>
                        <td>WB Gene ID</td>
                        <td>WormBase Gene ID(e.g. WBGene00005663)</td>
                    </tr>
                </table>
            </p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat blue white-text">Agree</a>
        </div>
    </div>
    </div>

    <footer class="page-footer fixed-bottom" style="height: 90px;">
            <div class="center">
				<a class="grey-text text-lighten-3" href="#">ConVarT v.1.0</a>
			</div>
			<div class="center">
                <a class="grey-text text-lighten-3" href="#">Developed By </a>
                <a class="grey-text text-lighten-3" href="https://www.linkedin.com/in/asayici">A.Sayıcı,</a>
                <a class="grey-text text-lighten-3" href="https://www.linkedin.com/in/fcoskunnn">F.Coskun,</a>
                <a class="grey-text text-lighten-3" href="https://www.linkedin.com/in/halil-bilgin-85217056/">H.Bilgin,</a>
                <a class="grey-text text-lighten-3" href="https://www.linkedin.com/in/furkanmtorun/">F.Torun</a>
            </div>
            <div class="center">
                <a class="grey-text text-lighten-3" href="#">Maintained By</a>
                <a class="grey-text text-lighten-3" href="http://kaplanlab.com">The Kaplan Lab</a>
            </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="files/js/js.js"></script>
    <script src="files/js/CurrentProject.js"></script>

    <script type="text/javascript">
        $('.mainForm').submit(function(e) {
            e.preventDefault();
            window.location = $(this).prop('action') + '?q=' + $(this).find('input[type=text]').val();
            return false;
        });
    </script>

    <script>
        window.twttr = (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function(f) {
                t._e.push(f);
            };

            return t;
        }(document, "script", "twitter-wjs"));
    </script>

    <script>
        $(document).ready(function() {
            url = window.location.href;
            key = url.split("?err=")[1]
            if (key == "page_error") {
                Materialize.toast("You used incorrect adress or link. You are redirected to home page.", 5500, "rounded");
            }
            if (key == "verify_robot") {
                Materialize.toast("Please verify you are not robot!", 5500, "rounded");
            }
            if (key == "maintenance") {
                window.location.href = "https://convart.org/503.html";
            }
        });
    </script>

</body>

</html>