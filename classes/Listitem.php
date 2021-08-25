<?php

    class Listitem{
        private $listId;
        private $listname;
        private $listdescription;
        
        public function setListId($listId)
        {
                $this->listId = $listId;
        }

        public function getListId()
        {
                return $this->listId;
        }

     
        public function getListname()
        {
                return $this->listname;
        }

       
        public function setListname($listname)
        {
                self::checklistName($listname);
                $this->listname = $listname;
        }

       
        public function getListdescription()
        {
                return $this->listdescription;
        }

        public function setListdescription($listdescription)
        {
                self::checklistDescription($listdescription);
                $this->listdescription = $listdescription;
        }

        public function savelist(){
            $conn = Database::getConnection();
            $query = $conn->prepare("INSERT INTO tbl_lists (list_name, list_description) VALUES (:list_name, :list_description)");
            $query->bindValue(":list_name", $this->listname);
            $query->bindValue(":list_description", $this->listdescription);

            $result=$query->execute();
            return $result;
        }

        private function checklistDescription($listdescription){
                if($listdescription == "") {
                    throw new Exception("Description cannot be empty.");
                }
            }

        private function checklistName($listname){
                if($listname == "") {
                    throw new Exception("Listname cannot be empty.");
                }
            }

            //returns all lists
                public static function getAllLists($userId, $amount = 20){
                $conn = Database::getConnection();
                $query = $conn->prepare("SELECT * FROM tbl_lists ");
                $query->bindValue(":userId", $userId);
                $query->execute();
                $posts = $query->fetchAll();
                return $posts;
            }
    }


?>