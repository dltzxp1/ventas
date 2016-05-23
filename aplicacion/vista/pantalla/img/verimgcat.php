<?php

ob_clean();

$dbhost5 = "50.63.244.198";
$dbuser6 = "Userjairo";
$dbpwd7 = "Jairo123";
$dbname8 = "Userjairo";

/* $dbhost5 = "localhost";
  $dbuser6 = "postgres";
  $dbpwd7 = "sasa";
  $dbname8 = "utn_tur"; */

$f = isset($_REQUEST['f']) ? $_REQUEST['f'] : 0;
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

$linkz = pg_connect("host=$dbhost5 user=$dbuser6 password=$dbpwd7 dbname=$dbname8") or die(pg_last_error($linkz));
$sql = "select fo_id,fo_archivo_nombre,fo_mime,size, coalesce(fo_archivo_oid,-1) as fo_archivo_oid,
	coalesce(fo_archivo_bytea,'-1') as fo_archivo_bytea from categoria where fo_id=$id";

$result = pg_query($linkz, $sql);

if (!$result || pg_num_rows($result) < 1) {
    header("Location: admcategoria.php");
    exit();
}
$row = pg_fetch_array($result, 0);
pg_free_result($result);
$isoid = false;
if ($row['archivo_bytea'] == -1)
    $isoid = true;
if ($row['fo_archivo_bytea'] == -1)
    die('No existe el archivo para mostrar o bajar');
if ($isoid) {
    pg_query($linkz, "begin");
    $file = pg_lo_open($linkz, $row['fo_archivo_oid'], "r");
} else {
    $file = pg_unescape_bytea($row['fo_archivo_bytea']);
}
//header("Cache-control: private");
ob_clean();
header("Content-type: $row[fo_mime]");
if ($f == 1)
    header("Content-Disposition: attachment; filename=\"$row[fo_archivo_nombre]\"");
header("Content-length: $row[fo_size]");
if ($isoid) {
    pg_lo_read_all($file);
    pg_lo_close($file);
    pg_query($linkz, "commit");
} else {
    echo $file;
}
pg_close($linkz);
?>
