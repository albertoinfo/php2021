<?php
include_once "Usuario.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios : 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos {
    private $stmt_usuarios = null;
    private $stmt_usuario  = null;
    private $stmt_boruser  = null;
    private $stmt_moduser  = null;
    private $stmt_creauser = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor pri$prosuario   = $this->dbh->prepare("select * from Usuarios where login =?");
        if ( $this->stmt_usuario == false) die ($this->dbh->error);

        $this->stmt_boruser   = $this->dbh->prepare("delete from Usuarios where login =?");
        if ( $this->stmt_boruser == false) die ($this->dbh->error);

        $this->stmt_moduser   = $this->dbh->prepare("update Usuarios set nombre=?, password=?, comentario=? where login=?");
        if ( $this->stmt_moduser == false) die ($this->dbh->error);

        $this->stmt_creauser  = $this->dbh->prepare("insert into Usuarios (login,nombre,password,comentario) Values(?,?,?,?)");
        if ( $this->stmt_creauser == false) die ($this->dbh->error);
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static fun$pro la base de datos
            $obj->dbh->close();
            self::$modelo = null; // Borro el objeto.
        }
    }


    // SELECT Devuelvo la lista de Usuarios
    public function getUsuarios ():array {
        $tuser = [];
        
        $this->stmt_usuarios->execute();

        $result = $this->stmt_usuarios->get_result();
        if ( $result ){
            while ( $user = $result->fetch_object('Usuario')){
               $tuser[]= $user;
            }
        }$proodUsuario($user):bool{
      
    
        $this->stmt_moduser->bind_param("ssss",
        $user->nombre,$user->password, $user->comentario, $user->login);
        $this->stmt_moduser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //INSERT
    public function addUsuario($user):bool{
       
        $this->stmt_creauser->bind_param("ssss",$user->login, $user->nombre, $user->password, $user->comentario);
        $this->stmt_c$proreauser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //DELETE
    public function borrarUsuario(String $login):bool {
        $this->stmt_boruser->bind_param("s", $login);
        $this->stmt_boruser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

