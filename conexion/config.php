<?php

class config {

    private $host;
    private $user;
    private $password;
    private $db;
    private $dns;
    //private $option;
    public function  __construct() {
        
        $this->host='localhost';
        $this->user='iestperasmo';
        $this->password='Firefox2021';
        $this->db='iestperasmo_gesdocumentaria';
        $this->port='3306';
        $this->dns='mysql:dbname='.($this->db).';port='.($this->port).';host='.($this->host);
    }

    public function setHost ( $host ) {
        $this->host=$host;
    }
    public function getHost () {
        return $this->host;
    }

    public function setUser ( $user ) {
        $this->user=$user;
    }
    public function getUser ( ) {
        return $this->user;
    }

    public function setPassword ( $password ) {
        $this->password=$password;
    }
    public function getPassword () {
        return $this->password;
    }

    public function setDb ( $db ) {
        $this->db=$db;
    }
    public function getDb ( ) {
        return $this->db;
    }

    public function setDns ( $dns ) {
        $this->dns=$dns;
    }
    public function getDns ( ) {
        return $this->dns;
    }

    /*public function setOption ( $option ) {
			$this->option=$option;
		}
		public function getOption ( ) {
			return $this->option;
		}*/
}