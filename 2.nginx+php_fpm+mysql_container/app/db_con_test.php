<?php
        $conn = mysqli_connect(
        'IP_ADDR',
        'test',
        'password',
        'TEST',
        '9876'
        );

        if(mysqli_connect_errno()) {
                echo "Failed to Connect to Mysql: ".mysqli_connect_error();
        }

        $sql = "select VERSION()";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        print_r($row["VERSION()"]);
?>
