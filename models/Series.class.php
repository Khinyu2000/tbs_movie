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

  public static function getNumRows()
  {
    $conn = parent::connect();
    $sql = 'SELECT COUNT(*) AS numRows FROM ' . TBL_SERIES;

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

  public static function getNumRowsBySeriesCategoryId($series_category_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT COUNT(*) AS numRows FROM ' . TBL_SERIES . ' WHERE series_category_id=:series_category_id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':series_category_id', $series_category_id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      return $row['numRows'];
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getAllSeries()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SERIES;

    try {
      $st = $conn->query($sql);
      $series = array();
      foreach ( $st->fetchAll() as $row ) {
        $series[] = new Series( $row );
      }
      parent::disconnect($conn);
      return $series;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getLimitSeries($startRow, $numRows)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SERIES . '  ORDER BY created_date DESC  LIMIT :startRow, :numRows';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue( ":startRow", $startRow, PDO::PARAM_INT );
      $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
      $st->execute();
      $series = array();
      foreach ( $st->fetchAll() as $row ) {
        $series[] = new Series( $row );
      }
      parent::disconnect($conn);
      return $series;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getSeriesBySeriesCategoryId($series_category_id, $startRow, $numRows)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SERIES . ' WHERE series_category_id=:series_category_id LIMIT :startRow, :numRows';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':series_category_id', $series_category_id, PDO::PARAM_INT);
      $st->bindValue( ":startRow", $startRow, PDO::PARAM_INT );
      $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
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
}
 ?>
