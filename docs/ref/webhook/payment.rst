New Payment/Refund
^^^^^^^^^^^^^^^^^^

This webhook is triggered whenever any transactions are added or refunded on your account.

A **JSON**, **XML**, or **x-www-form-urlencoded** object containing the following export fields can
be found in directly in the **raw body** of the POST request to your server:

payment
-------
+---------------------------+---------------+---------------------------------------------------+
| Field                     | Type          | Description                                       |
+===========================+===============+===================================================+
| **transaction_id**        | *string*      | A unique code used to refer to this transaction   |
+---------------------------+---------------+---------------------------------------------------+
| **date**                  | *timestamp*   | When this transaction was created                 |
+---------------------------+---------------+---------------------------------------------------+
| **status**                | *string*      | Identifies whether the transaction was a          |
|                           |               | payment (PAID) or a refund (REFUND)               |
+---------------------------+---------------+---------------------------------------------------+
| **amount**                | *decimal*     | The transaction's monetary amount                 |
+---------------------------+---------------+---------------------------------------------------+
| **gateway_id**            | *string*      | Identifies which payment gateway made the         |
|                           |               | transaction                                       |
+---------------------------+---------------+---------------------------------------------------+
| **payment_mask**          | *integer*     | The last four digits of the card, or              |
|                           |               | (POS) for a POS transaction.                      |
+---------------------------+---------------+---------------------------------------------------+
| **payment_type**          | *string*      | The type of card used, or the type of POS         |
|                           |               | transaction                                       |
+---------------------------+---------------+---------------------------------------------------+
| **payment_customer**      | *string*      | The payer's name                                  |
+---------------------------+---------------+---------------------------------------------------+
| **booking_id**            | *string*      | The code of the booking which received this       |
|                           |               | transaction (See :ref:`note-booking`)             |
+---------------------------+---------------+---------------------------------------------------+

Sample Payment Notification
---------------------------

JSON
~~~~
.. literalinclude:: ../../examples/response/webhook-payment.json
	:language: json
	:linenos:

XML
~~~
.. literalinclude:: ../../examples/response/webhook-payment.xml
	:language: xml
	:linenos: