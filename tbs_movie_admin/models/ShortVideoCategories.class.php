<?php
class ShortVideoCategories extends DataObject
{
  protected $data = array(
    'id' => '',
    'name' => ''
  );

  public function insert()
  {
    $conn = parent::connect();
    $sql = 'INSERT INTO ' . TBL_SHORT_VIDEO_CATEGORIES . ' (name) VALUES (:name)';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

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

  public static function getShortVideoCategoryByName($name)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_SHORT_VIDEO_CATEGORIES . ' WHERE name=:name';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':name', $name, PDO::PARAM_STR);
      $st->execute();
      $row = $st->fetch();

      parent::disconnect($conn);
      if($row) return new ShortVideoCategories($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function updateShortVideoCategoryName()
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_SHORT_VIDEO_CATEGORIES .' SET name = :name WHERE id = :id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
      $st->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessage());
    }
  }

  public function deleteShortVideoCategory()
  {
    $conn = parent::connect();
    $sql = 'DELETE FROM ' . TBL_SHORT_VIDEO_CATEGORIES . ' WHERE id = :id';

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
