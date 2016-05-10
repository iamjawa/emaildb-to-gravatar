# emaildb-to-gravatar
A PHP script that takes Email Addresses from a MySQL Database and saves their Gravatars as JPG's. This was initially created in order to
change a website from a Gravatar based avatar system to a manual upload system, and so to save time we needed the JPG's of the current
user's Gravatars which we could use for their accounts on the new system. However, with almost 1500 users, we needed a solution that was
simple and flexible. That's when this script was written.

The "cleaner.sh" is designed to be run once all of the images have been saved to clear the root directory of all empty folders and files. I'm working on a solution currently that will mean that the images are not saved at all if they do not exist, rather than being saved as
empty files.

For reference, this is the MySQL database structure I was using with this project:<br>
Database: emails<br>
Table: addresses<br>
Columns: ID, address<br>

Thanks to reddit.com/u/akeniscool for some awesome general advice on how to improve this script.
