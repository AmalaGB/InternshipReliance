<?php
$tryDbServername = "localhost";
$tryDbUsername = "root";
$tryDbPassword = "";
$tryDbDatabase = "try_db";


$conn_trydb = mysqli_connect($tryDbServername, $tryDbUsername, $tryDbPassword, $tryDbDatabase);


if (!$conn_trydb) {
    die("Connection to try_db database failed: " . mysqli_connect_error());
}


$qnaServername = "localhost";
$qnaUsername = "root";
$qnaPassword = "";
$qnaDatabase = "qna";


$conn_qna = mysqli_connect($qnaServername, $qnaUsername, $qnaPassword, $qnaDatabase);


if (!$conn_qna) {
    die("Connection to qna database failed: " . mysqli_connect_error());
}

$major_options = array();
$submajor_options_trydb = array();
$submajor_options_qna = array();
$category_options_trydb = array();
$subcategory_options_trydb = array();
$itemtype_options = array();
$item_options = array();
$category_options_qna = array();
$subcategory_options_qna = array();
$season_options_trydb = array();
$season_options_qna = array();
$stage_options = array();

$sql_trydb_major = "SELECT * FROM majorclassificationmaster";
$result_trydb_major = mysqli_query($conn_trydb, $sql_trydb_major);

while ($row = mysqli_fetch_assoc($result_trydb_major)) {
    $major_options[] = array('id' => $row['majorclassificationid'], 'name' => $row['majorclassification']);
}

$sql_trydb_submajor = "SELECT * FROM submajorclassificationmaster";
$result_trydb_submajor = mysqli_query($conn_trydb, $sql_trydb_submajor);

while ($row = mysqli_fetch_assoc($result_trydb_submajor)) {
    $submajor_options_trydb[] = array(
        'id' => $row['submajorclassificationid'],
        'name' => $row['submajorclassification'],
        'majorId' => $row['majorclassificationid']
    );
}


// Fetch submajor options from Quesation_and_Answer_12_07_2023
$sql_qna_submajor = "SELECT DISTINCT Sub_Major FROM Quesation_and_Answer_12_07_2023";
$result_qna_submajor = mysqli_query($conn_qna, $sql_qna_submajor);

while ($row = mysqli_fetch_assoc($result_qna_submajor)) {
    $submajor_options_qna[] = array('id' => $row['Sub_Major'], 'name' => $row['Sub_Major']);
}

// Fetch submajor options from Quesation_and_Answer_13_07_2023
$sql_qna_submajor_13_07_2023 = "SELECT DISTINCT Sub_Major FROM Quesation_and_Answer_13_07_2023";
$result_qna_submajor_13_07_2023 = mysqli_query($conn_qna, $sql_qna_submajor_13_07_2023);

while ($row = mysqli_fetch_assoc($result_qna_submajor_13_07_2023)) {
    $submajor_options_qna[] = array('id' => $row['Sub_Major'], 'name' => $row['Sub_Major']);
}

// Fetch submajor options from Quesation_and_Answer_22_07_2023
$sql_qna_submajor_22_07_2023 = "SELECT DISTINCT Sub_Major FROM Quesation_and_Answer_22_07_2023";
$result_qna_submajor_22_07_2023 = mysqli_query($conn_qna, $sql_qna_submajor_22_07_2023);

while ($row = mysqli_fetch_assoc($result_qna_submajor_22_07_2023)) {
    $submajor_options_qna[] = array('id' => $row['Sub_Major'], 'name' => $row['Sub_Major']);
}
$submajor_options = array_merge($submajor_options_trydb, $submajor_options_qna);

// Fetch category options from try_db
$sql_trydb_category = "SELECT * FROM categorymaster";
$result_trydb_category = mysqli_query($conn_trydb, $sql_trydb_category);

while ($row = mysqli_fetch_assoc($result_trydb_category)) {
    $submajorId = isset($row['submajorclassificationid']) ? $row['submajorclassificationid'] : null;

    $category_options_trydb[] = array(
        'id' => $row['categoryid'],
        'name' => $row['category'],
        'submajorId' => $submajorId
    );
}

// Fetch category options from Quesation_and_Answer_12_07_2023
$sql_qna_category = "SELECT DISTINCT Category FROM Quesation_and_Answer_12_07_2023";
$result_qna_category = mysqli_query($conn_qna, $sql_qna_category);

while ($row = mysqli_fetch_assoc($result_qna_category)) {
    $category_options_qna[] = array('id' => $row['Category'], 'name' => $row['Category']);
}

// Fetch category options from Quesation_and_Answer_13_07_2023
$sql_qna_category_13_07_2023 = "SELECT DISTINCT Category FROM Quesation_and_Answer_13_07_2023";
$result_qna_category_13_07_2023 = mysqli_query($conn_qna, $sql_qna_category_13_07_2023);

while ($row = mysqli_fetch_assoc($result_qna_category_13_07_2023)) {
    $category_options_qna[] = array('id' => $row['Category'], 'name' => $row['Category']);
}

// Fetch category options from Quesation_and_Answer_22_07_2023
$sql_qna_category_22_07_2023 = "SELECT DISTINCT Category FROM Quesation_and_Answer_22_07_2023";
$result_qna_category_22_07_2023 = mysqli_query($conn_qna, $sql_qna_category_22_07_2023);

while ($row = mysqli_fetch_assoc($result_qna_category_22_07_2023)) {
    $category_options_qna[] = array('id' => $row['Category'], 'name' => $row['Category']);
}

