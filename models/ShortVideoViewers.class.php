<?php
class ShortVideoViewers extends DataObject
{
  protected $data = array(
    'short_video_id' => '',
    'remote_address' => '',
    'times' => ''
  );

  public function record()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SHORT_VIDEO_VIEWERS . ' WHERE short_video_id=:short_video_id AND remote_address=:remote_address';
    try {
      $st = $conn->prepare( $sql );
      $st->bindValue('short_video_id', $this->data['short_video_id'], PDO::PARAM_INT);
      $st->bindValue('remote_address', $this->data['remote_address'], PDO::PARAM_STR);
      $st->execute();

      if($st->fetch()){
        $sql == 'UPDATE ' . TBL_SHORT_VIDEO_VIEWERS . ' SET times = times + 1 WHERE short_video_id=:short_video_id AND remote_address=:remote_address';
        $st = $conn->prepare($sql);
        $st->bindValue('short_video_id', $this->data['short_video_id'], PDO::PARAM_INT);
        $st->bindValue('remote_address', $this->data['remote_address'], PDO::PARAM_STR);
        $st->execute();
      } else {
        $sql = 'INSERT INTO ' . TBL_SHORT_VIDEO_VIEWERS . ' (short_video_id, remote_address, times) VALUES (:short_video_id, :remote_address, 1)';
        $st = $conn->prepare($sql);
        $st->bindValue(':short_video_id', $this->data['short_video_id'], PDO::PARAM_INT);
        $st->bindValue(':remote_address', $this->data['remote_address'], PDO::PARAM_STR);
        $st->execute();
      }

      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getViewersRelatedShortVideo($short_video_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT COUNT(*) AS viewers FROM ' . TBL_SHORT_VIDEO_VIEWERS . ' WHERE short_video_id=:short_video_id';
    try {
      $st = $conn->prepare( $sql );
      $st->bindValue('short_video_id', $short_video_id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return $row['viewers'];
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }
}
 ?>
