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

$slNo = $title = $programmeConductedPlace = $state = $queryLocalLanguage = $answerLocalLanguage = '';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['edit'])) {
    $editSLNo = $_GET['edit'];

    $tablename = "Quesation_and_Answer_12_07_2023";
    $sql_select = "SELECT SL_No, Title, Programme_conducted_Place, State, Query_asked_by_the_caller_Participants_in_Local_Language, Answer_in_local_language FROM $tablename WHERE SL_No = :editSLNo";
    $statement = $pdo->prepare($sql_select);
    $statement->bindParam(':editSLNo', $editSLNo);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $slNo = $result['SL_No'];
        $title = $result['Title'];
        $programmeConductedPlace = $result['Programme_conducted_Place'];
        $state = $result['State'];
        $queryLocalLanguage = $result['Query_asked_by_the_caller_Participants_in_Local_Language'];
        $answerLocalLanguage = $result['Answer_in_local_language'];
    } else {
        echo "No data found for editing";
    }

    $tablename_13_07_2023 = "Quesation_and_Answer_13_07_2023";
    $sql_select_13_07_2023 = "SELECT * FROM $tablename_13_07_2023 WHERE SL_No = :editSLNo";
    $statement_13_07_2023 = $pdo->prepare($sql_select_13_07_2023);
    $statement_13_07_2023->bindParam(':editSLNo', $editSLNo);
    $statement_13_07_2023->execute();
    $result_13_07_2023 = $statement_13_07_2023->fetch(PDO::FETCH_ASSOC);

    $tablename_22_07_2023 = "Quesation_and_Answer_22_07_2023";
    $sql_select_22_07_2023 = "SELECT * FROM $tablename_22_07_2023 WHERE SL_No = :editSLNo";
    $statement_22_07_2023 = $pdo->prepare($sql_select_22_07_2023);
    $statement_22_07_2023->bindParam(':editSLNo', $editSLNo);
    $statement_22_07_2023->execute();
    $result_22_07_2023 = $statement_22_07_2023->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Invalid request";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Csdms_mirror</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="script.js"></script>
    <style>
        .center-container {
            text-align: center;
        }

        .submit-button {
            display: inline-block;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<div class="container">
        <h2>Edit Data - SL_No: <?php echo $slNo; ?></h2>
        <form action="insert.php" method="post">
            <input type="hidden" name="SL_No" value="<?php echo $slNo; ?>">

            
      <div class="row">
    <div class="col-md-3">
       <div class="form-group">
        <label for="n">SL No:</label>
        <input type="text" name="SL_No" id="SL_No" >
        </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Programme_Code">Programme Code:</label>
        <input type="text" name="Programme_Code" id="Programme_Code" >
        </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Audio_confernce_Training_Phone_in_Programme_Knowledge_on_Wheels">Audio Conference Training Phone in Programme Knowledge on Wheels:</label>
        <input type="datetime-local" name="Audio_confernce_Training_Phone_in_Programme_Knowledge_on_Wheels" id="Audio_confernce_Training_Phone_in_Programme_Knowledge_on_Wheels" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Audio_confernce_Training_Awareness_Programme_Knowledge_on_Wheels">Audio Conference Training Awareness Programme Knowledge on Wheels:</label>
        <input type="text" name="Audio_confernce_Training_Awareness_Programme_Knowledge_on_Wheels" id="Audio_confernce_Training_Awareness_Programme_Knowledge_on_Wheels" >
          </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
        <div class="form-group">
                <label for="Title">Title:</label>
                <input type="text" name="Title" id="Title" value="<?php echo $title; ?>">
            </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
                <label for="Programme_conducted_Place">Programme Conducted Place:</label>
                <input type="text" name="Programme_conducted_Place" id="Programme_Conducted_Place" value="<?php echo $programmeConductedPlace; ?>">
            </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Programme_Conducted_District">Programme Conducted District:</label>
        <input type="text" name="Programme_Conducted_District" id="Programme_Conducted_District" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Participant_Name_Caller_Name">Participant Name Caller Name:</label>
        <input type="text" name="Participant_Name_Caller_Name" id="Participant_Name_Caller_Name" >
          </div>
        </div>
        

        <div class="col-md-3">
  <div class="form-group">
        <label for="Participant_Caller_phone_Mobile_no">Participant Caller Phone Mobile No:</label>
        <input type="text" name="Participant_Caller_phone_Mobile_no" id="Participant_Caller_phone_Mobile_no" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Revenue_Village_of_Participant_Caller">Revenue Village of Participant Caller:</label>
        <input type="text" name="Revenue_Village_of_Participant_Caller" id="Revenue_Village_of_Participant_Caller" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Tashil_of_Participant_Caller">Tashil of Participant Caller:</label>
        <input type="text" name="Tashil_of_Participant_Caller" id="Tashil_of_Participant_Caller" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="District_of_Participant_Caller">District of Participant Caller:</label>
        <input type="text" name="District_of_Participant_Caller" id="District_of_Participant_Caller" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
                <label for="State">State:</label>
                <input type="text" name="State" id="State" value="<?php echo $state; ?>">
            </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Gender_of_Participant_Caller">Gender of Participant Caller:</label>
        <input type="text" name="Gender_of_Participant_Caller" id="Gender_of_Participant_Caller" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Was_Call_or_programme_recorded_or_not">Was Call or Programme Recorded or Not:</label>
        <input type="text" name="Was_Call_or_programme_recorded_or_not" id="Was_Call_or_programme_recorded_or_not" >
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
          <b><label>Major Classification:</label></b>
            <select name="majorclassificationmaster" id="majorclassificationmaster" class="form-control">
              <option value="">Select</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
          <b><label>Sub Major Classification:</label></b>
            <select name="submajorclassificationmaster" id="submajorclassificationmaster" class="form-control">
              <option value="">Select</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
          <b><label>Item Type:</label></b>
            <select name="itemtypemaster" id="itemtypemaster" class="form-control">
              <option value="">Select</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
          <b><label>Item Master Type:</label></b>
            <select name="itemmaster" id="itemmaster" class="form-control">
              <option value="">Select</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
          <b><label>Season:</label></b>
          <select name="seasonmaster" id="seasonmaster" class="form-control">
      <option value="">Select</option>
      </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
          <b><label>Category:</label></b>
            <select name="categorymaster" id="categorymaster" class="form-control">
              <option value="">Select</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label for="subcategoryid">Subcategory ID:</label>
            <select name="subcategorymaster" id="subcategorymaster" class="form-control">
              <option value="">Select</option>
            </select>
          </div>
        </div>

    <div class="col-md-3">
  <div class="form-group">
        <label for="Seed_Treatment_Fodder_Management_Fertility_Issue_Subisidy_etc">Seed Treatment/Fodder Management/Fertility Issue/Subsidy etc.:</label>
        <input type="text" name="Seed_Treatment_Fodder_Management_Fertility_Issue_Subisidy_etc" id="Seed_Treatment_Fodder_Management_Fertility_Issue_Subisidy_etc" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Age_of_Crops">Age of Crops:</label>
        <input type="text" name="Age_of_Crops" id="Age_of_Crops" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Title_in_english">Title in English:</label>
        <input type="text" name="Title_in_english" id="Title_in_english" value="<?php echo $title; ?>">

          </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
                <label for="Query_asked_by_the_caller_Participants_in_Local_Language">Query asked by the caller/Participants in Local Language:</label>
                <input type="text" name="Query_asked_by_the_caller_Participants_in_Local_Language" id="Query_asked_by_the_caller_Participants_in_Local_Language" value="<?php echo $queryLocalLanguage; ?>">
            </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="for_the_expert_Cable_TV_number_Audio_Confernce_contact_number">For the expert - Cable TV number/Audio Conference contact number:</label>
        <input type="text" name="for_the_expert_Cable_TV_number_Audio_Confernce_contact_number" id="for_the_expert_Cable_TV_number_Audio_Confernce_contact_number" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Expert_Name">Expert Name:</label>
        <input type="text" name="Expert_Name" id="Expert_Name" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
                <label for="Answer_in_local_language">Answer in Local Language:</label>
                <textarea name="Answer_in_local_language" id="Answer_in_local_language"><?php echo $answerLocalLanguage; ?></textarea>
            </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Call_transfer_forwarded_programme_conducted_person_Name">Call transfer forwarded - Programme conducted person Name:</label>
        <input type="text" name="Call_transfer_forwarded_programme_conducted_person_Name" id="Call_transfer_forwarded_programme_conducted_person_Name" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Answered_offline_Yes_or_No">Answered offline (Yes or No):</label>
        <input type="text" name="Answered_offline_Yes_or_No" id="Answered_offline_Yes_or_No" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Query_answered_on_Date">Query answered on Date:</label>
        <input type="datetime-local" name="Query_answered_on_Date" id="Query_answered_on_Date" >
          </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="days_you_took_to_answer_the_caller_participant_query_in_offline">Days you took to answer the caller/participant query in offline:</label>
        <input type="text" name="days_you_took_to_answer_the_caller_participant_query_in_offline" id="days_you_took_to_answer_the_caller_participant_query_in_offline" >
                  </div>
        </div>

        <div class="col-md-3">
  <div class="form-group">
        <label for="Whether_Query_Addressed_Yes_or_No">Whether Query Addressed (Yes or No):</label>
        <input type="text" name="Whether_Query_Addressed_Yes_or_No" id="Whether_Query_Addressed_Yes_or_No" >
          </div>
        </div>
        </div>
        

        <div class="center-button">
        <input type="submit" class="submit-button" value="Update" name="update">

      </div>
    </form>
  </div>
  <?php

if (isset($_POST['submit'])) {
    $slNo = isset($_POST['SL_No']) ? $_POST['SL_No'] : '';
    $title = isset($_POST['Title']) ? $_POST['Title'] : '';
    $programmeConductedPlace = isset($_POST['Programme_conducted_Place']) ? $_POST['Programme_conducted_Place'] : '';
    $state = isset($_POST['State']) ? $_POST['State'] : '';
    $queryLocalLanguage = isset($_POST['Query_asked_by_the_caller_Participants_in_Local_Language']) ? $_POST['Query_asked_by_the_caller_Participants_in_Local_Language'] : '';
    $answerLocalLanguage = isset($_POST['Answer_in_local_language']) ? $_POST['Answer_in_local_language'] : '';

    $date = date('d-m-Y');
    $targetTable = "Quesation_and_Answer_" . str_replace("-", "_", $date);

    $query = "INSERT INTO $targetTable (Title, Programme_conducted_Place, State, Query_asked_by_the_caller_Participants_in_Local_Language, Answer_in_local_language, SL_No)
    VALUES (:title, :programme_conducted_place, :state, :query_local_language, :answer_local_language, :sl_no)";

    $statement = $pdo->prepare($query);

    $statement->bindParam(':title', $title);
    $statement->bindParam(':programme_conducted_place', $programmeConductedPlace);
    $statement->bindParam(':state', $state);
    $statement->bindParam(':query_local_language', $queryLocalLanguage);
    $statement->bindParam(':answer_local_language', $answerLocalLanguage);
    $statement->bindParam(':sl_no', $slNo);
    
    $statement->execute();

    header("Location: final.php");
    exit();
}
?>


    </div>
  <script src="script.js"></script>
</body>
</html>

