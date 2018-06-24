<?php
/**
 *
 * @category   User
 * @author     Alan Nunes da Silva <alann.625@gmail.com>
 *
 * 23/06/2018
 */

 class User
 {
   /**
   * @var int
   **/
   private $Id;
   /**
   * @var string
   **/
   public $Username;
   /**
   * @var string
   **/
   public $Password;
   /**
   * @var string
   **/
   public $FirstName;
   /**
   * @var string
   **/
   public $LastName;
   /**
   * @var string
   **/
   public $Email;
   /**
   * @var int
   **/
   public $Age;
   /**
   * @var string 'F' or 'M'
   **/
   public $Gender;
   /**
   * @var boolean
   **/
   public $InterestsInMen;
   /**
   * @var boolean
   **/
   public $InterestsInWomen;
   /**
   * @var boolean
   **/
   private $AccountDeleted;

   // An instance of DataBase
   public $db;

   public function __construct($db)
   {
     $this->db = $db;
   }

   public function ListAccounts()
   {
     return $this->db->Query("SELECT * FROM users");
   }

   public function RegisterAccount()
   {
     $sql = "INSERT INTO users (username, password, firstname, lastname, email,
        age, gender, interestsInMen, interestsInWomen) VALUES ('{$this->Username}',
        '{$this->Password}', '{$this->FirstName}', '{$this->LastName}',
        '{$this->Email}', {$this->Age}, '{$this->Gender}', {$this->InterestsInMen},
          {$this->InterestsInWomen})";

     return $this->db->Query($sql);
   }
 }
 ?>
