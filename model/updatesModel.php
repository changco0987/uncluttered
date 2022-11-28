<?php
    class updatesModel
    {
        private $id;
        private $title;
        private $filename;
        private $note;
        private $datetimeCreation;
        private $userAccountId;
        private $repositoryId;

        public function getId()
        {
            return $this->id;
        }
        
        public function setId($id)
        {
            $this->id = $id;
        }
        

        public function getTitle()
        {
            return $this->title;
        }
        
        public function setTitle($title)
        {
            $this->title = $title;
        }
        

        public function getFilename()
        {
            return $this->filename;
        }
        
        public function setFilename($filename)
        {
            $this->filename = $filename;
        }
        

        public function getNote()
        {
            return $this->note;
        }
        
        public function setNote($note)
        {
            $this->note = $note;
        }
        

        public function getDatetimeCreation()
        {
            return $this->datetimeCreation;
        }
        
        public function setDatetimeCreation()
        {
            date_default_timezone_set('Asia/Manila');
            $currentDateTime = date('Y-m-d h:i:s a');

            $this->datetimeCreation = $currentDateTime;
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


    }

?>