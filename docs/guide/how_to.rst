How To...
=========

List Items
----------
You can query a list of available items based on search critera supplied in an API call to :doc:`../ref/item`.

When no dates are passed in the API call, a full list of enabled items in the inventory.  When a date is passed, the API will return a "**rated**" response that includes pricing and availablity, as well as a "**SLIP**" that will be used to add the item to a session.

In order to build bookings, you'll need to first retrieve "**rated**" item details (by declaring the booking length and any additional parameters in an :doc:`../ref/item` call, see above), which will return a "**SLIP**" -- effectively a token encoding the necessary information to book that item in that time period with the options you've selected.

Example rated request to a specific :doc:`../ref/item`:

.. sourcecode:: http

	GET /api/3.0/item/17?start_date=20141224&end_date=20150101&param[guests]=2 HTTP/1.1
	Host: your-company.checkfront.com

Add Items to a Booking Session
------------------------------

Once you have the :ref:`slip` for your desired item (or items), this can be passed in to create a new :doc:`../ref/booking/session`.  The session can be thought of as your "cart", and can be modified until you are ready to submit your booking.

If you have collected multiple items to be added, you can also add them in a batch by sending them as an array.

Example of adding a :ref:`slip` to a *new* session:

.. sourcecode:: http
	:emphasize-lines: 4	

	POST /api/3.0/booking/session HTTP/1.1
	Host: your-company.checkfront.com
	
	slip[]=17.20141224X8-guests.2&slip[]=18.20141224X8-guests.2

Alter Items in the Session
--------------------------

If you need to alter items in a :doc:`../ref/booking/session`, such as opting-in to upsell items, changing quantities, or removing the item, you can use the 'alter' query parameter of a :doc:`../ref/booking/session` call to an existing session.

To change the selected quantity of an added session item, pass the quantity in to the **alter** array entry for the selected line (which will be part of each session response).  To opt-in or out of package items, find their line id and specify "optin" or "optout" instead of a quantity.

To remove an item from the session, use the alter array to specify that the line item should be removed from the order.

.. sourcecode:: http
	:emphasize-lines: 4
	
	POST /api/3.0/booking/session HTTP/1.1
	Host: your-company.checkfront.com
	
	session_id=rtdv4osethqurlmqgi55mcrkm4&alter[3]=4&alter[2.1]=optin&alter[1]=remove

Create a New Booking
--------------------

After you've added :ref:`slip`\s to your session, your application should then capture the customer information needed to make a booking.  The fields required for checkout on your account can be retrieved with a GET request to :doc:`../ref/booking/form`.

To submit a booking to the system, you'll then pass your ``session_id`` along with the required customer information to a :doc:`../ref/booking/create` call, which will return data relating to your booking, such as the booking/customer IDs (which could be recorded in your system) and an invoice/payment URL (if applicable).

