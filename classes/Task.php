<?php

 class Task{
    private $taskId;
    private $taskname;
    private $taskhours;
    private $taskdeadline;
    private $priority;

    
    public function getTaskId()
    {
        return $this->taskId;
    }

    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;

        return $this;
    }

    public function getTaskname()
    {
        return $this->taskname;
    }

   
    public function setTaskname($taskname)
    {
        $this->taskname = $taskname;

        return $this;
    }

   
    public function getTaskhours()
    {
        return $this->taskhours;
    }

    public function setTaskhours($taskhours)
    {
        $this->taskhours = $taskhours;

        return $this;
    }

    public function getTaskdeadline()
    {
        return $this->taskdeadline;
    }

    public function setTaskdeadline($taskdeadline)
    {
        $this->taskdeadline = $taskdeadline;

        return $this;
    }

   
    public function getpriority()
    {
        return $this->priority;
    }

    public function setpriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    private function checkTask($taskname){
        if($this->taskExists($taskname)){
            throw new Exception("This task already exists.");
        }
    }
    private function taskExists($taskname){ 
        $conn = db::getConnection();
        $query = $conn->prepare("SELECT id FROM tasks WHERE task_name = :task_name");

        $query->bindValue(":task_name", $taskname);            
        $query->execute();
        $result = $query->fetch();

        if(!$result){
            return False;
        } else {
            return True;
        }
    }
    public function savetask(){
        $conn = db::getConnection();
        $query = $conn->prepare("INSERT INTO tbl_lists (list_name, list_description) VALUES (:list_name, :list_description)");
        $query->bindValue(":list_name", $this->listname);
        $query->bindValue(":list_description", $this->listdescription);

        $result=$query->execute();
        return $result;
    }
}



?>