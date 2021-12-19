<?php
require_once('config.php');
require_once('functions.php');
/* */

if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
}
if (!$captcha) {
    //echo '<h2>Please verify you are not robot!</h2>';
    header("Location: index.php?err=verify_robot"); 
    exit();
}

$check_point = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdZMaMUAAAAAG9OsWBShn5P1ykVd1f3EAIYbWt4&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']));

if ($check_point->success == false) {
    //echo '<h2>Spam!!!!!</h2>';
    header("Location: index.php?err=verify_robot");
    exit;
}

if (! isset($_REQUEST['sequence'])){
    exit;
}
$randomFilename = '/tmp/'.uniqid();
file_put_contents($randomFilename, $_REQUEST['sequence']);

$result = shell_exec("blastp -query $randomFilename -db '/var/opt/blast_db/convart_curated_fasta.fasta' -outfmt 6 -num_threads 1");
$result = explode("\n", $result);
$id = explode("\t", $result[0])[1];

$humanGeneDetails = getGeneDetailsById($id, true);

$humanRandomFilename = '/tmp/'.uniqid();

$outputRandomFilename = '/tmp/'.uniqid();

file_put_contents($humanRandomFilename, ">{$id} [Homo sapiens]\n".$humanGeneDetails['sequence']);
function cmd_exec($cmd, &$stdout, &$stderr)
{
    $outfile = tempnam(".", "cmd");
    $errfile = tempnam(".", "cmd");
    $descriptorspec = array(
        0 => array("pipe", "r"),
        1 => array("file", $outfile, "w"),
        2 => array("file", $errfile, "w")
    );
    $proc = proc_open($cmd, $descriptorspec, $pipes);
    
    if (!is_resource($proc)) return 255;

    fclose($pipes[0]);    //Don't really want to give any input

    $exit = proc_close($proc);
    $stdout = file($outfile);
    $stderr = file($errfile);

    unlink($outfile);
    unlink($errfile);
    return $exit;
}

cmd_exec("needle  -asequence {$randomFilename} -bsequence {$humanRandomFilename} -gapopen 10.0 -gapextend 0.5 -endopen 10.0 -endextend 0.5 -sprotein1 -adesshow3 -sprotein2 -aformat3 fasta -outfile $outputRandomFilename", $stdout, $stderr);

var_dump($stderr);
var_dump($stdout);
print('<h1>TEST</h1>');

$fasta = file_get_contents($outputRandomFilename);
var_dump([$humanGeneDetails['convart_gene_id']]);

if (!empty($humanGeneDetails['convart_gene_id'])) {
    $msaId = createMSA($fasta, [$humanGeneDetails['convart_gene_id']], 'pairwise');
    header("Location: ".$GLOBALS['base_url'].'msa?id='.$id. "&msa_id=".$msaId);
} else {
    header("Location: https://convart.org/msa?id=NOGENE");
}

unlink($randomFilename);
unlink($humanRandomFilename);
unlink($outputRandomFilename);


