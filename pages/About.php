<!DOCTYPE html>
<?php require("../header.php"); ?>

<div class="container pageBox white z-depth-2">

	<div class="row"><br>
	    <div class="col s12 l12 m12"><img src="../files/img/convart_black.png" alt="ConVarT" class="homePageLogo center"></div>
	</div>
	<div class="row specialTextBox">
	    <span class="flow-text"><br>
			The conserved clinical variation visualization tool (ConVarT) is an online search engine for matching variants (MatchVars) between humans and mice, C. elegans developed by the Kaplan Lab. ConVarT integrated amino acid substitutions associated with diseases and non-clinically significant amino acid substitutions from ClinVar, COSMIC and gnomAD, dbSNP databases for humans, and amino acid substitutions from Mutagenetix for mouse and Wormbase for C. elegans, allowing easy access to collections of phenotypic, pathogenic, bening MatchVars and non-MatchVars between humans and mice, C. elegans for the model organism research and clinical scientist community. Protein domains and PTMs (post-translational modifications) are integrated into the corresponding positions of amino acids on the human protein sequences.
	        <br><br>All genes consisting of all types of amino acid substitutions from ClinVar (329,338 amino acid variations), COSMIC (6,842,627 amino acid variations) and gnomAD (16,179,380 amino acid variations), dbSNP (1,086,546 amino acid variations), Mutagenetix (374,555 variants), Wormbase (406,844 variants) databases have been extracted, and a series of multiple sequence alignments of ortholog genes between Human, Mouse, and C. elegans were conducted, with integration of all amino acid substitutions and Pfam protein domains into the corresponding positions. The data visualization tool is freely available for the benefit of the scientific community.
	        <br><br>
	        <b>Here is the outline of ConVarT workflow:</b>
			<div class="material-placeholder"><img class="materialboxed " width="98%" src="../files/img/pipelineFigure.png" data-caption="Pipeline Figure"></div>
			
			<br>
			<h4><b>Why ConVarT might be useful?</b></h4>
			It is presently challenging to determine the biological effects of the ever-increasing number of genetic variants. Apparently, the currently available functional inference computational tools are not sufficient to predict the impacts of missense variants, raising the issue of understanding the large scale of human genetic variations. Ease of knock-in with Cas9/CRISPR facilitates the  single amino acid substitutions at any position, thus opening up a novel avenue to experimentally assess the functional effects of human genetic variants using model organisms including Mouse, Zebrafish, nematode <i>C. elegans</i> and Fruit fly Drosophila. 
			<br>However, the available databases can not easily provide rapid visualization of human genetic variants in the genome of model organisms.
			ConVarT enables researchers scientists to copy and paste their own protein sequence to view human genetic variations and PTMs in the respective amino acid positions, followed by the incorporation of Pfam protein domains, extending ConVarT's use to other model systems. Briefly, ConVarT provides easy access to all conserved human genetic variants and PTMs on protein-encoding regions. The database would be useful for the biomedical and model organism research communities.

			<br><br>
			<h4><b>How to use ConVarT?</b></h4>
			There are two ways to make a search on this site. You can simply write the gene identifiers you searched for such as gene name, synonyms or species-specific gene-identifiers like MGI ID, FlyBase ID ,etc. or you can use rs number in the search box on the ConVarT. More detailed information and the list of identifiers that can be used as an input is accessible on the <a href="Faq.php" target="_blank">FAQs page</a>. 
			<br><br>One important innovation of ConVarT is that you can copy and paste a protein sequence of a gene you're looking for into the search box on ConVarT page. Then, the protein sequence you have searched for will be aligned with the protein sequence of human homolog with the integration of human genetic variants, and together with PTMs (post-translational modifications) and Pfam protein domains. This novel feature enables the expansion of ConVarT use for other species.

			<br><br>
			<b>Shown is the representative pipeline of protein sequence search:</b> 
			<div class="material-placeholder"><img class="materialboxed " width="48%" src="../files/img/searchScreen.png" data-caption="Search screen in ConVarT"></div>
			<br>To become more familiar with ConVarT, you can also watch our <b>Tutorial Videos</b> on the <a href="Help.php">Help page</a>.
			
			<br><br>
			<h4><b>Interactive Charts</b></h4> Interactive charts are critical parts of ConVarT. The table below shows the number of transcript IDs (more than 100 thousand), variants (more than 20 million) and PTMs (more than 380 thousand). Interactive charts are generated for each transcript with the categorization of human genetic variants, meaning that a total of over 100,000 interactive charts were created on the ConVarT project. In addition, the same methodology is applied for PTMs, generating a total of over 20,000 interactive charts with the categorization of types of PTMs.  
			<br>For ClinVar, there is a number of different data sets that can be grouped into different categorization. For example, human genetic variations data coming from ClinVar can be grouped into 5 different sub-categories namely "Pathogenic", "Benign", "VUS", "Conflicts" and "Others". Human genetic variations for each gene are classified into these five sub-categories and visualized using interactive charts. Furthermore, PTMs (post-translational modifications) are also integrated into ConVarT and are categorized into types of post-translational modifications such as "Methylation", "Acetylation", "Ubiquitination" and others using interactive charts. 
			<br> Importantly, each interactive chart is downloadable as ".png" or ".svg" format for publication or presentation. Also, the number of records in each category can be accessed by mousing over the segments of interactive charts. In addition, some sub-categories you are not interested in can be eliminated by clicking the names of the sub-categories.
			
			<br><br>
			<table class="special_table">
				<tr>
					<th>Source <i class="material-icons right">filter_list</i></th>
					<th># Unique Transcript ID <i class="material-icons right">filter_list</i></th>
					<th># Records in the Table <i class="material-icons right">filter_list</i></th>
					<th>Last Update <i class="material-icons right">filter_list</i></th>
				</tr>
				<tr>
					<td>COSMIC</td>
					<td>29,247</td>
					<td>6,842,627</td>
					<td>29 June, 2019</td>
				</tr>
				<tr>
					<td>gnomAD</td>
					<td>43,352</td>
					<td>16,179,380</td>
					<td>29 June, 2019</td>
				</tr>
				<tr>
					<td>ClinVar</td>
					<td>35,618 </td>
					<td>2,280,300 </td>
					<td>12 November, 2021</td>
				</tr>
				<tr>
					<td>PhosphoSitePlus</td>
					<td>21,282</td>
					<td>383,095</td>
					<td>29 June, 2019</td>
				</tr>
				<tr>
					<td>WormBase</td>
					<td>30,744 </td>
					<td>443,523 </td>
					<td>12 November, 2021</td>
				</tr>
				<tr>
					<td>Mutagenetix </td>
					<td>57,208  </td>
					<td>618,501 </td>
					<td>12 November, 2021</td>
				</tr>
				<tr>
                                        <td>APF </td>
                                        <td>8,474  </td>
                                        <td>21,186 </td>
                                        <td>12 November, 2021</td>
                                </tr>
				<tr>
					<td>TOPMed </td>
					<td>95,223 </td>
					<td>39,891,272 </td>
					<td>12 November, 2021</td>
				</tr>
			</table>

			<br><br><b>Shown are the representative images of interactive charts for each data set: </b>
			<br><br>
			ClinVar
			<div class="material-placeholder"><img class="materialboxed " width="98%" src="../files/img/InteractiveChartClinVar.png" data-caption="Dist. of ClinVar Data for each gene"></div>
			COSMIC
			<div class="material-placeholder"><img class="materialboxed " width="98%" src="../files/img/InteractiveChartCOSMIC.png" data-caption="Dist. of COSMIC Data for each gene"></div>
			gnomAD
			<div class="material-placeholder"><img class="materialboxed " width="98%" src="../files/img/InteractiveChartgnomAD.png" data-caption="Dist. of gnomAD Data for each gene"></div>
			PTMs
			<div class="material-placeholder"><img class="materialboxed " width="98%" src="../files/img/InteractiveChartPTM.png" data-caption="Dist. of PTMs Data for each gene"></div>
			

			<br><br>
			<h4><b>Table Features</b></h4>
			ConVarT has incorporated various resources and brought a number of different novelties together. We always ensure, however, that users can also visit the source of the data from where we acquire it. Therefore, we provide a link that is represented as blue to each record for each data set in the tables. 
			<br> Each data set coming from ClinVar, gnomAD, COSMIC, PTMs, Pfam protein domains and disease-associated genes from DisGeNET are represented in the separate tables and then our search feature enables users to quickly search within the table. Furthermore, users can sort the table based on the column categorization. 
			<video class="responsive-video" controls> <source src="../files/img/table.mp4" type="video/mp4"> </video>

			<br><br>
			<h4><b>Browse</b></h4>
			If you are not interested in a specific gene or variant, you can inspect the <a href="DiseaseStatistics.php">Disease</a>, 
			<a href="ClinVarStatistics.php">ClinVar</a>, <a href="PTM_gnomAD_COSMIC.php">PTM, gnomAD and COSMIC</a> or <a href="ConservationStats.php"> Conservation Score</a> and the 
			<a href="Downloads.php">Downloads</a> page from the <b>Explore</b> menu.  
			
			<br><br>
			<h4><b>Help develop the ConVarT</b></h4>
			To contribute to the development of ConVarT, you can suggest the inclusion of databases, resources or anything that can be useful to the community. Please, feel free to contact us through our <a href="Contact.php">Contact</a> page.

			<br><br>
			<h4><b>Open Source</b></h4>
			Open source is critical to disseminate the information. ConVarT is ,therefore, an open source, free web-based tool, and coding and scripts used to generate all the information and the data are freely available. Scripts and the web-based tool can be accessed through <a href="https://github.com/thekaplanlab" target="_blank">our GitHub repository</a>. Also, you can directly download the data from the <a href="Downloads.php">Downloads</a> page. 
			
			<br><br>
			<h4><b>Archiving Old Versions</b></h4>   
			ConVarT currently is in the first version. We are planning to archive old versions of ConVarT in the future.

			<br><br>
			<h4><b>API</b></h4>        
			We are currently working on API system.     
			
	        <br><br>
	    </span>

	    <hr><br><br>

	    <div class="col s12 m12 l3"><span class="credits-text"><b>Principal Investigators</b> <br> Oktay I. Kaplan <br> Sebiha Cevik</span></div>
	    <div class="col s12 m12 l3"><span class="credits-text"><b>Data Production Team </b> <br> Mustafa S. Pir<br> Halil I. Bilgin<br> Furkan M. Torun</span></div>
	    <div class="col s12 m12 l3"><span class="credits-text"><b>Web Site Team</b> <br> Ahmet Sayıcı <br> Fatih Coskun <br> Halil  I. Bilgin<br>Furkan M. Torun </span></div>
	    <div class="col s12 m12 l3"><span class="credits-text"><b>Experimental Team </b> <br> Mustafa S. Pir<br> Pei Zhao (SunyBiotech Co.,Ltd)<br> Yahong Kang (SunyBiotech Co.,Ltd)</span></div>
	    
		<div class="col s12 m12 l3"><span class="credits-text"><br><b>Databases and Tools</b> <br> 
			<a href="https://www.ncbi.nlm.nih.gov/clinvar/" target="_blank"> ClinVar</a> <br> 
			<a href="https://gnomad.broadinstitute.org/" target="_blank">gnomAD</a> <br>
			<a href="https://cancer.sanger.ac.uk/cosmic" target="_blank">COSMIC</a> <br> 
			<a href="https://www.phosphosite.org/" target="_blank">PhosphoSitePlus</a> <br>
			<a href="https://zfin.org/" target="_blank">ZFIN</a> <br>
			<a href="https://blast.ncbi.nlm.nih.gov/Blast.cgi?PAGE=Proteins" target="_blank">BLASTp</a>  
		</span></div>
		<div class="col s12 m12 l3"><span class="credits-text"><br><br> 
			<a href="https://www.flyrnai.org/cgi-bin/DRSC_orthologs.pl" target="_blank">DIOPT</a> <br>
			<a href="https://www.ensembl.org/" target="_blank">Ensembl</a> <br>
			<a href="https://ncbi.nlm.nih.gov" target="_blank">NCBI</a> <br>
			<a href="http://www.informatics.jax.org/" target="_blank">MGI</a> <br>
			<a href="http://www.disgenet.org/" target="_blank">DisGeNET</a> <br>
			<a href="https://pfam.xfam.org/" target="_blank">Pfam</a>
		</span></div>
		<div class="col s12 m12 l3"><span class="credits-text"><br><br> 
			<a href="https://www.uniprot.org/" target="_blank">UniProt</a> <br>
			<a href="ftp://ftp.ebi.ac.uk/pub/databases/Pfam/Tools/" target="_blank">Pfam Scan Script</a>  <br>
			<a href="https://www.genome.jp/tools/clustalw/" target="_blank">ClustalW</a> <br>
			<a href="https://apexcharts.com/" target="_blank">ApexChart JS Library</a>  
			<a href="https://materializecss.com/" target="_blank">Materialize  CSS Framework</a> <br>
			<a href="https://meshb.nlm.nih.gov/" target="_blank">MeSH Browser</a>  <br>
		</span></div>
		<div class="col s12 m12 l3"><span class="credits-text"><br><br> 
			<a href="https://datatables.net/" target="_blank">DataTables jQuery Plug-in</a> <br>
			<a href="https://www.ebi.ac.uk/Tools/psa/emboss_needle/" target="_blank">EMBOSS Needle</a> <br>
			<a href="https://github.com/jrderuiter/pybiomart" target="_blank">PyBiomart</a> <br>
		</span></div>

	</div><br>

</div><br>

<?php require("../footer.php"); ?>
