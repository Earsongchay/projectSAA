<?php

if (isset($_REQUEST['submit'])) {
   $a =$_FILES['name']['name'];
   echo $a;
}
function hoursandmins($time)
{
    if ($time < 1) {
        return ;
    } else {
        $hour = floor($time / 60);
        $min = ($time % 60);
        if ($min == 1) {
            $format = '%01dh %02d minute';
        } else {
            $format = '%01dh %02d minutes';
            if ($hour < 1) {
                $format = '%02d minutes';
                return sprintf($format, $min);
            }
        }
        return sprintf($format, $hour, $min);
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="name" id="name">
    <button type="submit" id="submit" name="submit">Submit</button>
</form>