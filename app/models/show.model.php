<?php

class ShowModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=circus;charset=utf8', 'root', '');
    }

    /**
     * Obtengo los Shows junto con el Artista
     */
    public function getAllShows($inicioPag, $tamanioPag, $sortedby = "id_artist", $order = "asc")
    {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase
        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT `show`.*, artist.name as `artist` FROM `show` JOIN `artist` ON show.id_artist = artist.id_artist ORDER BY $sortedby $order
        LIMIT $inicioPag,$tamanioPag");
        $query->execute();

        // 3. obtengo los resultados
        $shows = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos

        return $shows;
    }


  
    //obtengo solo los shows sin el artista
    public function getAllShowsNotArtist()
    {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase

        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM `show`");
        $query->execute();

        // 3. obtengo los resultados
        $shows = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos

        return $shows;
    }
    //Obtener el artista por id

    /**
     * Inserta un show en la base de datos.
     */
    public function insertShow($name, $id_artist, $date, $price)
    {
        $query = $this->db->prepare("INSERT INTO `show` (name,id_artist,date, price) VALUES (?, ?, ?,?)");
        $query->execute([$name, $id_artist, $date, $price]);
        return $this->db->lastInsertId();
    }


    function deleteShowById($id_show)
    {
        $query = $this->db->prepare('DELETE FROM `show` WHERE `id_show` = ?');
        $query->execute([$id_show]);
    }

    function updateShowById($name, $id_artist, $date, $price, $id_show)
    {
        $query = $this->db->prepare("UPDATE `show` SET `name`=?,`id_artist`=?,`date`=?,`price`=? WHERE `id_show`=?");
        $query->execute([$name, $id_artist, $date, $price, $id_show]);
    }
    function ShowArtistShowsById($id_artist)
    {
        $query = $this->db->prepare("SELECT * FROM `show` WHERE `id_artist`=?");
        $query->execute([$id_artist]);
        $shows = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $shows;
    }


    function ShowShowDetail($showDetail)
    {
        $query = $this->db->prepare("SELECT `show`.*, artist.name as `artist` FROM `show` JOIN `artist` ON show.id_artist = artist.id_artist WHERE `show`.`id_show`=?");
        $query->execute([$showDetail]);
        $shows = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $shows;
    }

    function getFiltredShows($inicioPag, $tamanioPag, $order, $sortBy,$search)
    {
        $query = $this->db->prepare("SELECT * FROM `show` WHERE $sortBy = ?
                                                              ORDER BY $sortBy $order
                                                              LIMIT $inicioPag,$tamanioPag");
        $query->execute([$search]);

        $shows = $query->fetchAll(PDO::FETCH_OBJ);

        return $shows;
    }
 
    //obtener arreglo de las columnas de las tablas
    function getAllColumns(){
        $query = $this->db->prepare("SELECT COLUMN_NAME 
                                                             FROM INFORMATION_SCHEMA.COLUMNS 
                                                             WHERE TABLE_NAME = N'show'");
        $query->execute();

        $columns = $query->fetchAll(PDO::FETCH_OBJ);

        return $columns;
    }
}
?>