category
========
.. http:get:: /api/3.0/category

 	Retrieve a list of the available categories in the system.

	:>jsonarr integer category_id: The unique ID of the category.
	:>jsonarr string name: The display name of the category.
	:>jsonarr integer pos: The order in which the category will display.

Public API
----------
If the Public API is enabled, non-authenticated users can make requests to the */category* end point. This is the same functionality as a customer viewing the categories on the `Hosted Booking Page <https://support.checkfront.com/hc/en-us/articles/115004917593-Hosted-Booking-Page>`_. Only categories that are publicly visible and have customer-visible items will be returned. Check out our Knowledge Base for more information on how `Categories display on the Booking Page <https://support.checkfront.com/hc/en-us/articles/360007510473-Booking-Page-Category-Display>`_.

.. literalinclude:: ../examples/response/category.json
	:language: json
	:linenos:
