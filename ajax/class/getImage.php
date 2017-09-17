<?php

/**
 * Description of getImage
 *
 * @author Neylton Benjamim
 */
class getImage {

    private $Width;
    private $Height;
    private $Image;
    private $Name;
    private $Ext;
    private $Src;
    private $Type;
    private $Id;

    /** @var Imagem */
    private $ClassImage;
    private $ImageMax;
    private $ImageMedia;
    private $ImageMini;

    private $miniHeight;

    private $Caminho;

    public function __construct($Src, $Nome, $Ext, $Id = 'upload',$Caminho = '') {
        $this->Id = $Id;
        $this->Src = $Src;
        $this->Name = $Nome;
        $this->Ext = $Ext;
        $this->Caminho = $Caminho;

        $imgSize = getimagesize($this->Src);
        $this->Width = $imgSize[0];
        $this->Height = $imgSize[1];
        $this->Type = $imgSize['mime'];
        $this->criarImage();
    }

    private function criarImage() {
        $this->Resoulcao();
        $this->Posicao();
        $this->CreateFolder($this->Id);
        $this->Type($this->Ext);

        $image_original = imagecreatetruecolor($this->Width,$this->Height); 
        $image_mini = imagecreatetruecolor($this->miniHeight['width'], $this->miniHeight['height']);
        
        if($this->Ext == 'jpg'):
            $white = imagecolorallocate($image_original, 255, 255,255);
            $white = imagecolorallocate($image_mini, 255, 255, 255);
        else:
            $white = imagecolorallocatealpha($image_original, 0, 0, 0,127);
            $white = imagecolorallocatealpha($image_mini, 0, 0, 0,127);
        endif;

        imagealphablending($image_original, false);
        imagesavealpha($image_original, true); 
        imagefill($image_original, 0, 0, $white);
        

        imagealphablending($image_mini, false);
        imagesavealpha($image_mini, true);        
        imagefill($image_mini, 0, 0, $white);

        imagecopyresampled($image_original, $this->Image, 0, 0, 0, 0, $this->Width, $this->Height, $this->Width, $this->Height);
        
        imagecopyresampled($image_mini, $this->Image, 0,0, 0, 0, $this->ImageMini['width'], $this->ImageMini['height'], $this->Width, $this->Height);


        switch ('image/' . $this->Ext):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($image_original, $this->Caminho."upload/{$this->Id}/original-{$this->Name}." . $this->Ext, 100);

                imagejpeg($image_mini, $this->Caminho."upload/{$this->Id}/mini-{$this->Name}." . $this->Ext, 100);
                break;
            case 'image/png':
            case 'image/x-png':
                imagepng($image_original, $this->Caminho."upload/{$this->Id}/original-{$this->Name}." . $this->Ext, 9);

                imagepng($image_mini, $this->Caminho."upload/{$this->Id}/mini-{$this->Name}." . $this->Ext, 9);
                
                break;
        endswitch;
    }

    private function Posicao() {
        if ($this->Width > $this->Height):
            $this->ImageMini['x'] = 0;

            $this->ImageMini['y'] = (round(35 - $this->ImageMini['height'])) / 2;
        else:
            $this->ImageMini['y'] = 0;
            
            $this->ImageMini['x'] = (round(35 - $this->ImageMini['width'])) / 2;
        endif;
    }

    private function Type($Type) {
        switch ('image/'.$Type):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->Image = imagecreatefromjpeg($this->Src);
                break;
            case 'image/png':
            case 'image/x-png':
                $this->Image = imagecreatefrompng($this->Src);
                break;
        endswitch;
    }

    private function Resoulcao() {
        $this->ClassImage = new Imagem;
        if ($this->Width > $this->Height):
            $this->ImageMini = $this->ClassImage->Resolucao($this->Src, 35);
        else:
            $this->ImageMini = $this->ClassImage->Resolucao($this->Src, null, 35);
        endif;
        $this->miniHeight = $this->ImageMini;
    }

    private function createFolder($Id) {
        $Id = explode('/', $Id);
        if (!file_exists($this->Caminho.'upload/'.$Id[0].'/'.$Id[1])):
        	if(!file_exists($this->Caminho.'upload/'.$Id[0])):
        		mkdir($this->Caminho.'upload/'.$Id[0], 0777);
        	endif;
        	mkdir($this->Caminho.'upload/'.$Id[0].'/'.$Id[1], 0777);
        endif;
    }

    public function getResolucao(){
        return $this->Width.' X '.$this->Height;
    }

}
