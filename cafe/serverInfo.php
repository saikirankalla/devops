<?php
// Check if server info should be displayed
if (isset($showServerInfo) && $showServerInfo == 'true') {
    // Initialize cURL session
    $ch = curl_init();

    // Get a valid IMDSv2 token
    $headers = ['X-aws-ec2-metadata-token-ttl-seconds: 21600'];
    $url = "http://169.254.169.254/latest/api/token";
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_URL, $url);
    
    $token = curl_exec($ch);
    
    if ($token === false) {
        echo '<p class="error-message">Error: Could not retrieve metadata token. ' . curl_error($ch) . '</p>';
        curl_close($ch);
        return;
    }

    // Set headers with token for subsequent requests
    $headers = ['X-aws-ec2-metadata-token: ' . $token];

    // Retrieve Public IP Address
    $url = "http://169.254.169.254/latest/meta-data/public-ipv4";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    $ipAddress = curl_exec($ch);
    if ($ipAddress === false) {
        $ipAddress = "N/A (Error: " . curl_error($ch) . ")";
    }

    // Retrieve Instance ID
    $url = "http://169.254.169.254/latest/meta-data/instance-id";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    $instanceID = curl_exec($ch);
    if ($instanceID === false) {
        $instanceID = "N/A (Error: " . curl_error($ch) . ")";
    }

    // Retrieve Availability Zone
    $url = "http://169.254.169.254/latest/meta-data/placement/availability-zone";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    $az = curl_exec($ch);
    if ($az === false) {
        $az = "N/A (Error: " . curl_error($ch) . ")";
    }

    // Close cURL session
    curl_close($ch);

    // Display instance metadata
    echo '<div class="confirmation-content">';
    echo '<hr style="border: 1px solid #ff8c00; margin: 1rem 0;">';
    echo '<div style="text-align: center;">';
    echo '<h3 style="color: #d43f3a; font-family: \'Poppins\', sans-serif; font-weight: 600;">Server Information</h3>';
    echo '<p style="font-size: 1rem; color: #333;">';
    echo 'IP Address: ' . htmlspecialchars($ipAddress) . '     Region/Availability Zone: ' . htmlspecialchars($az) . '     Instance ID: ' . htmlspecialchars($instanceID);
    echo '</p>';
    echo '</div>';
    echo '</div>';
}
?>
