<?php
namespace app\config;

use app\config\Path;

// https://www.php.net/manual/ja/filter.filters.validate.php
class Message {
    const UPLOAD_ERR = [
        'INT_SIZE'    => 'HTML MAX_FILE_SIZE limit exceeded.',
        'PARTIAL'     => 'Only part of the file has been uploaded.',
        'NO_FILE'     => 'File not uploaded',
        'NO_TMP_DIR'  => 'Temporary folder does not exist.',
        'CANT_WRITE'  => 'Failed to write to disc.',
        'EXTENSION'   => 'Upload interrupted by extension module',
        'NOT_IMAGE'   => 'Files other than images cannot be uploaded.',
        'FAILED'      => 'Upload failed.'
    ];  
}
?>