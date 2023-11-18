<?php

class MARIAAreaDAO {

    public function getListArea(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT iId, vDescripcion FROM area WHERE iEstado = 1 ORDER BY vDescripcion DESC;";
        $pr= $connection->prepare($sql);
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function registrarArea($nombre){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="INSERT INTO area (vDescripcion, iEstado) VALUES (?,1);";
        $pr=$connection->prepare($sql);
        $pr->bindParam(1, $nombre, PDO::PARAM_STR);

        if($pr->execute()){
            return true;
        }else{
            return false;
        }
        
    }

    public function editarArea($nombre, $id){

        try{

            $factoryConnection = FactoryConnection::create('mysql');
            $connection = $factoryConnection->getConnection();

            $sql="UPDATE area SET vDescripcion = ? WHERE iId = ?;";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $nombre, PDO::PARAM_STR);
            $pr->bindParam(2, $id, PDO::PARAM_INT);

            $pr->execute();

            return true;

        } catch(Exception $ex){
            return false;
        }
    }

    public function eliminarOficina($id){

        try{

            $factoryConnection = FactoryConnection::create('mysql');
            $connection = $factoryConnection->getConnection();

            $sql="DELETE FROM area WHERE iId = ?;";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $id, PDO::PARAM_INT);

            $pr->execute();

            return true;

        } catch(Exception $ex){
            return false;
        }
    }

}
