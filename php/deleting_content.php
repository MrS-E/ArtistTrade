<?php
if(isset($_GET['typ']))
    $typ = $_GET['typ'];
//echo $typ . "\n";
if(isset($_GET['id']))
    $id = $_GET['id'];
//echo $id . "\n";

require './sql_connection.php';

$sql="";

switch ($typ){
    case "post":
        if(isset($id)) {
            //getting comments to delete
            $sql = "select CommID from TComments as cm natural join TContributions as cn where cn.ConID='$id'; ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $arr = array('');
                while($row = mysqli_fetch_assoc($result)) {
                    $arr[] = $row['CommID'];

                }
                unset($new_arr);
            }
            //deleting post
            $sql = "delete from TContributions where ConID='$id';";
            if (mysqli_query($conn, $sql)) {
                //echo "Record deleted successfully";
            } else {
                echo "Error occoured deleting this record, please reload the side and try again";
            }
            //deleting comments
            if(isset($arr)){
                foreach($arr as $x){
                    $sql="delete from TComments where CommID='$x';";
                    if (mysqli_query($conn, $sql)) {
                        //echo "Record deleted successfully";
                    } else {
                        //echo "Error deleting record: " . mysqli_error($conn);
                    }
                }
            }
        }
        unset($arr,$x,$sql,$typ,$id);
        break;
    case "comment":
        if(isset($id)){
            $sql="delete from TComments where CommID='$id';";
            if (mysqli_query($conn, $sql)) {
                //echo "Record deleted successfully";
            } else {
                echo "Error occoured deleting this record, please reload the side and try again";
            }
        }
        unset($id,$typ,$sql);
        break;
    default:
        echo "Error: strange typ";
        break;
}

echo"deleted content";

