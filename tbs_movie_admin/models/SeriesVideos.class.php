<?php
class SeriesVideos extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => '',
    'info' => '',
    'full_video' => '',
    'series_id' => '',
    'created_date' => ''
  );

  public function insert()
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO ' . TBL_SERIES_VIDEOS . ' (name, info, full_video, series_id, created_date) VALUES (:name, :info, :full_video, :series_id, NOW())';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->bindValue(':info', $this->data['info'], PDO::PARAM_STR);
      $st->bindValue(':full_video', $this->data['full_video'], PDO::PARAM_STR);
      $st->bindValue(':series_id', $this->data['series_id'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

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

  public function updateSeriesVideo()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_SERIES_VIDEOS .' SET name = :name, info=:info, full_video=:full_video WHERE id = :id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->bindValue(':info', $this->data['info'], PDO::PARAM_STR);
      $st->bindValue(':full_video', $this->data['full_video'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function deleteSeriesVideo()
  {
    $conn = parent::connect();
    $sql = 'DELETE FROM ' . TBL_SERIES_VIDEOS . ' WHERE id = :id';

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
