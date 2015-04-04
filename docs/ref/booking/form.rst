booking/form
------------
This call can easily be cached if your configuration does not often change, but depending on your setup, a number of the fields returned in this request may be required to complete a booking.

You will receive an error indicating missing information if you attempt to call :doc:`create` without the required fields, either those required by staff if you're acting on behalf of a staff member, or by a customer otherwise.

.. http:get:: /api/3.0/booking/form

	Retrieve the customer details input form for the booking.  Some fields may be required to call booking/create.

	:>json booking_form_ui: An array of form field definitions

	.. literalinclude:: ../../examples/response/booking-form.json
		:language: json
		:linenos:
