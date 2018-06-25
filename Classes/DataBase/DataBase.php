<?php
/**
 *
 * @category   DataBase
 * @author     Alan Nunes da Silva <alann.625@gmail.com>
 *
 * 23/06/2018
 */


 class DataBase
 {
   /**
   * @var string
   **/
   private $Host = "localhost";
   /**
   * @var string
   **/
   public $Username = "root";
   /**
   * @var string
   **/
   public $Password = "";
   /**
   * @var string
   **/
   public $DataBaseName = "DatingApp";

   // DataBase connection
   private $conn;

   public function __construct()
   {
     $this->conn = new mysqli($this->Host, $this->Username, $this->Password,
                                $this->DataBaseName);
   }

   public function GetConnection()
   {
     return $this->conn;
   }

   public function Query($sql)
   {
     return $this->conn->query($sql);
   }

   /**
   * Prevents SQL Injection
   */
   public function PreventAttacks($data)
   {
     return $this->conn->real_scape_string($data);
   }
 }
 ?>
