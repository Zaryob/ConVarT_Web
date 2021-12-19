

function MSAViewer(id, rawSequence, geneSymbol, variations) {
    var ids = {
        id: id,
        domainSequence: id+'-domain-sequence',
        proteinLength: id+'-protein-length',
        sequence: id+'-sequence',
        aminoacidInfo: id+'-aminoacid-info',
        nameContainer: id+'-name-container',
        geneName: id+'-gene-name',
        speciesNames: id+'-species-names',
        goToPosition: id+'-go-to-position',
        positionInput: id+'-position',
        speciesSelect: id+'-species-select'
    }
    this.ids = ids;
    var that = this;


    template = `
        <section class="msa-container">
            <!--Current Project | Domains and Sequences Parts -->
            <section id="${ids.domainSequence}" class="domain-sequence">
                
                <!-- Current Project | Protein Domains for Human -->
                <section id="${ids.proteinLength}" class="protein-length">
                </section> <!-- end of domains -->

                <!-- Current Project | Protein Sequences -->
                <section id="${ids.sequence}" class="sequence-container">
                    <div id="${ids.aminoacidInfo}" class="aminoacid-info"></div>
                </section> <!-- end of protein sequences -->

            </section> <!-- end of domain and sequences parts -->

            <!--Gene name and specie names-->
            <section id="${ids.nameContainer}" class="species-and-gene-names">
                <div id="${ids.geneName}" class="gene-name"><br>Human: ${geneSymbol}</div>
                <div id="${ids.speciesNames}" class="species-names"></div>
            </section>
            <section id="${ids.goToPosition}" class="go-to-position">
            </section>
            <br><br>
        </section>
    `;
    $('#' + id).append(template);
    this.mainDiv = $('#' + id).find('.msa-container');
    $mainDiv = this.mainDiv;

    this.loadAminoacidSearch();

    var variationNotes = {};
    this.variationNotes = variationNotes;

    var PHEPositions_mouse = {};
    this.PHEPositions_mouse = PHEPositions_mouse;
	
	var PHEPositions_celegans = {};
    this.PHEPositions_celegans = PHEPositions_celegans;

    var ptmNotes = {};
    this.ptmNotes = ptmNotes;

    var HMPositions = {};
    this.HMPositions = HMPositions;

    var HCPositions = {};
    this.HCPositions = HCPositions;

    var HMCPositions = {};
    this.HMCPositions = HMCPositions;

    function getOffsetX(prNumber, aaNumber) {
        var indexOfAA = that.getAminoacidPositionInViewport(prNumber, aaNumber);

        var offsetX = indexOfAA * 20 + 30;

        return offsetX;
    }

    this.showVariation = function(prNumber, aaNumber) {
        let textBox = document.createElement("div");
        let innerTextBox = document.createElement("div"); // YENI -> addVariation Notu Uzunsa Scroll Yaptırmak için
        textBox.setAttribute("class", "variation-text-box");
        innerTextBox.setAttribute("class", "variation-inner-text-box");

        proteinNotes = variationNotes[prNumber];
        for (var source in proteinNotes[aaNumber]) {
            if(source != 'HM' && source != 'HC' && source != 'HMC' && source != 'PHE_mouse' && source != 'PHE_celegans') {
                innerTextBox.innerHTML += "<h3>" + source + "</h3>" + proteinNotes[aaNumber][source];
                //console.log(source);
            }
        }
        var aminoacidInfoBox = document.getElementById(this.ids.aminoacidInfo);
        aminoacidInfoBox.innerHTML = '';
        aminoacidInfoBox.appendChild(textBox).appendChild(innerTextBox); // time to insert the textBox into aminoacidInfoBox | eski: aminoacidInfoBox.appendChild(textBox)
        $(".variation-inner-text-box").mouseleave(function (e) {
            var aminoacidInfo = document.getElementById(ids.aminoacidInfo);
            aminoacidInfo.innerHTML = "";
        });

        offsetX = getOffsetX(prNumber, aaNumber);
        var container = document.getElementById("protein0");

        if (container.scrollWidth < (offsetX + 600)) {
            offsetX = offsetX - 340;

            textBox.className += " rightArrow";
        }
        let specificPositionforCVBox = "top: " + (prNumber * 20 - 13) + "px;" + "left: " + (offsetX) + "px;  box-shadow:#555 1px 1px 5px 3px;";
        document.getElementById(ids.aminoacidInfo).childNodes[0].style.cssText = specificPositionforCVBox;

    }

    this.processedSequences = [];
    var processedSequences = this.processedSequences;
    this.loadedPositions = [];
    var loadedPositions = this.loadedPositions;
    this.viewportToAANumber = [];
    viewportToAANumber = this.viewportToAANumber;

    for(i in variations) {
        variation = variations[i];
        this.addVariation(variation['protein'], variation['aminoacid'], variation['note'], variation['source']);
    }

    // Core Code
    function loadSeq(txt) {
        let startPr, endPr, startPr2 = -1;
        let j = 0;

        do {
            startPr = txt.indexOf(">", startPr + 1);
            endPr = txt.indexOf("\n", startPr + 1);
            startPr2 = txt.indexOf(">", startPr + 1);
            let seq1 = txt.slice(endPr + 1, startPr2);
            //removing new line characters inside seq1
            seq1 = seq1.replace(/\s/g, "");
            let proteinId = "protein" + [j];

            viewportToAANumber.push([]);
            aa_ind = 0;
            for (ind = 0; ind < seq1.length; ind++) {

                if (seq1.charAt(ind) == '-') {
                    viewportToAANumber[j].push(-1);
                    continue;
                } else {
                    viewportToAANumber[j].push(aa_ind);
                    aa_ind++;
                }
            }

            processedSequences[j] = seq1;
            //Protein Name-Identifier
            let prName = txt.slice(startPr + 1, endPr + 1);
            let prID = prName.split(" ")[0]; // 7 MART
            let species = prName.split("[").slice(-1)[0].split("]")[0];
            $('#'+ids.speciesSelect).html($('#'+ids.speciesSelect).html() + '<option value="' + j + '">' + species + '</option>');
            let species_by_word = species.split(" ");
            species = species_by_word[0][0] + ". " + species_by_word[1];
            //Protein sequences slicing

            //console.log(seq1.length);
            var proteinLengthforDomain = "width:" + seq1.length * 20 + "px;"; // every aacid inside a box in 20x20 size
            //console.log(proteinLengthforDomain);
            document.getElementById(ids.proteinLength).style = proteinLengthforDomain;
            //creating flex container for proteins
            let protein = document.createElement("section");
            document.getElementById(ids.sequence).appendChild(protein);
            protein.id = proteinId;
            protein.className = "protein";
            j++;
            // write the name of the species and genes
            var speciesName = document.createElement("div");
            var speciesNameLink = document.createElement("a");
            var prType = prName.substring(0, 2);
            // console.log('hey', prType);
            if (prType == "NP" || prType == "XP") {
                speciesNameLink.setAttribute("href", "https://www.ncbi.nlm.nih.gov/protein/" + prID);
            }
            if (prType == "EN") {
                speciesNameLink.setAttribute("href", "https://www.ensembl.org/id/" + prID);
            }

            regexPattern = "[OPQ][0-9][A-Z0-9]{3}[0-9]|[A-NR-Z][0-9]([A-Z][A-Z0-9]{2}[0-9]){1,2}"
            if (prName.search(regexPattern) != "-1") {
                prID = prName.split(" ")[1];
                speciesNameLink.setAttribute("href", "https://www.uniprot.org/uniprot/" + prID);
            }

            speciesNameLink.setAttribute('target', '_blank');
            speciesNameLink.setAttribute('class', 'tooltipped');
            speciesNameLink.setAttribute('data-position', 'right');
            speciesNameLink.setAttribute('data-tooltip', prName);

            document.getElementById(ids.speciesNames).appendChild(speciesName).appendChild(speciesNameLink);
            speciesName.className = "species-name";
            speciesNameLink.appendChild(document.createTextNode(species)); //// exception case olacak 

        } while (startPr2 != -1);
        for (i = 0; i < processedSequences[0].length; i++) {
            loadedPositions.push(false);
        }
    }

    // Time To Run
    loadSeq(rawSequence);
    if ((typeof(domains) != "undefined") && (domains.length != 0)) {
        this.addDomains(domains);
    }
    this.loadDivsInViewport();
    $mainDiv.scroll(function() {
        that.loadDivsInViewport();
    });

    this.loadDomainBar();

}

