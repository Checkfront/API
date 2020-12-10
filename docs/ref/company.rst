company
=======
.. http:get:: /api/3.0/company

	Retrieve company configuration information of the system you are connecting to.

	:>json string url: The Checkfront URL of the account.
	:>json string name: The display name of the company.
	:>json integer plan_id: The Checkfront subscription plan ID of the account.
	:>json string email: The contact email address of the company.
	:>json string address: The street address of the company.
	:>json string city: The city where the company is located.
	:>json string postal_zip: The postal or zip code of the company.
	:>json string region: The state/province of the company.
	:>json string region_id: The state/province of the company.
	:>json string country_id: The country where the company is based.
	:>json string currency_id: The currency type accepted by the company.
	:>json string timezone: The timezone of the company.
	:>json string locale_id: The locale string set for the company.
	:>json string lang_id: The ISO 639-1 language code of the company.
	:>json string date_format: The date format set for the company.
	:>json string time_format: The time format set for the company.

Public API
----------
If the Public API is enabled, unauthenticated users can make requests to the */company* endpoint. Both the public and authenticated responses are identical.

.. literalinclude:: ../examples/response/company.json
	:language: json
	:linenos:
