<?php
if(isset($_GET['id']))
    $id = intval($_GET['id']);

if(isset($_GET['typ']))
    $typ = intval($_GET['typ']);

require './sql_connection.php';

$sql="select c.UseID as UseID, u.UseUsername as Username, CommText, date_format(CommDate, '%d.%m.%Y') as CommDate, cast(CommDate as time) as CommTime from TComments as c, TAccountsUser as u where c.UseID = u.UseID and ConID='$id' order by CommID desc;";
$result = mysqli_query($conn, $sql);
echo"<div style='margin-left: 10vmin;'>Comments:";
if($typ==0) {
    echo "<span style='float: right'><a onclick=\"leave_comment(" . $id . ")\">leave a comment</a></span>";
}
echo"<br><div style='margin-left: 10vmin'>";

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo"<div style='border: black solid 1px;padding-left: 10px;padding-top: 2px;padding-bottom: 2px;'><table>";
        echo"<tr><td>Commented ".$row['CommDate']." at ".$row['CommTime']." by ".$row['Username'].":</td></tr>";
        echo"<tr><td>".$row['CommText']."</td></tr>";
        echo"</table></div>";
    }
}else{
    echo"<strong>No one has left a comment :(</strong>";
}