#!/usr/bin/env php

<?php

require_once 'backup2google.php';

$fileToDelete = $_SERVER['argv'][1];

$service = new DriveServiceHelper( CLIENT_ID, SERVICE_ACCOUNT_NAME, KEY_PATH );

if($fileToDelete == "all") {
    printf( " Deleting all files and folders in Google Drive " );
    $service->deleteAllFiles();
}

else {
    $id = $service->getFileIdByName($fileToDelete);
    if($id) {
        printf( " Deleting %s from Google Drive ", $fileToDelete );    
        $service->deleteFile($id);
    }
    else {
        printf( " %s does not exist on google drive ", $fileToDelete );
    }
}



