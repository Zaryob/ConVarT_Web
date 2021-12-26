<?php require_once('functions.php'); ?>
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
    <link rel="icon" href="<?= $GLOBALS['base_url']; ?>files/img/convart_black.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?= $GLOBALS['base_url']; ?>files/css/style.css" media="screen" />
    <link type="text/css" rel="stylesheet" href="<?= $GLOBALS['base_url']; ?>files/css/CurrentProject.css?id=v4" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8XPN6CS5D"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-M8XPN6CS5D');
    </script>
    <!--    
     <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(53359828, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/53359828" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
 -->
</head>

<body id="CurrentProject">
    <?php if (!defined('IGNORE_HEADER')) : ?>
        <!-- Header -->
        <ul id="info-menu" class="dropdown-content">
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/About.php">About</a></li>
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/Help.php">Help</a></li>
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/Faq.php">FAQs</a></li>
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/Database.php">Database Schema</a></li>
            <li><a onclick="Materialize.toast('Coming Soon!', 4000)">API</a></li>
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/Contact.php">Contact</a></li>
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/Terms.php">Terms</a></li>
        </ul>

        <ul id="explore-menu" class="dropdown-content">
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/DiseaseStatistics.php">Disease Statistics</a></li>
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/ClinVarStatistics.php">ClinVar Statistics</a></li>
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/PTM_gnomAD_COSMIC.php">PTM, gnomAD and COSMIC Statistics</a></li>
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/ClinVarGeneHomology.php">ClinVar and Gene Homology</a></li>
            <li><a href="<?= $GLOBALS['base_url']; ?>pages/Downloads.php">Download Data</a></li>
        </ul>

        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper sitemenu">
                    <a href="<?= $GLOBALS['base_url']; ?>" class="brand-logo sitelogo"><img src="<?= $GLOBALS['base_url']; ?>files/img/convart.png" class="sitelogoimg"></a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse white-text"><i class="mobilbuton material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down menulinks">
                        <li><a href="<?= $GLOBALS['base_url']; ?>">Home</a></li>
                        <li><a class="dropdown-button" href="#!" data-activates="info-menu">Info<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a class="dropdown-button" href="#!" data-activates="explore-menu">Explore<i class="material-icons right">arrow_drop_down</i></a></li>
						<li><a href="<?= $GLOBALS['base_url']; ?>pages/Citation.php" data-activates="citation">Cite ConVarT</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/Submit.php">Submit</a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/About.php">About</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/Help.php">Help</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/Faq.php">FAQs</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/Citation.php">How to cite ConVarT</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/Experiments.php">Experimental Validation</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/Database.php">Database Schema</a></li>
                        <li><a onclick="Materialize.toast('Coming Soon!', 4000)">API</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/Contact.php">Contact</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/Terms.php">Terms</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/DiseaseStatistics.php">Disease Statistics</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/ClinVarStatistics.php">ClinVar Statistics</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/PTM_gnomAD_COSMIC.php">PTM, gnomAD and COSMIC Statistics</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/ClinVarGeneHomology.php">ClinVar and Gene Homology</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/Downloads.php">Download Data</a></li>
                        <li><a href="<?= $GLOBALS['base_url']; ?>pages/Submit.php">Submit</a></li>
                    </ul>
                </div>
            </nav>
        </div> <!-- end of header -->



        <!-- Search Field -->
        <div class="search_field row">
            <div class="col s12 m12 l3"></div>
            <div class="col s12 m12 l6">
                <center>
                    <form action="<?= $GLOBALS['base_url']; ?>" method="get" name="headerSearching" autocomplete="off">
                        <div class="col s1 m1 l1"></div>
                        <div class="col s3 m3 l3">
                            <div class="input-field col s12 searchingOptions"><select class="searchingOption" id="searchingOption">
                                    <option value="GeneSearch">Gene Search</option>
                                    <option value="SpemudSearch" selected>MatchVar</option>
                                    <option value="DiseaseSearch">Disease Search</option>
                                </select></div>
                        </div>
                        <div class="col s6 m6 l6"><input name="searchText" id="searchTerm" type="text" class="searchbox" placeholder="Search a gene, GeneID, Ensembl ID or protein ID" required></div>
                        <div class="col s1 m1 l1"><button class="btn waves-effect waves-light waves-white sb" type="submit"><i class="material-icons">search</i></button></div>
                        <div class="col s1 m1 l1"></div>
                    </form>
                </center>
            </div>
        </div>
        <div class="col s12 m12 l3"></div>
        </div> <!-- end of search field -->
    <?php endif; ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="<?= $GLOBALS['base_url']; ?>files/js/js.js"></script>
    <script src="<?= $GLOBALS['base_url']; ?>files/js/CurrentProject.js"></script>
    <script type="text/javascript">
        /*function searchingOptions() {
                searchingOption = document.getElementById("searchingOption").value;
                if (searchingOption = "DiseaseSearch") {searchingPage="diseases.php"} else {searchingPage="preResults.php";}
            } */
        $("#searchingOption").change(function() {
            searchingOption = document.getElementById("searchingOption").value;
            if (searchingOption == "DiseaseSearch") {
                placeholder = "Search a disease name"
            }
            if (searchingOption == "SpemudSearch") {
                placeholder = "Search a gene, GeneID, Ensembl ID or protein ID"
            }
            if (searchingOption == "GeneSearch") {
                placeholder = "Search a gene, GeneID, Ensembl ID or protein ID"
            }

            $('#searchTerm').attr("placeholder", placeholder);
        });
        $("form[name=headerSearching]").submit(function(e) {
            e.preventDefault();
            searchingOption = document.getElementById("searchingOption").value;
            if (searchingOption == "DiseaseSearch") {
                searchingPage = "disease";
                placeholder = "Search a disease name"
            }
            if (searchingOption == "SpemudSearch") {
                searchingPage = "search";
                placeholder = "Search a gene, GeneID, Ensembl ID or protein ID"
            }
            if (searchingOption == "GeneSearch") {
                searchingPage = "search";
                placeholder = "Search a gene, GeneID, Ensembl ID or protein ID"
            }

            if (searchingOption == "SpemudSearch") {
                window.location.href = $(this).prop('action') + searchingPage + '?spemud=' + encodeURIComponent($('#searchTerm').val());
            } else {
                window.location.href = $(this).prop('action') + searchingPage + '?q=' + encodeURIComponent($('#searchTerm').val());
            }
            return false;
        });
    </script>