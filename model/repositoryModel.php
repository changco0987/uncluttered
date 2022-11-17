<?php
    class repositoryModel
    {
        private $id;
        private $repositoryName;
        private $members;
        private $userAccountsId;

        public function getId()
        {
            return $this->id;
        }
        
        public function setId($id)
        {
            $this->id = $id;
        }
        

        public function getRepositoryName()
        {
            return $this->repositoryName;
        }
        
        public function setRepositoryName($repositoryName)
        {
            $this->repositoryName = $repositoryName;
        }
        

        public function getMembers()
        {
            return $this->members;
        }
        
        public function setMembers($members)
        {
            $this->members = $members;
        }


        public function getUserAccountsId()
        {
            return $this->userAccountsId;   
        }

        public function setUserAccountsId($userAccountsId)
        {
            $this->userAccountsId = $userAccountsId;
        }


        public function getImageName()
        {
            return $this->imageName;   
        }

        public function setImageName($imageName)
        {
            $this->imageName = $imageName;
        }
    }

?>