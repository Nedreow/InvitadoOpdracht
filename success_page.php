<?php
$personalData = new PersonalData($_POST);

$personalData->save();

backupDatabase();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
</head>
<body>
    <p>
        Bedankt voor het invullen van ons formulier, we zullen zo spoedig mogenlijk contact opnemen
    </p>
</body>
</html>

<?php

function backupDatabase()
{
    $conn = DatabaseConfig::getConnection();

    $row=$conn->prepare('select * from personal_data');

    $row->execute();
    $personalData = [];

    foreach($row as $rec)
    {
        $subArray['id'] = $rec['id'];
        $subArray['salutation'] = $rec['salutation'];
        $subArray['custom_salutation'] = $rec['custom_salutation'];
        $subArray['first_name'] = $rec['first_name'];
        $subArray['last_name'] = $rec['last_name'];
        $subArray['birthday'] = $rec['birthday'];
        $subArray['email'] = $rec['email'];
        $subArray['country'] = $rec['country'];

        array_push($personalData, $subArray);
    }

    $jsonBackup = fopen("database_backup.json", "w");
    fwrite($jsonBackup, json_encode($personalData));
}