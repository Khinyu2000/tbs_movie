<?php

class AdminAccount extends DataObject
{
  protected $data = array(
    'id' => '',
    'username' => '',
    'password' => ''
  );

  public static function getAdminAccountById($id)
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_ADMIN_ACCOUNTS . ' WHERE id = :id';
    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_STR);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);
      if($row) return new AdminAccount($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }
  }

  public function updateAdminAccount($id)
  {
    $conn = parent::connect();
    $sql = 'UPDATE ' . TBL_ADMIN_ACCOUNTS .' SET username = :username, password = password(:password) WHERE id = :id';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':id', $id, PDO::PARAM_INT);
      $st->bindValue(':username', $this->data['username'], PDO::PARAM_STR);
      $st->bindValue(':password', $this->data['password'], PDO::PARAM_STR);
      $st->execute();
      parent::disconnect($conn);
    } catch (PDOExceptino $e) {
      parent::disconnect($conn);
      die("Query failed: ". $e->getMessae());
    }
  }

  public function authenticateAdminAccount()
  {
    $conn = parent::connect();
    $sql = 'SELECT * FROM ' . TBL_ADMIN_ACCOUNTS . ' WHERE username = :username AND password = password(:password)';

    try {
      $st = $conn->prepare($sql);
      $st->bindValue(':username', $this->data['username'], PDO::PARAM_STR);
      $st->bindValue(':password', $this->data['password'], PDO::PARAM_STR);
      $st->execute();
      $row = $st->fetch();
      parent::disconnect($conn);

      if($row) return new AdminAccount($row);
    } catch (PDOException $e) {
      parent::disconnect($conn);
      die('Query failed: ' . $e->getMessage());
    }

  }
}

 ?>
