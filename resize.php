<?php
    header("Content-type: image/jpeg");
    function redimage($img_src,$dst_w,$dst_h)
    {
        // Lit les dimensions de l'image
        $size = GetImageSize("$img_src");
        $src_w = $size[0];
        $src_h = $size[1];
        // Teste les dimensions tenant dans la zone
        $test_h = round(($dst_w / $src_w) * $src_h);
        $test_w = round(($dst_h / $src_h) * $src_w);
        // Crée une image vierge aux bonnes dimensions
        // $dst_im = ImageCreate($dst_w,$dst_h);
        $dst_im = ImageCreateTrueColor($dst_w, $dst_h);
        // Copie dedans l'image initiale redimensionnée
        $src_im = ImageCreateFromJpeg("$img_src");
        //ImageCopyResized($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
        ImageCopyResampled($dst_im, $src_im, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        // Retourne l'image au navigateur
        ImageJpeg($dst_im);
        // Détruis les tampons
        ImageDestroy($dst_im);
        ImageDestroy($src_im);
    }
    $imageSource = str_replace(' ','_',urldecode($_GET["img"]));
    redimage($imageSource,300,300);
?>