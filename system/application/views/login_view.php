<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Logon</title>
    </head>
    <body>
        <h1> Seja Bem Vindo, User! </h1>

        <div><?php echo $this->session->flashdata("msg");?></div>
        
        <div>
            <?php
            echo form_open("maincontroller/login");
            echo form_fieldset("Conjuntos de Campos em nosso FORM");
            echo "Usuário: ";
            echo form_input("login");
            echo form_error("login");
            echo "Senha: ";
            echo form_password("senha");
            echo form_error("senha");
            echo form_fieldset_close();
            echo form_submit("submit", "Enviar");
            echo form_close();
            ?>
        </div>
    </body>
</html>
