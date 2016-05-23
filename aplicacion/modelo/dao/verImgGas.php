<?php

$pr_id = $_GET['pr_id'];
$ca_id = $_GET['ca_id'];
$cat_id = $_GET['cat_id'];
$si_id = $_GET['si_id'];
$ga_id = $_GET['ga_id'];

ob_clean();
$dbhost5 = "localhost";
$dbuser6 = "postgres";
$dbpwd7 = "sasa";
$dbname8 = "utn_tur";

$linkz = pg_connect("host=$dbhost5 user=$dbuser6 password=$dbpwd7 dbname=$dbname8") or die(pg_last_error($linkz));
$sql = "select ga_id,ga_archivo_nombre,ga_mime,size, coalesce(ga_archivo_oid,-1) as ga_archivo_oid,
	coalesce(ga_archivo_bytea,'-1') as ga_archivo_bytea from gastronomia where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND ga_id=$ga_id";

$result = pg_query($linkz, $sql);

if (!$result || pg_num_rows($result) < 1) {
    header("Location: admgastronomia.php");
    exit();
}
$row = pg_fetch_array($result, 0);
pg_free_result($result);
$isoid = false;
if ($row['archivo_bytea'] == -1)
    $isoid = true;
if ($row['ga_archivo_bytea'] == -1)
    die('No existe el archivo para mostrar o bajar');
if ($isoid) {
    pg_query($linkz, "begin");
    $file = pg_lo_open($linkz, $row['ga_archivo_oid'], "r");
} else {
    $file = pg_unescape_bytea($row['ga_archivo_bytea']);
}
//header("Cache-control: private");
ob_clean();
header("Content-type: $row[ga_mime]");
//if ($f == 1)
//    header("Content-Disposition: attachment; filename=\"$row[fo_archivo_nombre]\"");
header("Content-length: $row[ga_size]");
if ($isoid) {
    pg_lo_read_all($file);
    pg_lo_close($file);
    pg_query($linkz, "commit");
} else {
    echo $file;
}
pg_close($linkz);
?>