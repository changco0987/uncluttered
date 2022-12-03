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
        private $gmail_Id;

        public function getId()
        {
            return $this->id;
        }
        
        public function setId($id)
        {
            $this->id = $id;
        }
        

        public function getFirstname()
        {
            return $this->firstname;
        }
        
        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;
        }
        

        public function getLastname()
        {
            return $this->lastname;
        }
        
        public function setLastname($lastname)
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



        public function getGmail_Id()
        {
            return $this->gmail_Id;
        }
    
        
        public function setGmail_Id($gmail_Id)
        {
            $this->gmail_Id = $gmail_Id;
        }
    }

?>