MSAViewer.prototype.loadDomainBar = function() {
    var that = this;
    $('.domain').each(function() {
        //console.log($(this).data('start-point'), );
        startPosition = that.getAminoacidPositionInViewport(0, parseInt($(this).data('start-point'))-1);

        width = that.getAminoacidPositionInViewport(0, parseInt($(this).data('end-point'))-1) - startPosition;

        $(this).css('display', 'flex');
        $(this).css('left', (startPosition*20)+'px');
        $(this).width((width*20)+'px');
    });

    $(document).on('mouseover', '.specialAa', function(){
        prNumber = $(this).data('sid');
        aaNumber = parseInt($(this).attr('class').split(' ')[0].split('-')[1])
        that.showVariation(prNumber, viewportToAANumber[prNumber][aaNumber]);
    });

        
    var ids = this.ids;
    $('.protein').width(($('#'+ids.proteinLength).width())+'px');
    $('#'+ids.sequence).width(($('#'+ids.proteinLength).width())+'px');
}

MSAViewer.prototype.getAminoacidPositionInViewport = function(species_id, position) {
    var sequence = processedSequences[species_id];
    var aminoacidIndex = 0;
    for(i = 0; i< sequence.length; i++){
    if(sequence.charAt(i) == '-')
        continue;
    if(aminoacidIndex == position){
        return i;
    }
    if(sequence.charAt(i) != '-'){
        aminoacidIndex++;
    }
    
    }
    return -1;
}

