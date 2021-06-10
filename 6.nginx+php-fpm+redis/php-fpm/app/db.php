<?php
        $conn = mysqli_connect(
        '172.17.0.5',
        'test',
        'password',
        'TEST',
        '3306'
        );

        if(mysqli_connect_errno()) {
                echo "Failed to Connect to Mysql: ".mysqli_connect_error();
        }

        $sql = "select VERSION()";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
	print_r($row["VERSION()"]);
?>
<br><br>
	"172.17.0.4:9001"
