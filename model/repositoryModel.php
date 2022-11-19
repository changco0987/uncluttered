<?php
    class repositoryModel
    {
        private $id;
        private $repositoryName;
        private $members;
        private $userAccountId;

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


        public function getUserAccountId()
        {
            return $this->userAccountId;   
        }

        public function setUserAccountId($userAccountId)
        {
            $this->userAccountId = $userAccountId;
        }


    }

?>