Google Drive DB backup
======================

Command line utility to do periodic (e.g. daily / weekly / monthly) mysql database backups, and to clone these to a Google Drive account (http://systemsarchitect.net/automated-backups-to-google-drive-with-php-api/)

Google drive part forked from from https://github.com/lukaszkujawa/cp2google (http://systemsarchitect.net/automated-backups-to-google-drive-with-php-api/)

Syntax:
======

    $ ./db_drive_backup.sh period backupsnum
	$ php addfile.php /path/to/file
	$ php deletefile.php /path/to/file

Requirements:
============

* PHP CURL extension

Requires config.php in the same directory as cp2google.php in the following form:

	<?php

	define( 'BACKUP_FOLDER', '' );
	define( 'SHARE_WITH_GOOGLE_EMAIL', '' );
	define( 'CLIENT_ID', '' );
	define( 'SERVICE_ACCOUNT_NAME', '' );
	define( 'KEY_PATH', '');

BACKUP_FOLDER – path to top level backup folder. Will be created if doesn't exist
SHARE_WITH_GOOGLE_EMAIL – your google account.
CLIENT_ID – your project’s client id
SERVICE_ACCOUNT_NAME – your project’s account name. It’s called e-mail address on the console page.
KEY_PATH – path to the downloaded private key.
