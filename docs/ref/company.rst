company
=======
.. http:method:: GET /api/3.0/company

.. http:response:: Retrieve company configuration information of the system you are connecting to.

	:data string url: The Checkfront URL of the account.
	:data string name: The display name of the company.
	:data integer plan_id: The Checkfront subscription plan ID of the account.
	:data string email: The contact email address of the company.
	:data string address: The street address of the company.
	:data string city: The city where the company is located.
	:data string postal_zip: The postal or zip code of the company.
	:data string region: The state/province of the company.
	:data string region_id: The state/province of the company.
	:data string country_id: The country where the company is based.
	:data string currency_id: The currency type accepted by the company.
	:data string timezone: The timezone of the company.
	:data string locale_id: The locale string set for the company.
	:data string lang_id: The ISO 639-1 language code of the company.
	:data string date_format: The date format set for the company.
	:data string time_format: The time format set for the company.

.. literalinclude:: ../examples/response/company.json
	:language: js
	:linenos: