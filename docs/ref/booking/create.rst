booking/create
--------------
A call to booking/create must pass in at least one :ref:`slip` - either directly as an array of slips, or by using a **session_id** from a previously created :doc:`session` containing at least one :ref:`slip`. Additionally, the call must pass in any customer input entered to fields from :doc:`form`, for all required fields and any optional fields.

.. http:post:: /api/3.0/booking/create

	Attempt to create a booking from an existing session, with customer form input sent in the request in the "form" parameter.

	:form array form: An array of fields containing customer details matching the required and optional booking fields (e.g. ``form[customer_name]="John Smith"``)
	:form string session_id: The session ID containing the booking items to be committed.  *Can also be sent as a cookie.*
	:form string/array slip: A :ref:`slip` or array of :ref:`slip`\s that can be passed directly to booking/create, bypassing the need to specify a session_id
