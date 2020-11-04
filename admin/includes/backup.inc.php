<?php
    require_once "../../composer/vendor/autoload.php";

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../..");
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db_names = array();
        foreach(array_keys($_POST['tables']) as $name) {
            $db_names[] = $name;
        }

        $sqlOut = "";
        foreach($db_names as $table) {
            $sql = "SHOW CREATE TABLE $table";
            $result = $conn->query($sql);
            $row = $result->fetch();
            $sqlOut .= "\n\n$row[1];\n\n";

            $tb = "\n\n$row[1]\n\n";

            $query = "SELECT * FROM $table";
            $result = $conn->query($query);

            $cols = $result->columnCount();

            while($row = $result->fetch()) {
                $sqlOut .= "INSERT INTO $table VALUES(";
                for($i = 0; $i < $cols; $i++) {
                    if(isset($row[$i])) {
                        $sqlOut .= '"' . $row[$i] . '"';
                    }
                    else {
                        $sqlOut .= '""';
                    }
                    $sqlOut .= $i < ($cols - 1) ? ',' : '';
                }
                $sqlOut .= ");\n";
            }
            $sqlOut .= "\n";
        }

        // Did this file in sessions, because sessions is already available to write in
        $backup_fname = "../../sessions/" . $_ENV['DB_NAME'] . '_backup_' . time() . '.sql';
        $f = fopen($backup_fname, 'w+');
        fwrite($f, $sqlOut);
        fclose($f);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backup_fname));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header("Pragma: public");
        header('Content-Length: ' . filesize($backup_fname));
        ob_clean();
        flush();
        readfile($backup_fname);
        exec('rm ' . $backup_fname);

        exit();
    }
    else {
        $arr = array();
        $arr['message'] = 'Invalid connection';
        header("Content-Type: application/json; charset=utf-8");
        
        echo json_encode($arr);
        exit();
    }