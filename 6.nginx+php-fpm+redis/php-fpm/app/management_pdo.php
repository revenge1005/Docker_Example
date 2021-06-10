<?php

try{
    $conn=new pdo('mysql:host=localhost','root','0157');    
            
}catch(PDOException $e){
            echo 'could not connect:'.$e->getMessage();
}
        
$selDb=$conn->exec('use answerofgod');


switch($_GET['mode']){
	case 'insert':
		if($_POST['url']!=null){
			
			$insert=$conn->prepare('insert into blog (url,description) value (:url,:description)' );
			$url=filter_input(INPUT_POST,'url');
			$insert->bindParam(':url',$url,PDO::PARAM_STR);
			$description=filter_input(INPUT_POST,'description');
			$insert->bindParam(':description',$description,PDO::PARAM_STR);
			$insert->execute();
			
		}
		header('Location: blog_manage_pdo.php');
		
		break;
	case 'delete':
		
		$delete=$conn->prepare('delete from blog where id=:id');
		$id=filter_input(INPUT_POST,'id');
		$delete->bindParam(':id',$id,PDO::PARAM_INT);
		$delete->execute();
		

		header('Location: blog_manage_pdo.php');
		break;
	
	case 'modify':
		
		
		$update=$conn->prepare('update blog set url=:url,description=:description where id=:id');
		
		$url=filter_input(INPUT_POST,'url');
		$update->bindParam(':url',$url,PDO::PARAM_STR);
		$description=filter_input(INPUT_POST,'description');
		$update->bindParam(':description',$description,PDO::PARAM_STR);
		$id=filter_input(INPUT_POST,'id');
		$update->bindParam(':id',$id,PDO::PARAM_INT);
		$update->execute();
		
		
		header('Location: blog_manage_pdo.php');
		break;
	default:
		header('Location: blog_manage_pdo.php');
		break;
	}

?>	
