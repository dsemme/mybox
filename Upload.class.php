<?php

/**
 * @copyright (c) 2015, Daniel S. Melo - DSeMMe Tecnologia
 */
class Upload {

    private $File;
    private $Name;
    private $Width;
    private $Img;
    
    //MÉTODO QUE DEFINE UMA LARGURA PARA A IMAGEM
    
    public function Img(array $Img, $Width = NULL) {
        $this->File = $Img;
        $this->Name = $Img['name'];
        $this->Width = ((int) $Width ? $Width : 1024);

        $this->UploadImg();
    }

    //REALIZANDO O UPLOAD

    private function UploadImg() {
        switch ($this->File['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->Img = imagecreatefromjpeg($this->File['tmp_name']);
                break;
            case 'image/png';
            case 'image/x-png';
                $this->Img = imagecreatefrompng($this->File['tmp_name']);
                break;
        endswitch;

        if (!$this->Img):
            $this->Result = FALSE;
            $this->Error = 'Tipo de arquivo Inválido, envie um formato .jpg ou .png';
        else:
            $x = imagesx($this->Img);
            $y = imagesy($this->Img);
            $ImgX = ($this->Width < $x ? $this->Width : $x);
            $ImgY = ($ImgX * $y) / $x;

            $NewImg = imagecreatetruecolor($ImgX, $ImgY);
            imagealphablending($NewImg, FALSE);
            imagesavealpha($NewImg, TRUE);
            imagecopyresampled($NewImg, $this->Img, 0, 0, 0, 0, $ImgX, $ImgY, $x, $y);

            switch ($this->File['type']):
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewImg, $this->Name);
                    break;
                case 'image/png';
                case 'image/x-png';
                    imagepng($NewImg, $this->Name);
                    break;
            endswitch;

            imagedestroy($this->Img);
            imagedestroy($NewImg);
        endif;
    }

}
