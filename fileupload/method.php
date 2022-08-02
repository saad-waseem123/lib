<?php
$imageFile = $this->request->getFile('pro_img');
if ($imageFile->isValid() && !$imageFile->hasMoved()) {
    $name = $imageFile->getRandomName();
    $imageFile->move(UPLOAD_PATH . '/products', $name);
    $imgName = $name;
} else {
    $imgName = $this->request->getVar('old_pro_img');
}
