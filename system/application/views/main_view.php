<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Boas Vindas - <?php echo $titulo ?></title>
    </head>
    <body>
        <h1>Seja Bem Vindo, <?php echo $usuario ?>!</h1>

        <div><?php echo $this->session->flashdata("msg");?></div>
        
        <div>
            <?php
            echo form_open("maincontroller/adicionar");
            echo form_fieldset("Conjuntos de Campos em nosso FORM");
            echo "Usuário: ";
            echo form_input("login");
            echo "Senha: ";
            echo form_password("senha");
            echo form_fieldset_close();
            echo form_submit("submit", "Enviar");
            echo form_close();
            ?>
        </div>

        <?php
        echo "<pre>";
        foreach ($usuarios as $key => $usuario) {
            if ($usuario->id == 1) {
                continue;
            }
            
            echo "id: " . $usuario->id . "<br />",
                 "id_perfil: " . $usuario->id_perfil . "<br />",
                 "login: " . $usuario->login . "<br />",
                 "senha: " . $usuario->senha . "<br />";
            echo anchor("maincontroller/delete/".$usuario->id, "delete") . " | ";
            echo anchor("maincontroller/editar/".$usuario->id, "editar") . "<hr />";
        }
        ?>

    </body>
</html>
