-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 28 Nis 2019, 17:32:49
-- Sunucu sürümü: 10.1.36-MariaDB
-- PHP Sürümü: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `current_project`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `clinvar`
--

CREATE TABLE `clinvar` (
  `clinvar_id` int(11) NOT NULL,
  `gene_id` int(11) NOT NULL,
  `allele_id` int(11) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `rs_number` varchar(255) NOT NULL,
  `rcv_accession` varchar(255) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `variant_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nm_id` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `variation` varchar(255) NOT NULL,
  `clinical_significance` varchar(255) NOT NULL,
  `last_updated` varchar(255) NOT NULL,
  `phenotypes` varchar(255) NOT NULL,
  `cytogenetic` varchar(255) NOT NULL,
  `review_status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `conservation_scores`
--

CREATE TABLE `conservation_scores` (
  `cs_id` int(11) NOT NULL,
  `aminoacid_number` int(11) NOT NULL,
  `specie` varchar(255) NOT NULL,
  `transcript_id_specie` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `score_type` varchar(255) NOT NULL,
  `transcript_id` varchar(255) NOT NULL,
  `gene_symbol` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `convart_gene`
--

CREATE TABLE `convart_gene` (
  `id` varchar(32) NOT NULL,
  `sequence` text NOT NULL,
  `species_id` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `convart_gene_to_db`
--

CREATE TABLE `convart_gene_to_db` (
  `convart_gene_id` varchar(50) NOT NULL,
  `db` varchar(25) NOT NULL,
  `db_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `CosmicMutantExport`
--

CREATE TABLE `CosmicMutantExport` (
  `cme_id` int(11) NOT NULL,
  `gene_name` varchar(255) DEFAULT NULL,
  `accession_number` varchar(255) DEFAULT NULL,
  `gene_cds_length` int(11) DEFAULT NULL,
  `hgnc_id` varchar(255) DEFAULT NULL,
  `sample_name` varchar(255) DEFAULT NULL,
  `id_sample` int(11) DEFAULT NULL,
  `id_tumour` int(11) DEFAULT NULL,
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
  `position` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `diseases_genes`
--

CREATE TABLE `diseases_genes` (
  `dg_id` int(11) NOT NULL,
  `gene_id` int(11) NOT NULL,
  `disease_id` varchar(255) NOT NULL,
  `dsi` float NOT NULL,
  `dpi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `disease_info`
--

CREATE TABLE `disease_info` (
  `di_id` int(11) NOT NULL,
  `disease_id` varchar(255) NOT NULL,
  `disease_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `domains`
--

CREATE TABLE `domains` (
  `domain_id` int(11) NOT NULL,
  `transcript_id` varchar(255) NOT NULL,
  `pfam_id` varchar(255) NOT NULL,
  `pfam_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `start_point` int(11) NOT NULL,
  `end_point` int(11) NOT NULL,
  `bitscore` float NOT NULL,
  `evalue` varchar(10) NOT NULL,
  `clan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `domains_desc`
--

CREATE TABLE `domains_desc` (
  `domain_desc_id` int(11) NOT NULL,
  `pfam_id` varchar(11) NOT NULL,
  `pfam_name` varchar(255) NOT NULL,
  `domain_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gnomad`
--

CREATE TABLE `gnomad` (
  `id` int(11) NOT NULL,
  `consequence` varchar(255) NOT NULL,
  `ensg_id` varchar(255) NOT NULL,
  `canonical_transcript` varchar(255) NOT NULL,
  `variation` varchar(255) NOT NULL,
  `filters` varchar(255) NOT NULL,
  `rs_number` varchar(255) NOT NULL,
  `variant_id` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `allele_count` int(11) NOT NULL,
  `allele_number` int(11) NOT NULL,
  `allelle_frequency` int(11) NOT NULL,
  `flags` varchar(255) NOT NULL,
  `datasets` varchar(512) NOT NULL,
  `is_canon` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `homology`
--

CREATE TABLE `homology` (
  `homology_id` int(11) NOT NULL,
  `human_gene_id` int(11) NOT NULL,
  `chimp_gene_id` varchar(255) NOT NULL,
  `macaque_gene_id` varchar(255) NOT NULL,
  `rat_gene_id` varchar(255) NOT NULL,
  `mouse_gene_id` varchar(255) NOT NULL,
  `zebrafish_gene_id` varchar(255) NOT NULL,
  `frog_gene_id` varchar(255) NOT NULL,
  `fruitfly_gene_id` varchar(255) NOT NULL,
  `worm_gene_id` varchar(255) NOT NULL,
  `yeast_gene_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mapping_human`
--

CREATE TABLE `mapping_human` (
  `mh_id` int(11) NOT NULL,
  `gene_id` int(11) NOT NULL,
  `other_ids` varchar(255) NOT NULL,
  `gene_symbol` varchar(255) NOT NULL,
  `gene_synonyms` varchar(255) NOT NULL,
  `protein_numbers` varchar(255) NOT NULL,
  `gene_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `msa`
--

CREATE TABLE `msa` (
  `id` int(11) NOT NULL,
  `fasta` mediumtext COLLATE latin1_bin NOT NULL,
  `alignment_method` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `msa_best_combination`
--

CREATE TABLE `msa_best_combination` (
  `msa_id` int(11) NOT NULL,
  `convart_gene_id` varchar(32) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `msa_gene`
--

CREATE TABLE `msa_gene` (
  `msa_id` int(11) NOT NULL,
  `convart_gene_id` varchar(32) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ncbi_gene_meta`
--

CREATE TABLE `ncbi_gene_meta` (
  `id` int(11) NOT NULL,
  `ncbi_gene_id` int(11) NOT NULL,
  `meta_key` varchar(50) NOT NULL,
  `meta_value` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ptm`
--

CREATE TABLE `ptm` (
  `index_id` bigint(20) DEFAULT NULL,
  `gene` text,
  `protein` text,
  `acc_id` varchar(32) DEFAULT NULL,
  `hu_chr_loc` text,
  `mod_rsd` text,
  `site_grp_id` bigint(20) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `species`
--

CREATE TABLE `species` (
  `id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `clinvar`
--
ALTER TABLE `clinvar`
  ADD PRIMARY KEY (`clinvar_id`),
  ADD KEY `gene_id` (`gene_id`),
  ADD KEY `gene_id_2` (`gene_id`),
  ADD KEY `gene_id_3` (`gene_id`);

--
-- Tablo için indeksler `conservation_scores`
--
ALTER TABLE `conservation_scores`
  ADD PRIMARY KEY (`cs_id`),
  ADD KEY `transcript_id` (`transcript_id`);

--
-- Tablo için indeksler `convart_gene`
--
ALTER TABLE `convart_gene`
  ADD PRIMARY KEY (`id`),
  ADD KEY `species` (`species_id`);
ALTER TABLE `convart_gene` ADD FULLTEXT KEY `sequence` (`sequence`);

--
-- Tablo için indeksler `convart_gene_to_db`
--
ALTER TABLE `convart_gene_to_db`
  ADD PRIMARY KEY (`convart_gene_id`,`db`,`db_id`),
  ADD KEY `db` (`db`),
  ADD KEY `db_id` (`db_id`);

--
-- Tablo için indeksler `CosmicMutantExport`
--
ALTER TABLE `CosmicMutantExport`
  ADD PRIMARY KEY (`cme_id`),
  ADD KEY `accession_number` (`accession_number`);

--
-- Tablo için indeksler `diseases_genes`
--
ALTER TABLE `diseases_genes`
  ADD PRIMARY KEY (`dg_id`),
  ADD KEY `gene_id` (`gene_id`);

--
-- Tablo için indeksler `disease_info`
--
ALTER TABLE `disease_info`
  ADD PRIMARY KEY (`di_id`),
  ADD UNIQUE KEY `disease_id` (`disease_id`),
  ADD KEY `disease_name` (`disease_name`);

--
-- Tablo için indeksler `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`domain_id`),
  ADD KEY `transcript_id` (`transcript_id`);

--
-- Tablo için indeksler `domains_desc`
--
ALTER TABLE `domains_desc`
  ADD PRIMARY KEY (`domain_desc_id`),
  ADD UNIQUE KEY `pfam_id` (`pfam_id`);

--
-- Tablo için indeksler `gnomad`
--
ALTER TABLE `gnomad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `variant_id` (`variant_id`),
  ADD KEY `canonical_transcript` (`canonical_transcript`),
  ADD KEY `ensg_id` (`ensg_id`),
  ADD KEY `rs_number` (`rs_number`),
  ADD KEY `consequence` (`consequence`),
  ADD KEY `is_canon` (`is_canon`);

--
-- Tablo için indeksler `homology`
--
ALTER TABLE `homology`
  ADD PRIMARY KEY (`homology_id`);

--
-- Tablo için indeksler `mapping_human`
--
ALTER TABLE `mapping_human`
  ADD PRIMARY KEY (`mh_id`),
  ADD UNIQUE KEY `gene_id` (`gene_id`);

--
-- Tablo için indeksler `msa`
--
ALTER TABLE `msa`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `msa_best_combination`
--
ALTER TABLE `msa_best_combination`
  ADD PRIMARY KEY (`msa_id`),
  ADD KEY `convart_gene_id` (`convart_gene_id`);

--
-- Tablo için indeksler `msa_gene`
--
ALTER TABLE `msa_gene`
  ADD PRIMARY KEY (`msa_id`,`convart_gene_id`),
  ADD KEY `convart_gene_id` (`convart_gene_id`),
  ADD KEY `msa_id` (`msa_id`);

--
-- Tablo için indeksler `ncbi_gene_meta`
--
ALTER TABLE `ncbi_gene_meta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ncbi_gene_id` (`ncbi_gene_id`,`meta_key`,`meta_value`),
  ADD KEY `meta_value` (`meta_value`),
  ADD KEY `meta_key` (`meta_key`),
  ADD KEY `convart_gene_id` (`ncbi_gene_id`);

--
-- Tablo için indeksler `ptm`
--
ALTER TABLE `ptm`
  ADD KEY `ix_ptm_index` (`index_id`);

--
-- Tablo için indeksler `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `clinvar`
--
ALTER TABLE `clinvar`
  MODIFY `clinvar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `conservation_scores`
--
ALTER TABLE `conservation_scores`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `CosmicMutantExport`
--
ALTER TABLE `CosmicMutantExport`
  MODIFY `cme_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `diseases_genes`
--
ALTER TABLE `diseases_genes`
  MODIFY `dg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `disease_info`
--
ALTER TABLE `disease_info`
  MODIFY `di_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `domains`
--
ALTER TABLE `domains`
  MODIFY `domain_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `domains_desc`
--
ALTER TABLE `domains_desc`
  MODIFY `domain_desc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `gnomad`
--
ALTER TABLE `gnomad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `homology`
--
ALTER TABLE `homology`
  MODIFY `homology_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `mapping_human`
--
ALTER TABLE `mapping_human`
  MODIFY `mh_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `msa`
--
ALTER TABLE `msa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ncbi_gene_meta`
--
ALTER TABLE `ncbi_gene_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

