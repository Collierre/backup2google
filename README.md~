Google Drive DB backup
======================

Command line utility to do periodic (e.g. daily / weekly / monthly) mysql database backups, and to clone these to a Google Drive account (http://systemsarchitect.net/automated-backups-to-google-drive-with-php-api/)

Google drive part forked from from https://github.com/lukaszkujawa/cp2google (http://systemsarchitect.net/automated-backups-to-google-drive-with-php-api/)

Usage:
======

    $ ./db_drive_backup.sh period backupsnum
	$ php addfile.php /path/to/file
	$ php deletefile.php /path/to/file

Requirements:
============

* PHP CURL extension

Installation:
=============

* Download the files
* Make a config.sh in the following form:

    # DB details

    dbname=""
    dbuser=""
    dbpass=""

    bkupdirid="" # ID for your backups directory. E.g. if you give it the id `mysite` the folder will be named `mysite_db_backups`

* Make a config.php in the following form:

	<?php

	define( 'BACKUP_ID', '' ); // ID for top level backup folder. Will be created if doesn't exist, and `_db_backups` will be appended to the ID
	define( 'SHARE_WITH_GOOGLE_EMAIL', '' ); // Your google account.
	define( 'CLIENT_ID', '' ); // Your project’s client id
	define( 'SERVICE_ACCOUNT_NAME', '' ); //  Your project’s account name. It’s called e-mail address on the console page.
	define( 'KEY_PATH', ''); // Path to the downloaded private key.
