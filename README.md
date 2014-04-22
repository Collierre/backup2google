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

	define( 'BACKUP_FOLDER', 'eas_db_backups_monthly' );
	define( 'SHARE_WITH_GOOGLE_EMAIL', 'intatexit@gmail.com' );
	define( 'CLIENT_ID', '10958614625-nod57ovmj13j8il1k0gcm47oc50n5spo.apps.googleusercontent.com' );
	define( 'SERVICE_ACCOUNT_NAME', '10958614625-nod57ovmj13j8il1k0gcm47oc50n5spo@developer.gserviceaccount.com' );
	define( 'KEY_PATH', '../google-drive-key/a84dd7cec5923f44f3d8bec5f1d99730027e940a-privatekey.p12');

BACKUP_FOLDER – name of shared folder. The script will create it at the first run.
SHARE_WITH_GOOGLE_EMAIL – your google account.
CLIENT_ID – your project’s client id
SERVICE_ACCOUNT_NAME – your project’s account name. It’s called e-mail address on the console page.
KEY_PATH – path to the downloaded private key.
