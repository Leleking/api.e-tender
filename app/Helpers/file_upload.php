<?php
function save_image($image,$folder){
    $image = $image;
    $name = time().'.'.$image->getClientOriginalExtension();
    $destinationPath = public_path($folder);
    $image->move($destinationPath, $name);
    return $name;
}