$category_options = array_merge($category_options_trydb, $category_options_qna);

// Fetch subcategory options from try_db
$sql_trydb_subcategory = "SELECT * FROM subcategorymaster";
$result_trydb_subcategory = mysqli_query($conn_trydb, $sql_trydb_subcategory);

while ($row = mysqli_fetch_assoc($result_trydb_subcategory)) {
    $categoryId = isset($row['categoryid']) ? $row['categoryid'] : null;

    $subcategory_options_trydb[] = array(
        'id' => $row['subcategoryid'],
        'name' => $row['subcategory'],
        'categoryId' => $categoryId
    );
}

// Fetch subcategory options from Quesation_and_Answer_12_07_2023
$sql_qna_subcategory = "SELECT DISTINCT Sub_Category FROM Quesation_and_Answer_12_07_2023";
$result_qna_subcategory = mysqli_query($conn_qna, $sql_qna_subcategory);

while ($row = mysqli_fetch_assoc($result_qna_subcategory)) {
    $subcategory_options_qna[] = array(
        'id' => $row['Sub_Category'],
        'name' => $row['Sub_Category'],
        'categoryId' => $categoryId
    );
}

// Fetch subcategory options from Quesation_and_Answer_13_07_2023
$sql_qna_subcategory_13_07_2023 = "SELECT DISTINCT Sub_Category FROM Quesation_and_Answer_13_07_2023";
$result_qna_subcategory_13_07_2023 = mysqli_query($conn_qna, $sql_qna_subcategory_13_07_2023);

while ($row = mysqli_fetch_assoc($result_qna_subcategory_13_07_2023)) {
    $subcategory_options_qna[] = array(
        'id' => $row['Sub_Category'],
        'name' => $row['Sub_Category'],
        'categoryId' => $categoryId
    );
}

// Fetch subcategory options from Quesation_and_Answer_22_07_2023
$sql_qna_subcategory_22_07_2023 = "SELECT DISTINCT Sub_Category FROM Quesation_and_Answer_22_07_2023";
$result_qna_subcategory_22_07_2023 = mysqli_query($conn_qna, $sql_qna_subcategory_22_07_2023);

while ($row = mysqli_fetch_assoc($result_qna_subcategory_22_07_2023)) {
    $subcategory_options_qna[] = array(
        'id' => $row['Sub_Category'],
        'name' => $row['Sub_Category'],
        'categoryId' => $categoryId
    );
}
$subcategory_options = array_merge($subcategory_options_trydb, $subcategory_options_qna);

// Fetch itemtype options from try_db
$sql_trydb_itemtype = "SELECT * FROM itemtypemaster";
$result_trydb_itemtype = mysqli_query($conn_trydb, $sql_trydb_itemtype);

while ($row = mysqli_fetch_assoc($result_trydb_itemtype)) {
    $itemtype_options[] = array(
        'id' => $row['itemtypeid'],
        'name' => $row['itemtype'],
        'submajorId' => $row['submajorclassificationid']
    );
}

// Fetch item options from try_db
$sql_trydb_item = "SELECT * FROM itemmaster";
$result_trydb_item = mysqli_query($conn_trydb, $sql_trydb_item);

while ($row = mysqli_fetch_assoc($result_trydb_item)) {
    $item_options[] = array(
        'id' => $row['itemid'],
        'name' => $row['item'],
        'itemtypeId' => $row['itemtypeid']
    );
}
// Fetch season options from try_db
$sql_trydb_season = "SELECT * FROM seasonmaster";
$result_trydb_season = mysqli_query($conn_trydb, $sql_trydb_season);

while ($row = mysqli_fetch_assoc($result_trydb_season)) {
    $season_options_trydb[] = array('id' => $row['seasonid'], 'name' => $row['seasondesc']);
}

// Fetch season options from Quesation_and_Answer_12_07_2023
$sql_qna_season = "SELECT DISTINCT Seasons FROM Quesation_and_Answer_12_07_2023";
$result_qna_season = mysqli_query($conn_qna, $sql_qna_season);

while ($row = mysqli_fetch_assoc($result_qna_season)) {
    $season_options_qna[] = array('id' => $row['Seasons'], 'name' => $row['Seasons']);
}

$season_options = array_merge($season_options_trydb, $season_options_qna);


$season_options = array_values($season_options);


$sql_trydb_stage = "SELECT * FROM stagemaster";
$result_trydb_stage = mysqli_query($conn_trydb, $sql_trydb_stage);

while ($row = mysqli_fetch_assoc($result_trydb_stage)) {
    $stage_options_trydb[] = array('id' => $row['stageid'], 'name' => $row['stagedesc']);
}


$stage_options_trydb = array_values($stage_options_trydb);

$stage_options = $stage_options_trydb;
header('Content-Type: application/json');
$data = array(
    'major' => $major_options,
    'submajor_trydb' => $submajor_options_trydb,
    'submajor_qna' => $submajor_options_qna,
    'category_trydb' => $category_options_trydb, 
    'category_qna' => $category_options_qna,
    'subcategory_trydb' => $subcategory_options_trydb, 
    'subcategory_qna' => $subcategory_options_qna,
    'itemtype' => $itemtype_options,
    'item' => $item_options,
    'submajor' => $submajor_options,
    'category' => $category_options,
    'subcategory' => $subcategory_options,
    'season' => $season_options,
    'stage' => $stage_options
);

echo json_encode($data);

mysqli_close($conn_trydb);
mysqli_close($conn_qna);
?>
