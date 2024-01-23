<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $major = isset($_POST['majorclassificationmaster']) ? $_POST['majorclassificationmaster'] : '';
    $submajor = isset($_POST['submajorclassificationmaster']) ? $_POST['submajorclassificationmaster'] : '';
    $category = isset($_POST['categorymaster']) ? $_POST['categorymaster'] : '';
    $subcategory = isset($_POST['subcategorymaster']) ? $_POST['subcategorymaster'] : '';
    $itemtype = isset($_POST['itemtypemaster']) ? $_POST['itemtypemaster'] : '';
    $item = isset($_POST['itemmaster']) ? $_POST['itemmaster'] : '';
    $seasons = isset($_POST['seasonmaster']) ? $_POST['seasonmaster'] : '';
    $queryLocalLanguage = isset($_POST['Query_asked_by_the_caller_Participants_in_Local_Language']) ? $_POST['Query_asked_by_the_caller_Participants_in_Local_Language'] : '';
    $answerLocalLanguage = isset($_POST['Answer_in_local_language']) ? $_POST['Answer_in_local_language'] : '';

    try {
        $insertServername = "localhost";
        $insertUsername = "root";
        $insertPassword = "";
        $insertDatabase = "schema"; 

        $insertPdo = new PDO("mysql:host=$insertServername;dbname=$insertDatabase", $insertUsername, $insertPassword);
        $insertPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $insertSql = "INSERT INTO `contentmaster` (`majorclassificationid`, `submajorclassificationid`, `categoryid`, `subcategoryid`, `itemtypeid`, `itemid`, `seasonid`, `needquestion`, `needanswer`)
                VALUES (:major, :submajor, :category, :subcategory, :itemtype, :item, :seasons, :needquestion, :needanswer)";

        $insertStatement = $insertPdo->prepare($insertSql);

        $insertStatement->bindParam(':major', $major);
        $insertStatement->bindParam(':submajor', $submajor);
        $insertStatement->bindParam(':category', $category);
        $insertStatement->bindParam(':subcategory', $subcategory);
        $insertStatement->bindParam(':itemtype', $itemtype);
        $insertStatement->bindParam(':item', $item);
        $insertStatement->bindParam(':seasons', $seasons);
        $insertStatement->bindParam(':needquestion', $queryLocalLanguage);
        $insertStatement->bindParam(':needanswer', $answerLocalLanguage);

        $insertStatement->execute();
        $retrieveServernameTryDB = "localhost";
        $retrieveUsernameTryDB = "root";
        $retrievePasswordTryDB = "";
        $retrieveDatabaseTryDB = "try_db"; 

        $retrievePdoTryDB = new PDO("mysql:host=$retrieveServernameTryDB;dbname=$retrieveDatabaseTryDB", $retrieveUsernameTryDB, $retrievePasswordTryDB);
        $retrievePdoTryDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $getIdSqlTryDB = "SELECT MAX(majorclassification) as last_id FROM majorclassificationmaster"; 
        $getIdStatementTryDB = $retrievePdoTryDB->prepare($getIdSqlTryDB);
        $getIdStatementTryDB->execute();
        $idResultTryDB = $getIdStatementTryDB->fetch(PDO::FETCH_ASSOC);

        if ($idResultTryDB) {
            $lastInsertedIdTryDB = $idResultTryDB['last_id'];
           // echo "Last inserted ID from try_db.majorclassificationmaster: $lastInsertedIdTryDB <br>";
        } else {
            echo "ID not found in try_db";
        }
    } catch (PDOException $e) {
        die("Retrieve connection failed: " . $e->getMessage());
    }
}

$fetchServername = "localhost";
$fetchUsername = "root";
$fetchPassword = "";
$fetchDatabase = "schema"; 

