<?php
    function query($query) {
        global $conn; 
        $result = mysqli_query($conn, $query);
        if(!is_bool($result) && mysqli_num_rows($result) > 0)
        {
            $res = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $res[] = $row;
            }
    
            return $res;
        }
    
        return false;
    }
    function getImageType($blobData) {
        $signature = substr($blobData, 0, 4); // Get the first 4 bytes (magic number)
    
        // Check for JPEG or JPG
        if ($signature === "\xFF\xD8\xFF\xE0" || $signature === "\xFF\xD8\xFF\xE1") {
            return 'image/jpeg';
        }
    
        // Check for PNG
        if ($signature === "\x89\x50\x4E\x47") {
            return 'image/png';
        }
    
        return null; // Unknown image type
    }
    function getImageSrc($profile) {
        $mimeType = getImageType($profile);
    
        if ($mimeType === 'image/jpeg' || $mimeType === 'image/png') {
            // Convert blob to base64
            $base64Image = base64_encode($profile);
    
            // Create a data URI for the image
            $dataUri = 'data:' . $mimeType . ';base64,' . $base64Image;
        } else {
            // Handle unknown image type
            $dataUri = null;
        }
        return $dataUri;
    }
?>