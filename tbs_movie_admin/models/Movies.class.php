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

  public function insert()
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO ' . TBL_MOVIES . ' (name, released_year, rate, unicode, zawgyi, full_video, trailer, photo, movie_category_id, created_date) VALUES (:name, :released_year, :rate, :unicode, :zawgyi, :full_video, :trailer, :photo, :movie_category_id, NOW())';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->bindValue(':released_year', $this->data['released_year'], PDO::PARAM_STR);
      $st->bindValue(':rate', $this->data['rate'], PDO::PARAM_STR);
      $st->bindValue(':unicode', $this->data['unicode'], PDO::PARAM_STR);
      $st->bindValue(':zawgyi', $this->data['zawgyi'], PDO::PARAM_STR);
      $st->bindValue(':full_video', $this->data['full_video'], PDO::PARAM_STR);
      $st->bindValue(':trailer', $this->data['trailer'], PDO::PARAM_STR);
      $st->bindValue(':photo', $this->data['photo'], PDO::PARAM_STR);
      $st->bindValue(':movie_category_id', $this->data['movie_category_id'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
      return $conn->lastInsertId();
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  // public static function getAllMovies()
  // {
  //   $conn = parent::connect();
  //   $sql = 'SELECT * FROM ' . TBL_MOVIES;
  //
  //   try {
  //     $st = $conn->query($sql);
  //
  //     $movie_caetegories = array();
  //     foreach ( $st->fetchAll() as $row ) {
  //       $movie_caetegories[] = new Movies( $row );
  //     }
  //     parent::disconnect($conn);
  //     return $movie_caetegories;
  //   } catch (PDOException $e) {
  //     parent::disconnect($conn);
  //     die("Query failed: ". $e->getMessage());
  //   }
  // }

  public static function getMoviesByMovieCategoryId($movie_category_id, $order)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MOVIES . ' WHERE movie_category_id=:movie_category_id ORDER BY ' . $order;

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':movie_category_id', $movie_category_id, PDO::PARAM_INT);
      // $st->bindValue(':order', $order, PDO::PARAM_STR);
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

  public function updateMovieTextInfo()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_MOVIES .' SET name = :name, released_year = :released_year, rate=:rate, unicode=:unicode, zawgyi=:zawgyi, full_video=:full_video, trailer=:trailer, movie_category_id=:movie_category_id WHERE id = :id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->bindValue(':released_year', $this->data['released_year'], PDO::PARAM_STR);
      $st->bindValue(':rate', $this->data['rate']);
      $st->bindValue(':unicode', $this->data['unicode'], PDO::PARAM_STR);
      $st->bindValue(':zawgyi', $this->data['zawgyi'], PDO::PARAM_STR);
      $st->bindValue(':full_video', $this->data['full_video'], PDO::PARAM_STR);
      $st->bindValue(':trailer', $this->data['trailer'], PDO::PARAM_STR);
      $st->bindValue(':movie_category_id', $this->data['movie_category_id'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function updateMoviePhoto()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_MOVIES .' SET photo = :photo WHERE id = :id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->bindValue(':photo', $this->data['photo'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function deleteMovie()
  {
    $conn = parent::connect();
    $sql = 'DELETE FROM ' . TBL_MOVIES . ' WHERE id = :id';

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
