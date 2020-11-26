booking/form
============
This call can easily be cached if your configuration does not often change, but depending on your setup, a number of the fields returned in this request may be required to complete a booking.

You will receive an error indicating missing information if you attempt to call :doc:`create` without the required fields, either those required by staff if you're acting on behalf of a staff member, or by a customer otherwise.

Public API
----------
If the Public API is enabled, non-authenticated users can make requests to the */booking/forms* end point. This is the same functionality as a customer viewing the form when making a booking on the `Hosted Booking Page <https://support.checkfront.com/hc/en-us/articles/115004917593-Hosted-Booking-Page>`_. Only form fields that are set to show on the Customer Booking Form will be returned. Check out our Knowledge Base for more information on `Booking Form Field Options <https://support.checkfront.com/hc/en-us/articles/360007374474-Booking-Form-Field-Editor-Options-Tab>`_.

.. http:get:: /api/3.0/booking/form

	Retrieve the customer details input form for the booking.  Some fields may be required to call booking/create.

	:>json booking_form_ui: An array of form field definitions

	.. literalinclude:: ../../examples/response/booking-form.json
		:language: json
		:linenos:
