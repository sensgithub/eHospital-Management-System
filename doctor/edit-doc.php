
    <?php
    include("../connection.php");
    if($_POST){
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $oldemail=$_POST["oldemail"];
        $nic=$_POST['nic'];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select doctor.doctor_id from doctor inner join webuser on doctor.doctor_email=webuser.email where webuser.email='$email';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["doctor_id"];
            }else{
                $id2=$id;
            }
            
            echo $id2."jdfjdfdh";
            if($id2!=$id){
                $error='1';
                    
            }else{
                $sql1="update doctor set doctor_email='$email',doctor_name='$name',doctor_password='$password',doctor_nickname='$nic',doctor_tel='$tele',specialties=$spec where doctor_id=$id ;";
                $database->query($sql1);
                $sql1="update webuser set email='$email' where email='$oldemail' ;";
                $database->query($sql1);
                echo $sql1;
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }           
    } 
    else{
        $error='3';
    }   
    header("location: settings.php?action=edit&error=".$error."&id=".$id);
    ?>
</body>
</html>