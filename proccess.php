<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, 'documents');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = array('error' => false);
$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'read') {
    $sql1 = $conn->query("SELECT * FROM documents");
    $docs = array();
    $sql2 = $conn->query("SELECT * FROM categories");
    $ctg = array();
    while ($row1 = $sql1->fetch_assoc()) {
        array_push($docs, $row1);
    }

    while ($row2 = $sql2->fetch_assoc()) {
        array_push($ctg, $row2);
    }


    $result['docs'] = $docs;
    $result['ctg'] = $ctg;
}

if ($action == 'readList') {
    $id = $_POST['id'];
    $sql1 = $conn->query("SELECT * FROM documents WHERE category_id = '$id' ");
    $docs = array();
    $sql2 = $conn->query("SELECT * FROM categories");
    $ctg = array();
    while ($row1 = $sql1->fetch_assoc()) {
        array_push($docs, $row1);
    }

    while ($row2 = $sql2->fetch_assoc()) {
        array_push($ctg, $row2);
    }


    $result['docs'] = $docs;
    $result['ctg'] = $ctg;
}

if ($action == 'create') {
    $name = $_POST['name'];
    $category_id = $_POST['cat_id'];
    $sql = $conn->query("INSERT INTO documents (name, category_id ) VALUES('$name', '$category_id' )");
    if ($sql) {
        $result['message'] = "Document with name '$name' added successfully ";
    } else {
        $result['error'] =  'Document not added';
    }
}

if ($action == 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category_id = $_POST['cat_id'];
    $sql = $conn->query("UPDATE  documents SET name='$name',category_id ='$category_id' WHERE id = '$id' ");
    if ($sql) {
        $result['message'] = "Document with name '$name' updated successfully ";
    } else {
        $result['error'] = "Document with name' $name 'not updated  ";
    }
}

if ($action == 'delete') {
    $id = $_POST['id'];
    $sql = $conn->query("DELETE from documents WHERE id='$id' ");
    if ($sql) {
        $result['message'] = "Document deleted successfully ";
    } else {
        $result['error'] = "Document not deleted";
    }
}


$conn->close();
echo json_encode($result);
