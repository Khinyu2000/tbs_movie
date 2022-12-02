<?php
class ShortVideos extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => '',
    'full_video' => '',
    'unicode' => '',
    'zawgyi' => '',
    'photo' => '',
    'short_video_category_id' => '',
    'created_date' => ''
  );

  public static function getNumRows()
  {
    $conn = parent::connect();
    $sql = 'SELECT COUNT(*) AS numRows FROM ' . TBL_SHORT_VIDEOS;

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

  public static function getNumRowsByCategoryId($short_video_category_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT COUNT(*) AS numRows FROM ' . TBL_SHORT_VIDEOS . ' WHERE short_video_category_id=:short_video_category_id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':short_video_category_id', $short_video_category_id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      return $row['numRows'];
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getLimitShortVideos($startRow, $numRows)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SHORT_VIDEOS . ' ORDER BY created_date DESC LIMIT :startRow, :numRows';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue( ":startRow", $startRow, PDO::PARAM_INT );
      $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
      $st->execute();
      $short_videos = array();
      foreach ( $st->fetchAll() as $row ) {
        $short_videos[] = new ShortVideos( $row );
      }
      parent::disconnect($conn);
      return $short_videos;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getShortVideosByCategoryId($short_video_category_id, $startRow, $numRows)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SHORT_VIDEOS . ' WHERE short_video_category_id=:short_video_category_id LIMIT :startRow, :numRows';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':short_video_category_id', $short_video_category_id, PDO::PARAM_INT);
      $st->bindValue( ":startRow", $startRow, PDO::PARAM_INT );
      $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
      $st->execute();
      $short_videos = array();
      foreach ($st->fetchAll() as $row) {
        $short_videos[] = new ShortVideos($row);
      }

      parent::disconnect($conn);
      return $short_videos;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getShortVideoById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SHORT_VIDEOS . ' WHERE id=:id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();

      parent::disconnect($conn);
      if($row) return new ShortVideos($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

}
 ?>
