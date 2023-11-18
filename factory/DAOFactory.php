<?php

class  DAOFactory {
   
    public static function getDAOUsuario( $tipo ) {
		$rs = NULL ;
		switch ($tipo) :
			case 'mysql':
				$rs = new MYSQLUsuarioDAO ;
			break;
			case 'maria':
				$rs = new MARIAUsuarioDAO ;
			break;
			case 'pgsql_pdo':
				$rs = new PGSQL_PDOUsuarioDAO ;
			break;
		endswitch;
        return $rs ;
    }

    public static function getDAOArea( $tipo ) {
		$rs = NULL ;
		switch ($tipo) :
			case 'mysql':
				$rs = new MYSQLAreaDAO ;
			break;
			case 'maria':
				$rs = new MARIAAreaDAO ;
			break;
			case 'pgsql_pdo':
				$rs = new PGSQL_PDOAreaDAO ;
			break;
		endswitch;
        return $rs ;
    }

    public static function getDAOSolicitud( $tipo ) {
		$rs = NULL ;
		switch ($tipo) :
			case 'mysql':
				$rs = new MYSQLSolicitudDAO ;
			break;
			case 'maria':
				$rs = new MARIASolicitudDAO ;
			break;
			case 'pgsql_pdo':
				$rs = new PGSQL_PDOSolicitudDAO ;
			break;
		endswitch;
        return $rs ;
    }

    public static function getDAOReporte( $tipo ) {
		$rs = NULL ;
		switch ($tipo) :
			case 'mysql':
				$rs = new MYSQLReporteDAO ;
			break;
			case 'maria':
				$rs = new MARIAReporteDAO ;
			break;
			case 'pgsql_pdo':
				$rs = new PGSQL_PDOReporteDAO ;
			break;
		endswitch;
        return $rs ;
    }
   
}
?>
