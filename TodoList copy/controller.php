<?php

$conn = mysqli_connect("localhost", "root", "", "todo");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function registration($data)
{
    global $conn;

    $username = strtolower($data["username"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirmation = mysqli_real_escape_string($conn, $data["confirm"]);

    $cekUsername = mysqli_query($conn, "SELECT username FROM user WHERE username='$username'");

    if (mysqli_fetch_assoc($cekUsername)) {
        echo "
        <script>
        alert('username taken');
        </script>
        ";
        return false;
    }
    if ($password !== $confirmation) {
        echo "
        <script>
        alert('confirmation password error');
        </script>
        ";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO user VALUES('','$username','$password')";


    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function add($data)
{
    global $conn;
    $task = htmlspecialchars($data["task"]);
    $status = 0;
    $user=$_SESSION["user_id"];
    $query = "INSERT INTO newlist 
VALUES ('','$task','$status','$user')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function deleteTgt($id)
{
    global $conn;
    $user = $_SESSION["user_id"];
    $query = "DELETE FROM newlist WHERE id='$id' AND user_id='$user'";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function editTask($data)
{

    global $conn;
    $task = htmlspecialchars($data["task"]);
    $id = $data["id"];
    $user=$_SESSION["user_id"];


    $query = "UPDATE newlist set 
    task='$task'
    WHERE id='$id'AND user_id='$user'
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}



function change($data)
{
    global $conn;
    $id = htmlspecialchars($data);
    $user=$_SESSION["user_id"];


    $temp = query("SELECT status FROM newlist WHERE id='$id' AND user_id='$user'")[0];
    if ($temp["status"] == 1) {
        $query = "UPDATE newlist SET status=0 WHERE id='$id' AND user_id='$user'; ";
    } else {
        $query = "UPDATE newlist SET status=1 WHERE id='$id' AND user_id='$user'; ";
    }
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
