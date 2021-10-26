<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die(  );
    }
?>

<?php
    function uploadImages($con,$images,$MSHH,$pathFolder){   
        $imagesName = $images['name'];
        $imagesTmpPath = $images['tmp_name'];
        $length = count($imagesName);
        $isSuccess = true;

        for ($i =0 ;$i<$length; $i++) {
            $imageName = $imagesName[$i];
            $ext = pathinfo($imageName, PATHINFO_EXTENSION);
            $tmpPath = $imagesTmpPath[$i];
            $imgID = uniqid('image'); 
            
            $imageName = $imgID. '.' . $ext;
            $query = "INSERT INTO `hinhhanghoa`(`MSHH`, `TenHinh`) VALUES ('$MSHH','$imageName')";
            $result = $con->query($query); 
            if (!$result) {

                $isSuccess = false;
                break;
            }
            $path = $pathFolder.$imageName;
            move_uploaded_file($tmpPath,$path);
        }

        return $isSuccess;
    }
?>