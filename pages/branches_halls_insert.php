<?php
include('db_connect.php');

if (isset($_POST['upload'])) {
    $hall_id = $_POST['hall_id'];
    $branch_id = $_POST['branch_id'];
    echo $branch_id ;
    echo $hall_id."<br>";

    $sql = "SELECT hall_branch_id,hall_id,branch_id FROM branches_halls WHERE hall_id IN (SELECT hall_id from halls)
                                                 AND branch_id IN (SELECT branch_id from branches)
                                                 ORDER BY branch_id";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
 
        if ($hall_id == $row['hall_id'] && $branch_id == $row['branch_id'] ) {
            echo "The data is already existed which id = " . $row['hall_branch_id'];
            break;
        } else {
            continue;
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Insert Branch_Hall</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        #content {
            background-color: brown;
            padding: 50px;
        }

        h1 {
            color: bisque;
        }
    </style>
</head>

<body>
    <div id="content">
        <h1>Insert into Branch_Hall</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <!-- pull hall data -->
            <?php
            $sql = "SELECT hall_id,hall_name FROM halls";
            $result = $connection->query($sql);
            ?>
            <select class="form-control" id="exampleFormControlSelect1" name="hall_id">
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <option value="<?php echo $row['hall_id'] ?>"><?php echo $row['hall_name'] ?>
                    </option><?php
                            }
                                ?>
            </select>
            <br>
            <!-- pull branch data -->
            <?php
            $sql = "SELECT branch_id,branch_name FROM branches";
            $result = $connection->query($sql);
            ?>
            <select class="form-control" id="exampleFormControlSelect1" name="branch_id">
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <option value="<?php echo $row['branch_id'] ?>"><?php echo $row['branch_name'] ?>
                    </option><?php
                            }
                                ?>
            </select>
            <br>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="go">GO</button>
            </div><br><br>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
            </div>
        </form>
    </div>
</body>

</html>