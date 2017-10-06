booking/session
===============

While creating a booking, the details of the proposed booking are stored in an API session.  This allows you to add multiple items to a booking, remove items and inform the server of your intent to book the item(s) in order to prevent over-bookings.  

Each session call will return the **session_id** of the active session, and any attached session information.  Your application **must** use the **session_id** in order to further modify the session or submit the booking beyond this point, and can pass it back to the API either as a **cookie** or a request parameter.

To start a new session, you simply pass in the booking :ref:`slip`\s returned when from earlier "**rated**" inventory :doc:`../item` queries.

.. http:post:: /api/3.0/booking/session

	Create or return information about and stored in the current server session.
	Once initiated, you can fetch the details of a proposed booking by accessing the **session** again with the **session_id** found in the response.  The item details for the session will be returned with your request.

	:form string session_id: The session ID to be loaded or written to.  *Can also be sent as a cookie.*
	:form string/array slip: A :ref:`slip`, or multiple :ref:`slip`\s to be **added** to a session.  If need to add or remove more of the *same* item to a session, use **alter** below.
	:form array alter: Alterations to be made on the current session, based on the **line_id** of items in the session and actions to be taken.  To change the **qty** of an item in the session, send an alter for the line_id of that item with the integer value you need to set (e.g alter[3]=5 sets item 3 to a qty of 5).  To **remove** an item, use alter 'remove'; and to opt-in or out of listed package items use 'optin' or 'optout' respectively.


.. http:get:: /api/3.0/booking/session

	:query string session_id: The session ID to read information from.  *Can also be sent as a cookie.*
	
.. literalinclude:: ../../examples/response/booking-session.json
	:language: json
	:linenos:
	:emphasize-lines: 24


.. http:post:: /api/3.0/booking/session/clear
.. http:post:: /api/3.0/booking/session/end

	:query string session_id: The session ID to empty or close.  *Can also be sent as a cookie.*
