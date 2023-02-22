<?php
if(isset($_GET['q']))
    $q = intval($_GET['q']);//get past variable
if(isset($_GET['p']))
    $p = intval($_GET['p']);
if(isset($_GET['comm_show'])) {
    $comm_show = 1;
}else{
    $comm_show = 0;
}

require './sql_connection.php';

$sql="select ConID, CreatUsername, ConTyp, ConFile, ConDescryption, date_format(ConDate, '%d.%m.%Y') as ConDate, cast(ConDate as time) as ConTime from TContributions as p, TAccountsCreater as c where p.CreatID = c.CreatID order by ConID desc"; //get all posts, without comments
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $count=0;
    while($row = mysqli_fetch_assoc($result)) {
        if( $count>=$p && $count<$q) {
            echo "<div id=" . $row["ConID"] . " style='border: solid black 2px; padding: 10px; margin: 5px;'><table>";
            echo "<tr></tr><td>Posted " . $row["ConDate"] . " at " . $row["ConTime"] . " by " . $row["CreatUsername"] . " </td></tr>";
            switch ($row["ConTyp"]) {
                case "png":
                case "jpg":
                case "jpeg":
                case "img":
                case "gif":
                case "ico":
                    echo "<tr><td><img width='200vmin' height='auto' src=\"data:image/" . $row["ConTyp"] . ";base64," . $row["ConFile"] . "\"/></td></tr>";
                    break;
                case "mp3":
                case "wav":
                case "aac":
                //case "mp4a":
                    echo "<tr><td><audio controls><source src=\"data:audio/" . $row["ConTyp"] . ";base64," . $row["ConFile"] . "\"></audio></td></tr>";
                    break;
                case "mp4":
                case "webm":
                case "avi":
                case "mov":
                case "mkv":
                    echo "<tr><td><video width='200vmin' height='auto' controls><source src=\"data:video/" . $row["ConTyp"] . ";base64," . $row["ConFile"] . "\">This browser does not support this video.</video></td></tr>";
                    break;
                case "txt":
                    echo"<tr><td><iframe src=\"data:/" . $row["ConTyp"] . ";base64," . $row["ConFile"] . "\" width=\"200vmin\" height=\"100vmin\" frameborder=\"0\" allow-same-origin></iframe></td></tr>";
                    break;
                case "pdf":
                    echo"<tr><td><iframe src=\"data:application/" . $row["ConTyp"] . ";base64," . $row["ConFile"] . "\" width=\"200vmin\" height=\"100vmin\" allow-same-origin></iframe></td></tr>";
                    break;
                default:
                    echo "<p></p>";
                    break;
            }
            echo "<tr><td> Description: <br>" . $row["ConDescryption"] . "</td></tr>";
            if($comm_show==1)
                echo "<tr><td><button style='margin-top: 1vmin' class=\"btn btn-default\" onclick=\"comment(" . $row["ConID"] . ")\">show comments</button></td>";
            echo "</table>";
            if($comm_show==1)
                echo "<div id=\"".$row["ConID"]."_comment\"></div>";
            echo "</div>";
        }
        $count+=1;
    }
} else {
    //echo "Nothing to see here ;-)";
}
?>

