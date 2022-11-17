<?php
    class userAccountModel
    {
        private $id;
        private $firstname;
        private $lastname;
        private $username;
        private $password;
        private $imageName;
        private $resetCode;
        private $email;

        public function getId()
        {
            return $this->id;
        }
        
        public function setId($id)
        {
            $this->id = $id;
        }
        

        public function getfirstname()
        {
            return $this->firstname;
        }
        
        public function setfirstname($firstname)
        {
            $this->firstname = $firstname;
        }
        

        public function getlastname()
        {
            return $this->lastname;
        }
        
        public function setlastname($lastname)
        {
            $this->lastname = $lastname;
        }


        public function getUsername()
        {
            return $this->username;   
        }

        public function setUsername($username)
        {
            $this->username = strtolower($username);
        }


        public function getPassword()
        {
            return $this->password;   
        }

        public function setPassword($password)
        {
            $this->password = strtoupper(hash('sha256',$password));
        }


        public function getImageName()
        {
            return $this->imageName;   
        }

        public function setImageName($imageName)
        {
            $this->imageName = $imageName;
        }
        

        public function getResetCode()
        {
            return $this->resetCode;
        }
        
        public function setResetCode($resetCode)
        {
            $this->resetCode = $resetCode;
        }
        
        
        public function getEmail()
        {
            return $this->email;
        }
        
        public function setEmail($email)
        {
            $this->email = $email;
        }
    
    }

?>