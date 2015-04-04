Connecting to the API
=====================
The **Checkfront API** is accessable via a secure authenticated HTTPS connection to our hosted services, and is isolated to your subscription.  This requires your application to have the ability to connect to external servers using SSL and one of the identity token services provided to your Checkfront account.

Setting Up Your Application
---------------------------
To start setting up your application, open your Checkfront account page and use the menu to navigate your browser to **Manage > Developer**.  
This page will provide access to a listing of your active application clients, as well as containing your webhook notifications configuration under the "**Webhooks**" tab, and :doc:`../guide/dev_console`.

Click the "**New Application**" button in the upper-left corner, and *carefully* read the terms of service provided.

Choosing Your Workflow
^^^^^^^^^^^^^^^^^^^^^^
When adding your application, you will be given a choice between two "authentication types".  The method you choose for your application is largely determined by the intended use and scope of your application, and in certain cases you may choose to add more than one access method to your account.

Token Authentication
~~~~~~~~~~~~~~~~~~~~
**Token** authentication makes use of a simple static private key and secret that can be used for *server-to-server communication only*.  For example, this can be used by an application running on your **private web server** to create a customer-facing booking page.  Applications using this method can only be used privately within your organization, and *must not be distributed*.

OAuth2 Authentication
~~~~~~~~~~~~~~~~~~~~~
**OAuth2** is a secure `open standard <http://tools.ietf.org/html/rfc6749>`_ providing a simple transparent avenue of authenticating with the API.  Using this method of authentication can allow your application to act on behalf of individual members of your staff by allowing them to "log in" and grant permission to the app.  This is ideal for any case where you want to allow your staff to (for example) make or change bookings in the system.

Please see `our SDKs <https://github.com/Checkfront>`_ or support libraries for `OAuth2 <http://oauth.net/2/>`_ in your preferred environment.  If we don't have an example for your language, there are `many libraries <http://oauth.net/2/>`_ and documentation available for various programming languages that provide all the functionality you'll need to implement a custom OAuth2 solution.

Obtaining API Credentials
^^^^^^^^^^^^^^^^^^^^^^^^^
After you choose an application name (for your own reference), an authentication type, and accept the terms of service, you can click "**Create**" to save and return to your application listing.  

**Click on your new application** to show the credentials used to connect your application to the API.

.. warning::

	Your API credentials provide your application with access to private data stored on your account and the ability to act on your behalf.  Treat these as you would your password, and be careful not to distribute or send these to untrusted parties.


If you are using the SDK, see :doc:`../guide/sdk_setup`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. note::

	Much of the following documentation is intended for custom integrations and understanding of the protocols involved in authentication.  Our `SDK resources <https://github.com/Checkfront>`_ abstract the complex authentication processes to simplify development of your application.

.. _auth-token:

Authenticating with Token Pairs
-------------------------------
If you are using token authentication, your application will provide you with two keys:

	+------------------+--------------------------------------------------------------------------------+
	| **API Key**      | Will be set as your *HTTP BASIC* **Username**                                  |
	+------------------+--------------------------------------------------------------------------------+
	| **API Secret**   | Will be set as your *HTTP BASIC* **Password**                                  |
	+------------------+--------------------------------------------------------------------------------+

When sent together in a request header using HTTP Basic authorization, these allow direct access to API endpoints without any additional preamble.

See ``CURLOPT_USERPWD`` if working with cURL libraries, or the documentation on *HTTP Basic authentication* relevant to your chosen framework.  If building your requests manually, HTTP Basic credentials are **base64 encoded** in the sequence "``username:password``" and sent in the **request header** in the following format:

.. sourcecode:: http

	Authorization: Basic M2JlOTg2NDFmMDc0NWI2ZmU3ZGFjYzJkZjk0N2FkYmMxZGE3MzEyZDo0YzRkNTk4YTVkOTQwZjA4ZmRiNDM1YjY5YWY5ODZjNzBmMjIwNmRk


Authenticating with OAuth2
--------------------------

Logging in with a Staff Account
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

#. Redirect your staff user to your **Authorize Token URL** (eg. ``https://your-company.checkfront.com/oauth/``) with the following query string parameters set:

	+------------------+--------------------------------------------------------------------------------+
	| **client_id**    | Your application's "Consumer Key" (see your application setup).                |
	+------------------+--------------------------------------------------------------------------------+
	| **response_type**| **MUST** be set to ``code``                                                    |
	+------------------+--------------------------------------------------------------------------------+
	| **redirect_uri** | The URI to return your user to after authorization.                            |
	+------------------+--------------------------------------------------------------------------------+

#. Upon completion of authorization, the staff user will be sent to the redirect_uri specified, passing a **code** parameter in the query string that must be exchanged by your application for an access/refresh token pair within 60 seconds.  

	To exchange the code for an access token, make a call to your **Access Token URL** (eg. ``https://your-company.checkfront.com/oauth/token/``) with the following parameters set: 

	+------------------+--------------------------------------------------------------------------------+
	| **client_id**    | *Should be sent as HTTP Basic credentials.*  See :ref:`consumer-key-secret`.   |
	+------------------+--------------------------------------------------------------------------------+
	| **client_secret**| *Should be sent as HTTP Basic credentials.*  See :ref:`consumer-key-secret`.   |
	+------------------+--------------------------------------------------------------------------------+	
	| **grant_type**   | **MUST** be set to ``authorization_code``                                      |
	+------------------+--------------------------------------------------------------------------------+
	| **code**         | The authorization code as returned in the client's GET request to your page.   |
	+------------------+--------------------------------------------------------------------------------+	
	| **redirect_uri** | The URI to return your user to after authorization.                            |
	+------------------+--------------------------------------------------------------------------------+	
	

#. Store the token returned by the previous call in a *secure* database along with a field containing the timestamp of most recent update to the token.  Your tokens should be refreshed on a regular basis as long as the authorization continues to be used.  

	Your application should store and make use of the following fields from the response:

	+-------------------+-----------+-------------------------------------------------------------------+
	| **access_token**  | *string*  | See :ref:`access-token`.                                          |
	+-------------------+-----------+-------------------------------------------------------------------+
	| **expires_in**    | *integer* | The time (in seconds) after which the *access* token will expire. |
	+-------------------+-----------+-------------------------------------------------------------------+	
	| **refresh_token** | *string*  | See :ref:`refresh-token`.                                         |
	+-------------------+-----------+-------------------------------------------------------------------+	


Using and Maintaining OAuth2 Tokens
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
While your first authentication will provide a usable access token for identifying with the server, the access token has a fixed lifetime and must be refreshed in order to maintain access to the API.  

See :ref:`refresh-token` and other details below for information on performing a refresh.

.. _oauth2-ref:

OAuth2 Reference
^^^^^^^^^^^^^^^^

Authorization Endpoints
~~~~~~~~~~~~~~~~~~~~~~~
There are two important endpoints used in authenticating tokens using OAuth2, which are both displayed when viewing the application key setup on your Checkfront developer page.

* Your **Authorize Token URL** is used when redirecting a user to grant permission to use their account.  On success, this will return a code for you to pass to the *Access Token URL* to grant a token you can use to access the API.

	::
	
		https://your-company.checkfront.com/oauth/

* Your **Access Token URL** is used for granting access tokens from code requests, and refreshing existing access/refresh tokens.

	::
	
		https://your-company.checkfront.com/oauth/token/


.. _consumer-key-secret:

Consumer Key / Consumer Secret
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
These are generated when setting up your application and can be found on your Checkfront developer page.
Your consumer key and secret allow your application to grant and refresh tokens on behalf of your users.  

.. warning::

	You consumer key and secret should **only** be sent together when making calls to your **Access Token URL**.  When your application is making calls to endpoints requiring a valid access token, the key/secret pair **should not** be sent.

As with token pairs (see above), these can (and should) be sent as HTTP Basic credentials. *However*, these can only be sent in this manner to the **/oauth/token/** (code/refresh) endpoint.  Your request will be *rejected* if you attempt to send these to an /api/ endpoint.

See ``CURLOPT_USERPWD`` if working with cURL, or the documentation on HTTP Basic authorization relevant to your chosen framework.  If building your requests manually, HTTP Basic credentials are **base64 encoded** in the sequence "``username:password``" and sent in the **request header** in the following format::

	Authorization: Basic M2JlOTg2NDFmMDc0NWI2ZmU3ZGFjYzJkZjk0N2FkYmMxZGE3MzEyZDo0YzRkNTk4YTVkOTQwZjA4ZmRiNDM1YjY5YWY5ODZjNzBmMjIwNmRk


.. _access-token:

Access Token
~~~~~~~~~~~~
This is used by the API server to identify you and allow the application to act on your behalf.  When using OAuth2 for your application, an access token is **required** to be sent with **all** API calls to secure data endpoints. 

Access tokens have a lifetime of **14000 seconds** (this will be returned as ``expires_in`` when new tokens are granted), after which they must be *refreshed* to obtain a new token.  Your application should keep track of when this token will be expiring and check if it needs refreshing before attempting a request.

When sending your token with an API request, it can be sent in a header in the following format::

	Authorization: BEARER f58ef579d0bb5ffb3b5bb0985a85e21a

It will also be accepted in the form of the query string parameter ``access_token`` in the GET request or POST body if necessary for your application, although this is not recommended in a live application. ::

	access_token=f58ef579d0bb5ffb3b5bb0985a85e21a


.. _refresh-token:	
	
Refresh Token
~~~~~~~~~~~~~

After your current **access token** has expired, this token can be passed to create a new access/refresh token pair, which must completely replace your previously stored token (which will be invalidated).

To exchange the the refresh token for a new access/refresh token pair, make a call to your **Access Token URL** (eg. ``https://your-company.checkfront.com/oauth/token/``) with the following parameters set: 

	+------------------+--------------------------------------------------------------------------------+
	| **client_id**    | *Should be sent as HTTP Basic credentials.*  See :ref:`consumer-key-secret`.   |
	+------------------+--------------------------------------------------------------------------------+
	| **client_secret**| *Should be sent as HTTP Basic credentials.*  See :ref:`consumer-key-secret`.   |
	+------------------+--------------------------------------------------------------------------------+	
	| **grant_type**   | **MUST** be set to ``refresh_token``                                           |
	+------------------+--------------------------------------------------------------------------------+
	| **refresh_token**| The current (active) refresh token for this user.                              |
	+------------------+--------------------------------------------------------------------------------+	


Refresh tokens have a lifetime of **14 days** from issue, after which (if allowed to expire) you must generate a new access/refresh token pair to regain application authorization.
