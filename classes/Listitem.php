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

        public static function getlistnameById($listId){
            $conn = db::getConnection(); 
            $query = $conn->prepare("SELECT list_name FROM tbl_lists WHERE list_id = :list_id");
            $query->bindValue(":list_id", $listId);
            $query->execute();
            $listname = $query->fetch();
            return $listname;
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

        public static function getdescriptionById($listId){
            $conn = db::getConnection(); 
            $query = $conn->prepare("SELECT list_description FROM tbl_lists WHERE list_id = :list_id");  
            $query->bindValue(":list_id", $listId);
            $query->execute();
            $listdescription = $query->fetch();
            return $listdescription;

            
        
        }

        public function update(){
            $conn = db::getConnection();
            $query = $conn->prepare("UPDATE tbl_lists SET list_name=:list_name, list_description=:list_description WHERE id=:listId");

            $query->bindValue(":listId", $this->listId);
            $query->bindValue(":list_name", $this->listname);     
            $query->bindValue(":list_description", $this->listdescription);  

            $result = $query->execute();
            return $result;    
        }

        public function savelist(){
            $conn = db::getConnection();
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
                public static function getAllLists($listId, $amount = 20){
                $conn = db::getConnection();
                $query = $conn->prepare("SELECT * FROM tbl_lists ");
                $query->bindValue(":listId", $listId);
                $query->execute();
                $posts = $query->fetchAll();
                return $posts;
            }

            public function deleteList() {
                $conn = db::getConnection();
                $query = $conn->prepare("DELETE FROM tbl_lists WHERE tbl_lists.list_id = :list_id");
                $query->bindValue(":list_id","list_id");
                $result = $query->execute();
                return $result;
                
            //DELETE FROM tbl_lists WHERE list_id = :listId"
            //DELETE FROM tbl_lists WHERE okee = list_id
    }
}
   

?>