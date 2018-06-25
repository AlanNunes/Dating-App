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
   /**
   * @var integer
   **/
   public $Phone;

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
     $sql = "INSERT INTO users (password, firstname, lastname, email,
        age, gender, interestsInMen, interestsInWomen, phone) VALUES (
        '{$this->Password}', '{$this->FirstName}', '{$this->LastName}',
        '{$this->Email}', {$this->Age}, '{$this->Gender}', {$this->InterestsInMen},
          {$this->InterestsInWomen}, {$this->Phone})";

     return $this->db->Query($sql);
   }

   /**
   * Checks if the email is available
   *
   * @return bool
   **/
   public function IsEmailAvailable($email)
   {
     $result = $this->db->Query("SELECT email FROM users WHERE email = '{$email}'");
     if($result->num_rows)
     {
       return false;
     }
     else
     {
       return true;
     }
   }


   /**
   * Checks if the phone is available
   *
   * @return bool
   **/
   public function IsPhoneAvailable($phone)
   {
     $result = $this->db->Query("SELECT phone FROM users WHERE phone = '{$phone}'");
     if($result->num_rows)
     {
       return false;
     }
     else
     {
       return true;
     }
   }

   /**
   * Auth User
   *
   * @return boolean Returns true if auth was successful. Otherwise false.
   **/
   public function AuthUser($identification, $password)
   {
     $identification = $this->db->PreventAttacks($identification);
     $password = $this->db->PreventAttacks($password);

     $result = $this->db->Query("SELECT id FROM users WHERE
                    (email = '{$identification}' OR phone = '{$identification}')
                                                AND password = '{$password}'");
     if($result->num_rows)
     {
       return true;
     }
     else
     {
       return false;
     }
   }
 }
 ?>
