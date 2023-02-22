<?php

if(isset($_GET['desc']))
    $desc = $_GET['desc'];//get past variable
if(isset($_GET['user']))
    $user = $_GET['user'];
if(isset($_GET['typ']))
    $typ = $_GET['typ'];

require './sql_connection.php';

switch($typ){
    case "text":
        $typ = array("pdf","txt","docx");
        break;
    case "pic":
        $typ = array("png","jpg","jpeg","img","ico","gif");
        break;
    case "audio":
        $typ = array("mp3","wav","aac");
        break;
    case "video":
        $typ = array("mp4","mov","avi","mkv","webm");
        break;
    default:
        $typ = array("");
        break;
}

for($x = 0; $x < count($typ); $x++) {

    $sql = "select ConID, CreatUsername, ConTyp, ConFile, ConDescryption,  date_format(ConDate, '%d.%m.%Y') as ConDate, cast(ConDate as time) as ConTime from TContributions as p, TAccountsCreater as c where locate('$desc', p.ConDescryption) and locate('$user',c.CreatUsername) and locate('$typ[$x]', p.ConTyp) and c.CreatID = p.CreatID order by ConID desc;";
    $result = mysqli_query($conn, $sql); //TODO select also comments
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
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
                    echo"<tr><td><iframe src=\"data:/" . $row["ConTyp"] . ";base64," . $row["ConFile"] . "\" width=\"200vmin\" height=\"100vmin\" frameborder=\"0\"></iframe></td></tr>";
                    break;
                case "pdf":
                    echo"<tr><td><iframe src=\"data:/" . $row["ConTyp"] . ";base64," . $row["ConFile"] . "\" width=\"200vmin\" height=\"100vmin\"></iframe></td></tr>";
                    break;
                default:
                    echo "<p></p>";
            }
            echo "<tr><td> Description: <br>" . $row["ConDescryption"] . "</td></tr>";
            echo "</table></div>";
        }
    }
}
?>
