<?php
if(isset($_GET['user']))
    $user=$_GET['user'];
$sql="select ConID, ConTyp, ConDescryption, ConFile, date_format(ConDate, '%d.%m.%Y') as ConDate, cast(ConDate as time) as ConTime, a.CreatID from TContributions as c, TAccountscreater as a where a.CreatID = c.CreatID and CreatUsername='$user';";

require './sql_connection.php';

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div id=" . $row["ConID"] . " style='border: solid black 2px; padding: 10px; margin: 5px;'><table>";
        echo "<tr></tr><td>Posted " . $row["ConDate"] . " at " . $row["ConTime"] . "<span onclick=\"delete_post(" . $row["ConID"] . ")\" style='position:relative; padding-left:10vmin;' class=\"glyphicon glyphicon-trash\"></span></td></tr>";
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
        echo "<tr><td><button style='margin-top: 1vmin' class=\"btn btn-default\" onclick=\"comment(" . $row["ConID"] . ")\">show comments</button></td>";
        echo "</table>";
        echo "<div id=\"".$row["ConID"]."_comment\"></div>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

