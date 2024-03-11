<?php

require 'database_connection.php'; // Assuming database_connection.php contains the database connection code

$display_query = "SELECT * FROM calendar_event_master 
                  INNER JOIN facility ON facility.facility_id = calendar_event_master.facility
                  WHERE is_approved = 2";

$results = mysqli_query($con, $display_query);

if ($results) {
    $data_arr = array();
    $i = 0; // Start index from 0 instead of 1

    while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
        $data_arr[$i]['event_id'] = $data_row['event_id'];
        $data_arr[$i]['title'] = $data_row['event_name'];
        $data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['event_start_date']));
        $data_arr[$i]['end'] = $data_row['event_end_date'] ? date("Y-m-d", strtotime($data_row['event_end_date'])) : null; // Check if event_end_date exists
        $data_arr[$i]['color'] = '#63d481'; // Random hex color in a lighter range of green
        //$data_arr[$i]['url'] = 'https://www.shinerweb.com';
        $data_arr[$i]['venue'] = $data_row['facility_name'];
        
        $i++;
    }
    
    $data = array(
        'status' => true,
        'msg' => 'Events retrieved successfully!',
        'data' => $data_arr
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Error fetching events from the database'
    );
}

echo json_encode($data);

?>
