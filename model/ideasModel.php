<?php
    class ideasModel
    {
        private $id;
        private $userAccountId;
        private $repositoryId;
        private $idea;

        public function getId()
        {
            return $this->id;
        }
        
        public function setId($id)
        {
            $this->id = $id;
        }


        public function getUserAccountId()
        {
            return $this->userAccountId;   
        }

        public function setUserAccountId($userAccountId)
        {
            $this->userAccountId = $userAccountId;
        }
        

        public function getRepositoryId()
        {
            return $this->repositoryId;
        }
        
        public function setRepositoryId($repositoryId)
        {
            $this->repositoryId = $repositoryId;
        }


        public function getIdea()
        {
            return $this->idea;
        }
        
        public function setIdea($idea)
        {
            $this->idea = $idea;
        }

    }

?>