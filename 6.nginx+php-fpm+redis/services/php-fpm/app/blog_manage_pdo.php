<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['is_login'])){
    $_SESSION['msg']='need a login!!';
    header('Location: ./login.php');
}else{
    if(isset($_SESSION['id'])){
        echo 'Welcome '.$_SESSION['id'];
    }else{
        echo 'Welcome to blog management';
    }
    echo '<form action="logout.php" >
    <input type="submit" value="logout"/>
    </form>'; 
}
?>
<html>
    <head>
        <TITLE> Blog management</TITLE>
       
    </head>   
    <body>
        <H2>BLOG MANAGEMENT</h2>

        <table border='1'>
            <tr align='center'>
                <td>
                    <p>ID</p>
                </td>
                <td>
                    <p>URL</p>
                </td>
                <td>
                    <p>DESCRIPTION</p>
                </td>
                <td>
                    <p>DELETE/MODIFY</p>
                </td>
            </tr>
        <?php
        try{
            $conn=new pdo('mysql:host=localhost','root','0157');    

        }catch(PDOException $e){
            echo 'could not connect:'.$e->getMessage();
        }
        
        $selDb=$conn->exec('use answerofgod');
        if(!$selDb){
           // die('can not use answerofgod :'.mysql_error()); 
            $createDB=$conn->exec('create database answerofgod');
            $useDB=$conn->exec('use answerofgod');
            $createTable=$conn->exec('create table blog(
                                        id int not null auto_increment, 
                                        url text not null, 
                                        description text null, 
                                        constraint pk primary key(id) 
                                        )');
        }
        $queryData=$conn->query('select * from blog');
        if(!$queryData){
            echo('query error :'.mysql_error());
        }
        while($row=$queryData->fetch(PDO::FETCH_ASSOC)){

            echo '<tr><form action="./management_pdo.php?mode=modify" method="POST">
            <td><input name="id" value="'.$row['id'].'" readonly size=1/></td>
            <td><input name="url" value="'.$row['url'].'"/></td>
            <td><input name="description" value="'.$row['description'].'"/></td>
            <td>
            <input type="submit" value="MODIFY"/>
            </form>

            <form action="./management_pdo.php?mode=delete" method="POST">
            <input type="hidden" name="id" value="'.$row['id'].'"/>
            <input type="submit" value="DELETE"/>
            </form>
            </td>';
            
        }
        ?>          
                 
        </tr>
        </table>

        <p>ADD DATA</p>
        <form action="./management_pdo.php?mode=insert" method="POST">
            <table border='1'>
                <tr>
                    <td align='center'>
                       <p> BLOG URL</p>
                    </td>
                    <td>
                        <input type="text" name="url" size='25'>   
                    </td>
                </tr>

                <tr>
                    <td align='center'>
                        <p>DESCRIPTION</p>
                    </td>
                    <td>
                        <input type="text" name="description" size='25'/>
                    </td>

                </tr>

                <tr align='center'>
                    <td>
                        <p>ADD</p>
                    </td>
                    <td>
                        <input type="submit" value="send"/>            
                    </td>
                </tr>

            </table>
	</form>
    </body>
</html>
