# Natas 3 Solution

By using Inspect Element, we notice a suspicious image:

```
<img src="files/pixel.png">
```

The image is in a `files` subdirectory.

We head to [natas2.natas.labs.overthewire.org/files](http://natas2.natas.labs.overthewire.org/files) to see if there are perhaps more files that can help us. Sure enough, we notice a `users.txt` file.

```
natas2.natas.labs.overthewire.org/files/users.txt:

# username:password
alice:BYNdCesZqW
bob:jw2ueICLvT
charlie:G5vCxkVV3m
natas3:sJIJNW6ucpu6HPZ1ZAchaDtwd7oGrD14
eve:zo4mJWyNj2
mallory:9urtcpzBmH
```

**Username: natas3**  
**Password: sJIJNW6ucpu6HPZ1ZAchaDtwd7oGrD14**
