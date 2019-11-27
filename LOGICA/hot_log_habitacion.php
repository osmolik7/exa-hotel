<?Php 
/**
 * Logica de las paginas que tienen que ver con clientes
 *
 * @author Alejandro Camacho
 * @version 1.0
 *
 * @package hotel.LOGICA
 */
require_once("hot_sql_habitacion.php");

/* Clase para conexion a la capa de acceso a datos */
class Class_Log_Conexion_Hab extends MysqlConexion{ }//Fin de clase Class_Log_Conexion

/* Clase para acceder a los datos */
class Class_Log_Datos_Hab extends MysqlDatosContab{
    function __construct(){
        $this->setSentencias('sentencias_cli');
 	}
}

 ?>