try {
    $fetchPdo = new PDO("mysql:host=$fetchServername;dbname=$fetchDatabase", $fetchUsername, $fetchPassword);
    $fetchPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlFetch = "SELECT * FROM `contentmaster`";
    $resultFetch = $fetchPdo->query($sqlFetch);

    if ($resultFetch) {
        echo "<table border='1'>
            <tr>
                <th>Major</th>
                <th>Submajor</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Item Type</th>
                <th>Item</th>
                <th>Season</th>
                <th>Question</th>
                <th>Answer</th>
            </tr>";

        while ($row = $resultFetch->fetch(PDO::FETCH_ASSOC)) {
            $nameQueryMajor = "SELECT majorclassification FROM majorclassificationmaster WHERE majorclassificationid = :majorId";
            $nameStatementMajor = $retrievePdoTryDB->prepare($nameQueryMajor);
            $nameStatementMajor->bindParam(':majorId', $row['majorclassificationid']);
            $nameStatementMajor->execute();
            $nameResultMajor = $nameStatementMajor->fetch(PDO::FETCH_ASSOC);

            $majorName = ($nameResultMajor) ? $nameResultMajor['majorclassification'] : 'Unknown';

            $nameQuerySubmajor = "SELECT submajorclassification FROM submajorclassificationmaster WHERE submajorclassificationid = :submajorId";
            $nameStatementSubmajor = $retrievePdoTryDB->prepare($nameQuerySubmajor);
            $nameStatementSubmajor->bindParam(':submajorId', $row['submajorclassificationid']);
            $nameStatementSubmajor->execute();
            $nameResultSubmajor = $nameStatementSubmajor->fetch(PDO::FETCH_ASSOC);

            $submajorName = ($nameResultSubmajor) ? $nameResultSubmajor['submajorclassification'] : 'Unknown';

            $nameQueryCategory = "SELECT category FROM categorymaster WHERE categoryid = :categoryId";
            $nameStatementCategory = $retrievePdoTryDB->prepare($nameQueryCategory);
            $nameStatementCategory->bindParam(':categoryId', $row['categoryid']);
            $nameStatementCategory->execute();
            $nameResultCategory = $nameStatementCategory->fetch(PDO::FETCH_ASSOC);

            $categoryName = ($nameResultCategory) ? $nameResultCategory['category'] : 'Unknown';

            $nameQuerySubcategory = "SELECT subcategory FROM subcategorymaster WHERE subcategoryid = :subcategoryId";
            $nameStatementSubcategory = $retrievePdoTryDB->prepare($nameQuerySubcategory);
            $nameStatementSubcategory->bindParam(':subcategoryId', $row['subcategoryid']);
            $nameStatementSubcategory->execute();
            $nameResultSubcategory = $nameStatementSubcategory->fetch(PDO::FETCH_ASSOC);

            $subcategoryName = ($nameResultSubcategory) ? $nameResultSubcategory['subcategory'] : 'Unknown';

            $nameQueryItemtype = "SELECT itemtype FROM itemtypemaster WHERE itemtypeid = :itemtypeId";
            $nameStatementItemtype = $retrievePdoTryDB->prepare($nameQueryItemtype);
            $nameStatementItemtype->bindParam(':itemtypeId', $row['itemtypeid']);
            $nameStatementItemtype->execute();
            $nameResultItemtype = $nameStatementItemtype->fetch(PDO::FETCH_ASSOC);

            $itemtypeName = ($nameResultItemtype) ? $nameResultItemtype['itemtype'] : 'Unknown';

            $nameQueryItem = "SELECT item FROM itemmaster WHERE itemid = :itemId";
            $nameStatementItem = $retrievePdoTryDB->prepare($nameQueryItem);
            $nameStatementItem->bindParam(':itemId', $row['itemid']);
            $nameStatementItem->execute();
            $nameResultItem = $nameStatementItem->fetch(PDO::FETCH_ASSOC);

            $itemName = ($nameResultItem) ? $nameResultItem['item'] : 'Unknown';

            $nameQuerySeason = "SELECT seasondesc FROM seasonmaster WHERE seasonid = :seasonId";
            $nameStatementSeason = $retrievePdoTryDB->prepare($nameQuerySeason);
            $nameStatementSeason->bindParam(':seasonId', $row['seasonid']);
            $nameStatementSeason->execute();
            $nameResultSeason = $nameStatementSeason->fetch(PDO::FETCH_ASSOC);

            $seasonName = ($nameResultSeason) ? $nameResultSeason['seasondesc'] : 'Unknown';

            echo "<tr>
                <td>{$majorName}</td>
                <td>{$submajorName}</td>
                <td>{$categoryName}</td>
                <td>{$subcategoryName}</td>
                <td>{$itemtypeName}</td>
                <td>{$itemName}</td>
                <td>{$seasonName}</td>
                <td>{$row['needquestion']}</td>
                <td>{$row['needanswer']}</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "Error fetching data: " . mysqli_error($conn);
    }
} catch (PDOException $e) {
    die("Fetch connection failed: " . $e->getMessage());
}
?>
