<?php

class dtoUsuario {
    private $idUsuario;
    private $idUsuarioServicio;
    private $nombre;
    private $paterno;
    private $materno;
    private $dni;
    private $email;
    private $telefono;
    private $departamento;
    private $circulo;
    private $ubicacion;
    private $genero;
    private $fechaNacimiento;
    private $isPlanilla;
    private $clave;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $usuarioCreacion;
    private $usuarioModificacion;
    private $nombreUsuarioModificacion;
    private $tipoUsuario;
    private $privilegio;
    private $descripcion;
    private $idcirculo;
    private $usuario;
    
    public function dtoUsuario(){
        
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getIdCirculo(){
        return $this->idcirculo;
    }
        
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getIdUsuarioServicio() {
        return $this->idUsuarioServicio;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPaterno() {
        return $this->paterno;
    }

    public function getMaterno() {
        return $this->materno;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function getCirculo() {
        return $this->circulo;
    }

    public function getUbicacion() {
        return $this->ubicacion;
    }


    public function getGenero() {
        return $this->genero;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getIsPlanilla() {
        return $this->isPlanilla;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    public function getFechaModificacion() {
        return $this->fechaModificacion;
    }

    public function getUsuarioCreacion() {
        return $this->usuarioCreacion;
    }

    public function getUsuarioModificacion() {
        return $this->usuarioModificacion;
    }


    public function setUsuario($usuario){
        $this->usuario=$usuario;
    }

    public function setIdCirculo($idcirculo){
        $this->idcirculo=$idcirculo;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setIdUsuarioServicio($idUsuarioServicio) {
        $this->idUsuarioServicio = $idUsuarioServicio;
    }

    public function setDescripcion($descripcion){
        $this->descripcion= $descripcion;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPaterno($paterno) {
        $this->paterno = $paterno;
    }

    public function setMaterno($materno) {
        $this->materno = $materno;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    public function setCirculo($circulo) {
        $this->circulo = $circulo;
    }

    public function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function setIsPlanilla($isPlanilla) {
        $this->isPlanilla = $isPlanilla;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function setFechaModificacion($fechaModificacion) {
        $this->fechaModificacion = $fechaModificacion;
    }

    public function setUsuarioCreacion($usuarioCreacion) {
        $this->usuarioCreacion = $usuarioCreacion;
    }

    public function setUsuarioModificacion($usuarioModificacion) {
        $this->usuarioModificacion = $usuarioModificacion;
    }
    public function setNombreUsuarioModificacion($nombreUsuarioModificacion) {
        $this->nombreUsuarioModificacion = $nombreUsuarioModificacion;
    }


    public function getNombreUsuarioModificacion() {
        return $this->nombreUsuarioModificacion ;
    }

    
    


    
}
