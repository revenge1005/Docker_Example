<?php
session_start();
if(($_POST['id']!=null)&&($_POST['pw']!=null)){
	if(($_POST['id']=='answer')&&($_POST['pw']=='1234')){
		$_SESSION['is_login']=true;
		$_SESSION['id']=$_POST['id'];
		header('Location: ./blog_manage_pdo.php');
	}else{
		$_SESSION['msg']='wrong id or pw';
		header('Location: ./login.php');
	}
}else{
	$_SESSION['msg']='null id or pw';
	header('Location: ./login.php');
}
?>
