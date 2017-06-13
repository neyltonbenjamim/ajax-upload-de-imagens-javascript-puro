<?php

/**
 * imagem.class [IMAGEM]
 * Descricao
 * @copyright (c) 2016, Neylton Benjamim 
 */
class Imagem {

    private $Width;
    private $Height;
    private $NewWidth;
    private $NewHeight;
    private $Src;
    private $Resolucao;

    public function Resolucao($Src, $Width = null, $Height = null) {
        $this->Src = $Src;
        $this->Resolucao = getimagesize($this->Src);
        if ($this->Resolucao) {
            $this->Width = $this->Resolucao[0];
            $this->Height = $this->Resolucao[1];

            if (isset($Width) && !isset($Height)) {

                $this->Largura($this->Width, $this->Height, $Width);
            } else if (!isset($Width) && isset($Height)) {

                $this->Altura($this->Width, $this->Height, $Height);
                
            } else if (isset($Width) && isset($Height)) {

                $this->Personalizado($Width, $Height);
                
            } else {
                $this->Padrao();
            }
            $this->LimparMemoria();
            return $arr = ['width' => $this->NewWidth, 'height' => $this->NewHeight];
        } else {
            return false;
        }
    }

    private function Largura($width, $height, $newWidth) {
        $por = (100 * $newWidth / $width) / 100;
        $newRes = ['width' => (int) round($por * $width), 'height' => (int) round($por * $height)];
        $this->NewWidth = $newRes['width'];
        $this->NewHeight = $newRes['height'];
    }

    private function Altura($width, $height, $newHeight) {
        $por = (100 * $newHeight / $height) / 100;
        $newRes = ['width' => (int) round($por * $width), 'height' => (int) round($por * $height)];
        $this->NewWidth = $newRes['width'];
        $this->NewHeight = $newRes['height'];
    }

    private function Personalizado($newWidth, $newHeight) {
        $newRes = ['width' => $newWidth, 'height' => $newHeight];
        $this->NewWidth = $newRes['width'];
        $this->NewHeight = $newRes['height'];
    }

    private function Padrao() {
        $this->NewWidth = $this->Width;
        $this->NewHeight = $this->Height;
    }
    private function LimparMemoria(){
        $this->Resolucao = null;
        $this->Width = null;
        $this->Height = null;
        $this->Src = null;
    }

}
