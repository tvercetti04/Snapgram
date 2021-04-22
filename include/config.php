<?php
    session_start();

        class Social{

            private $host = "localhost";
            private $username = "root";
            private $password = "";
            private $database = "snapgram";

            private $connect;

            public function __construct(){
                $this->connect = new mysqli($this->host, $this->username, $this->password, $this->database);

                if(mysqli_connect_error()){
                    trigger_error("Database Connection Failed" .mysqli_connect_error());
                }
                else{
                    return $this->connect;
                }
            }
            public function insert($table, $fields){
                $col = implode(",",array_keys($fields));
                $rows = implode("','",array_values($fields));

                $sql = $this->connect->query("INSERT INTO $table($col) VALUE('$rows')");

                if($sql){
                    $_SESSION['alert'] = "Data Inserted Successfully";
                }
                else{
                    echo "Failed";
                }
            }
            
            public function redirect($page){
                echo "<script>window.open('$page.php','_self')</script>";
            }

            public function select($query){
                $run = $this->connect->query($query);
                $array = [];

                if($run->num_rows > 0){
                    while($row = $run->fetch_assoc()){
                        $array[] = $row;
                    }
                    return $array;
                }
                else{
                    echo "No records found";
                    return $array;
                }
            }
            public function update($table, $fields, $cond){
                $sql = $this->connect->query("UPDATE $table SET $fields WHERE $cond");
                return($sql)?true:false;
            }

            public function countData($query){
                $run = $this->connect->query($query);
                return $run->num_rows;
            }

            public function delete($table, $cond){
                $sql = $this->connect->query("DELETE FROM $table WHERE $cond");
                return($sql)?true:false;
            }
          
        }

        $snap = new Social();
?>