ping
====

.. http:get:: /api/3.0/ping

	Show API connection details and latency.

Public API
----------
If the Public API is enabled, non-authenticated users can make requests to the */ping* end point. Both the public and authenticated responses are identical.

.. literalinclude:: ../examples/response/ping.json
	:language: json
	:linenos:
