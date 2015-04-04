booking
=======
A **booking** in the system represents an order and all associated information.  It's possible to list, retrieve, create, and modify bookings in the system through use of the API.

booking
-------
.. http:get:: /api/3.0/booking

	Retrieve a listing of bookings in the system.

	:query string status_id: The current status of a booking.
	:query integer customer_id: The customer id associated with the booking.
	:query string customer_email: The customer email associated with the booking.
	:query string/timestamp start_date: The date the booking starts on (i.e. check-in).
	:query string/timestamp end_date: The date the booking starts on (i.e. check-in).
	:query integer limit: The limit of bookings to return per page (default: 100).
	:query integer page: The page of results to return.

	:>jsonarr integer booking_id: The internal index of a booking.
	:>jsonarr string code: The unique booking reference code.
	:>jsonarr string status_id: The status code of the booking.
	:>jsonarr string status_name: The display name of the booking status.
	:>jsonarr timestamp created_date: The date/time the booking was created.
	:>jsonarr float total: The full value of the booking.
	:>jsonarr float tax_total: The sum of the taxes applied to the booking.
	:>jsonarr float paid_total: The amount the customer has paid on the booking.
	:>jsonarr string customer_name: The full name of the booking contact.
	:>jsonarr string customer_email: The email address of the booking contact.
	:>jsonarr string summary: A brief description of the contents of the booking.
	:>jsonarr string date_desc: A string describing the booked dates/times.
	:>jsonarr string token: A customer token for the booking, can be used to build links to customer portions of the reservation system.

	.. literalinclude:: ../examples/response/booking-index.json
		:language: json
		:linenos:
		:lines: 23-39

Booking endpoints
-----------------
.. toctree::
	:glob:
	:maxdepth: 1

	booking/*
