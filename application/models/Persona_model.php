<?php

class Persona_model extends CI_Model{
    
    function __Construct(){
        parent::__Construct();
    }

    public function listaPersona(){
        $consulta   =   $this->db->get('persona');
        return $consulta->result();
    }

    public function insertarPersona($nombre,$apellido,$edad,$direccion,$pass){

        $data   =   array(
            'nombre'    =>  $nombre,
            'apellido'  =>  $apellido,
            'edad'  =>  $edad,
            'direccion' =>  $direccion,
            'pass'  =>  $pass
        );

        $this->db->insert('persona',$data);
        $num    =   $this->db->affected_rows();
        return $num;
    }

    public function actualizarPersona($id,$nombre,$apellido){
        $data   =   array(
            'nombre'    =>  $nombre,
            'apellido'  =>  $apellido
        );
        $this->db->where('id_persona', $id);
        $this->db->update('persona',$data);
        $num    =   $this->db->affected_rows();
        return $num;
    }

    public function eliminarPersona($id)
    {
        $this->db->where('id_persona', $id);
        $this->db->delete('persona');
    }
}
?>