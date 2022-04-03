# ConVarT

![ConVarT](http://convart.org/files/img/convart_black.png)


The conserved clinical variation visualization tool (ConVarT) is an online visualization resource developed by the Kaplan Lab, with the goal of displaying the evolutionary conservation of amino acid substitutions associated with diseases from ClinVar and gnomAD databases, and allowing easy access to collections of conserved genes and conserved variants associated with human diseases for the model organism research community.

All genes consisting of all types of amino acid substitutions from ClinVar and gnomAD databases have been extracted, and a series of multiple sequence alignments of ortholog genes between human, chimp, macaca, zebrafish, mouse, rat, _Xenopus, Drosophila,_ and _C. elegans_ have been performed, with integration of human disease causing amino acid into corresponding positions.
The data visualization tool is freely available for the benefit of the scientific community.


# Details coming soon

> Details coming soon


MSA THERE: SELECT GROUP_CONCAT(convart_gene_id) AS ids, msa_id FROM msa_gene GROUP BY msa_id HAVING ids = '22438,45031' LIMIT 1,
No MSA: SELECT GROUP_CONCAT(convart_gene_id) AS ids, msa_id FROM msa_gene GROUP BY msa_id HAVING ids = '76138,80285'


