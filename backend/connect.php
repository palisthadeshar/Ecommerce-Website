<?php $conn = oci_connect('PALISTHA DESHAR', 'Palistha10599#', '//localhost/xe'); 
// schema name - ANMOLKAR schema password - Nepal123$
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
} else {
    // print "Connected to Oracle!";
}
