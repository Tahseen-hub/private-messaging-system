<html>
    <head>
        <title>Symetric Encryption Test with OpenSSL</title>
    </head>
    <body>
<?php
//We display a welcome message, if the user is logged, we display it username
$plaintext = "message to be encrypted: THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG + 30 digits: 123456789012345678901234567890";
$cipher = "aes-128-gcm";
$ivlen = openssl_cipher_iv_length($cipher);
echo "Size of block AES-128: ".((string)$ivlen)."<BR>";
$iv     = openssl_random_pseudo_bytes($ivlen);
$key    = openssl_random_pseudo_bytes(16);
$tag    = null;
$method = openssl_get_cipher_methods();
echo "Initial test:\n";
if (in_array($cipher, $method))
{
    echo "Cryptography: ".$plaintext.'<BR>';
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv, $tag);
    echo "Mensagem cifrada (raw): ".$ciphertext_raw.'<BR>';
    echo "Mensagem cifrada (base64): ".base64_encode($ciphertext_raw).'<BR>';
    echo "Gerando MAC:<BR>";
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    echo "Assignature (raw): ".$hmac.'<BR>';
    echo "Assignature (base64): ".base64_encode($hmac).'<BR>';
    $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );    //store $cipher, $iv, and $tag for decryption later
    echo "message ciphered (base64): ".$ciphertext.'<BR>';

    echo "<BR>Decipher:<BR>";
	$c = base64_decode($ciphertext);
	$iv = substr($c, 0, $ivlen);
    echo "Gerando MAC:<BR>";
	$hmac = substr($c, $ivlen, $sha2len=32);
    echo "Assinatura (raw): ".$hmac.'<BR>';
    echo "Assinatura (base64): ".base64_encode($hmac).'<BR>';
	$ciphertext_raw = substr($c, $ivlen+$sha2len);
    echo "Mensagem cifrada (raw): ".$ciphertext_raw.'<BR>';
    echo "Mensagem cifrada (base64): ".base64_encode($ciphertext_raw).'<BR>';
	$decrypted = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv, $tag);
	$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    echo "Verification MAC:<BR>";
	if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
	{
		echo ">>>>>>>>>>>>>>>Text original: ".$decrypted."\n";
	}
	else
	{
		echo "Authentication Succeeded\n";
	}
}
else
{
	echo "Pan\n";
}
?>
	</body>
</html>