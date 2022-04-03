<!DOCTYPE html>
<?php 
    require("header.php"); 
    require("db_connection.php"); 

    #Capture the term searched
    $searchText = $_GET["q"];
    $searchText = preg_replace("#[^0-9a-z]i#","", $searchText);

    $disease_cat_mapping = ['C01' => 'Bacterial Infections and Mycoses ','C02' => 'Virus Diseases ','C03' => 'Parasitic Diseases ','C04' => 'Neoplasms ','C05' => 'Musculoskeletal Diseases ','C06' => 'Digestive System Diseases ','C07' => 'Stomatognathic Diseases ','C08' => 'Respiratory Tract Diseases ','C09' => 'Otorhinolaryngologic Diseases ','C10' => 'Nervous System Diseases ','C11' => 'Eye Diseases ','C12' => 'Male Urogenital Diseases ','C13' => 'Female Urogenital Diseases and Pregnancy Complications ','C14' => 'Cardiovascular Diseases ','C15' => 'Hemic and Lymphatic Diseases ','C16' => 'Congenital, Hereditary, and Neonatal Diseases and Abnormalities ','C17' => 'Skin and Connective Tissue Diseases ','C18' => 'Nutritional and Metabolic Diseases ','C19' => 'Endocrine System Diseases ','C20' => 'Immune System Diseases ','C21' => 'Disorders of Environmental Origin ','C22' => 'Animal Diseases ','C23' => 'Pathological Conditions, Signs and Symptoms ','C24' => 'Occupational Diseases ','C25' => 'Chemically-Induced Disorders ','C26' => 'Wounds and Injuries ','F01' => 'Behavior and Behavior Mechanisms ','F02' => 'Psychological Phenomena ','F03' => 'Mental Disorders '];
    $disease_result="";

    if(isset($searchText)) {

	#SELECT diseases_genes.gene_id, mapping_human.gene_symbol, disease_info.disease_name, disease_info.category, diseases_genes.dsi, diseases_genes.dpi, COUNT(DISTINCT clinvar.clinvar_id) FROM `diseases_genes` INNER JOIN disease_info ON diseases_genes.disease_id=disease_info.disease_id INNER JOIN mapping_human ON diseases_genes.gene_id=mapping_human.gene_id INNER JOIN clinvar ON diseases_genes.gene_id=clinvar.gene_id WHERE disease_info.disease_name LIKE '%JOUBERT%' GROUP BY diseases_genes.gene_id
	#Diseases Search Block
        $queryForDisease = mysqli_query($db_connection, "SELECT diseases_genes.gene_id, mapping_human.gene_symbol, disease_info.disease_name, disease_info.category, diseases_genes.dsi, diseases_genes.dpi FROM `diseases_genes` INNER JOIN disease_info ON diseases_genes.disease_id=disease_info.disease_id INNER JOIN mapping_human ON diseases_genes.gene_id=mapping_human.gene_id WHERE disease_info.disease_name LIKE '%$searchText%' ORDER BY mapping_human.gene_symbol") or die ("Could not search");
        $countForDisease = mysqli_num_rows($queryForDisease);
        if($countForDisease == 0) {$disease_result='<tr><td class="grey" colspan="6"><span class="flow-text white-text center">NO RESULT FOUND</span></td></tr>';}
        else {
            while ($row = mysqli_fetch_array($queryForDisease)) {
            $raw_category = $row['category'];
            if(empty($raw_category)==false) {
                $array_raw_category = explode(";", $raw_category);
                $category="";
                foreach ($array_raw_category as $cat_id) {
                $category .= $disease_cat_mapping[$cat_id] ."; ";
                } 
            }
            else {$category="N/A";}
            $disease_result .='<tr class="list-dis-gene"> <td>'.$row['gene_id'].'</td> <td><a href="search?q='.$row['gene_symbol'].'" target="_blank">'.$row['gene_symbol'].'</a></td> <td>'.$row['disease_name'].'</td> <td width="350">'.$category.'</td> <td>'.$row['dsi'].'</td> <td>'.$row['dpi'].'</td> </tr>';
            }
        }

    } #end of isset

    else {echo "Your term is not setted well!";}

?>


<!-- CurrentProject PreResult Page -->
<div class="container pageBox">
    <div class="pageTitle">Results for "<i><?php echo $searchText; ?></i> "</div><p class="blue-text">*DSI: Disease Specificity Index for the gene.  **DPI: Disease Pleiotropy Index for the gene.</p>
<br>

<!-- Diseases and Genes Table -->
<div class="col s12 m12 l12">
    <div class="collapsible-header active"><i class="material-icons">view_list</i>Diseases and Genes</div>
    <div class="collapsible-body">
        <center><input type="text" class="quick_search" id="quick_search_diseases" placeholder="Search in the table "></center>
        <div style="max-height: 500px !important; overflow-y: scroll !important; overflow-x: scroll !important;">
            <table id="DiseasesTable" class="special_table"><tbody>
                <tr>
                    <th>Gene ID <i class="material-icons right">filter_list</i></th>
                    <th>Gene Symbol <i class="material-icons right">filter_list</i></th>
                    <th>Disease Name <i class="material-icons right">filter_list</i></th>
                    <th width="350">Disease Category <i class="material-icons right">filter_list</i></th>
                    <th>DSI* <i class="material-icons right">filter_list</i></th>
                    <th>DPI** <i class="material-icons right">filter_list</i></th>
                </tr>
                <tr id="noResultQS_diseases" class="grey"><td colspan="6"><span class="flow-text white-text center">NO RESULT FOUND</span></td></tr>
		 <?= $disease_result ?>
            </tbody></table>
        </div>
    </div>
</div>


</div> <!-- end of preResult page -->


<?php require("footer.php"); ?>
