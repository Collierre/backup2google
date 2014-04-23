<?php

require_once 'config.php';

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';

class DriveServiceHelper {
	
	protected $scope = array('https://www.googleapis.com/auth/drive');
	
	private $_service;
	
	public function __construct( $clientId, $serviceAccountName, $key ) {
		$client = new Google_Client();
		$client->setClientId( $clientId );
		
		$client->setAssertionCredentials( new Google_AssertionCredentials(
				$serviceAccountName,
				$this->scope,
				file_get_contents( $key ) )
		);
		
		$this->_service = new Google_DriveService($client);
	}
	
	public function __get( $name ) {
		return $this->_service->$name;
	}
	
	public function createFile( $name, $mime, $description, $content, Google_ParentReference $fileParent = null ) {
		$file = new Google_DriveFile();
		$file->setTitle( $name );
		$file->setDescription( $description );
		$file->setMimeType( $mime );
		
		if( $fileParent ) {
			$file->setParents( array( $fileParent ) );
		}
		
		$createdFile = $this->_service->files->insert($file, array(
				'data' => $content,
				'mimeType' => $mime,
		));
		
		return $createdFile['id'];
	}
	
	public function createFileFromPath( $path, $description, Google_ParentReference $fileParent = null ) {
		$fi = new finfo( FILEINFO_MIME );
		$mimeType = explode( ';', $fi->buffer(file_get_contents($path)));
		$fileName = preg_replace('/.*\//', '', $path );
		
		return $this->createFile( $fileName, $mimeType[0], $description, file_get_contents($path), $fileParent );
	}
	
	
	public function createFolder( $name, Google_ParentReference $folderParent = null ) {
		return $this->createFile( $name, 'application/vnd.google-apps.folder', null, null, $folderParent);
	}
	
	public function setPermissions( $fileId, $value, $role = 'writer', $type = 'user' ) {
		$perm = new Google_Permission();
		$perm->setValue( $value );
		$perm->setType( $type );
		$perm->setRole( $role );
		
		$this->_service->permissions->insert($fileId, $perm);
	}
	
	public function getFileIdByName( $name, $parentId = null ) {
		$files = $this->_service->files->listFiles();
		foreach( $files['items'] as $item ) {
			if( $item['title'] == $name && ($parentId == null || $parentId == $item['parents'][0]['id'] )) {
				return $item['id'];
			}
		}
		
		return false;
	}

    public function deleteFile( $id ) {
        $this->_service->files->delete( $id );
    }
    
    public function deleteAllFiles() {
        $files = $this->_service->files->listFiles();
        foreach ($files['items'] as $item ) {
            $this->_service->files->delete($item['id']);
        }
    }

}
