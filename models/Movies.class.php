<?php
class Movies extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => '',
    'released_year' => '',
    'rate' => '',
    'unicode' => '',
    'zawgyi' => '',
    'full_video' => '',
    'trailer' => '',
    'photo' => '',
    'movie_category_id' => '',
    'created_date' => ''
  );

  public static function getNumRows()
  {
    $conn = parent::connect();
    $sql = 'SELECT COUNT(*) AS numRows FROM ' . TBL_MOVIES;

    try {
      $st = $conn->query($sql);
      $row = $st->fetch();
      parent::disconnect($conn);
      return $row['numRows'];
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getNumRowsByMovieCategoryId($movie_category_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT COUNT(*) AS numRows FROM ' . TBL_MOVIES . ' WHERE movie_category_id=:movie_category_id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':movie_category_id', $movie_category_id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      return $row['numRows'];
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getAllMovies()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MOVIES;

    try {
      $st = $conn->query($sql);
      $movie_caetegories = array();
      foreach ( $st->fetchAll() as $row ) {
        $movie_caetegories[] = new Movies( $row );
      }
      parent::disconnect($conn);
      return $movie_caetegories;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getLimitMovies($startRow, $numRows)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MOVIES . '  ORDER BY created_date DESC  LIMIT :startRow, :numRows';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue( ":startRow", $startRow, PDO::PARAM_INT );
      $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
      $st->execute();
      $movie_caetegories = array();
      foreach ( $st->fetchAll() as $row ) {
        $movie_caetegories[] = new Movies( $row );
      }
      parent::disconnect($conn);
      return $movie_caetegories;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getMoviesByMovieCategoryId($movie_category_id, $startRow, $numRows)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MOVIES . ' WHERE movie_category_id=:movie_category_id LIMIT :startRow, :numRows';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':movie_category_id', $movie_category_id, PDO::PARAM_INT);
      $st->bindValue( ":startRow", $startRow, PDO::PARAM_INT );
      $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
      $st->execute();
      $movies = array();
      foreach ($st->fetchAll() as $row) {
        $movies[] = new Movies($row);
      }

      parent::disconnect($conn);
      return $movies;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getMovieById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MOVIES . ' WHERE id=:id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();

      parent::disconnect($conn);
      if($row) return new Movies($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

}
 ?>