MSAViewer.prototype.positionKeyUp = function() {
    $mainDiv = this.mainDiv;
    console.log(this);
    var position = $('#'+this.ids.positionInput).val();
    var species = parseInt($('#'+this.ids.speciesSelect).val());
    var alignmentPosition = this.getAminoacidPositionInViewport(species, position - 1);
    
    $mainDiv.find('#position-number').remove();
    $mainDiv.find('.highlight-column').removeClass('highlight-column');
    $mainDiv.find('.ptmHighlighted').removeClass('ptmHighlighted');
    $mainDiv.find('#protein0').append('<div class="highlight-column" id="position-number" style="left:' + (alignmentPosition * 20) + 'px">' + position + '</div>');

    $mainDiv.scrollLeft(alignmentPosition * 20 - ($mainDiv.width() - 160) / 2)

    setTimeout(function () {
        $mainDiv.find('.i-' + alignmentPosition).addClass('highlight-column');
        $mainDiv.find('#protein' + species + ' .ptm.i-' + alignmentPosition).addClass('ptmHighlighted');
    }, 75);
}

MSAViewer.prototype.loadAminoacidSearch = function() {
    var ids = this.ids;
    var that = this;
    
    $goToDiv = this.mainDiv.find('.go-to-position');

    $goToDiv.append('Search a position: <input type="number" placeholder="3" name="position" class="form_input" id="'+ids.positionInput+'">');
    $goToDiv.append(' Species : <select name="species" id="'+ids.speciesSelect+'"></select><br>');

    $('#'+ids.positionInput).on("keyup", function() {
        that.positionKeyUp();
    });
    $('#'+ids.speciesSelect).on("change", function() {
        that.positionKeyUp();
    });
}

