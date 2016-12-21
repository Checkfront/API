Webhooks
========

Your Checkfront account is capable of directly POSTing details of new or modified bookings, items,
item events, and transactions to your SSL-secured server endpoint.

Notifications are sent over a standard **HTTPS POST** request as **JSON**, **XML**, or **x-www-form-urlencoded** data.

Your server **must** respond with an **HTTP 200** class status code immediately upon receipt.
If your server does not indicate a successful response in a timely manner,
after 5 consecutive failed delivery attempts, your webhook will be automatically disabled.

Webhook setup can be found in the **Manage > Developer** section of your Checkfront account under the "**Webhooks**" tab.

.. toctree::
	:caption: Webhook Events
	:glob:
	:maxdepth: 1

	webhook/*
