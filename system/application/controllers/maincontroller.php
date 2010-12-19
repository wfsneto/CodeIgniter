<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Maincontroller
 *
 * @author walmir-neto
 */
class Maincontroller extends Controller {

    function Maincontroller() {
        parent::Controller();
    }

    function index() {
        $this->load->view("login_view");
    }

    function listar() {
        //$this->load->view('welcome_message');
        //$usuario = "Walmir Neto";
        //$this->bemvindousuario($usuario);

        $data = array (
            "titulo"=>"Título do TUTORIAL",
            "usuario"=>"Walmir Neto",
        );

        $this->load->model("usuario_model");
        $data["usuarios"] = $this->usuario_model->getAll();

//        $this->load->helper("form");
        $this->load->view("main_view", $data);
    }

    function bemvindousuario ($usuario) {
        //$this->load->view('welcome_message');
        echo "Oi, ". $usuario;
    }

    function adicionar () {

        $this->load->model("usuario_model");
        $data = array(
            "login" => $this->input->post("login"),
            "senha" => sha1($this->input->post("senha")),
            "id_perfil" => 1,
        );

        if ($this->usuario_model->add($data)) {
            $this->session->set_flashdata("msg","Usuario Criado com Sucesso!");
            redirect("maincontroller");
        }
    }

    function editar ($id) {

        $this->load->model("usuario_model");

        $data["usuario"] = $this->usuario_model->find($id);

        $this->form_validation->set_rules("login", "login","trim|required");
        if ($this->form_validation->run()) {
//            $this->session->set_flashdata("msg","Registro Apagado!");
            $_POST["id"] = $id;
            if ($this->usuario_model->update($_POST)) {
                $this->session->set_flashdata("msg","Usuario Editado com Sucesso!");
                redirect("maincontroller");
            }
        } else {
            $this->session->set_flashdata("msg","Usuario não foi editado!");
        }

        $this->load->view("update_view", $data);
    }

    function delete () {

        $this->load->model("usuario_model");

        if ($this->usuario_model->delete($data)) {
            $this->session->set_flashdata("msg","Registro Apagado!");
            redirect("maincontroller");
        }
    }

    public function login () {
        $this->form_validation->set_rules("login", "login","trim|required|valid_email|callback__check_login");
        if ($this->form_validation->run()) {
            $this->session->set_flashdata("msg","Você estar logado");
            redirect("maincontroller");
        } else {
            $this->load->view("login_view");
        }
    }

    public function _check_login ($login) {
        if ($this->input->post("senha")) {
            $this->load->model("usuario_model");
            $usuario = $this->usuario_model->get_usuario($login, $this->input->post("senha"));

            if ($usuario) {
                return true;
            }
        }
        $this->form_validation->set_message("_check_login", "Login e/ou Senha Invalida");
        return false;
    }

    public function email () {
        $config = array(
            "protocol" => "smtp",
            "smtp_host" => "smtp.live.com",
            "smtp_user" => "wfsnt@hotmail.com",
            "smtp_pass" => "Agripina",
        );

        $this->load->library("email", $config);

        $this->email->initialize($config);
        $this->email->from("wfsnt@hotmail.com");
        $this->email->to("wfsneto@gmail.com");
        $this->email->subject("Assunto Email");
        $this->email->message("Mensagem do Email com Ação");
        $this->email->send();
        
        echo $this->email->print_debugger();
    }

}

?>
