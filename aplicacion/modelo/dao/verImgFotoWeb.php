<?php

// Revisar que exista el modulo de pgsql
if (!extension_loaded('pgsql')) {
    // el m�dulo no estaba cargado, trata de cargarlo
    dl('pgsql.so');
}

$pr_id = $_GET['pr_id'];
$ca_id = $_GET['ca_id'];
$cat_id = $_GET['cat_id'];
$si_id = $_GET['si_id'];
$fo_id = $_GET['fo_id'];

$dbConnStr = "host=localhost dbname=utn_tur user=postgres password=sasa";
$conn = pg_connect($dbConnStr);

if (!$conn) {
    echo "Ocurri� un error al intentar conectarse a la base de datos.\n";
    exit;
}

// el header a continuaci�n le indica al browser que el contenido del archivo es una imagen.
// debido al header(), ning�n mensaje de texto (por ejemplo, las llamadas a echo()
// realizadas anteriormente cuando ocurr�a un error) ser� desplegado, debido a que el browser
// pensar� que este archivo es una imagen PNG
header('Content-type: image/png');

// consulta el OID para el cliente con c�digo = 1
$rs = pg_exec($conn, "SELECT fo_archivo_bytea FROM foto WHERE pr_id=$pr_id AND ca_id='$ca_id' AND cat_id='$cat_id' AND si_id='$si_id' AND fo_id='$fo_id'");
$row = pg_fetch_row($rs, 0);

// el uso de pg_lo_open debe estar dentro de una transacci�n, asi que la iniciamos
pg_query($conn, "begin");

// abre el BLOB
$loid = pg_unescape_bytea($conn, $row[0], "r");

// lee todo el contenido del blob (que es el contenido de la imagen) y se lo tira al browser
pg_lo_read_all($loid);

// cierra el objeto
pg_lo_close($loid);

// cierra la transacci�n
pg_query($conn, "commit");

// cierra la conexi�n
pg_close();
?>