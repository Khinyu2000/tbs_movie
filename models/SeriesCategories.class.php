<?php
class SeriesCategories extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => ''
  );

  public static function getAllSeriesCategories()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SERIES_CATEGORIES;

    try {
      $st = $conn->query($sql);

      $series_caetegories = array();
      foreach ( $st->fetchAll() as $row ) {
        $series_caetegories[] = new SeriesCategories( $row );
      }
      parent::disconnect($conn);
      return $series_caetegories;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getSeriesCategoryById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SERIES_CATEGORIES . ' WHERE id=:id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();

      parent::disconnect($conn);
      if($row) return new SeriesCategories($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

}
 ?>
