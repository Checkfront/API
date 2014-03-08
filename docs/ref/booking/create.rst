booking/create
--------------
A call to booking/create must pass in a **session_id** for a :doc:`session` containing at least one :ref:`slip` in addition to customer input entered to fields from :doc:`form`

.. http:method:: POST /api/3.0/booking/create

	:param array form: An array of fields containing customr details matching the required and optional booking fields.
	:param string session_id: The session ID containing the booking items to be committed.  *Can also be sent as a cookie.*
	
.. http:response:: Returns the creation status and details of the booking.