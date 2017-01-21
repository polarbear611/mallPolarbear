<?php
    function buildInfo()
    {
        if(!$_FILES)
        {
            return ;
        }
        $files = array();
        $i = 0;
        foreach($_FILES as $f)
        {

            if(is_string($f['name']))
            {
                $files[$i] = $f;
                $i++;
            }
            else
            {
                foreach($f['name'] as $key => $val)
                {
                    $files[$i]['name'] = $val;
                    $files[$i]['size'] = $f['size'][$key];
                    $files[$i]['tmp_name'] = $f['tmp_name'][$key];
                    $files[$i]['error'] =$f['error'][$key];
                    $files[$i]['type'] = $f['type'][$key];
                    $i++;
                }
            }
        }
        return $files;
    }
    function uploadFile($path = "uploads", 
        $allowExt = array("gif", "jpeg", "jpg", "wbmp"),
        $maxSize = 2097152,
        $imgFlag = true)
    {
        if(!file_exists($path))
        {
            mkdir($path, 0777, true);
        }
        $i = 0;
        $files = buildInfo();
        if(!($files && is_array($files)))
        {
            return;
        }
        foreach($files as $file)
        {
            if($file['error'] == UPLOAD_ERR_OK)
            {
                $ext = getExt($file['name']);
                if(!in_array($ext, $allowExt))
                {
                    exit("Illegal file type");
                } if($imgFlag)
                {
                    if(!getimagesize($file['tmp_name']))
                    {
                        exit("Not real image file.");
                    }
                }
                if($file['size'] > $maxSize)
                {
                    exit("Upload file too large");
                }
                if(!is_uploaded_file($file['tmp_name']))
                {
                    exit("File is not upload by HTTP POST way.");
                }
                $filename = getUniName() . "." . $ext;
                $destnation = $path. "/" . $filename;
                if(move_uploaded_file($file['tmp_name'], $destnation))
                {
                    $file['name'] = $filename;
                    unset($file['tmp_name'], 
                        $file['size'], 
                        $file['type']);
					$uploadedFiles[$i] = $file;
                    $i++;
                }
            }
            else
            {
                switch($file['error'])
                {
                case UPLOAD_ERR_INI_SIZE:
                    $mes = "UPLOAD_ERR_INI_SIZE";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $mes = "UPLOAD_ERR_FORM_SIZE";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $mes = "UPLOAD_ERR_PARTIAL";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $mes = "UPLOAD_ERR_NO_TMP_DIR";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $mes = "UPLOAD_ERR_NO_FILE";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $mes = "UPLOAD_ERR_CANT_WRITE";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $mes = "UPLOAD_ERR_EXTENSION";
                    break;
                default:
                    break;
                }
                echo $mes;
            }
        }
    return $uploadedFiles;
    }
?>
