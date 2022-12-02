<?php
class MovieCategories extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => ''
  );

  public function insert()
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO ' . TBL_MOVIE_CATEGORIES . ' (name) VALUES (:name)';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

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

  public static function getMovieCategoryByName($name)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MOVIE_CATEGORIES . ' WHERE name=:name';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':name', $name, PDO::PARAM_STR);
      $st->execute();
      $row = $st->fetch();

      parent::disconnect($conn);
      if($row) return new MovieCategories($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function updateMovieCategoryName()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_MOVIE_CATEGORIES .' SET name = :name WHERE id = :id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function deleteMovieCategory()
  {
    $conn = parent::connect();
    $sql = 'DELETE FROM ' . TBL_MOVIE_CATEGORIES . ' WHERE id = :id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

}
 ?>
