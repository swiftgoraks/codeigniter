<?php

class Detalle_model extends CI_Model{
    
    function __Construct(){
        parent::__Construct();
    }    

    public function listaDetalle($id_receta){
        return $this->db->query("Select id_detalle_receta,id_receta,medicamento,cantidad,d.id_medicamento FROM detalle_receta d INNER JOIN 
        medicamento m ON d.id_medicamento=m.id_medicamento WHERE id_receta=$id_receta")->result();

    }

    public function listaMedicamento(){
        $consulta = $this->db->get('medicamento');
        return $consulta->result();
    }

    public function agregarDet($idReceta,$idMedicamento,$cantidad){

        $data   =   array(
            'id_receta'    =>  $idReceta,
            'id_medicamento'  =>  $idMedicamento,
            'cantidad'    =>  $cantidad
        );

        $this->db->insert('detalle_receta',$data);
        $num    =   $this->db->affected_rows();
        return $num;
    }

    public function editarDet($id_receta,$id_medicamento,$cantidad){
        $data   =   array(
            'id_medicamento'  =>  $id_medicamento,
            'cantidad'   =>  $cantidad
        );

        $this->db->where('id_detalle_receta', $id_receta);
        $this->db->update('detalle_receta',$data);
        $num    =   $this->db->affected_rows();
        return $num;
    }

    public function eliminarDet($idDetalleReceta)
    {
        $this->db->where('id_detalle_receta', $idDetalleReceta);
        $this->db->delete('detalle_receta');
    }
}
?>