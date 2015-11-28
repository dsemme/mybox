<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require('./Upload.class.php');

        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($form && $form['sendImg']):
            $upload = new Upload();
            $imagem = $_FILES['imagem'];
            $upload->Img($imagem, 300);
        endif;
        ?>

        <form name="formUploads" action="" method="post" enctype="multipart/form-data">
            <label>
                <input type="file" name="imagem">
            </label>
            <input type="submit" name="sendImg" value="Enviar imagem" />
        </form>
    </body>
</html>
