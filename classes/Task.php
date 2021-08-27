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

    public static function getTasknameById($taskId){
        $conn = db::getConnection(); 
        $query = $conn->prepare("SELECT list_name FROM tbl_lists WHERE list_id = :list_id");
        $query->bindValue(":list_id", $taskId);
        $query->execute();
        $listname = $query->fetch();
        return $listname;
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
        $query = $conn->prepare("SELECT id FROM tbl_tasks WHERE task_name = :task_name");

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
        $query = $conn->prepare("INSERT INTO tbl_tasks (task_name, task_hours, task_deadline, priority) VALUES (:task_name, :task_hours, :task_deadline, :priority)");
        $query->bindValue(":task_name", $this->taskname);
        $query->bindValue(":task_hours", $this->taskhours);
        $query->bindValue(":task_deadline", $this->taskdeadline);
        $query->bindValue(":priority", $this->priority);

        $result=$query->execute();
        return $result;
    }
     //returns all tasks
     public static function getAllTasks($taskId, $amount = 120){
        $conn = db::getConnection();
        $query = $conn->prepare("SELECT * FROM tbl_tasks ");
        $query->bindValue(":taskId", $taskId);
        $query->execute();
        $posts = $query->fetchAll();
        return $posts;
    }
}



?>