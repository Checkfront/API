booking/create
--------------
A call to booking/create must pass in a **session_id** for a :doc:`session` containing at least one :ref:`slip` in addition to customer input entered to fields from :doc:`form`

.. http:post:: /api/3.0/booking/create

	Attempt to create a booking from an existing session, with customer form input sent in the request in the "form" parameter.

	:form form: An array of fields containing customer details matching the required and optional booking fields (e.g. ``form[customer_name]``)
	:form session_id: The session ID containing the booking items to be committed.  *Can also be sent as a cookie.*
