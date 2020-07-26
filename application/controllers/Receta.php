<?php

session_start();
$_SESSION["arrayDetalle"]=null;
$_SESSION["id_receta"]=null;
class Receta extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('receta_model');
        $this->load->model('detalle_model');
    }

    public function index(){
        
        $persona = $this->receta_model->listaPaciente();
        $data= array(
            'header'=>'section/header',
            'sidebar'=>'section/sidebar',
            'content' => 'receta/receta_view' ,
            'persona' =>  $persona
        );
         
        $this->load->view('master/master',$data);
    }

    public function indexDetalle($id_detalle){
        $mostrarDetalle=true;
        $listadoR = $this->receta_model->listaReceta();
        $Detalle = $this->detalle_model->listaDetalle($id_detalle);
        $Medicamento = $this->detalle_model->listaMedicamento();
        $persona = $this->receta_model->listaPaciente();
        $data= array(
          
            'header'=>'section/header',
            'sidebar'=>'section/sidebar',
            'content' => 'receta/listado_receta' ,
            'medicamento'   =>   $Medicamento,
            'listadoR' => $listadoR,
            'persona' =>  $persona,
            'detalle'   =>  $Detalle,
            'mostrarD'  =>  $mostrarDetalle,
            "idDetalle" =>  $id_detalle
            
        );     
        $this->load->view('master/master',$data);
    }

    public function listadoReceta(){
        $mostrarDetalle=false;
        $listadoR = $this->receta_model->listaReceta();
        $persona = $this->receta_model->listaPaciente();
        $data= array(
            'header'=>'section/header',
            'sidebar'=>'section/sidebar',
            'content' => 'receta/listado_receta',
            'listadoR' => $listadoR,
            'persona' =>  $persona,
            'mostrarD'  =>  $mostrarDetalle
        );
        $this->load->view('master/master',$data);
    }

    public function insertar(){

        include_once "funcion_injection.php";
        $imgFile = $_FILES['image2']['name'];
        $tmp_dir = $_FILES['image2']['tmp_name'];
        $imgSize = $_FILES['image2']['size'];
        $upload_dir = 'img/'; // upload directory 
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $userpic = rand(1000,1000000).".".$imgExt;
        move_uploaded_file($tmp_dir,$upload_dir.$userpic);

        $idP =   $this->input->post('id_persona');
        $fecha =   $this->input->post('datepicker');
        if(injection($idP) || injection($fecha))
        {
            $mostrarDetalle=false;
            $listadoR = $this->receta_model->listaReceta();
            $persona = $this->receta_model->listaPaciente();
            $data= array(
                'header'=>'section/header',
                'sidebar'=>'section/sidebar',
                'content' => 'receta/listado_receta',
                'listadoR' => $listadoR,
                'persona' =>  $persona,
                'mostrarD'  =>  $mostrarDetalle,
                'sqlInjection' =>  "mostrar"
            );
           
            $this->load->view('master/master',$data);
        }
        else
        {
            if($imgFile)
            {
                $resultado  =   $this->receta_model->insertarReceta($idP,$fecha,$userpic);
            }
            else
            {
                $resultado  =   $this->receta_model->insertarReceta($idP,$fecha,"default.png");
            }
           
            if($resultado=1)
            {
                redirect('/receta/listadoReceta','refresh');
            }
        }
       
    }

    public function AgregarDetalle(){
        $id_receta =   $this->input->post('modalidreceta');
        $id_medicamento =  $this->input->post('modalMedicamentoAgregar');
        $cantidad =  $this->input->post('modalcantidadAgregar');
        include_once "funcion_injection.php";

        if(injection($id_medicamento) || injection($cantidad))
        {
            $mostrarDetalle=false;
            $listadoR = $this->receta_model->listaReceta();
            $persona = $this->receta_model->listaPaciente();
            $data= array(
                'header'=>'section/header',
                'sidebar'=>'section/sidebar',
                'content' => 'receta/listado_receta',
                'listadoR' => $listadoR,
                'persona' =>  $persona,
                'mostrarD'  =>  $mostrarDetalle,
                'sqlInjection' =>  "mostrar"
            );
           
            $this->load->view('master/master',$data);
        }
        else
        {
            $resultado  =   $this->detalle_model->agregarDet($id_receta,$id_medicamento,$cantidad);
            if($resultado=1)
            {
                redirect("/receta/indexDetalle/$id_receta",'refresh');
            }
        }
    }

    public function EditarDetalle(){
        $id_receta =   $this->input->post('modalidreceta');
        $id_detalle =   $this->input->post('modaliddetalleEdit');
        $id_medicamento =  $this->input->post('modalMedicamentoEdit');
        $cantidad =  $this->input->post('modalcantidadEdit');
        include_once "funcion_injection.php";
        if(injection($id_medicamento) || injection($cantidad))
        {
            $mostrarDetalle=false;
            $listadoR = $this->receta_model->listaReceta();
            $persona = $this->receta_model->listaPaciente();
            $data= array(
                'header'=>'section/header',
                'sidebar'=>'section/sidebar',
                'content' => 'receta/listado_receta',
                'listadoR' => $listadoR,
                'persona' =>  $persona,
                'mostrarD'  =>  $mostrarDetalle,
                'sqlInjection' =>  "mostrar"
            );
           
            $this->load->view('master/master',$data);
        }
        else
        {
            $resultado  =   $this->detalle_model->editarDet($id_detalle,$id_medicamento,$cantidad);
            if($resultado=1)
            {
                redirect("/receta/indexDetalle/$id_receta",'refresh');
            } 
        }
        
    }  

    public function EliminarDetalle(){
        $id_receta =   $this->input->post('id_detalleShow');
        $id_detalle =   $this->input->post('id_detalle_receta');
        $resultado  =   $this->detalle_model->eliminarDet($id_detalle);  
    }  

    public function actualizar(){
        try {
            $resultado;
            $imgFile = $_FILES['image']['name'];
            $tmp_dir = $_FILES['image']['tmp_name'];
            $imgSize = $_FILES['image']['size'];
            $idReceta =   $this->input->post('modalidreceta');
            $idPersona =   $this->input->post('modalPaciente');
            $fecha =   $this->input->post('modalFecha');
            $img =   $this->input->post('imgDel');

            include_once "funcion_injection.php";
           
            if(injection($fecha) || injection($idPersona) || injection($img) )
            {
               
                $mostrarDetalle=false;
                $listadoR = $this->receta_model->listaReceta();
                $persona = $this->receta_model->listaPaciente();
                $data= array(
                    'header'=>'section/header',
                    'sidebar'=>'section/sidebar',
                    'content' => 'receta/listado_receta',
                    'listadoR' => $listadoR,
                    'persona' =>  $persona,
                    'mostrarD'  =>  $mostrarDetalle,
                    'sqlInjection' =>  "mostrar"
                );
               
                $this->load->view('master/master',$data);
            }
            else
            {
                if($imgFile)
                {
                    $upload_dir = 'img/'; // upload directory 
                    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
                    $userpic = rand(1000,1000000).".".$imgExt;
                    move_uploaded_file($tmp_dir,$upload_dir.$userpic);

                    $resultado  =   $this->receta_model->actualizarReceta($idReceta,$idPersona,$fecha,$userpic);
                }
                else
                {
                    $resultado  =   $this->receta_model->actualizarReceta($idReceta,$idPersona,$fecha,0);
                }
                if($resultado=1 && $imgFile && $img!="default.png")
                {
                    unlink('img/'.$img);
                    redirect('/receta/listadoReceta','refresh');
                }
                else
                {
                    redirect('/receta/listadoReceta','refresh');
                }
            }
                
        } catch (\Throwable $th) {
        }
    }

    public function eliminar(){
        $data =   $this->input->post('id_receta');
        $img    =   $this->input->post('img');
        $resultado  = $this->receta_model->eliminarReceta($data);
        if($resultado=1 && $img!="default.png")
        {
            unlink('img/'.$img);
           
        }
    }

    public function eliminarImg(){
       
        $id_receta =   $this->input->post('id_receta');
        $img =   $this->input->post('img');
        $resultado  =   $this->receta_model->eliminarImage($id_receta);
        if($resultado=1 && $img!="default.png")
        {
            unlink('img/'.$img);
        }
    }
}
	
?>