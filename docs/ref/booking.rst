booking
=======
A **booking** in the system represents an order and all associated information.  It's possible to list, retrieve, create, and modify bookings in the system through use of the API.

booking
-------
.. http:method:: GET /api/3.0/booking

	:optparam string status_id: The current status of a booking.
	:optparam integer customer_id: The customer id associated with the booking.
	:optparam string customer_email: The customer email associated with the booking.
	:optparam string/timestamp start_date: The date the booking starts on (i.e. check-in).
	:optparam string/timestamp end_date: The date the booking starts on (i.e. check-in).
	:optparam integer limit: The limit of bookings to return per page (default: 100).
	:optparam integer page: The page of results to return.

.. http:response:: Retrieves the booking index.

	Details returned on *individual* bookings in the response:
	
	:data integer booking_id: The internal index of a booking.
	:data string code: The unique booking reference code.
	:data string status_id: The status code of the booking.
	:data string status_name: The display name of the booking status.
	:data timestamp created_date: The date/time the booking was created.
	:data float total: The full value of the booking.
	:data float tax_total: The sum of the taxes applied to the booking.
	:data float paid_total: The amount the customer has paid on the booking.
	:data string customer_name: The full name of the booking contact.
	:data string customer_email: The email address of the booking contact.
	:data string summary: A brief description of the contents of the booking.
	:data string date_desc: A string describing the booked dates/times.
	:data string token: A customer token for the booking, can be used to build links to customer portions of the reservation system.
	
	.. literalinclude:: ../examples/response/booking-index.json
		:language: js
		:linenos:
		:lines: 23-39

Booking endpoints
-----------------
.. toctree::
	:glob:
	:maxdepth: 1

	booking/*