MSAViewer.prototype.loadDivsInViewport = function(reset) {

    var ids  = this.ids;
    loadedPositions = this.loadedPositions;
    processedSequences = this.processedSequences;
    variationNotes  = this.variationNotes;
    ptmNotes = this.ptmNotes;
    HMPositions = this.HMPositions;
    HCPositions = this.HCPositions;
    PHEPositions_mouse = this.PHEPositions_mouse;
	PHEPositions_celegans = this.PHEPositions_celegans;
    HMCPositions = this.HMCPositions;

    if(reset == true){
        for(var i in loadedPositions){
            loadedPositions[i] = false;
        }
        $('#'+ids.sequence).find('section div').remove();
    }  
    var viewportOffset = document.getElementById(ids.sequence).getBoundingClientRect();

    var aminoacid_index = 0;
   
    startX = parseInt((Math.abs(viewportOffset.left) - document.getElementById(ids.nameContainer).clientWidth)/20 - window.innerWidth/40) ;
    if(startX < 0){
      startX = 0;
    }
    endX = parseInt(startX+(document.getElementById(ids.nameContainer).clientWidth)/20 + 3*window.innerWidth/40 + 20) ;
    
    if(processedSequences[0].length <= endX) {
      endX = processedSequences[0].length-1;
    }

    
    for(j = 0; j < processedSequences.length; j++){
      seq1 = processedSequences[j];
       var documentFragment = document.createDocumentFragment();
      for (i = startX; i < endX; i++) {

        if(loadedPositions[i] && seq1.length < 5000){
            continue;
        }
        let aaBox = document.createElement("div");
        //reading protein sequence letter by letter
        var aaLetter = seq1.charAt(i);
        //creating amino acid boxes
        
        if(aaLetter != '-'){
            aminoacid_index+= 1;
            
            aaBox.className = "i-"+i;  
        }
        /*if(aaLetter == '-'){
          continue;
        }
		*/
        if(j in variationNotes && viewportToAANumber[j][i] != -1 && viewportToAANumber[j][i] in variationNotes[j]){
           aaBox.className += " specialAa";
           aaBox.setAttribute('data-sid', j);
        }

        if(j == 0 && viewportToAANumber[j][i] != -1 && viewportToAANumber[j][i] in ptmNotes){
           aaBox.className += " ptm";
           aaBox.setAttribute('data-sid', j);
        }

        if(j == 0 && viewportToAANumber[j][i] != -1 && viewportToAANumber[j][i] in HMPositions){
            aaBox.className += " hm";
            aaBox.setAttribute('data-sid', j); 
        }

        if(j == 0 && viewportToAANumber[j][i] != -1 && viewportToAANumber[j][i] in HCPositions){
            aaBox.className += " hc";
            aaBox.setAttribute('data-sid', j);
        }

        if(j == 0 && viewportToAANumber[j][i] != -1 && viewportToAANumber[j][i] in HMCPositions){
            aaBox.className += " hmc";
            aaBox.setAttribute('data-sid', j);
        }
		//console.log(PHEPositions_mouse);
		if (j == 0 && j+1+1 <= processedSequences.length) {
			if ( viewportToAANumber[j+1][i] != -1 && viewportToAANumber[j+1][i] in PHEPositions_mouse){ 
			//console.log("PHE" + i + "mouse");
            aaBox.className += " phe";
            aaBox.setAttribute('data-sid', j);
            aaBox.classList.remove("hm");
            aaBox.classList.remove("hmc");
            aaBox.classList.remove("hc");
            aaBox.classList.remove("ptm");
			}
		}
        if(j == 0 && j+2+1 <= processedSequences.length) {	
			if (viewportToAANumber[j+2][i] != -1 && viewportToAANumber[j+2][i] in PHEPositions_celegans){
			//console.log("PHE" + i + "celegans");
            aaBox.className += " phe";
            aaBox.setAttribute('data-sid', j);
            aaBox.classList.remove("hm");
            aaBox.classList.remove("hmc");
            aaBox.classList.remove("hc");
            aaBox.classList.remove("ptm");
			}
        }
        /*
        if(j == 0 && viewportToAANumber[j][i] != -1 && viewportToAANumber[j][i] === 11){
            aaBox.className += " hm";
            aaBox.setAttribute('data-sid', j);
        }
        */

        aaBox.innerHTML = aaLetter;
        aaBox.style.cssText  = 'left:'+(i*20)+'px;';
        //giving the proper color to each amino acid
        if (aaLetter.includes("M") === true || aaLetter.includes("C") === true) {aaBox.style.cssText += "background-color:#a5a513"};
        if (aaLetter.includes("A") === true) {aaBox.style.cssText += "background-color:#C8C8C8"};
        if (aaLetter.includes("L") === true || aaLetter.includes("V") === true || aaLetter.includes("I") === true) {aaBox.style.cssText += "background-color:#0F820F"};
        if (aaLetter.includes("D") === true || aaLetter.includes("E") === true) {aaBox.style.cssText += "background-color:#E60A0A"};
        if (aaLetter.includes("K") === true || aaLetter.includes("R") === true) {aaBox.style.cssText += "background-color:#145AFF"};
        if (aaLetter.includes("S") === true || aaLetter.includes("T") === true) {aaBox.style.cssText += "background-color:#FA9600"};
        if (aaLetter.includes("F") === true || aaLetter.includes("Y") === true) {aaBox.style.cssText += "background-color:#3232AA"};
        if (aaLetter.includes("N") === true || aaLetter.includes("Q") === true) {aaBox.style.cssText += "background-color:#00DCDC"};
        if (aaLetter.includes("G") === true) {aaBox.style.cssText += "background: #EBEBEB; color: #777;"};
        if (aaLetter.includes("W") === true) {aaBox.style.cssText += "background-color:#B45AB4"};
        if (aaLetter.includes("-") === true) {aaBox.style.cssText += "background-color:#333"};
        if (aaLetter.includes("H") === true) {aaBox.style.cssText += "background-color:#8282D2"};
        if (aaLetter.includes("P") === true) {aaBox.style.cssText += "background-color:#DC9682"};
        documentFragment.appendChild(aaBox);
        aaBox = null;
    }
        let element = document.getElementById('protein'+j);
        if(seq1.length >= 5000){
          element.innerHTML = '';  
        }
        element.appendChild(documentFragment);
        documentFragment.innerHTML='';
    }
    
    for(i = 0; i < seq1.length; i++){
      if(i >= startX && i < endX)
        loadedPositions[i] = true;
      else if(seq1.length >= 5000)
        loadedPositions[i] = false;
    }  

}

