Webhooks
========

Checkfront webhooks allow you to receive real-time notifications when specific events occur in your account, such as new bookings, updates to existing bookings, item modifications, and transactions. When an event is triggered, Checkfront will send an **HTTPS POST** request with relevant data to your designated webhook URL.

How Webhooks Work
-----------------

1. **Event Trigger**: A booking, item, or transaction update occurs in your Checkfront account.
2. **Webhook Notification**: Checkfront sends an HTTPS POST request to your server with the event details.
3. **Server Acknowledgment**: Your server must respond with an HTTP **200** class status code (e.g., 200 OK) to confirm receipt.
4. **Retry Mechanism**: If Checkfront does not receive a successful response, it retries up to **5 times** before disabling the webhook.

Webhook Data Formats
--------------------

Webhook notifications can be sent in the following formats:

+-------------------------+------------------------------------+
| Format                  | Content Type                        |
+=========================+====================================+
| JSON                    | ``application/json``               |
+-------------------------+------------------------------------+
| XML                     | ``application/xml``                |
+-------------------------+------------------------------------+
| x-www-form-urlencoded   | ``application/x-www-form-urlencoded`` |
+-------------------------+------------------------------------+

Example JSON payload:

.. code-block:: json

    {
      "event": "booking.create",
      "booking": {
        "id": 123456,
        "status": "CONFIRMED",
        "customer": {
          "name": "John Doe",
          "email": "john@example.com"
        },
        "items": [
          {
            "id": 987,
            "name": "City Tour",
            "quantity": 2
          }
        ]
      }
    }

Webhook Setup
-------------

To configure a webhook in Checkfront:

1. Navigate to **Manage > Developer**.
2. Click on the **Webhooks** tab.
3. Add a new webhook by specifying:
   - **Webhook URL**: Your server endpoint to receive notifications.
   - **Event Types**: Choose which events should trigger webhook notifications.
   - **Format**: Select JSON, XML, or x-www-form-urlencoded.
4. Save the configuration and test the webhook using the **Test Webhook** button.

Handling Webhook Requests
-------------------------

Your server should:

- Validate incoming requests by checking the request signature or IP if Checkfront provides security measures.
- Respond with an HTTP **200** status code as soon as the request is received.
- Process the payload asynchronously if needed (e.g., queue for later processing).
- Log received events for debugging purposes.

Example of a simple webhook handler in Python (Flask):

.. code-block:: python

    from flask import Flask, request, jsonify

    app = Flask(__name__)

    @app.route('/webhook', methods=['POST'])
    def webhook():
        data = request.get_json()
        print("Received webhook:", data)
        return jsonify({"message": "Webhook received"}), 200

    if __name__ == '__main__':
        app.run(port=5000)

Debugging & Testing Webhooks
----------------------------

To test your webhook, you can use tools like:

- **`Beeceptor <https://beeceptor.com/>`_** – Quickly inspect webhook requests and debug responses.
- **`Typed Webhook Tools <https://typedwebhook.tools/>`_** – Capture and analyze webhook payloads.

These tools allow you to check if Checkfront is sending the correct data and verify how your server processes the webhook requests.

Webhook Event Reference
-----------------------

For a detailed list of webhook event types, refer to:

.. toctree::
    :caption: Webhook Events
    :glob:
    :maxdepth: 1

    webhook/*
