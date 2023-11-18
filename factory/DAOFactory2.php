<?php

class  DAOFactory {

    public static function getDAOUsuario ( ) {
        return new MYSQLUsuarioDAO ;
    }
	
}
?>