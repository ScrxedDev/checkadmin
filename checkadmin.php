<?php
$errorMessage = "{\"error\" : \"No valid userid provided!\"}";
if (!isset($_GET["userid"]) || empty($_GET["userid"])) {
    echo($errorMessage);
    return;
}
$userid = filter_var($_GET["userid"], FILTER_SANITIZE_NUMBER_INT);
if (strlen($userid) == 0) {
    echo($errorMessage);
    return;
}
$badgeUrl = "https://www.roblox.com/badges/roblox?userId=$userid&imgWidth=512&imgHeight=512&imgFormat=png";
$request = file_get_contents($badgeUrl);
$completeArray = json_decode($request, true);
if (is_null($completeArray)) {
   echo("{\"error\" : \"The request failed!\"}");
   return;
}
$badgeArray = $completeArray["RobloxBadges"];
if (!$badgeArray) {
    echo("{\"error\" : \"This user does not exist!\"}");
    return;
}
$checkAdmin = "false";
for ($i = 0; $i < count($badgeArray); $i++) {
    $currentBadgeName = $badgeArray[$i]["Name"];
    if ($currentBadgeName === "Administrator") {
        $checkAdmin = "true";
    }
}
echo($checkAdmin);
?>
