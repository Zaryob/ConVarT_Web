-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Feb 08, 2022 at 08:44 AM
-- Server version: 8.0.28
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `convart`
--

-- --------------------------------------------------------

--
-- Table structure for table `38clinvar`
--

CREATE TABLE `38clinvar` (
  `clinvar_id` int NOT NULL,
  `gene_id` int NOT NULL,
  `allele_id` int NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `rs_number` varchar(255) NOT NULL,
  `rcv_accession` varchar(255) NOT NULL,
  `variation_id` int NOT NULL,
  `variant_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` int NOT NULL,
  `variation` varchar(255) NOT NULL,
  `clinical_significance` varchar(255) NOT NULL,
  `last_updated` varchar(255) NOT NULL,
  `phenotypes` varchar(255) NOT NULL,
  `cytogenetic` varchar(255) NOT NULL,
  `review_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `celegans_variants`
--

CREATE TABLE `celegans_variants` (
  `primary_id` int NOT NULL,
  `ids` varchar(255) DEFAULT NULL,
  `pos` bigint DEFAULT NULL,
  `refseq_id` varchar(255) DEFAULT NULL,
  `aa_change` varchar(255) DEFAULT NULL,
  `gene_name` varchar(255) DEFAULT NULL,
  `variant_type` varchar(255) DEFAULT NULL,
  `phenotype` mediumtext,
  `SIFT` varchar(255) DEFAULT NULL,
  `PolyPhen` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinvar`
--

CREATE TABLE `clinvar` (
  `clinvar_id` bigint NOT NULL,
  `gene_id` bigint DEFAULT NULL,
  `allele_id` bigint DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `rs_number` varchar(255) DEFAULT NULL,
  `rcv_accession` varchar(255) DEFAULT NULL,
  `variation_id` bigint DEFAULT NULL,
  `variant_type` varchar(255) DEFAULT NULL,
  `phenotype_ids` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `clinical_significance` varchar(255) DEFAULT NULL,
  `review_status` varchar(255) DEFAULT NULL,
  `phenotypes` varchar(255) DEFAULT NULL,
  `nm_id` text,
  `variation` varchar(255) DEFAULT NULL,
  `position` bigint DEFAULT NULL,
  `np_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `community_variants`
--

CREATE TABLE `community_variants` (
  `id` int NOT NULL,
  `consequence` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `impact` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `protein_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `biotype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `protein_pos` int NOT NULL,
  `aa_change` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `source` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phenotype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `validation` tinyint(1) DEFAULT '0',
  `organism` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `organization` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sended_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `validation_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conservation_scores`
--

CREATE TABLE `conservation_scores` (
  `cs_id` int NOT NULL,
  `msa_id` int NOT NULL,
  `aminoacid_number` int NOT NULL,
  `specie` varchar(255) NOT NULL,
  `transcript_id_specie` varchar(255) NOT NULL,
  `score` int NOT NULL,
  `score_type` varchar(255) NOT NULL,
  `transcript_id` varchar(255) NOT NULL,
  `gene_symbol` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `convart_gene`
--

CREATE TABLE `convart_gene` (
  `id` int NOT NULL,
  `sequence` text NOT NULL,
  `species_id` varchar(55) NOT NULL,
  `hash` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `convart_gene_to_db`
--

CREATE TABLE `convart_gene_to_db` (
  `convart_gene_id` int NOT NULL,
  `db` varchar(25) NOT NULL,
  `db_id` varchar(50) NOT NULL,
  `db_id_version` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `CosmicMutantExport`
--

CREATE TABLE `CosmicMutantExport` (
  `cme_id` int NOT NULL,
  `gene_name` varchar(255) DEFAULT NULL,
  `accession_number` varchar(255) DEFAULT NULL,
  `gene_cds_length` int DEFAULT NULL,
  `hgnc_id` varchar(255) DEFAULT NULL,
  `sample_name` varchar(255) DEFAULT NULL,
  `id_sample` int DEFAULT NULL,
  `id_tumour` int DEFAULT NULL,
  `primary_site` varchar(255) DEFAULT NULL,
  `site_subtype_1` varchar(255) DEFAULT NULL,
  `site_subtype_2` varchar(255) DEFAULT NULL,
  `site_subtype_3` varchar(255) DEFAULT NULL,
  `primary_histology` varchar(255) DEFAULT NULL,
  `histology_subtype_1` varchar(255) DEFAULT NULL,
  `histology_subtype_2` varchar(255) DEFAULT NULL,
  `histology_subtype_3` varchar(255) DEFAULT NULL,
  `genome_wide_screen` varchar(255) DEFAULT NULL,
  `mutation_id` varchar(255) DEFAULT NULL,
  `mutation_cds` varchar(255) DEFAULT NULL,
  `mutation_aa` varchar(255) DEFAULT NULL,
  `mutation_description` varchar(255) DEFAULT NULL,
  `mutation_zygosity` varchar(255) DEFAULT NULL,
  `loh` varchar(255) DEFAULT NULL,
  `grch` varchar(255) DEFAULT NULL,
  `mutation_genome_position` varchar(255) DEFAULT NULL,
  `mutation_strand` varchar(255) DEFAULT NULL,
  `snp` varchar(255) DEFAULT NULL,
  `resistance_mutation` varchar(255) DEFAULT NULL,
  `fathmm_prediction` varchar(255) DEFAULT NULL,
  `fathmm_score` varchar(255) DEFAULT NULL,
  `mutation_somatic_status` varchar(255) DEFAULT NULL,
  `pubmed_pmid` varchar(255) DEFAULT NULL,
  `id_study` varchar(255) DEFAULT NULL,
  `sample_type` varchar(255) DEFAULT NULL,
  `tumour_origin` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `position` int NOT NULL DEFAULT '0',
  `genomic_mutation_id` varchar(255) DEFAULT NULL,
  `legacy_genomic_mutation_id` varchar(255) DEFAULT NULL,
  `hgvsp` varchar(255) DEFAULT NULL,
  `hgvsc` varchar(255) DEFAULT NULL,
  `hgvsg` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `dbsnp`
--

CREATE TABLE `dbsnp` (
  `id` int NOT NULL,
  `ensm_protein_id` varchar(255) DEFAULT NULL,
  `rs_id` varchar(50) DEFAULT NULL,
  `ensm_gene_id` varchar(255) DEFAULT NULL,
  `ensm_transcript_id` varchar(80) DEFAULT NULL,
  `variant_type` varchar(255) DEFAULT NULL,
  `position` int DEFAULT NULL,
  `variation` varchar(50) DEFAULT NULL,
  `sift_score` varchar(255) DEFAULT NULL,
  `polyphen_score` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diseases_genes`
--

CREATE TABLE `diseases_genes` (
  `dg_id` int NOT NULL,
  `gene_id` int NOT NULL,
  `disease_id` varchar(255) NOT NULL,
  `dsi` float NOT NULL,
  `dpi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `disease_info`
--

CREATE TABLE `disease_info` (
  `di_id` int NOT NULL,
  `disease_id` varchar(255) NOT NULL,
  `disease_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `domain_id` int NOT NULL,
  `transcript_id` varchar(255) NOT NULL,
  `pfam_id` varchar(255) NOT NULL,
  `pfam_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `start_point` int NOT NULL,
  `end_point` int NOT NULL,
  `bitscore` float NOT NULL,
  `evalue` varchar(10) NOT NULL,
  `clan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `domains_desc`
--

CREATE TABLE `domains_desc` (
  `domain_desc_id` int NOT NULL,
  `pfam_id` varchar(11) NOT NULL,
  `pfam_name` varchar(255) NOT NULL,
  `domain_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `gnomad`
--

CREATE TABLE `gnomad` (
  `id` int NOT NULL,
  `consequence` varchar(255) NOT NULL,
  `ensg_id` varchar(255) NOT NULL,
  `canonical_transcript` varchar(80) NOT NULL,
  `variation` varchar(50) NOT NULL,
  `filters` varchar(255) NOT NULL,
  `rs_number` varchar(50) NOT NULL,
  `variant_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `position` int NOT NULL,
  `allele_count` int NOT NULL,
  `allele_number` int NOT NULL,
  `allelle_frequency` int NOT NULL,
  `flags` varchar(255) NOT NULL,
  `datasets` varchar(512) NOT NULL,
  `is_canon` tinyint NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `go_annotation`
--

CREATE TABLE `go_annotation` (
  `id` int NOT NULL,
  `go_term_acc` varchar(127) NOT NULL,
  `gene_name` varchar(127) DEFAULT NULL,
  `go_term_evidence_code` varchar(63) DEFAULT NULL,
  `go_domain` varchar(63) DEFAULT NULL,
  `gene_id` varchar(127) DEFAULT NULL,
  `go_term_name` varchar(255) DEFAULT NULL,
  `go_term_def` text,
  `organism` varchar(127) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `homology`
--

CREATE TABLE `homology` (
  `homology_id` int NOT NULL,
  `human_gene_id` int NOT NULL,
  `chimp_gene_id` varchar(255) NOT NULL,
  `macaque_gene_id` varchar(255) NOT NULL,
  `rat_gene_id` varchar(255) NOT NULL,
  `mouse_gene_id` varchar(255) NOT NULL,
  `zebrafish_gene_id` varchar(255) NOT NULL,
  `frog_gene_id` varchar(255) NOT NULL,
  `fruitfly_gene_id` varchar(255) NOT NULL,
  `worm_gene_id` varchar(255) NOT NULL,
  `yeast_gene_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `human_celegans_orthologous`
--

CREATE TABLE `human_celegans_orthologous` (
  `id` int NOT NULL,
  `Human_Protein_ID` varchar(255) DEFAULT NULL,
  `C_elegans_Protein_ID` varchar(255) DEFAULT NULL,
  `Mouse_Protein_ID` varchar(255) DEFAULT NULL,
  `Human_Variation` varchar(255) DEFAULT NULL,
  `C_elegans_Variation` varchar(255) DEFAULT NULL,
  `Human_Clinical_Significance` varchar(255) DEFAULT NULL,
  `C_elegans_Significance` varchar(255) DEFAULT NULL,
  `Human_Variant_ID` varchar(255) DEFAULT NULL,
  `C_elegans_Variant_ID` varchar(255) DEFAULT NULL,
  `Human_Gene_Name` varchar(255) DEFAULT NULL,
  `C_elegans_Gene_Name` varchar(255) DEFAULT NULL,
  `Human_Disease` varchar(255) DEFAULT NULL,
  `C_elegans_Phenotype` varchar(255) DEFAULT NULL,
  `Allele_Frequency` varchar(255) DEFAULT NULL,
  `Source` varchar(255) DEFAULT NULL,
  `msa_index` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `human_mouse_orthologous`
--

CREATE TABLE `human_mouse_orthologous` (
  `id` int NOT NULL,
  `Human_Protein_ID` varchar(255) DEFAULT NULL,
  `Mouse_Protein_ID` varchar(255) DEFAULT NULL,
  `C_elegans_Protein_ID` varchar(255) DEFAULT NULL,
  `Human_Variation` varchar(255) DEFAULT NULL,
  `Mouse_Variation` varchar(255) DEFAULT NULL,
  `Human_Clinical_Significance` varchar(255) DEFAULT NULL,
  `Mouse_Significance` varchar(255) DEFAULT NULL,
  `Human_Variant_ID` varchar(255) DEFAULT NULL,
  `Mouse_Variant_ID` varchar(255) DEFAULT NULL,
  `Human_Gene_name` varchar(255) DEFAULT NULL,
  `Mouse_Gene_Name` varchar(255) DEFAULT NULL,
  `Human_Disease` varchar(255) DEFAULT NULL,
  `Mouse_Phenotype` varchar(255) DEFAULT NULL,
  `Allele_Frequency` varchar(255) DEFAULT NULL,
  `Source.y` varchar(255) DEFAULT NULL,
  `Source.x` varchar(255) DEFAULT NULL,
  `msa_index` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapping_human`
--

CREATE TABLE `mapping_human` (
  `mh_id` int NOT NULL,
  `gene_id` int NOT NULL,
  `other_ids` varchar(255) NOT NULL,
  `gene_symbol` varchar(255) NOT NULL,
  `gene_synonyms` varchar(255) NOT NULL,
  `protein_numbers` varchar(255) NOT NULL,
  `gene_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `mouse_variants`
--

CREATE TABLE `mouse_variants` (
  `id` int NOT NULL,
  `variation_id` bigint DEFAULT NULL,
  `gene_name` varchar(255) DEFAULT NULL,
  `phenotype` varchar(255) DEFAULT NULL,
  `aa_change` varchar(255) DEFAULT NULL,
  `pos` bigint DEFAULT NULL,
  `refseq_id` varchar(255) DEFAULT NULL,
  `variant_type` varchar(255) DEFAULT NULL,
  `variation` varchar(255) DEFAULT NULL,
  `polyphen_score` varchar(255) DEFAULT NULL,
  `predicted_effect` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `msa`
--

CREATE TABLE `msa` (
  `id` int NOT NULL,
  `fasta` mediumtext CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `alignment_method` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `msa_best_combination`
--

CREATE TABLE `msa_best_combination` (
  `msa_id` int NOT NULL,
  `convart_gene_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `msa_gene`
--

CREATE TABLE `msa_gene` (
  `msa_id` int NOT NULL,
  `convart_gene_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `msa_old`
--

CREATE TABLE `msa_old` (
  `id` int NOT NULL,
  `fasta` mediumtext CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `alignment_method` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `ncbi_gene_meta`
--

CREATE TABLE `ncbi_gene_meta` (
  `ncbi_gene_id` int NOT NULL,
  `meta_key` varchar(50) NOT NULL,
  `meta_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `proxies`
--

CREATE TABLE `proxies` (
  `proxy` varchar(40) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ptm`
--

CREATE TABLE `ptm` (
  `index_id` bigint DEFAULT NULL,
  `gene` text,
  `protein` text,
  `acc_id` varchar(32) DEFAULT NULL,
  `hu_chr_loc` text,
  `mod_rsd` text,
  `site_grp_id` bigint DEFAULT NULL,
  `organism` text,
  `mw_kd` double DEFAULT NULL,
  `domain` text,
  `site_+/-7_aa` text,
  `lt_lit` double DEFAULT NULL,
  `ms_lit` double DEFAULT NULL,
  `ms_cst` double DEFAULT NULL,
  `cst_cat#` text,
  `ptm_type` text,
  `enst_id` text,
  `position` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `species`
--

CREATE TABLE `species` (
  `id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `topmed`
--

CREATE TABLE `topmed` (
  `id` int NOT NULL,
  `ensm_protein_id` varchar(255) DEFAULT NULL,
  `rs_id` varchar(50) DEFAULT NULL,
  `ensm_gene_id` varchar(255) DEFAULT NULL,
  `ensm_transcript_id` varchar(80) DEFAULT NULL,
  `variant_type` varchar(255) DEFAULT NULL,
  `position` int DEFAULT NULL,
  `variation` varchar(50) DEFAULT NULL,
  `variant_ids` varchar(255) DEFAULT NULL,
  `sift_score` varchar(255) DEFAULT NULL,
  `polyphen_score` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tubulin_mutations`
--

CREATE TABLE `tubulin_mutations` (
  `id` int NOT NULL,
  `organism` varchar(255) NOT NULL,
  `gene_tag` varchar(255) NOT NULL,
  `transcript` varchar(255) NOT NULL,
  `position` int NOT NULL,
  `aa_change` varchar(255) NOT NULL,
  `phenotype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `38clinvar`
--
ALTER TABLE `38clinvar`
  ADD PRIMARY KEY (`clinvar_id`),
  ADD KEY `gene_id` (`gene_id`),
  ADD KEY `gene_id_2` (`gene_id`),
  ADD KEY `gene_id_3` (`gene_id`);

--
-- Indexes for table `celegans_variants`
--
ALTER TABLE `celegans_variants`
  ADD PRIMARY KEY (`primary_id`),
  ADD KEY `celegans_refseq_id_index` (`refseq_id`(191));

--
-- Indexes for table `clinvar`
--
ALTER TABLE `clinvar`
  ADD PRIMARY KEY (`clinvar_id`),
  ADD UNIQUE KEY `clinvar_id` (`clinvar_id`);

--
-- Indexes for table `community_variants`
--
ALTER TABLE `community_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conservation_scores`
--
ALTER TABLE `conservation_scores`
  ADD PRIMARY KEY (`cs_id`),
  ADD KEY `transcript_id` (`transcript_id`),
  ADD KEY `msa_id` (`msa_id`);

--
-- Indexes for table `convart_gene`
--
ALTER TABLE `convart_gene`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hash` (`hash`),
  ADD KEY `species` (`species_id`);

--
-- Indexes for table `convart_gene_to_db`
--
ALTER TABLE `convart_gene_to_db`
  ADD PRIMARY KEY (`convart_gene_id`,`db`,`db_id`),
  ADD KEY `db` (`db`),
  ADD KEY `db_id` (`db_id`),
  ADD KEY `convart_gene_id` (`convart_gene_id`);

--
-- Indexes for table `CosmicMutantExport`
--
ALTER TABLE `CosmicMutantExport`
  ADD PRIMARY KEY (`cme_id`),
  ADD KEY `accession_number` (`accession_number`),
  ADD KEY `gene_name` (`gene_name`),
  ADD KEY `sample_name` (`sample_name`),
  ADD KEY `primary_site` (`primary_site`),
  ADD KEY `primary_histology` (`primary_histology`),
  ADD KEY `mutation_id` (`mutation_id`),
  ADD KEY `mutation_cds` (`mutation_cds`),
  ADD KEY `mutation_aa` (`mutation_aa`),
  ADD KEY `mutation_description` (`mutation_description`),
  ADD KEY `fathmm_prediction` (`fathmm_prediction`),
  ADD KEY `fathmm_score` (`fathmm_score`),
  ADD KEY `mutation_somatic_status` (`mutation_somatic_status`),
  ADD KEY `pubmed_pmid` (`pubmed_pmid`),
  ADD KEY `tumour_origin` (`tumour_origin`),
  ADD KEY `position` (`position`);

--
-- Indexes for table `dbsnp`
--
ALTER TABLE `dbsnp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `canonical_transcript_2` (`rs_id`,`ensm_transcript_id`,`variation`) USING BTREE,
  ADD KEY `ensm_transcript_id` (`ensm_transcript_id`),
  ADD KEY `rs_id` (`rs_id`);

--
-- Indexes for table `diseases_genes`
--
ALTER TABLE `diseases_genes`
  ADD PRIMARY KEY (`dg_id`),
  ADD KEY `gene_id` (`gene_id`);

--
-- Indexes for table `disease_info`
--
ALTER TABLE `disease_info`
  ADD PRIMARY KEY (`di_id`),
  ADD UNIQUE KEY `disease_id` (`disease_id`),
  ADD KEY `disease_name` (`disease_name`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`domain_id`),
  ADD KEY `transcript_id` (`transcript_id`);

--
-- Indexes for table `domains_desc`
--
ALTER TABLE `domains_desc`
  ADD PRIMARY KEY (`domain_desc_id`),
  ADD UNIQUE KEY `pfam_id` (`pfam_id`);

--
-- Indexes for table `gnomad`
--
ALTER TABLE `gnomad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `canonical_transcript_2` (`canonical_transcript`,`variation`,`rs_number`),
  ADD KEY `canonical_transcript` (`canonical_transcript`),
  ADD KEY `ensg_id` (`ensg_id`),
  ADD KEY `rs_number` (`rs_number`),
  ADD KEY `consequence` (`consequence`),
  ADD KEY `is_canon` (`is_canon`);

--
-- Indexes for table `go_annotation`
--
ALTER TABLE `go_annotation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `term_gene_id` (`go_term_acc`,`gene_name`,`gene_id`,`go_term_evidence_code`) USING BTREE,
  ADD KEY `gene_id` (`gene_id`);

--
-- Indexes for table `homology`
--
ALTER TABLE `homology`
  ADD PRIMARY KEY (`homology_id`);

--
-- Indexes for table `human_celegans_orthologous`
--
ALTER TABLE `human_celegans_orthologous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `human_refseq` (`Human_Protein_ID`(191)),
  ADD KEY `worm_refseq` (`C_elegans_Protein_ID`(191)),
  ADD KEY `mouse_refseq` (`Mouse_Protein_ID`(191)),
  ADD KEY `msa_index` (`msa_index`(191));

--
-- Indexes for table `human_mouse_orthologous`
--
ALTER TABLE `human_mouse_orthologous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `human_refseq` (`Human_Protein_ID`(191)),
  ADD KEY `mouse_refseq` (`Mouse_Protein_ID`(191)),
  ADD KEY `worm_refseq` (`C_elegans_Protein_ID`(191));

--
-- Indexes for table `mapping_human`
--
ALTER TABLE `mapping_human`
  ADD PRIMARY KEY (`mh_id`),
  ADD UNIQUE KEY `gene_id` (`gene_id`);

--
-- Indexes for table `mouse_variants`
--
ALTER TABLE `mouse_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msa`
--
ALTER TABLE `msa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msa_best_combination`
--
ALTER TABLE `msa_best_combination`
  ADD PRIMARY KEY (`msa_id`),
  ADD UNIQUE KEY `msa_id` (`msa_id`,`convart_gene_id`);

--
-- Indexes for table `msa_gene`
--
ALTER TABLE `msa_gene`
  ADD PRIMARY KEY (`msa_id`,`convart_gene_id`),
  ADD KEY `convart_gene_id` (`convart_gene_id`),
  ADD KEY `msa_id` (`msa_id`);

--
-- Indexes for table `msa_old`
--
ALTER TABLE `msa_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ncbi_gene_meta`
--
ALTER TABLE `ncbi_gene_meta`
  ADD PRIMARY KEY (`ncbi_gene_id`,`meta_key`,`meta_value`),
  ADD KEY `meta_key` (`meta_key`),
  ADD KEY `meta_value` (`meta_value`),
  ADD KEY `ncbi_gene_id_2` (`ncbi_gene_id`);

--
-- Indexes for table `proxies`
--
ALTER TABLE `proxies`
  ADD PRIMARY KEY (`proxy`);

--
-- Indexes for table `ptm`
--
ALTER TABLE `ptm`
  ADD KEY `ix_ptm_index` (`index_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topmed`
--
ALTER TABLE `topmed`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `canonical_transcript_2` (`rs_id`,`ensm_transcript_id`,`variation`) USING BTREE,
  ADD KEY `ensm_transcript_id` (`ensm_transcript_id`),
  ADD KEY `rs_id` (`rs_id`);

--
-- Indexes for table `tubulin_mutations`
--
ALTER TABLE `tubulin_mutations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `38clinvar`
--
ALTER TABLE `38clinvar`
  MODIFY `clinvar_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `community_variants`
--
ALTER TABLE `community_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conservation_scores`
--
ALTER TABLE `conservation_scores`
  MODIFY `cs_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `convart_gene`
--
ALTER TABLE `convart_gene`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CosmicMutantExport`
--
ALTER TABLE `CosmicMutantExport`
  MODIFY `cme_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbsnp`
--
ALTER TABLE `dbsnp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diseases_genes`
--
ALTER TABLE `diseases_genes`
  MODIFY `dg_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disease_info`
--
ALTER TABLE `disease_info`
  MODIFY `di_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `domain_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains_desc`
--
ALTER TABLE `domains_desc`
  MODIFY `domain_desc_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gnomad`
--
ALTER TABLE `gnomad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `go_annotation`
--
ALTER TABLE `go_annotation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homology`
--
ALTER TABLE `homology`
  MODIFY `homology_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `human_celegans_orthologous`
--
ALTER TABLE `human_celegans_orthologous`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `human_mouse_orthologous`
--
ALTER TABLE `human_mouse_orthologous`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mapping_human`
--
ALTER TABLE `mapping_human`
  MODIFY `mh_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mouse_variants`
--
ALTER TABLE `mouse_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `msa`
--
ALTER TABLE `msa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `msa_old`
--
ALTER TABLE `msa_old`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topmed`
--
ALTER TABLE `topmed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tubulin_mutations`
--
ALTER TABLE `tubulin_mutations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
