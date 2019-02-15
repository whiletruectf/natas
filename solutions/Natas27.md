# Natas 27 Solution

TODO, basically:

- Notice username max length is 64
- Notice while loop
- MySQL will truncate everything past 64 characters when inserting
- When comparing two strings, trailing whitespace is ignored

See:
- https://bugs.mysql.com/bug.php?id=64772
- https://www.davidpashley.com/2009/02/15/silently-truncated/

Solution:
1. Create a new user with username `natas28` followed by a lot of whitespace, followed by some non-whitespace, with a known password
2. Log in with username `natas28` and the password above

**Username: natas28**  
**Password: JWwR438wkgTsNKBbcJoowyysdM82YjeF**
