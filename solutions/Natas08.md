# Natas 8 Solution

Natas 8 greets us with an input box and an option to view the source code.

http://natas8.natas.labs.overthewire.org/index-source.html:
```php
<?

$encodedSecret = "3d3d516343746d4d6d6c315669563362";

function encodeSecret($secret) {
    return bin2hex(strrev(base64_encode($secret)));
}

if(array_key_exists("submit", $_POST)) {
    if(encodeSecret($_POST['secret']) == $encodedSecret) {
    print "Access granted. The password for natas9 is <censored>";
    } else {
    print "Wrong secret";
    }
}
?>
```

Notice that all it does is encode the user input and compare it to an already encoded
secret. To decode the secret, simply perform the opposite operations in the opposite order.
The `strrev` function reverses a string, so running it on a reversed string will return the original string.

You can run this php using an [online php sandbox](https://wtools.io/php-sandbox):
```php
<?php
$encodedSecret = "3d3d516343746d4d6d6c315669563362";

function decodeSecret($secret) {
    return base64_decode(strrev(hex2bin($secret)));
}
echo decodeSecret($encodedSecret);
?>
```

Simply enter the decoded secrect `oubWYf2kBq` into the input field and submit to get the password.

**Username: natas9**  
**Password: W0mMhUcRRnG8dcghE4qvk3JA9lGt8nDl**
