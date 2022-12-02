<?php
class ShortVideoCategories extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => ''
  );

  public static function getAllShortVideoCategories()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SHORT_VIDEO_CATEGORIES;

    try {
      $st = $conn->query($sql);

      $short_video_caetegories = array();
      foreach ( $st->fetchAll() as $row ) {
        $short_video_caetegories[] = new ShortVideoCategories( $row );
      }
      parent::disconnect($conn);
      return $short_video_caetegories;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getShortVideoCategoryById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SHORT_VIDEO_CATEGORIES . ' WHERE id=:id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();

      parent::disconnect($conn);
      if($row) return new ShortVideoCategories($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

}
 ?>
