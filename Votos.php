<?php

Class Votos extends FIMAZConfig{

  function __construct(){
    FIMAZConfig::dbConnect();
  }

  function login($user,$pass){

    $pass = hash('sha256', $pass);
    $results = $this->db->get_results("SELECT * FROM alumnos WHERE usuario='$user' AND password='$pass' AND status='1'");
    
    if(isset($results['0']->id_alumno)){
    
      $_SESSION['me']['id'] = $results['0']->id_alumno;
      return true;
    
    }else{      
      return false;
    
    }

  }

  function getUser(){

  }

  function me(){

    if(isset($_SESSION['me']['id']) && $_SESSION['me']['id']>=1){
      $id_alumno = $_SESSION['me']['id'];

      $results = $this->db->get_results("SELECT * FROM alumnos WHERE id_alumno='$id_alumno' AND status='1'");
      return $results['0'];
    }

    return false;

  }

  function checarVoto($id_votante,$sexo){
    $results = $this->db->get_results("SELECT count(*) as cuenta FROM votos WHERE id_votante='$id_votante' AND sexo='$sexo'");
    
    if($results['0']->cuenta>=1) return true;
    
    return false;
  }

  function sumarVoto($id_votante,$id_votante,$sexo){
    $results = $this->db->query("INSERT INTO votos (id_votante,id_votado,sexo) VALUES ('$id_votante', '$id_votado', '$sexo');");
    return ($results);
  }

  function show($id){
    $results = $this->db->get_results("SELECT * FROM alumnos WHERE id='$id'");
    return ($results['0']);
  }

  function masVotados(){
    $results = $this->db->get_results("SELECT count(id_voto) as total, b.nombre, b.apellido_paterno, b.apellido_materno FROM votos a INNER JOIN alumnos b ON a.id_votante=b.id_alumno GROUP BY id_votado ORDER BY total DESC");
    return ($results);
  }
  
  function getAvatar($email){
    $default = 'http://i.imgur.com/b8SsaWn.png';
    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=128";
  }

}