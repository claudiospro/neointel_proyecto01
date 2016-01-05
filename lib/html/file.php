<?php
print 'a';
class File{
    public static function save_image($path, $image, $name) {
        print 'b';
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $image["name"]);
        $extension = end($temp);

        if ((($image["type"] == "image/gif") || ($image["type"] == "image/jpeg") ||
                ($image["type"] == "image/jpg") || ($image["type"] == "image/pjpeg") ||
                ($image["type"] == "image/x-png") || ($image["type"] == "image/png")) &&
                ($image["size"] < 20000) &&
                in_array($extension, $allowedExts)) {
            if ($image["error"] <= 0) {
                move_uploaded_file(
                        $image["tmp_name"]
                        , $path . $name.'.'.$extension
                );
            }
        }
    }
}
