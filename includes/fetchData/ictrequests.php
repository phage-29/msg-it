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

session_start();

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
           c.`Category` LIKE :Category OR 
           h.DateRequested LIKE :Date )";
    $searchArray = array(
        'RequestNo' => "%$searchValue%",
        'Status' => "%$searchValue%",
        'Division' => "%$searchValue%",
        'Category' => "%$searchValue%",
        'Date' => "%$searchValue%"
    );
}

// Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM helpdesks WHERE RequestedBy=" . $_SESSION['id'] . " ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

// Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM helpdesks h LEFT JOIN users rb ON h.RequestedBy = rb.id LEFT JOIN divisions d ON rb.`DivisionID` = d.id LEFT JOIN categories c ON h.`CategoryID` = c.id WHERE RequestedBy=" . $_SESSION['id'] . " " . $searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

// Fetch records
$stmt = $conn->prepare("SELECT  h.`id`, h.`RequestNo`, h.`Status`, d.`Division`, c.`Category`, h.`DateRequested` AS Date, h.`Csf` FROM helpdesks h LEFT JOIN users rb ON h.RequestedBy = rb.id LEFT JOIN divisions d ON rb.`DivisionID` = d.id LEFT JOIN categories c ON h.`CategoryID` = c.id WHERE RequestedBy=" . $_SESSION['id'] . " AND h.`Status`='" . $_POST['Status'] . "'" . " " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

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
    $status = $row['Status'];
    $badgeClass = 'bg-warning';

    switch ($status) {
        case 'Open':
            $badgeClass = 'bg-primary';
            break;
        case 'Pending':
        case 'Pre-Repair':
            $badgeClass = 'bg-warning text-dark';
            break;
        case 'Completed':
            $badgeClass = 'bg-success';
            break;
        case 'Denied':
        case 'Cancelled':
        case 'Unserviceable':
            $badgeClass = 'bg-danger';
            break;
    }

    $data[] = array(
        "RequestNo" => $row['RequestNo'],
        "Status" => "<p class='text-center'><span class='badge " . $badgeClass . "'>" . $status . "</span></p>",
        "Division" => $row['Division'],
        "Category" => $row['Category'],
        "Date" => $row['Date'],
        "Action" => "<button class='editbtn btn btn-primary' onclick='return ehid(" . $row['id'] . ")'>View</button> " .
            ($status == 'Open' || $status == 'Pending' ?
                "<button class='cancelbtn btn btn-outline-danger' onclick='return chid(" . $row['id'] . ")'>Cancel</button>" : "") .
            ($status == 'Completed' ?
                ($row['Csf'] == 'Pending' ?
                    "<button class='cancelbtn btn btn-outline-success' onclick='return csfhid(" . $row['id'] . ")'>CSF</button>" : "<button class='cancelbtn btn btn-outline-success' disabled>CSF<i class='bi bi-check-circle'></i></button>") : "")

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
