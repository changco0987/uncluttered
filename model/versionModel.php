<?php
    class versionModel
    {
        private $id;
        private $updateId;
        private $userAccountId;
        private $datetimeCreation;
        private $note;
        private $filename;

        public function getId()
        {
            return $this->id;
        }
        
        public function setId($id)
        {
            $this->id = $id;
        }
        


        public function getUpdateId()
        {
            return $this->updateId;
        }
        
        public function setUpdateId($updateId)
        {
            $this->updateId = $updateId;
        }


        public function getUserAccountId()
        {
            return $this->userAccountId;   
        }

        public function setUserAccountId($userAccountId)
        {
            $this->userAccountId = $userAccountId;
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

        

        public function getNote()
        {
            return $this->note;
        }
        
        public function setNote($note)
        {
            $this->note = $note;
        }
        

        public function getFilename()
        {
            return $this->filename;
        }
        
        public function setFilename($filename)
        {
            $this->filename = $filename;
        }


    }

?>