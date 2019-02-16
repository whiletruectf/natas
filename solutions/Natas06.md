# Natas 6 Solution

Natas6 has a view source code link. We notice that the site simply checks if the submitted text is equal to
a variable. The variable isn't defined in the source code, but rather an include file.

http://natas6.natas.labs.overthewire.org/index-source.html:
```php
<?

include "includes/secret.inc";

    if(array_key_exists("submit", $_POST)) {
        if($secret == $_POST['secret']) {
        print "Access granted. The password for natas7 is <censored>";
    } else {
        print "Wrong secret";
    }
    }
?>
```

Simply head to [http://natas6.natas.labs.overthewire.org/includes/secret.inc](http://natas6.natas.labs.overthewire.org/includes/secret.inc),
and the secret is available right there.

```
http://natas6.natas.labs.overthewire.org/includes/secret.inc:

<?
$secret = "FOEIUWGHFEEUHOFUOIU";
?>
```

Submit `FOEIUWGHFEEUHOFUOIU` to the site to get the password.

**Username: natas7**  
**Password: 7z3hEENjQtflzgnT29q7wAvMNfZdh0i9**
