<?php
class MovieCategories extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => ''
  );

  public static function getAllMovieCategories()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MOVIE_CATEGORIES;

    try {
      $st = $conn->query($sql);

      $movie_caetegories = array();
      foreach ( $st->fetchAll() as $row ) {
        $movie_caetegories[] = new MovieCategories( $row );
      }
      parent::disconnect($conn);
      return $movie_caetegories;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getMovieCategoryById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MOVIE_CATEGORIES . ' WHERE id=:id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();

      parent::disconnect($conn);
      if($row) return new MovieCategories($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }
}
 ?>
