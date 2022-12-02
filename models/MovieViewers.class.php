<?php
class MovieViewers extends DataObject
{
  protected $data = array(
    'movie_id' => '',
    'remote_address' => '',
    'times' => ''
  );

  public function record()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_MOVIE_VIEWERS . ' WHERE movie_id=:movie_id AND remote_address=:remote_address';
    try {
      $st = $conn->prepare( $sql );
      $st->bindValue('movie_id', $this->data['movie_id'], PDO::PARAM_INT);
      $st->bindValue('remote_address', $this->data['remote_address'], PDO::PARAM_STR);
      $st->execute();

      if($st->fetch()){
        $sql == 'UPDATE ' . TBL_MOVIE_VIEWERS . ' SET times = times + 1 WHERE movie_id=:movie_id AND remote_address=:remote_address';
        $st = $conn->prepare($sql);
        $st->bindValue('movie_id', $this->data['movie_id'], PDO::PARAM_INT);
        $st->bindValue('remote_address', $this->data['remote_address'], PDO::PARAM_STR);
        $st->execute();
      } else {
        $sql = 'INSERT INTO ' . TBL_MOVIE_VIEWERS . ' (movie_id, remote_address, times) VALUES (:movie_id, :remote_address, 1)';
        $st = $conn->prepare($sql);
        $st->bindValue(':movie_id', $this->data['movie_id'], PDO::PARAM_INT);
        $st->bindValue(':remote_address', $this->data['remote_address'], PDO::PARAM_STR);
        $st->execute();
      }

      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public static function getViewersRelatedMovie($movie_id)
  {
    $conn = parent::connect();
    $sql = 'SELECT COUNT(*) AS viewers FROM ' . TBL_MOVIE_VIEWERS . ' WHERE movie_id=:movie_id';
    try {
      $st = $conn->prepare( $sql );
      $st->bindValue('movie_id', $movie_id, PDO::PARAM_INT);
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
