# Natas 28 Solution

We notice that after entering a search query, we are taken to a `search.php` page with a long query string. We can decode this string by using a tool such as [cryptii.com](https://cryptii.com), by first decoding URL encoding, then undoing the base64 encoding.

Submitting an empty string results in the following hex data after decoding the query parameter:

```
1b e8 25 11 a7 ba 5b fd 57 8c 0e ef 46 6d b5 9c 
dc 84 72 8f dc f8 9d 93 75 1d 10 a7 c7 5c 8c f2
e8 7f f6 0c 99 ad 72 cc bd 94 7e 34 17 a9 01 28 
a7 7e 8e d1 aa be 0b 5d 05 c4 ff e6 ac 14 23 ab
47 8e b1 a1 fe 26 1a 2c 6c 15 06 11 09 b3 fe da
```

We can guess that this is some type of encrypted data. After submitting a single `a` character, then two `a` characters, then three, and so on, we can make a few observations.

First, the first 32 bytes are constant, regardless of what we submit.
```
Submitting a single 'a':
1b e8 25 11 a7 ba 5b fd 57 8c 0e ef 46 6d b5 9c    // constant
dc 84 72 8f dc f8 9d 93 75 1d 10 a7 c7 5c 8c f2    // constant
ab 88 0a 8f 13 6f be b9 89 67 89 13 24 a1 b0 75 
bd fa 10 54 ec 68 51 5c f9 6f 2a 55 44 59 19 47
90 4f 4b 2a bf 2c 2d 76 86 aa 72 a5 31 51 c9 70

Submitting two 'a' characters:
1b e8 25 11 a7 ba 5b fd 57 8c 0e ef 46 6d b5 9c    // constant
dc 84 72 8f dc f8 9d 93 75 1d 10 a7 c7 5c 8c f2    // constant
b1 30 a5 31 be c8 9c 70 52 13 bf a5 c9 66 7a c7 
48 79 9a 07 b1 d2 9b 59 82 01 5c 93 55 c2 e0 0e 
ad ed 9b db ac a6 a7 3b 71 b3 5a 01 0d 2c 4c 57
```

Second, the length of hex decoding increases on the thirteenth `a` character we submit:

```
Submitting 12 a's in a row:
1b e8 25 11 a7 ba 5b fd 57 8c 0e ef 46 6d b5 9c 
dc 84 72 8f dc f8 9d 93 75 1d 10 a7 c7 5c 8c f2
c0 87 2d ee 8b c9 0b 11 56 91 3b 08 a2 23 a3 9e
ce 82 a9 55 3b 65 b8 12 80 fb 6d 3b f2 90 0f 47
75 fd 50 44 fd 06 3d 26 f6 bb 7f 73 4b 41 c8 99

Submitting 13 a's in a row:
1b e8 25 11 a7 ba 5b fd 57 8c 0e ef 46 6d b5 9c 
dc 84 72 8f dc f8 9d 93 75 1d 10 a7 c7 5c 8c f2
c0 87 2d ee 8b c9 0b 11 56 91 3b 08 a2 23 a3 9e
1f 74 71 4d 76 fc c5 d4 64 c6 a2 21 e6 ed 98 e4
62 23 a1 4d 9c 42 91 b9 87 75 b0 3f bc 73 d4 ed
d8 ae 51 d7 da 71 b2 b0 83 d9 19 a0 d7 b8 8b 98   // sixth line!
```

Finally, we notice that the thirteenth `a` character added sixteen new bytes. From this we can predict that every 16 characters will add a new line to the data, and we can verify this by submitting more test strings.

```
Submitting 13 a's in a row:
1b e8 25 11 a7 ba 5b fd 57 8c 0e ef 46 6d b5 9c 
dc 84 72 8f dc f8 9d 93 75 1d 10 a7 c7 5c 8c f2
c0 87 2d ee 8b c9 0b 11 56 91 3b 08 a2 23 a3 9e
1f 74 71 4d 76 fc c5 d4 64 c6 a2 21 e6 ed 98 e4
62 23 a1 4d 9c 42 91 b9 87 75 b0 3f bc 73 d4 ed
d8 ae 51 d7 da 71 b2 b0 83 d9 19 a0 d7 b8 8b 98   // six lines

Submitting 29 a's in a row:
1b e8 25 11 a7 ba 5b fd 57 8c 0e ef 46 6d b5 9c 
dc 84 72 8f dc f8 9d 93 75 1d 10 a7 c7 5c 8c f2
c0 87 2d ee 8b c9 0b 11 56 91 3b 08 a2 23 a3 9e 
b3 90 38 c2 8d f7 9b 65 d2 61 51 df 58 f7 ea a3 
1f 74 71 4d 76 fc c5 d4 64 c6 a2 21 e6 ed 98 e4 
62 23 a1 4d 9c 42 91 b9 87 75 b0 3f bc 73 d4 ed 
d8 ae 51 d7 da 71 b2 b0 83 d9 19 a0 d7 b8 8b 98   // seven lines!
```

We can also try to submit a single b followed by 12 a's, and comparing that to submitting 13 a's in a row.

```
Submitting 13 a's in a row:
1b e8 25 11 a7 ba 5b fd 57 8c 0e ef 46 6d b5 9c 
dc 84 72 8f dc f8 9d 93 75 1d 10 a7 c7 5c 8c f2
c0 87 2d ee 8b c9 0b 11 56 91 3b 08 a2 23 a3 9e
1f 74 71 4d 76 fc c5 d4 64 c6 a2 21 e6 ed 98 e4
62 23 a1 4d 9c 42 91 b9 87 75 b0 3f bc 73 d4 ed
d8 ae 51 d7 da 71 b2 b0 83 d9 19 a0 d7 b8 8b 98

Submitting 'baaaaaaaaaaaa':
1b e8 25 11 a7 ba 5b fd 57 8c 0e ef 46 6d b5 9c
dc 84 72 8f dc f8 9d 93 75 1d 10 a7 c7 5c 8c f2 
67 ad e7 12 03 a0 94 94 44 eb 19 f2 29 fd 5e b3   // only this line is different! 
1f 74 71 4d 76 fc c5 d4 64 c6 a2 21 e6 ed 98 e4 
62 23 a1 4d 9c 42 91 b9 87 75 b0 3f bc 73 d4 ed 
d8 ae 51 d7 da 71 b2 b0 83 d9 19 a0 d7 b8 8b 98
```

We notice that only the third line is different, and the remaining lines are the same. This suggests that the encryption is done using [ECB Encryption](https://en.wikipedia.org/wiki/Block_cipher_mode_of_operation#Electronic_Codebook_(ECB)), with a fixed key size of 16 bytes.

Each "block" of 16 bytes is encrypted independently from each other, so changing part of the query string will only affect the 16 bytes of content that is in its block.
