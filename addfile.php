#!/usr/bin/env php

<?php

require("backup2google.php");

if( $_SERVER['argc'] < 2 ) {
	echo "ERROR: no file selected\n";
	die();
}

$path = $_SERVER['argv'][1];
$frequency = $_SERVER['argv'][2];

printf( "Uploading %s to Google Drive\n", $path );

$service = new DriveServiceHelper( CLIENT_ID, SERVICE_ACCOUNT_NAME, KEY_PATH );

$topFolderId = $service->getFileIdByName( BACKUP_ID . "_db_backups" );

if( ! $topFolderId ) {
	echo "Creating main folder on Google Drive...\n";
	$topFolderId = $service->createFolder( BACKUP_ID . "_db_backups" );
	$service->setPermissions( $topFolderId, SHARE_WITH_GOOGLE_EMAIL );
}

$topParent = new Google_ParentReference();
$topParent->setId( $topFolderId );

$frequencyFolderId = $service->getFileIdByName( $frequency, $topFolderId );

if( ! $frequencyFolderId ) {
    echo "Creating frequency folder on Google Drive...\n";
	$frequencyFolderId = $service->createFolder( $frequency, $topParent );
}

$fileParent = new Google_ParentReference();
$fileParent->setId( $frequencyFolderId );

$fileId = $service->createFileFromPath( $path, $path, $fileParent );

printf( "File: %s created on Google Drive\n", $fileId );

$service->setPermissions( $fileId, SHARE_WITH_GOOGLE_EMAIL );
