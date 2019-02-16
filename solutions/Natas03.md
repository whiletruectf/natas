# Natas 3 Solution

In Inspect Element, we notice an interesting comment:

```
<!-- No more information leaks!! Not even Google will find it this time... -->
```

Googlebot is a web crawler that Google Search uses to index the web. The [`robots.txt`](http://www.robotstxt.org/robotstxt.html)
file gives instructions to web crawlers on which pages of the websites should be *indexed*,
or available as a result to a search.

If robots.txt disallows a file, then it won't be indexed, hence `not even Google will find it`.

We head to [natas3.natas.labs.overthewire.org/robots.txt](http://natas3.natas.labs.overthewire.org/robots.txt) to see 
there are any pages of note.

http://natas3.natas.labs.overthewire.org/robots.txt:
```
User-agent: *
Disallow: /s3cr3t/
```

[/s3cr3t/](http://natas3.natas.labs.overthewire.org/s3cr3t/) lists the file [`users.txt`](http://natas3.natas.labs.overthewire.org/s3cr3t/users.txt), which contains the password.

http://natas3.natas.labs.overthewire.org/s3cr3t/users.txt:
```
natas4:Z9tkRkWmpt9Qr7XrR5jWRkgOU901swEZ
```


**Username: natas4**  
**Password: Z9tkRkWmpt9Qr7XrR5jWRkgOU901swEZ**
