<?php
require 'config.php';
$title = (empty($_POST['title'])?'Imagem': $_POST['title']);
$keywords = $_POST['keyword'];
$index = 0;
$image['images'] = array();
foreach($_FILES as $img):
    $newTitle = $title .' '. ($index === 0?'':$index);
        $Ext = 'jpg';
        switch ($img['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $Ext = 'jpg';
                break;
            case 'image/png':
            case 'image/x-png':
                $Ext = 'png';                
                break;
        endswitch;

    $Nome = md5(time().rand(0,9999));
    $data = date('m/d');
    $img = new getImage($img['tmp_name'], $Nome, $Ext,$data,'');
    $userImg = new userImages();
    $userImg->insert($newTitle, $keywords, $data, $Nome.'.'.$Ext);
    $image['images'][] = ['title'=>$newTitle,'src'=>$data,'name'=>$Nome.'.'.$Ext];
    $index++;
endforeach;
echo json_encode($image);


