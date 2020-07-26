<?php

class Persona extends CI_Controller {

    function __Construct(){
        parent::__Construct();
        $this->load->model('persona_model');
    }

    public function index(){
        $data   =   array(
           'header' =>  'section/header',
           'sidebar'    =>  'section/sidebar',
           'content'    =>  'persona/persona_view'
        );
        $this->load->view('master/master',$data);
    }

    public function listadoPersona(){

        $consulta = $this->persona_model->listaPersona();
        $data= array(
            'header'=>'section/header',
            'sidebar'=>'section/sidebar',
            'content' => 'persona/listado_persona',
            'consulta' => $consulta
        );
         
        $this->load->view('master/master',$data);
    }

    public function insertar(){

        $nombre =   $this->input->get('nombre');
        $apellido =   $this->input->get('apellido');
        $edad =   $this->input->get('edad');
        $direccion =   $this->input->get('direccion');
        $pass =   $this->input->get('pass');
        $resultado  =   $this->persona_model->insertarPersona($nombre,$apellido,$edad,$direccion,$pass);
        if($resultado=1)
        {
            redirect('/persona/','refresh');
        }
    }

    public function actualizar(){
        $id =   $this->input->get('modalidpersona');
        $nombre =   $this->input->get('modalnombre');
        $apellido =   $this->input->get('modalapellido');
        $resultado  =   $this->persona_model->actualizarPersona($id,$nombre,$apellido);
        if($resultado=1)
        {
            redirect('/persona/listadoPersona','refresh');
        }
    }

    public function eliminar(){
       
        $data =   $this->input->post('id_per');
        $this->persona_model->eliminarPersona($data);
        
    }
    
}

?>