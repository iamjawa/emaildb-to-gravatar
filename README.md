# emaildb-to-gravatar
A PHP script that takes Email Addresses from a MySQL Database and saves their Gravatars as JPG's. This was initially created in order to
change a website from a Gravatar based avatar system to a manual upload system, and so to save time we needed the JPG's of the current
user's Gravatars which we could use for their accounts on the new system. However, with almost 1500 users, we needed a solution that was
simple and flexible. That's when this script was written.

The "script.php" is the script itself. All you need to provide is the MySQL database and the Emails. I've recently updated the script, meaning that it also cleans up after itself by removing all of the empty directories and files that are created when people have not assigned a Gravatar to their email address, making the script run much more efficiently. 

For reference, this is the MySQL database structure I was using with this project:<br><br>
Database: emails<br>
Table: addresses<br>
Columns: ID, address<br>

Thanks to <a href="http://www.reddit.com/u/akeniscool">reddit.com/u/akeniscool</a> for some awesome general advice on how to improve this script.
