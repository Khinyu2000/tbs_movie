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

  public function insert()
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO ' . TBL_SHORT_VIDEOS . ' (name, full_video, unicode, zawgyi, photo, short_video_category_id, created_date) VALUES (:name, :full_video, :unicode, :zawgyi, :photo, :short_video_category_id, NOW())';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->bindValue(':full_video', $this->data['full_video'], PDO::PARAM_STR);
      $st->bindValue(':unicode', $this->data['unicode'], PDO::PARAM_STR);
      $st->bindValue(':zawgyi', $this->data['zawgyi'], PDO::PARAM_STR);
      $st->bindValue(':photo', $this->data['photo'], PDO::PARAM_STR);
      $st->bindValue(':short_video_category_id', $this->data['short_video_category_id'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
      return $conn->lastInsertId();
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  // public static function getAllShortVideos()
  // {
  //   $conn = parent::connect();
  //   $sql = 'SELECT * FROM ' . TBL_SHORT_VIDEOS;
  //
  //   try {
  //     $st = $conn->query($sql);
  //
  //     $short_videos = array();
  //     foreach ( $st->fetchAll() as $row ) {
  //       $short_videos[] = new ShortVideos( $row );
  //     }
  //     parent::disconnect($conn);
  //     return $short_videos;
  //   } catch (PDOException $e) {
  //     parent::disconnect($conn);
  //     die("Query failed: ". $e->getMessage());
  //   }
  // }

  public static function getShortVideosByCategoryId($short_video_category_id, $order)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SHORT_VIDEOS . ' WHERE short_video_category_id=:short_video_category_id ORDER BY ' . $order;

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':short_video_category_id', $short_video_category_id, PDO::PARAM_INT);
      // $st->bindValue(':order', $order, PDO::PARAM_STR);
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

  public function updateShortVideoTextInfo()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_SHORT_VIDEOS .' SET name = :name, full_video=:full_video, unicode=:unicode, zawgyi=:zawgyi, short_video_category_id=:short_video_category_id WHERE id = :id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->bindValue(':full_video', $this->data['full_video'], PDO::PARAM_STR);
      $st->bindValue(':unicode', $this->data['unicode'], PDO::PARAM_STR);
      $st->bindValue(':zawgyi', $this->data['zawgyi'], PDO::PARAM_STR);
      $st->bindValue(':short_video_category_id', $this->data['short_video_category_id'], PDO::PARAM_INT);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function updateShortVideoPhoto()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_SHORT_VIDEOS .' SET photo = :photo WHERE id = :id';

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

  public function deleteShortVideo()
  {
    $conn = parent::connect();
    $sql = 'DELETE FROM ' . TBL_SHORT_VIDEOS . ' WHERE id = :id';

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
