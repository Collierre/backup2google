<?php

require("cp2google.php");

if( $_SERVER['argc'] < 2 ) {
	echo "ERROR: no file selected\n";
	die();
}

$path = $_SERVER['argv'][1];
$frequency = $_SERVER['argv'][2];

printf( "Uploading %s to Google Drive\n", $path );

$service = new DriveServiceHelper( CLIENT_ID, SERVICE_ACCOUNT_NAME, KEY_PATH );

$folderId = $service->getFileIdByName( BACKUP_FOLDER );

if( ! $folderId ) {
	echo "Creating main folder on Google Drive...\n";
	$folderId = $service->createFolder( BACKUP_FOLDER );
	$service->setPermissions( $folderId, SHARE_WITH_GOOGLE_EMAIL );
}

$topParent = new Google_ParentReference();
$topParent->setId( $folderId );

$frequencyFolderId = $service->getFileIdByName( $frequency );

if( ! $frequencyFolderId ) {
    echo "Creating frequency folder on Google Drive...\n";
	$frequencyFolderId = $service->createFolder( $frequency, $topParent );
}

$fileParent = new Google_ParentReference();
$fileParent->setId( $frequencyFolderId );

$fileId = $service->createFileFromPath( $path, $path, $fileParent );

printf( "File: %s created on Google Drive\n", $fileId );

$service->setPermissions( $fileId, SHARE_WITH_GOOGLE_EMAIL );