customer
========

The customer object provides access to customer details stored in the system.  Customer information is automatically stored in the system when a new booking is made.  

To retrieve information on a specific customer, you should ideally use the customer ID in a GET call to **customer/[customer_id]**.  In this case, the customer information will be returned as "customer" in the JSON response.

If you do not have the customer ID stored, you can also look up customers based on indexed fields, including email address, name, and phone number.  These must be an exact match, but can return multiple results on non-unique fields such as the customer name.  The results will be stored in the "customers" object in the JSON response.

.. http:get:: /api/3.0/customer

	Retrieve a list of customers.

	:query string customer_id: The unique customer code identifying a customer in the system.
	:query string customer_email: A unique customer e-mail address to search.
	:query string customer_name: The full name of the customer to search.
	:query string customer_phone: The (exact) customer phone number to search.

.. http:get:: /api/3.0/customer/{customer_id}

	Retrieve contact details for a customer.

	:param string customer_id: The unique customer code identifying a customer in the system.

.. literalinclude:: ../examples/response/customer.json
	:language: json
	:linenos:
