<?php

class Receta_model extends CI_Model{
    
    function __Construct(){
        parent::__Construct();
    }

    public function listaReceta(){
        $consulta   =   $this->db->query('SELECT r.id_persona,id_receta,nombre,fecha,img FROM RECETA r JOIN persona p ON r.id_persona=p.id_persona');
        return $consulta->result();
    }

    public function listaPaciente(){
        $paciente   =   $this->db->query('SELECT id_persona,nombre FROM persona GROUP BY id_persona');
        return $paciente->result();
    }

    public function insertarReceta($idP,$fecha,$img){

        $data   =   array(
            'id_persona'    =>  $idP,
            'fecha'  =>  $fecha,
            'img'    =>  $img
        );

        $this->db->insert('receta',$data);
        $num    =   $this->db->affected_rows();
        return $num;
    }

    public function actualizarReceta($idReceta,$idP,$fecha,$img){
        if($img==0)
        {
            $data   =   array(
                'id_persona'    =>  $idP,
                'fecha'  =>  $fecha
            );
        }
        else
        {
            $data   =   array(
                'id_persona'    =>  $idP,
                'fecha'  =>  $fecha,
                'img'   =>  $img
            );
        }
        
        $this->db->where('id_receta', $idReceta);
        $this->db->update('receta',$data);
        $num    =   $this->db->affected_rows();
        return $num;
    }

    public function eliminarReceta($idReceta)
    {
        
        $tieneD   =   $this->db->get('detalle_receta');
        $tieneD->result();
        if($tieneD->result())
        {
            $this->db->where('id_receta', $idReceta);
            $this->db->delete('receta');
        }
    }

    public function eliminarImage($idReceta)
    {
       
        $this->db->query("UPDATE receta SET img='default.png' WHERE id_receta=$idReceta");
        $num     =   $this->db->affected_rows();
        return $num;
    }
}
?>