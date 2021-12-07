<?php

// use to fetch Movies data
class Movies{
    
    public $db = null;

    // Dependency Injenction
    public function __construct(DBController $db)
    {
        if(!isset($db->con)) return null;
        $this->db = $db;
    }

    // get data from any table of our db
    public function getData($table = 'movies'){
        //Select all the movies from moovie db
        $sql = "SELECT *
                FROM {$table};";
                // ORDER BY release_date

        // make query and get results
        $result = $this->db->con->query($sql);

        // get the result ( fetch)
        // fetch the resulting rows as an associative array
        $movies = $result->fetch_all(MYSQLI_ASSOC);

        return $movies;
    }

    // get movie using item id from
    public function getMovieById($id = null,$table = 'movies'){

        // first we have to escape any sensitive sql charachter to protect our db
        $id = $this->db->con->real_escape_string($id);

        // now lets make a sql to select 1 field only
        $sql = "SELECT * FROM {$table}
                WHERE id={$id}";
        //get the query result        
        $result = $this->db->con->query($sql);
        // fetch result into an assoc array
        // mysqli_fetch_assoc fetches only 1 result
        $movie = $result->fetch_assoc();

        return $movie;
    }

    // Delete Movie by id
    public function deleteMovieById($id = null,$table = 'movies'){

        // first we have to escape any sensitive sql charachter to protect our db
        $id = $this->db->con->real_escape_string($id);

        // now lets make a sql to delete the corresponding field
        $sql = "DELETE FROM {$table} WHERE id={$id}";

        $result = $this->db->con->query($sql);

        if($result){
            //if the delete was succesful lets head to the index page
            header('Location: index.php');
        }
        return $result;
    }

}

?>