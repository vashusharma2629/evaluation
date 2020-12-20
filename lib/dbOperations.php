<?php
    require_once('./config/db1.php');

    function fetchRecordAll($entity,$start=0,$end=10){
        // fetch records for entity(category, article, comment) where status is true
        // start and end will control the behaviour for pagination 
        $sql = "SELECT * FROM $entity WHERE `status` = 'A' LIMIT  $start, $end" ;
        global $con;
        $res = mysqli_query($con,$sql);
        $data = array();
        if(mysqli_num_rows($res)>0){
            while($record = mysqli_fetch_assoc($res)){
                $data[]=$record;
            }
            return $data;
        } else{
            return false;
        }
       
    }

    function fetchRecordSpecific($entity,$primary){
        // fetch single record for entity(category, article, comment)
        $sql ="SELECT * from $entity where `id` = $primary";
        global $con;
        $res = mysqli_query($con,$sql);
        $data = array();
        if(mysqli_num_rows($res)>0){
            while($record = mysqli_fetch_assoc($res)){
                $data=$record;
            }
            return $data;
        } else{
            return false;
        }
       
    }

       

    

    function insertRecord($entity,$data){
        // insert single record for entity(category, article, comment) with data passed
        //echo 'Insert Called';
        
        global $con;
        if($entity =='user'){
            $sql = "INSERT INTO user(`name`,`email`,`pwd`,`status`) VALUES ('$data[user]','$data[email]', '$data[pwd]', 'A')";
            $res = mysqli_query($con,$sql);

             if(mysqli_affected_rows($con)>0){
            
            echo 'Record Inserted';
        }else{
            echo 'Record Not Inserted';
        }
            
        }
       /* if($entity == 'category'){
            $sql = "INSERT INTO `category`(`name`,`discription`,`status`,`created`,`updated`) VALUES ('$data[name]', '$data[discription]', 'A','' , '')";
            $res = mysqli_query($con,$sql);
            if(mysqli_num_rows($res)>0){
                echo "inserted record";
            }else{
                echo "not inserted";
            }
        }
        if($entity == 'article'){
             $sql = "INSERT INTO `article`(`id`,`author`,`category`,`title`,`content`,`created`,`updated`) value('','$data[author]','$data[category]', '$data[title]','$data[content]','NOW()','NOW()')";
            $res = mysqli_query($con,$sql);
            if(mysqli_num_rows($res)>0){
                echo "inserted record";
            }else{
                echo "not inserted";
            }
        }
        if($entity == 'comment'){
             $sql = "INSERT INTO `comment`(`id`,`person`,`content`,`created`,`article`,`status`) value('','$data[person]','$data[content]', '','$data[article]','A')";
            $res = mysqli_query($con,$sql);
            if(mysqli_num_rows($res)>0){
                echo "inserted record";
            }else{
                echo "not inserted";
            }
        }
       */
    }

    function updateRecord($entity,$primary,$data){
        // update single record for entity(category, article, comment) using its primary key with data passed
        $sql ='';
        global $con;
        if($entity == 'user'){
             $sql = "UPDATE `user` SET `name` = '$data[name]' ,`email` = '$data[email]',`pwd` = '$data[pwd]' ,`status` = '$data[status]'  where `id` = $primary ";
            $res = mysqli_query($con,$sql);
            if(mysqli_num_rows($res)>0){
                echo "updated record";
            }else{

                echo "not updated";
            }
        }
        if($entity == 'category'){
             $sql = "UPDATE `category` SET `name`='$data[name]',`description`='$data[description]',`status`='$data[status]',`updated` = now(), `created` = now() WHERE `id` = $primary";
            $res = mysqli_query($con,$sql);
            /*if(@mysqli_affected_rows($res)>0){
                echo "updated record";
            }else{
                echo "not updated";
            }*/
        }
        if($entity == 'article'){
             $sql = "UPDATE `article` SET `author`= '$data[author]' ,`category` = '$data[category]',`title` = '$data[title]',`content` = '$data[content]',`updated` = NOW()   where `id` = $primary ";
            $res = mysqli_query($con,$sql);
            if(mysqli_num_rows($res)>0){
                echo "updated record";
            }else{
                echo "not updated";
            }
        }
        if($entity == 'user'){
             $sql = "UPDATE `comment` SET `person`= '$data[person]',`content`= '$data[content]',,`article`= '$data[article]',`status` = '$data[status]'  where `id` = $primary ";
            $res = mysqli_query($con,$sql);
            if(mysqli_num_rows($res)>0){
                echo "updated record";
            }else{
                echo "not updated";
            }
        }
        

       
    }

    function deleteRecord($entity,$primary){
        // delete single record for entity(category, article, comment) using its primary key
        $sql ='';
        global $con;
        if($entity == 'user'){
             $sql = "DELETE FROM `user` WHERE `id` = '$primary'" ;
            $res = mysqli_query($con,$sql);
            
        }
        if($entity == 'category'){
             $sql = "DELETE FROM `category` WHERE `category`.`id` = 3";
            $res = mysqli_query($con,$sql);
           
        }
        if($entity == 'article'){
             $sql = "DELETE FROM `article`  where `id` = '$primary' ";
            $res = mysqli_query($con,$sql);
            
        }
        if($entity == 'user'){
             $sql = "DELETE FROM `comment`  where `id` = '$primary' ";
            $res = mysqli_query($con,$sql);
           
    }
}
    function authenticate($username , $pwd){
        // if successful, redirect to dashboard
        // else stay on login page
        require_once('config/db1.php');
        global $con;
        $sql = "SELECT * from user where name='$username' and status='A' and pwd='$pwd'";
        $res = mysqli_query($con, $sql);
        return $res;
        
    }
?>