Request Formatting
==================

All requests made to the server are sent over an encrypted SSL connection using standard HTTPS methods such as **GET** and **POST**.  

When submitting input parameters with your request, these are encoded either in the query string for GET requests, or in the body of a POST request using commonplace url encoding of key-value pairs (:mimetype:`application/x-www-form-urlencoded`).

The headers of your request should also include the IP of the client you're forwarding for, as well as the credentials used to authenticate with the API.  If you have an open session on the server, you can also pass in a **session_id** cooking containing the ID to have it automatically reopened.

+--------------------+-------------------------------------------------------------------------+
| **X-Forwarded-For**| The IP address of the connecting client.                                |
+--------------------+-------------------------------------------------------------------------+
| **X-On-Behalf**    | The staff account to act on behalf of.  Use "off" to act as a customer. |
+--------------------+-------------------------------------------------------------------------+
| **Authorization**  | Credentials used to query the API. See :ref:`auth-token` or             |
|                    | :ref:`oauth2-ref`.                                                      |
+--------------------+-------------------------------------------------------------------------+

For example, to query a list of bookings with a status of PAID starting today, your full raw request might look like the following:

.. sourcecode:: http
	:emphasize-lines: 1

	GET /api/3.0/booking/index?start_date=today&status_id=PAID HTTP/1.1
	Host: your-company.checkfront.com
	Accept: application/json
	X-Forwarded-For: 66.228.55.142
	X-On-Behalf: 1
	Authorization: Basic M2JlOTg2NDFmMDc0NWI2ZmU3ZGFjYzJkZjk0N2FkYmMxZGE3MzEyZDo0YzRkNTk4YTVkOTQwZjA4ZmRiNDM1YjY5YWY5ODZjNzBmMjIwNmRk