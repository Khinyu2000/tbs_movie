<?php
class SeriesVideos extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => '',
    'full_video' => '',
    'series_id' => '',
    'created_date' => ''
  );

  public static function getSeriesVideoById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SERIES_VIDEOS . ' WHERE id=:id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();

      parent::disconnect($conn);
      if($row) return new SeriesVideos($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getSeriesVideosBySeriesId($series_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SERIES_VIDEOS . ' WHERE series_id=:series_id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':series_id', $series_id, PDO::PARAM_INT);
      $st->execute();
      $series_videos = array();
      foreach ($st->fetchAll() as $row) {
        $series_videos[] = new SeriesVideos($row);
      }

      parent::disconnect($conn);
      return $series_videos;
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

}
 ?>
