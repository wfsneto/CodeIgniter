<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario_model
 *
 * @author walmir-neto
 */
class usuario_model extends Model {
    //put your code here

    public function getAll () {
//        $query = $this->db->query("SELECT * FROM usuarios");
        $query = $this->db->get("usuarios");
        return $query->result();
    }

    public function find ($id) {
        $this->db->where("id", $id);
        $query = $this->db->get("usuarios");
        return $query->row(0);
    }

    public function add ($usuarios = array()) {
        
        $query = $this->db->insert("usuarios", $usuarios);
        return $this->db->affected_rows();
    }

    public function delete () {

        $this->db->where("id", $this->uri->segment(3));
        $query = $this->db->delete("usuarios");
        return $this->db->affected_rows();
    }

    public function update ($usuario = array()) {

        $this->db->set("login",$usuario["login"]);
        $this->db->set("senha",$usuario["senha"]);

        $this->db->where("id", $usuario["id"]);
        $query = $this->db->update("usuarios");
        return $this->db->affected_rows();
    }

    public function get_usuario ($login, $senha) {

        $this->db->where("login", $login);
        $this->db->where("senha", $senha);
        $query = $this->db->get("usuarios");
        return $query->row(0);
    }

    public function login ($usuario = array()) {

        $usuario = $this->get_usuario($usuario["login"], $usuario["senha"]);

        if (!$usuario) {
            return false;
        }
        return true;
    }
}
?>
