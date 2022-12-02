<?php
class Series extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => '',
    'released_year' => '',
    'rate' => '',
    'unicode' => '',
    'zawgyi' => '',
    'trailer' => '',
    'photo' => '',
    'series_category_id' => '',
    'created_date' => ''
  );

  public function insert()
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO ' . TBL_SERIES . ' (name, released_year, rate, unicode, zawgyi, trailer, photo, series_category_id, created_date) VALUES (:name, :released_year, :rate, :unicode, :zawgyi, :trailer, :photo, :series_category_id, NOW())';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->bindValue(':released_year', $this->data['released_year'], PDO::PARAM_STR);
      $st->bindValue(':rate', $this->data['rate'], PDO::PARAM_STR);
      $st->bindValue(':unicode', $this->data['unicode'], PDO::PARAM_STR);
      $st->bindValue(':zawgyi', $this->data['zawgyi'], PDO::PARAM_STR);
      $st->bindValue(':trailer', $this->data['trailer'], PDO::PARAM_STR);
      $st->bindValue(':photo', $this->data['photo'], PDO::PARAM_STR);
      $st->bindValue(':series_category_id', $this->data['series_category_id'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
      return $conn->lastInsertId();
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  // public static function getAllSeries()
  // {
  //   $conn = parent::connect();
  //   $sql = 'SELECT * FROM ' . TBL_SERIES;
  //
  //   try {
  //     $st = $conn->query($sql);
  //
  //     $movie_caetegories = array();
  //     foreach ( $st->fetchAll() as $row ) {
  //       $movie_caetegories[] = new Series( $row );
  //     }
  //     parent::disconnect($conn);
  //     return $movie_caetegories;
  //   } catch (PDOException $e) {
  //     parent::disconnect($conn);
  //     die("Query failed: ". $e->getMessage());
  //   }
  // }

  public static function getSeriesBySeriesCategoryId($series_category_id, $order)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SERIES . ' WHERE series_category_id=:series_category_id ORDER BY ' . $order;

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':series_category_id', $series_category_id, PDO::PARAM_INT);
      // $st->bindValue(':order', $order, PDO::PARAM_STR);
      $st->execute();
      $series = array();
      foreach ($st->fetchAll() as $row) {
        $series[] = new Series($row);
      }

      parent::disconnect($conn);
      return $series;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getSeriesById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SERIES . ' WHERE id=:id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();

      parent::disconnect($conn);
      if($row) return new Series($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function updateSeriesTextInfo()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_SERIES .' SET name=:name, released_year=:released_year, rate=:rate, unicode=:unicode, zawgyi=:zawgyi, trailer=:trailer, series_category_id=:series_category_id WHERE id=:id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->bindValue(':released_year', $this->data['released_year'], PDO::PARAM_STR);
      $st->bindValue(':rate', $this->data['rate']);
      $st->bindValue(':unicode', $this->data['unicode'], PDO::PARAM_STR);
      $st->bindValue(':zawgyi', $this->data['zawgyi'], PDO::PARAM_STR);
      $st->bindValue(':trailer', $this->data['trailer'], PDO::PARAM_STR);
      $st->bindValue(':series_category_id', $this->data['series_category_id'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function updateSeriesPhoto()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_SERIES .' SET photo = :photo WHERE id = :id';

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

  public function deleteSeries()
  {
    $conn = parent::connect();
    $sql = 'DELETE FROM ' . TBL_SERIES . ' WHERE id = :id';

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
