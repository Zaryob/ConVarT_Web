<!DOCTYPE html>
<?php require("../header.php"); ?>

<div class="container">
    <h4 class="blue-text text-darken-1 center"><br>Downloads</h4>
    <span class="flow-text">ConVarT is a free, open-source and user-friendly web-based tool. <br>Therefore, ConVarT enables researchers to download and use the data using the links on the names of the files.</span><br> <br>

	<!-- Download Article Tables -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">view_list</i>Downloads for the Tables in Article</div>
        <div class="collapsible-body">
            <center><input type="text" class="quick_search" id="quick_search_downloads" placeholder="Search in the table "></center>
            <div  style="max-height: 800px !important; overflow-y: scroll !important; overflow-x: scroll !important;">
                <table id="ArticleTable" class="special_table"><tbody>
		            <tr>
		                <th>File Name <i class="material-icons right">filter_list</i></th>
		                <th>File Description <i class="material-icons right">filter_list</i></th>
		                <th>Type <i class="material-icons right">filter_list</i></th>
						<th>Size <i class="material-icons right">filter_list</i></th>
		            </tr>
		            <tr id="noResultQS_downloads" class="grey"><td colspan="6"><span class="flow-text white-text center">NO RESULT FOUND</span></td></tr>
		            
		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_1.xlsx">Table 1</a></td>
		            	<td>Human and Mouse with Orthologous Variants (All)</td>
		            	<td>.XLSX</td>
						<td>17 MB</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_2.xlsx">Table 2</a></td>
		            	<td>Human variants and C. elegans Orthologous Variations (All)</td>
		            	<td>.XLSX</td>
						<td>40 MB</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_3.xlsx">Table 3</a></td>
		            	<td>C. elegans Variants Without Human Equivalent Variants (SIFT and Disease added) </td>
		            	<td>.XLSX</td>
						<td>14 MB</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_4.xlsx">Table 4</a></td>
		            	<td>C. elegans Phenotypic Variants without Human Equivalent Variants (SIFT and Disease added) </td>
		            	<td>.XLSX</td>
						<td>408 KB</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_5.xlsx">Table 5</a></td>
		            	<td>Human Benign Variants and C. elegans Phenotypic Variants</td>
		            	<td>.XLSX</td>
						<td>20 KB</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_6.xlsx">Table 6</a></td>
		            	<td>Human Benign Variants (ClinVar) and C. elegans Unknown Variants </td>
		            	<td>.XLSX</td>
						<td>532 KB</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_7.xlsx">Table 7</a></td>
		            	<td>Human Benign Variants (ClinVar) and Mouse Phenotypic Variants</td>
		            	<td>.XLSX</td>
						<td>128 KB</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_8.xlsx">Table 8</a></td>
		            	<td>Human Benign Variants (ClinVar) and Mouse Unknown Variants</td>
		            	<td>.XLSX</td>
						<td>248 KB</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_9.xlsx">Table 9</a></td>
		            	<td>Human Variants and C. elegans Orthologous Variants (No mouse orthologous genes)</td>
		            	<td>.XLSX</td>
						<td>264 KB</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_10.xlsx">Table 10</a></td>
		            	<td>Human Variants and Mouse Double Orthologous Variants (No C. elegans orthologous genes)</td>
		            	<td>.XLSX</td>
						<td>3.9 MB</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_11.xlsx">Table 11</a></td>
		            	<td>Human Pathogenic variants and C. elegans Phenotypic variants</td>
		            	<td>.XLSX</td>
						<td>164 KB</td>
		            </tr>
					
		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_12.xlsx">Table 12</a></td>
		            	<td>Human Pathogenic variants and C. elegans Unknown variants</td>
		            	<td>.XLSX</td>
						<td>428 KB</td>
		            </tr>
					
		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_13.xlsx">Table 13</a></td>
		            	<td>Human Pathogenic variants and Mouse Phenotypic variants</td>
		            	<td>.XLSX</td>
						<td>32 KB</td>
		            </tr>
					
		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_14.xlsx">Table 14</a></td>
		            	<td>Human Pathogenic variants and  Mouse Unknown variants</td>
		            	<td>.XLSX</td>
						<td>84 KB</td>
		            </tr>
					
		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_15.xlsx">Table 15</a></td>
		            	<td>Mouse Variants Without Human Equivalent Variants (SIFT and Disease added)</td>
		            	<td>.XLSX</td>
						<td>11 MB</td>
		            </tr>
					
		            <tr class="list-download">
		            	<td><a href="../files/tables/Table_16.xlsx">Table 16</a></td>
		            	<td>Mouse Phenotypic Variants  Without Human Equivalent Variants (SIFT and Disease added)</td>
		            	<td>.XLSX</td>
						<td>1.9 MB</td>
		            </tr>
        </tbody></table>
            </div>
        </div>
    <br></div>
	
    <!-- Download DB Tables -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">view_list</i>Downloads for the Tables in ConVarT</div>
        <div class="collapsible-body">
            <center><input type="text" class="quick_search" id="quick_search_downloads" placeholder="Search in the table "></center>
            <div  style="max-height: 800px !important; overflow-y: scroll !important; overflow-x: scroll !important;">
                <table id="DownloadsTable" class="special_table"><tbody>
		            <tr>
		                <th>File Name <i class="material-icons right">filter_list</i></th>
		                <th>File Description <i class="material-icons right">filter_list</i></th>
		                <th>Type <i class="material-icons right">filter_list</i></th>
		                <th>Size <i class="material-icons right">filter_list</i></th>
		                <th>Last Update <i class="material-icons right">filter_list</i></th>
		            </tr>
		            <tr id="noResultQS_downloads" class="grey"><td colspan="6"><span class="flow-text white-text center">NO RESULT FOUND</span></td></tr>
		            
		            <tr class="list-download">
		            	<td><a href="../files/tables/clinvar.csv">ClinVar</a></td>
		            	<td>ClinVar Whole Data</td>
		            	<td>.CSV</td>
		                <td>161 MB</td>
		            	<td>January, 2021</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/gnomad.csv">gnomAD</a></td>
		            	<td>gnomAD (only amino acid subs.) in GRCh37 </td>
		            	<td>.CSV</td>
		                <td>2.1 GB</td>
		            	<td>June, 2019</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/CosmicMutantExport.csv">COSMIC</a></td>
		            	<td>COSMIC Whole Data in GRCh37 </td>
		            	<td>.CSV</td>
		                <td>1.9 GB</td>
		            	<td>May, 2019</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/ptm.csv">PTM</a></td>
		            	<td>PTMs Whole Data in GRCh37 from PhosphoSitePlus</td>
		            	<td>.CSV</td>
		                <td>58 MB</td>
		            	<td>May, 2019</td>
		            </tr>
					
					<tr class="list-download">
		            	<td><a href="../files/tables/mouse_variants.csv">Mouse</a></td>
		            	<td>Mouse Variants</td>
		            	<td>.CSV</td>
		                <td>26 MB</td>
		            	<td>February, 2021</td>
		            </tr>
					
					<tr class="list-download">
		            	<td><a href="../files/tables/celegans_variants.csv">C. Elegans</a></td>
		            	<td>C. Elegans Variants</td>
		            	<td>.CSV</td>
		                <td>58 MB</td>
		            	<td>January, 2021</td>
		            
					</tr>
					
					<tr class="list-download">
		            	<td><a href="../files/tables/topmed.csv">TOPMed</a></td>
		            	<td>Human Variants in TOPMed</td>
		            	<td>.CSV</td>
		                <td>2.91 GB</td>
		            	<td>January, 2021</td>
		            
					</tr>
					
		            <tr class="list-download">
		            	<td><a href="../files/tables/diseases_genes.csv">DisGeNET Table</a></td>
		            	<td>Disease ID and Gene ID table from DisGeNET . </td>
		            	<td>.CSV</td>
		                <td>32 MB</td>
		            	<td>May, 2019</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/disease_info.csv">DisGeNET Info</a></td>
		            	<td>Disease ID and Disease Info from DisGeNET . </td>
		            	<td>.CSV</td>
		                <td>552 KB</td>
		            	<td>May, 2019</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/homology.csv">Homology Curation</a></td>
		            	<td>ConVarT Homology Curation. </td>
		            	<td>.CSV</td>
		                <td>1.3 MB</td>
		            	<td>May, 2019</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/domains.csv">Pfam Domains</a></td>
		            	<td>All of the Pfam protein domains with scores that are generated using human protein transcripts in ConVarT. </td>
		            	<td>.CSV</td>
		                <td>8.4 MB</td>
		            	<td>June, 2019</td>
		            </tr>

		            <tr class="list-download">
		            	<td><a href="../files/tables/domains_desc.csv">Pfam D. Descriptions</a></td>
		            	<td>Descriptions of Pfam domains with their IDs </td>
		            	<td>.CSV</td>
		                <td>985 KB</td>
		            	<td>April, 2019</td>
		            </tr>
        </tbody></table>
            </div>
        </div>
    <br></div>

    <!-- Download Sequences Tables -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">view_list</i>Downloads for the Sequence Files used in ConVarT</div>
        <div class="collapsible-body">
            <center><input type="text" class="quick_search" id="quick_search_downloads2" placeholder="Search in the table "></center>
            <div  style="max-height: 800px !important; overflow-y: scroll !important; overflow-x: scroll !important;">
                <table id="DownloadsTable2" class="special_table"><tbody>
		            <tr>
		                <th>Organism <i class="material-icons right">filter_list</i></th>
		                <th>Organism Name <i class="material-icons right">filter_list</i></th>
		                <th>Taxonomy ID <i class="material-icons right">filter_list</i></th>
		                <th>Source <i class="material-icons right">filter_list</i></th>
		                <th>Type <i class="material-icons right">filter_list</i></th>
		                <th>Info <i class="material-icons right">filter_list</i></th>
		                <th>Link <i class="material-icons right">filter_list</i></th>
		            </tr>
		            <tr id="noResultQS_downloads2" class="grey"><td colspan="7"><span class="flow-text white-text center">NO RESULT FOUND</span></td></tr>
		            
		            <tr class="list-download2">
		            	<td>Human</td>
		            	<td>Homo sapiens</td>
		            	<td>9606</td>
		            	<td>NCBI</td>
		            	<td>Protein</td>
		            	<td>GRCh37.p13</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/405/GCF_000001405.25_GRCh37.p13/GCF_000001405.25_GRCh37.p13_protein.faa.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/405/GCF_000001405.25_GRCh37.p13/GCF_000001405.25_GRCh37.p13_protein.faa.gz</a></td>
		            </tr>

		            <tr class="list-download2">
		            	<td>Human</td>
		            	<td>Homo sapiens</td>
		            	<td>9606</td>
		            	<td>NCBI</td>
		            	<td>Protein</td>
		            	<td>GRCh37</td>
		            	<td><a href="ftp://ftp.ensembl.org/pub/grch37/current/fasta/homo_sapiens/pep/Homo_sapiens.GRCh37.pep.all.fa.gz">ftp://ftp.ensembl.org/pub/grch37/current/fasta/homo_sapiens/pep/Homo_sapiens.GRCh37.pep.all.fa.gz</a></td>
		            </tr>

		            <tr class="list-download2">
		            	<td>Chimp</td>
		            	<td>Pan troglodytes</td>
		            	<td>9598</td>
		            	<td>NCBI</td>
		            	<td>Protein</td>
		            	<td>Clint_PTRv2</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/002/880/755/GCF_002880755.1_Clint_PTRv2/GCF_002880755.1_Clint_PTRv2_protein.faa.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/002/880/755/GCF_002880755.1_Clint_PTRv2/GCF_002880755.1_Clint_PTRv2_protein.faa.gz</a>></td>
		            </tr>

		            <tr class="list-download2">
		            	<td>Macaque</td>
		            	<td>Macaca mulatta</td>
		            	<td>9544</td>
		            	<td>NCBI</td>
		            	<td>Protein</td>
		            	<td>Mmul_8.0.1</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/772/875/GCF_000772875.2_Mmul_8.0.1/GCF_000772875.2_Mmul_8.0.1_protein.faa.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/772/875/GCF_000772875.2_Mmul_8.0.1/GCF_000772875.2_Mmul_8.0.1_protein.faa.gz</a></td>
		            </tr>

		            <tr class="list-download2">
		            	<td>Rat</td>
		            	<td>Rattus norvegicus</td>
		            	<td>10116</td>
		            	<td>NCBI</td>
		            	<td>Protein</td>
		            	<td>Rnor_6.0</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/895/GCF_000001895.5_Rnor_6.0/GCF_000001895.5_Rnor_6.0_protein.faa.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/895/GCF_000001895.5_Rnor_6.0/GCF_000001895.5_Rnor_6.0_protein.faa.gz</a></td>
		            </tr>

		            <tr class="list-download2">
		            	<td>Mouse</td>
		            	<td>Mus musculus</td>
		            	<td>10090</td>
		            	<td>NCBI</td>
		            	<td>Protein</td>
		            	<td>GRCm38.p6</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/635/GCF_000001635.26_GRCm38.p6/GCF_000001635.26_GRCm38.p6_protein.faa.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/635/GCF_000001635.26_GRCm38.p6/GCF_000001635.26_GRCm38.p6_protein.faa.gz</a></td>
		            </tr>

		            <tr class="list-download2">
		            	<td>Zebrafish</td>
		            	<td>Danio rerio</td>
		            	<td>7955</td>
		            	<td>NCBI</td>
		            	<td>Protein</td>
		            	<td>GRCz11</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/035/GCF_000002035.6_GRCz11/GCF_000002035.6_GRCz11_protein.faa.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/035/GCF_000002035.6_GRCz11/GCF_000002035.6_GRCz11_protein.faa.gz</a></td>
		            </tr>

		            <tr class="list-download2">
		            	<td>Frog</td>
		            	<td>Xenopus tropicalis</td>
		            	<td>8364</td>
		            	<td>NCBI</td>
		            	<td>Protein</td>
		            	<td>Xenopus_tropicalis_v9.1</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/004/195/GCF_000004195.3_Xenopus_tropicalis_v9.1/GCF_000004195.3_Xenopus_tropicalis_v9.1_protein.faa.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/004/195/GCF_000004195.3_Xenopus_tropicalis_v9.1/GCF_000004195.3_Xenopus_tropicalis_v9.1_protein.faa.gz</a></td>
		            </tr>

		            <tr class="list-download2">
		            	<td>Fruitfly</td>
		            	<td>Drosophila melanogaster</td>
		            	<td>7227</td>
		            	<td>NCBI</td>
		            	<td>Protein</td>
		            	<td>Release 6 plus ISO1 MT</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/215/GCF_000001215.4_Release_6_plus_ISO1_MT/GCF_000001215.4_Release_6_plus_ISO1_MT_protein.faa.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/215/GCF_000001215.4_Release_6_plus_ISO1_MT/GCF_000001215.4_Release_6_plus_ISO1_MT_protein.faa.gz</a></td>
		            </tr>

		            <tr class="list-download2">
		            	<td>Worm</td>
		            	<td>Caenorhabditis elegans</td>
		            	<td>6239</td>
		            	<td>NCBI</td>
		            	<td>Protein</td>
		            	<td>WBcel235</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/985/GCF_000002985.6_WBcel235/GCF_000002985.6_WBcel235_protein.faa.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/985/GCF_000002985.6_WBcel235/GCF_000002985.6_WBcel235_protein.faa.gz</a></td>
		            </tr>

        		</tbody></table>
            </div>
        </div>
    <br></div>

    <!-- Download GPPFF Tables -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">view_list</i>Downloads for the GPFF Files used in ConVarT</div>
        <div class="collapsible-body">
            <center><input type="text" class="quick_search" id="quick_search_downloads3" placeholder="Search in the table "></center>
            <div  style="max-height: 800px !important; overflow-y: scroll !important; overflow-x: scroll !important;">
                <table id="DownloadsTable3" class="special_table"><tbody>
		            <tr>
		                <th>Organism <i class="material-icons right">filter_list</i></th>
		                <th>Organism Name <i class="material-icons right">filter_list</i></th>
		                <th>Taxonomy ID <i class="material-icons right">filter_list</i></th>
		                <th>Source <i class="material-icons right">filter_list</i></th>
		                <th>Type <i class="material-icons right">filter_list</i></th>
		                <th>Link <i class="material-icons right">filter_list</i></th>
		            </tr>
		            <tr id="noResultQS_downloads3" class="grey"><td colspan="6"><span class="flow-text white-text center">NO RESULT FOUND</span></td></tr>
		            
		            <tr class="list-download3">
		            	<td>Human</td>
		            	<td>Homo sapiens</td>
		            	<td>9606</td>
		            	<td>NCBI</td>
		            	<td>GPFF</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/405/GCF_000001405.25_GRCh37.p13/GCF_000001405.25_GRCh37.p13_protein.gpff.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/405/GCF_000001405.25_GRCh37.p13/GCF_000001405.25_GRCh37.p13_protein.gpff.gz</a></td>
		            </tr>

		            <tr class="list-download3">
		            	<td>Chimp</td>
		            	<td>Pan troglodytes</td>
		            	<td>9598</td>
		            	<td>NCBI</td>
		            	<td>GPFF</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/002/880/755/GCF_002880755.1_Clint_PTRv2/GCF_002880755.1_Clint_PTRv2_protein.gpff.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/002/880/755/GCF_002880755.1_Clint_PTRv2/GCF_002880755.1_Clint_PTRv2_protein.gpff.gz</a></td>
		            </tr>

		            <tr class="list-download3">
		            	<td>Macaque</td>
		            	<td>Macaca mulatta</td>
		            	<td>9544</td>
		            	<td>NCBI</td>
		            	<td>GPFF</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/772/875/GCF_000772875.2_Mmul_8.0.1/GCF_000772875.2_Mmul_8.0.1_protein.gpff.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/772/875/GCF_000772875.2_Mmul_8.0.1/GCF_000772875.2_Mmul_8.0.1_protein.gpff.gz</a></td>
		            </tr>

		            <tr class="list-download3">
		            	<td>Rat</td>
		            	<td>Rattus norvegicus</td>
		            	<td>10116</td>
		            	<td>NCBI</td>
		            	<td>GPFF</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/895/GCF_000001895.5_Rnor_6.0/GCF_000001895.5_Rnor_6.0_protein.gpff.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/895/GCF_000001895.5_Rnor_6.0/GCF_000001895.5_Rnor_6.0_protein.gpff.gz</a></td>
		            </tr>

		            <tr class="list-download3">
		            	<td>Mouse</td>
		            	<td>Mus musculus</td>
		            	<td>10090</td>
		            	<td>NCBI</td>
		            	<td>GPFF</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/635/GCF_000001635.26_GRCm38.p6/GCF_000001635.26_GRCm38.p6_protein.gpff.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/635/GCF_000001635.26_GRCm38.p6/GCF_000001635.26_GRCm38.p6_protein.gpff.gz</a></td>
		            </tr>

		            <tr class="list-download3">
		            	<td>Zebrafish</td>
		            	<td>Danio rerio</td>
		            	<td>7955</td>
		            	<td>NCBI</td>
		            	<td>GPFF</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/035/GCF_000002035.6_GRCz11/GCF_000002035.6_GRCz11_protein.gpff.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/035/GCF_000002035.6_GRCz11/GCF_000002035.6_GRCz11_protein.gpff.gz</a></td>
		            </tr>

		            <tr class="list-download3">
		            	<td>Frog</td>
		            	<td>Xenopus tropicalis</td>
		            	<td>8364</td>
		            	<td>NCBI</td>
		            	<td>GPFF</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/004/195/GCF_000004195.3_Xenopus_tropicalis_v9.1/GCF_000004195.3_Xenopus_tropicalis_v9.1_protein.gpff.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/004/195/GCF_000004195.3_Xenopus_tropicalis_v9.1/GCF_000004195.3_Xenopus_tropicalis_v9.1_protein.gpff.gz</a></td>
		            </tr>

		            <tr class="list-download3">
		            	<td>Fruitfly</td>
		            	<td>Drosophila melanogaster</td>
		            	<td>7227</td>
		            	<td>NCBI</td>
		            	<td>GPFF</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/215/GCF_000001215.4_Release_6_plus_ISO1_MT/GCF_000001215.4_Release_6_plus_ISO1_MT_protein.gpff.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/215/GCF_000001215.4_Release_6_plus_ISO1_MT/GCF_000001215.4_Release_6_plus_ISO1_MT_protein.gpff.gz</a></td>
		            </tr>

		            <tr class="list-download3">
		            	<td>Worm</td>
		            	<td>Caenorhabditis elegans</td>
		            	<td>6239</td>
		            	<td>NCBI</td>
		            	<td>GPFF</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/985/GCF_000002985.6_WBcel235/GCF_000002985.6_WBcel235_protein.gpff.gz">ftp://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/985/GCF_000002985.6_WBcel235/GCF_000002985.6_WBcel235_protein.gpff.gz</a></td>
		            </tr>

        		</tbody></table>
            </div>
        </div>
    <br></div>

     <!-- Download Sources Tables -->
    <div class="col s12 m12 l12">
        <div class="collapsible-header active"><i class="material-icons">view_list</i>Downloads for the Sources used in ConVarT</div>
        <div class="collapsible-body">
            <center><input type="text" class="quick_search" id="quick_search_downloads4" placeholder="Search in the table "></center>
            <div  style="max-height: 800px !important; overflow-y: scroll !important; overflow-x: scroll !important;">
                <table id="DownloadsTable" class="special_table"><tbody>
		            <tr>
		                <th>Source <i class="material-icons right">filter_list</i></th>
		                <th>Version/Date <i class="material-icons right">filter_list</i></th>
		                <th>Link <i class="material-icons right">filter_list</i></th>
		            </tr>
		            <tr id="noResultQS_downloads4" class="grey"><td colspan="3"><span class="flow-text white-text center">NO RESULT FOUND</span></td></tr>
		            
		            <tr class="list-download4">
		            	<td>ClinVar</td>
		            	<td>February, 2019</td>
		            	<td><a href="ftp://ftp.ncbi.nlm.nih.gov/pub/clinvar/tab_delimited/variant_summary.txt.gz">ftp://ftp.ncbi.nlm.nih.gov/pub/clinvar/tab_delimited/variant_summary.txt.gz</a></td>
		            </tr>

		            <tr class="list-download4">
		            	<td>gnomAD</td>
		            	<td>June, 2019</td>
		            	<td><a href="https://gnomad.broadinstitute.org/api/">https://gnomad.broadinstitute.org/api/</a></td>
		            </tr>

		            <tr class="list-download4">
		            	<td>Pfam Domain</td>
		            	<td>February, 2019</td>
		            	<td><a href="ftp://ftp.ebi.ac.uk/pub/databases/Pfam/current_release/">ftp://ftp.ebi.ac.uk/pub/databases/Pfam/current_release/</a>, <a href="ftp://ftp.ebi.ac.uk/pub/databases/Pfam/current_release/Pfam-A.clans.tsv.gz">ftp://ftp.ebi.ac.uk/pub/databases/Pfam/current_release/Pfam-A.clans.tsv.gz</a></td>
		            </tr>

		            <tr class="list-download4">
		            	<td>MGI Vertebrate Homology</td>
		            	<td>February, 2019</td>
		            	<td><a href="http://www.informatics.jax.org/downloads/reports/HOM_AllOrganism.rpt">http://www.informatics.jax.org/downloads/reports/HOM_AllOrganism.rpt</a></td>
		            </tr>

		            <tr class="list-download4">
		            	<td>DIOPT</td>
		            	<td>March, 2019</td>
		            	<td><a href="https://www.flyrnai.org/cgi-bin/DRSC_orthologs.pl">https://www.flyrnai.org/cgi-bin/DRSC_orthologs.pl</a></td>
		            </tr>

		            <tr class="list-download4">
		            	<td>DisGeNET</td>
		            	<td>March, 2019</td>
		            	<td><a href="http://www.disgenet.org/static/disgenet_ap1/files/downloads/curated_gene_disease_associations.tsv.gz">http://www.disgenet.org/static/disgenet_ap1/files/downloads/curated_gene_disease_associations.tsv.gz</a></td>
		            </tr>

		            <tr class="list-download4">
		            	<td>MeSH Browser</td>
		            	<td>March, 2019</td>
		            	<td><a href="https://meshb.nlm.nih.gov/treeView">https://meshb.nlm.nih.gov/treeView</a></td>
		            </tr>

		            <tr class="list-download4">
		            	<td>ZFIN -ZebraFish Database-</td>
		            	<td>April, 2019</td>
		            	<td><a href="https://zfin.org/downloads/human_orthos.txt">https://zfin.org/downloads/human_orthos.txt</a>,<a href="https://zfin.org/downloads/gene.txt">https://zfin.org/downloads/gene.txt</a></td>
		            </tr>

		            <tr class="list-download4">
		            	<td>PhosphoSitePlus</td>
		            	<td>April, 2019</td>
		            	<td><a href="https://www.phosphosite.org/staticDownloads">https://www.phosphosite.org/staticDownloads</a></td>
		            </tr>

		            <tr class="list-download4">
		            	<td>COSMIC</td>
		            	<td>April, 2019</td>
		            	<td><a href="https://cancer.sanger.ac.uk/cosmic/download">https://cancer.sanger.ac.uk/cosmic/download</a></td>
		            </tr>

        		</tbody></table>
            </div>
        </div>
    </div>



</div><br>

<?php require("../footer.php"); ?>
