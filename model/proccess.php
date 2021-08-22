<?php
include "opendb.php";

$result = array('error' => false);
$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

// Dispaly the categories 

if ($action == 'read') {

    $sql2 = $conn->query("SELECT * FROM categories");
    $ctg = array();

    while ($row2 = $sql2->fetch_assoc()) {
        array_push($ctg, $row2);
    }


    $result['ctg'] = $ctg;
}

// Create new document 


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


// Update the document 

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


// Delete document

if ($action == 'delete') {
    $id = $_POST['id'];
    $sql = $conn->query("DELETE from documents WHERE id='$id' ");
    if ($sql) {
        $result['message'] = "Document deleted successfully ";
    } else {
        $result['error'] = "Document not deleted";
    }
}


// Dispaly list of the current category

if ($action == 'readList') {
    $id = $_POST['id'];
    $sql1 = $conn->query("SELECT * FROM documents WHERE category_id = '$id' ");
    $docs = array();

    while ($row1 = $sql1->fetch_assoc()) {
        array_push($docs, $row1);
    }



    $result['docs'] = $docs;
}



$conn->close();
echo json_encode($result);
