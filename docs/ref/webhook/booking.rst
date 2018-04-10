Booking Modified & Booking Status Change
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The **Booking Modified** webhook event is triggered whenever a booking is created or modified,
and the **Booking Status Change** webhook event is triggered whenever a booking status is altered.
These events may occur simultaneously in some circumstances,
and both are triggered whenever a booking status is changed.
Using both of these events on the same webhook endpoint URL is discouraged.

A **JSON**, **XML**, or **x-www-form-urlencoded** object containing the following export fields can be found in directly in the **raw body** of the POST request to your server:

.. _note-booking:

booking
-------

+---------------------------+------------------+----------------------------------------------------------------------------+
| Field                     | Type             | Description                                                                |
+===========================+==================+============================================================================+
| **status**                | *string*         | The current status code of the booking                                     |
+---------------------------+------------------+----------------------------------------------------------------------------+
| **code**                  | *string*         | A unique booking code used to refer to the booking                         |
+---------------------------+------------------+----------------------------------------------------------------------------+
| **created_date**          | *timestamp*      | The date on which the booking was created                                  |
+---------------------------+------------------+----------------------------------------------------------------------------+
| **staff_id**              | *integer*        | Account ID of the staff account used to create the booking                 |
+---------------------------+------------------+----------------------------------------------------------------------------+
| **source_ip**             | *string*         | The IP address used to create the booking                                  |
+---------------------------+------------------+----------------------------------------------------------------------------+
| **start_date**            | *timestamp*      | The start date/time of the booking, based on order items                   |
+---------------------------+------------------+----------------------------------------------------------------------------+
| **end_date**              | *timestamp*      | The end date/time of the booking, based on order items                     |
+---------------------------+------------------+----------------------------------------------------------------------------+
| **customer**              | *array*          | Customer details attached to the booking                                   |
|                           |                  | (See :ref:`note-booking-customer` below)                                   |
+---------------------------+------------------+----------------------------------------------------------------------------+
| **meta**                  | *array*          | A set of fields containing your custom parameters and other info           |
+---------------------------+------------------+----------------------------------------------------------------------------+
| **order**                 | *array*          | Details on booking items and payment.  See :ref:`note-booking-order` below |
+---------------------------+------------------+----------------------------------------------------------------------------+
| **tid**                   | *string*         | Details on the Tracking ID used for referral & campaign tracking           |
+---------------------------+------------------+----------------------------------------------------------------------------+

.. _note-booking-customer:

booking.customer
~~~~~~~~~~~~~~~~

	+---------------------------+------------------+----------------------------------------------------------------------------+
	| Field                     | Type             | Description                                                                |
	+===========================+==================+============================================================================+
	| **code**                  | *string*         | The customer's unique account code                                         |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **customer_name**         | *string*         | The customer's full name                                                   |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **customer_email**        | *string*         | The customer's email address                                               |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **customer_address**      | *string*         | The customer's street address                                              |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **customer_region**       | *string*         | The customer's province or state                                           |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **customer_country**      | *string*         | The customer's country of residence                                        |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **customer_postal_zip**   | *string*         | The customer's postal or zip code                                          |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **customer_phone**        | *string*         | The customer's phone number                                                |
	+---------------------------+------------------+----------------------------------------------------------------------------+

.. _note-booking-fields:

booking.fields
~~~~~~~~~~~~~~
		Contains each of the form fields associated with a booking.

.. _note-booking-order:

booking.order
~~~~~~~~~~~~~

	+---------------------------+------------------+----------------------------------------------------------------------------+
	| Field                     | Type             | Description                                                                |
	+===========================+==================+============================================================================+
	| **sub_total**             | *float*          | The sub-total of all charges added to the order                            |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **paid_total**            | *float*          | The total amount the customer has paid on the order                        |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **total**                 | *float*          | The total of all charges and taxes added to the order                      |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **tax_total**             | *float*          | The sum of all taxes applied to the order                                  |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **taxes**                 | *array*          | Individual taxes that have been applied to the order, their names, and     |
	|                           |                  | amounts                                                                    |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **discount**              | *float*          | The amount that has been discounted from the order total (if applicable)   |
	+---------------------------+------------------+----------------------------------------------------------------------------+
	| **items**                 | *array*          | Details on items included in the order                                     |
	|                           |                  | (See :ref:`note-booking-order-items` below)                                |
	+---------------------------+------------------+----------------------------------------------------------------------------+

.. _note-booking-order-items:

booking.order.items.item
~~~~~~~~~~~~~~~~~~~~~~~~
		An entry for *each* item in the booking will contain following fields:

		+---------------------------+------------------+------------------------------------------------------------------------+
		| Field                     | Type             | Description                                                            |
		+===========================+==================+========================================================================+
		| **start_date**            | *timestamp*      | The start date of the booking item                                     |
		+---------------------------+------------------+------------------------------------------------------------------------+
		| **end_date**              | *timestamp*      | The end date of the booking item                                       |
		+---------------------------+------------------+------------------------------------------------------------------------+
		| **sku**                   | *string*         | The unique stock keeping unit of the item                              |
		+---------------------------+------------------+------------------------------------------------------------------------+
		| **slip**                  | *string*         | The booking slip attached to the item                                  |
		+---------------------------+------------------+------------------------------------------------------------------------+
		| **package**               | *integer*        | The package the item belongs to (if applicable)                        |
		+---------------------------+------------------+------------------------------------------------------------------------+
		| **status**                | *string*         | The booking status of the item                                         |
		+---------------------------+------------------+------------------------------------------------------------------------+
		| **total**                 | *float*          | The total price of the booking item                                    |
		+---------------------------+------------------+------------------------------------------------------------------------+
		| **tax_total**             | *float*          | The sum of taxes applied to this item                                  |
		+---------------------------+------------------+------------------------------------------------------------------------+
		| **qty**                   | *integer*        | The quantity of this item in the booking                               |
		+---------------------------+------------------+------------------------------------------------------------------------+

Sample Booking Notification
---------------------------

JSON
~~~~
.. literalinclude:: ../../examples/response/webhook-booking.json
	:language: json
	:linenos:

XML
~~~
.. literalinclude:: ../../examples/response/webhook-booking.xml
	:language: xml
	:linenos:
