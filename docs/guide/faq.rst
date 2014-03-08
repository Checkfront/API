Frequently Asked Questions
==========================

Understanding Errors
++++++++++++++++++++

"The access token was not found."
---------------------------------
When using OAuth2, this error will only appear if the server **did not receive** the :ref:`auth-token` from your application.

"The access token provided is invalid."
---------------------------------------
The server received an access token from you, but could not authorize it.

"Malformed auth header."
------------------------
Your token pair authorization did not contain all of the required token information in the request header.

"You do not have access to this resource."
------------------------------------------
The token pair you attempted to use could not be authorized to use the API.  Double check that you are using the correct credentials, and that you are using the correct authentication type.  See :doc:`../overview/auth`