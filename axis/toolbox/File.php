<?php

namespace app\axis\toolbox;

use app\config\Message;

class File {
    /**
     * uploaded_file
     * @param array $file_data 
     * @return boolean $result
     */
	  function uploadFile($file_data) {
        $result = false;
        if (empty($file_data['upfile']['full_path'])) {
            $_SESSION['msg'] = 'No files have been uploaded.';
            header('Location: /index');
            exit();
        } 
        if($file_data['upfile']['error'] !== UPLOAD_ERR_OK){
            $msg = [
              'UPLOAD_ERR_INT_SIZE'   => Message::UPLOAD_ERR['INT_SIZE'],
              'UPLOAD_ERR_PARTIAL'    => Message::UPLOAD_ERR['PARTIAL'],
              'UPLOAD_ERR_NO_FILE'    => Message::UPLOAD_ERR['NO_FILE'],
              'UPLOAD_ERR_NO_TMP_DIR' => Message::UPLOAD_ERR['NO_TMP_DIR'],
              'UPLOAD_ERR_CANT_WRITE' => Message::UPLOAD_ERR['CANT_WRITE'],
              'UPLOAD_ERR_EXTENSION'  => Message::UPLOAD_ERR['EXTENSION'],
            ];

            $err_msg = $msg[$file_data['upfile']['error']];
        }else if(!in_array(strtolower(pathinfo($file_data['upfile']['name'])['extension']),
          ['gif','jpg', 'jpeg', 'png']))
        {
            $err_msg = Message::UPLOAD_ERR['NOT_IMAGE'];
        }else if(!in_array(finfo_file(
            finfo_open(FILEINFO_MIME_TYPE),$file_data['upfile']['tmp_name']),
            ['image/gif','image/jpg', 'image/jpeg', 'image/png']))
        {
          //Whether the file content is an image or not.
            $err_msg = Message::UPLOAD_ERR['NOT_IMAGE'];
        }else{
            $src  = $file_data['upfile']['tmp_name']; //temporary file path
            $dest = $file_data['upfile']['name']; 
          /**
           * move_uploaded_file
           * @param string $src　       temporary file path
           * @param string [path].$dest destination to save to
           */

          if(!move_uploaded_file($src, 'storage/doc/'.$dest)){
            $err_msg = Message::UPLOAD_ERR['FAILED'];
          }else{
            $result = true;
          }
        }

        return $result;
    }
}
?>