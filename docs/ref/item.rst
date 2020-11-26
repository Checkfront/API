item
====

Your Checkfront inventory is made up of '**items**' that are added to bookings, and have complex availability controls and rules defining their stock and prices.

When no dates are passed in the API call, a full list of enabled items in the inventory is displayed, without specific availability and pricing.  

However, if you pass in the relevant booking dates (and optionally parameters, discount codes, etc), the API will return a "**rated**" response that includes pricing and availablity, as well as a ":ref:`slip`" that will be used to add the item to a session.

.. _slip:

SLIP
----

The item SLIP is an encoded string returned when making a rated query to a specific item.  The slip contains the information needed to make a booking.  Don't attempt to reverse engineer this, as the format changes.  It must be optioned via a rated API call.

.. _booking-param:

Booking Parameters
------------------
Booking parameters are defined globally in your system, and can be configured on a per item basis.  Your parameters specify the number of items to book, for example Child and Adult.  These are completely configurable in your Checkfront account under **Manage / Settings / Configure**.

To query *specific* pricing and availability, you need to pass the appropriate parameters in your API call (using the parameter IDs as specified in your configuration).

Say for instance you have 2 parameters configured: Adults (id: adults), and Children (id: children).  To get pricing for 2 adults and one child you would pass: **param[adults]=2&param[children]=1** in your API call.

Booking parameters have many options, and can be configured to control inventory in very specific ways.  See the Checkfront support centre or ask us for more information.

Public API
----------
If the Public API is enabled, non-authenticated users can make requests to the */item*, */item/{id}*, */item/cal*, and */item/{id}/cal* end points. The responses between the internal and public API versions are identical for the *item/* and *item/{id}* endpoints. For the *item/cal* and *item/{id}/cal* endpoints the response will return 1 if the item is available instead of the available inventory. This is the same functionality as a customer viewing the item or availability calendar on the `Hosted Booking Page <https://support.checkfront.com/hc/en-us/articles/115004917593-Hosted-Booking-Page>`_.

Request
-------

.. http:get:: /api/3.0/item

	Retrieve a list of the enabled items in the system.

	:query date start_date: (rated) Booking start date.
	:query date end_date: (rated) Booking end date.
	:query date date: (rated) Alias of **start date** (for same-day bookings).
	:query date start_time: (rated) Start time (used in hourly bookings).
	:query date end_time: (rated) End time (used in hourly bookings).
	:query integer category_id: Filter items by category.
	:query boolean packages: Show package options.
	:query integer available: (rated) Filter to items with at least this many left in stock.
	:query string keyword: Filter to items with a name containing this keyword.
	:query string item_id: A comma-seperated list of items to filter to.
	:query string discount_code: (rated) The discount code to apply to the price.
	:query string rules: 'soft' will prevent triggering date based rule errors, or 'off' will disable rule checking.
	:query array param: (rated) See :ref:`booking-param`.
	
.. http:get:: /api/3.0/item/{item_id}

	Retrieve details for a single item.	Shares same params as above for rated requests.

	:param string item_id: The unique item_id of the item to query, as found in a response or your Checkfront panel.

.. http:get:: /api/3.0/item/{item_id}/cal

	Retrieve calendar availability for a single item.

	:param string item_id: The unique item_id of the item to query.
	:query date start_date: Availability range start date.
	:query date end_date: Availability range start date.

.. http:get:: /api/3.0/item/cal

	Retrieve calendar availability for a set of items.

	:query array|integer item_id: The unique item_id of the item to query, or an array of item IDs
	:query integer category_id: A category of items to filter to.
	:query date start_date: Availability range start date.
	:query date end_date: Availability range start date.

Unrated Response
++++++++++++++++

.. literalinclude:: ../examples/response/item.json
	:language: json
	:linenos:

Rated Response
++++++++++++++

.. literalinclude:: ../examples/response/item-rated.json
	:language: json
	:linenos:
	:emphasize-lines: 129
