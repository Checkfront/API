<?php

/*

Logging the notifications sent from Checkfront to guests… So, the process can be improved and we know exactly what is getting sent

*/

class Notification 
{

	public $host;
	public $status;
	public $code;
	public $email_date;
	public $created_date;
	public $staff_id;
	public $source_ip;
	public $start_date;
	public $end_date;
	public $name;
	public $email;
	public $region;
	public $address;
	public $country;
	public $postal_zip;

	public $data;
	public $dataArray;

	function __construct(){  
		$this->data = json_decode(file_get_contents('php://input'));
    }


	public function ParseNotificationData() {
		
		$host	 		= $this->data->{'@attributes'}->host;
		$status 		= $this->data->booking->status;
		$code 			= $this->data->booking->code;
		$email_date		= date('Y-m-d H:i:s');
		$created_date	= $this->data->booking->created_date;
		$staff_id		= $this->data->booking->staff_id;
		$source_ip		= sprintf('%u', ip2long($this->data->booking->source_ip));
		$start_date		= $this->data->booking->start_date;
		$end_date		= $this->data->booking->end_date;
		$name			= $this->data->booking->customer->name;
		$email			= $this->data->booking->customer->email;
		$region			= $this->data->booking->customer->region;
		$address		= $this->data->booking->customer->address;
		$country		= $this->data->booking->customer->country[0];
		$postal_zip		= $this->data->booking->customer->postal_zip;
		
		
		$this->dataArray = array('host'			=> $host,
								'status' 		=> $status, 
								'code' 			=> $code, 
								'email_date' 	=> $email_date,
								'created_date' 	=> $created_date, 
								'staff_id' 		=> $staff_id, 
								'source_ip' 	=> $source_ip, 
								'start_date' 	=> $start_date,
								'end_date' 		=> $end_date, 
								'name' 			=> $name,
								'email' 		=> $email, 
								'region' 		=> $region,
								'address' 		=> $address, 
								'country' 		=> $country,
								'postal_zip' 	=> $postal_zip,
								'raw_data'		=> serialize($this->data)
								);

    }
	
}

?>