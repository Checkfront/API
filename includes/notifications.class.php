<?php

/*

Logging the notifications sent from Checkfront to guests… So, the process can be improved and we know exactly what is getting sent

*/

class Notification 
{

	public $data;
	public $dataArray;

	function __construct(){  
		$this->raw_data = file_get_contents('php://input');
		$this->data = json_decode($this->raw_data);

		// Set an array with the correct timezone to unsure proper timestamp
        $this->site = new StdClass;
        $this->site->date = new DateTime();
        $this->site->date->setTimezone(new DateTimeZone('CET'));
    }


	public function ParseNotificationData() {	
		
		$this->dataArray = array('host'			=> $this->data->{'@attributes'}->host,
								'status' 		=> $this->data->booking->status, 
								'code' 			=> $this->data->booking->code, 
								'email_date' 	=> $this->site->date->format('Y-m-d H:i:s'),
								'created_date' 	=> $this->data->booking->created_date, 
								'staff_id' 		=> $this->data->booking->staff_id, 
								'source_ip' 	=> sprintf('%u', ip2long($this->data->booking->source_ip)), 
								'start_date' 	=> $this->data->booking->start_date,
								'end_date' 		=> $this->data->booking->end_date, 
								'name' 			=> $this->data->booking->customer->name,
								'email' 		=> $this->data->booking->customer->email, 
								'region' 		=> $this->data->booking->customer->region,
								'address' 		=> $this->data->booking->customer->address, 
								'country' 		=> $this->data->booking->customer->country[0],
								'postal_zip' 	=> $this->data->booking->customer->postal_zip,
								'raw_data'		=> serialize($this->raw_data),
								);

    }
	
}

?>