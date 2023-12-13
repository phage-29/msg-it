<?php

$host     = "localhost";
$user     = "root";
$password = "DTIRegion6!+";
$db       = "isdsdb";

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
   $conn = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
   echo $e->getMessage();
}

// Reading value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

$searchArray = array();

// Search
$searchQuery = " ";
if ($searchValue != '') {
   $searchQuery = " AND (h.`RequestNo` LIKE :RequestNo OR 
           h.`Status` LIKE :Status OR
           d.`Division` LIKE :Division OR 
           CONCAT(rb.`FirstName`, rb.`LastName`) LIKE :Requestor OR 
           c.`Category` LIKE :Category OR 
           h.DateRequested LIKE :Date ) ";
   $searchArray = array(
      'RequestNo' => "%$searchValue%",
      'Status' => "%$searchValue%",
      'Division' => "%$searchValue%",
      'Requestor' => "%$searchValue%",
      'Category' => "%$searchValue%",
      'Date' => "%$searchValue%"
   );
}

// Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM helpdesks ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

// Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM helpdesks h LEFT JOIN users rb ON h.RequestedBy = rb.id LEFT JOIN divisions d ON rb.`DivisionID` = d.id LEFT JOIN categories c ON h.`CategoryID` = c.id WHERE 1 " . $searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

// Fetch records
$stmt = $conn->prepare("SELECT  h.`RequestNo`, h.`Status`, d.`Division`, CONCAT(rb.`FirstName`, rb.`LastName`) AS Requestor, c.`Category`, h.`DateRequested` AS Date FROM helpdesks h LEFT JOIN users rb ON h.RequestedBy = rb.id LEFT JOIN divisions d ON rb.`DivisionID` = d.id LEFT JOIN categories c ON h.`CategoryID` = c.id WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

// Bind values
foreach ($searchArray as $key => $search) {
   $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach ($empRecords as $row) {
   $data[] = array(
      "RequestNo" => $row['RequestNo'],
      "Status" => "<span class='badge bg-secondary'>" . $row['Status'] . "</span>",
      "Division" => $row['Division'],
      "Requestor" => $row['Requestor'],
      "Category" => $row['Category'],
      "Date" => $row['Date'],
      "Action" => "<button class='btn btn-primary'>View</button> <button class='btn btn-danger'>Delete</button>"
   );
}

// Response
$response = array(
   "draw" => intval($draw),
   "iTotalRecords" => $totalRecords,
   "iTotalDisplayRecords" => $totalRecordwithFilter,
   "aaData" => $data
);

echo json_encode($response);