MSAViewer.prototype.addDomains = function(domains) {
    var ids = this.ids;
    for (var key in domains){
        domain_id = domains[key]["domain_id"];
        domain_name = domains[key]["domain_id"];
        domain_external_link = domains[key]["domain_external_link"];
        domain_start_point = domains[key]["domain_start_point"];
        domain_end_point = domains[key]["domain_end_point"];

        domain_template = `
        <a href="${domain_external_link}" target="_blank">
            <div class="domain" data-start-point="${domain_start_point}" data-end-point="${domain_end_point}">
                <div class="domain_start_point">${domain_start_point}</div>
                <p>${domain_name} (${domain_start_point} - ${domain_end_point})</p>
                <div class="domain_end_point">${domain_end_point}</div>
            </div>
        </a>
        `;

        $('#' + ids.proteinLength).append(domain_template);
    };
}

MSAViewer.prototype.addVariation = function(protein, aminoacid, variationNote, source) {
    let aaNumber = aminoacid - 1; // the aacids start from 0

    notesByProtein = this.variationNotes[protein];
    if (notesByProtein == undefined) {
        notesByProtein = [];
    }

    if (notesByProtein[aaNumber] == undefined) {
        notesByProtein[aaNumber] = {};
        notesByProtein[aaNumber][source] = "";
    } else if (notesByProtein[aaNumber][source] == undefined) {
        notesByProtein[aaNumber][source] = "";
    }


    notesByProtein[aaNumber][source] += "<br>" + variationNote;
    this.variationNotes[protein] = notesByProtein
    
    if (variationNote == "PHE_mouse") {
        this.PHEPositions_mouse[aaNumber] += aminoacid + 1;
    }
	if (variationNote == "PHE_celegans") {
        this.PHEPositions_celegans[aaNumber] += aminoacid + 1;
    }
    if (source == "HMC") {
        this.HMCPositions[aaNumber] += aminoacid + 1;
    }
    if (source == "HM") {
        this.HMPositions[aaNumber] += aminoacid + 1;
    }
    if (source == "HC") {
        this.HCPositions[aaNumber] += aminoacid + 1;
    }
    if (source == "PTM") {
        this.ptmNotes[aaNumber] += aminoacid + 1;
    }
}

MSAViewer.prototype.scrollIfNeeded = function(element, container) {

    const halfClientWidth = container.clientWidth / 2;
    if (element.offsetLeft < container.scrollLeft-200) {
      container.scrollLeft = element.offsetLeft - halfClientWidth;
    } else {
      const offsetRight = element.offsetLeft + element.offsetWidth;
      const scrollRight = container.scrollLeft + container.offsetWidth;
      if (offsetRight+200 > scrollRight) {
        container.scrollLeft = offsetRight - halfClientWidth;
      }
    }
}

MSAViewer.prototype.addConsensus = function(consensus_parameter) {
    if(consensus_parameter ==  "Yes") {
        var aaCount = processedSequences[0].length;
        for (let aaInd = 0; aaInd < aaCount; aaInd++) {
            var position_dict = {};
            for (let proteinIndex = 0; proteinIndex < processedSequences.length; proteinIndex++) {
                var protein = processedSequences[proteinIndex];
                var aminoacid = protein[aaInd];
                position_dict[aminoacid] = aaInd;
        }
            console.log(position_dict);
            var consensus_logo = [" "];
            if (Object.keys(position_dict).length == 1){
                // consensus_logo = consensus_logo.concat(aminoacid);
                console.log("Consensus");
            }
            else if (Object.keys(position_dict).length == processedSequences.length/2) {
                // consensus_logo = consensus_logo.concat(':');
                console.log("Half of them are conserved");
            }
            else if (Object.keys(position_dict).length == processedSequences.length)
            {
                // consensus_logo = consensus_logo.concat('-');
                console.log("All of them are different.");
            }
            else{
                // consensus_logo = consensus_logo.concat('.');
                console.log("Not fully conserved.");
            }
        }
        // console.log(consensus_logo);
        // processedSequences.push(consensus_logo);
    }
} 