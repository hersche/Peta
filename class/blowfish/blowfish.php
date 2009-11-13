<?php
//Usage of the blowfish class
include("blowfish.class.php");



$blowfish = new Blowfish("secret Key");
$cipher = $blow->Encrypt("Hello World");
$plain = $blow->Decrypt($c);

echo "Encrypted: $cipher <br>";
echo "Decrypted: $plain";

?>