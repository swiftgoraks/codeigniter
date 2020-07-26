<?php

class Detalle extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('detalle_model');
    }

    public function index($id_detalle){
       
        $Detalle = $this->detalle_model->listaDetalle($id_detalle);
        $Medicamento = $this->detalle_model->listaMedicamento();
        $data= array(
            'header'=>'section/header',
            'sidebar'=>'section/sidebar',
            'content' => 'receta/listado_receta',
            'medicamento'   =>   $Medicamento,
            'detalle'   =>  $Detalle
            
        );
         
        $this->load->view('master/master',$data);
    }

    public function AgregarDetalle(){
        $id_receta =   $this->input->post('modalidreceta');
        $id_medicamento =  $this->input->post('modalMedicamentoAgregar');
        $cantidad =  $this->input->post('modalcantidadAgregar');
        $resultado  =   $this->detalle_model->agregarDet($id_receta,$id_medicamento,$cantidad);
        if($resultado=1)
        {
            redirect("/detalle/index/$id_receta",'refresh');
        }
        
    }

    public function EditarDetalle(){
        $id_receta =   $this->input->post('modalidreceta');
        $id_detalle =   $this->input->post('modaliddetalleEdit');
        $id_medicamento =  $this->input->post('modalMedicamentoEdit');
        $cantidad =  $this->input->post('modalcantidadEdit');
        $resultado  =   $this->detalle_model->editarDet($id_detalle,$id_medicamento,$cantidad);
        if($resultado=1)
        {
            redirect("/detalle/index/$id_receta",'refresh');
        } 
    }  

    public function EliminarDetalle(){
        $id_receta =   $this->input->post('modalidreceta');
        $id_detalle =   $this->input->post('modaliddetalleEdit');
        $resultado  =   $this->detalle_model->eliminarDet($id_detalle);
        if($resultado=1)
        {
            redirect("/detalle/index/$id_receta",'refresh');
        } 
    }  


}
?>