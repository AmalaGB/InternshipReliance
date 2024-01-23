<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "qna";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function fetchDataFromTable($pdo, $tablename)
{
    $sql_select_all = "SELECT SL_No, Title, Programme_conducted_Place, Horticulture_Livestock_Fisheries_Microenterprises_Health_General, Sub_Major, Crop_Type, Crop_Livestock_Topic_name, Seasons, Category, Sub_Category, State, Query_asked_by_the_caller_Participants_in_Local_Language, Answer_in_local_language FROM $tablename";
    $statement = $pdo->query($sql_select_all);
    
    if ($statement === false) {
        echo "Error fetching data from table $tablename: " . print_r($pdo->errorInfo(), true);
        return [];
    }
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

$result_12_07_2023 = fetchDataFromTable($pdo, "Quesation_and_Answer_12_07_2023");
$result_13_07_2023 = fetchDataFromTable($pdo, "Quesation_and_Answer_13_07_2023");
$result_22_07_2023 = fetchDataFromTable($pdo, "Quesation_and_Answer_22_07_2023");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Csdms_mirror</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <table border="1">
            <tr>
                <th>SL No</th>
                <th>Title</th>
                <th>Programme Conducted Place</th>
                <th>Horticulture_Livestock_Fisheries_Microenterprises_Health_General</th>
                <th>State</th>
                <th>Query</th>
                <th>Answer</th>
                <th>Action</th>
            </tr>
            <?php
            // Loop through each table result separately
            foreach ($result_12_07_2023 as $row) {
                echo "<tr>";
                echo "<td>{$row['SL_No']}</td>";
                echo "<td>{$row['Title']}</td>";
                echo "<td>{$row['Programme_conducted_Place']}</td>";
                echo "<td>{$row['Horticulture_Livestock_Fisheries_Microenterprises_Health_General']}</td>";
                echo "<td>{$row['State']}</td>";
                echo "<td>{$row['Query_asked_by_the_caller_Participants_in_Local_Language']}</td>";
                echo "<td>{$row['Answer_in_local_language']}</td>";
                echo "<td><a href='excel.php?edit={$row['SL_No']}'>Edit</a></td>";
                echo "</tr>";
            }

            foreach ($result_13_07_2023 as $row) {
                echo "<tr>";
                echo "<td>{$row['SL_No']}</td>";
                echo "<td>{$row['Title']}</td>";
                echo "<td>{$row['Programme_conducted_Place']}</td>";
                echo "<td>{$row['Horticulture_Livestock_Fisheries_Microenterprises_Health_General']}</td>";
                echo "<td>{$row['State']}</td>";
                echo "<td>{$row['Query_asked_by_the_caller_Participants_in_Local_Language']}</td>";
                echo "<td>{$row['Answer_in_local_language']}</td>";
                echo "<td><a href='excel.php?edit={$row['SL_No']}'>Edit</a></td>";
                echo "</tr>";
            }

            foreach ($result_22_07_2023 as $row) {
                echo "<tr>";
                echo "<td>{$row['SL_No']}</td>";
                echo "<td>{$row['Title']}</td>";
                echo "<td>{$row['Programme_conducted_Place']}</td>";
                echo "<td>{$row['Horticulture_Livestock_Fisheries_Microenterprises_Health_General']}</td>";
                echo "<td>{$row['State']}</td>";
                echo "<td>{$row['Query_asked_by_the_caller_Participants_in_Local_Language']}</td>";
                echo "<td>{$row['Answer_in_local_language']}</td>";
                echo "<td><a href='excel.php?edit={$row['SL_No']}'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
