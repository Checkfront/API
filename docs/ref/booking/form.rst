booking/form
------------
This call will can easily be cached if your configuration does not often change, but depending on your setup, a number of the fields returned in this request may be required to complete a booking.

You will receive an error indicating missing information if you attempt to call :doc:`create` without the required fields, either those required by staff if you're acting on behalf of a staff member, or by a customer otherwise.

.. http:method:: GET /api/3.0/booking/form

.. http:response:: Retrieve the customer details input form for the booking.  Some fields may be required to call booking/create.

	.. literalinclude:: ../../examples/response/booking-form.json
		:language: js
		:linenos: