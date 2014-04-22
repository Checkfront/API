Setting Up The SDK
==================

Once you have set up credentials for your application (see :doc:`../overview/auth`), you can set up the SDK and its examples to get a head start on working with the API.

.. warning::

	Your API credentials provide your application with access to private data stored on your account and the ability to act on your behalf.  Treat these as you would your password, and be careful not to distribute or send these to untrusted parties.


With Token Authentication
-------------------------

Using the PHP-SDK with your extended Checkfront class, you would connect to the API by passing your token key and secrets into the settings, similar to the following:

.. code-block:: php
	:linenos:
	:emphasize-lines: 6,7
   
	new CheckfrontAPI(
		array(
			'host' => 'your-company.checkfront.com',
			'account_id' => 'off', // act on behalf of the customer
			'auth_type' => 'token',
			'api_key' => '3be98641f0745b6fe7dacc2df947adbc1da7312d',
			'api_secret' => 'b300e27b07bfc6fed944a0116b595ec2130e9efc6410424d12c68c7766f2d861',
		)
	);

Note that the **api_key** and **api_secret** fields must be set to the values obtained when setting up your application in your Checkfront account.

Once this is done, the application will be ready to run calls against the API.


With OAuth2 Authentication
--------------------------
If you are not familiar with how OAuth2 works, you may want to review :ref:`oauth2-ref` and the preceding authentication overview.

When using OAuth2 authentication, your application will require a place to store access/refresh tokens for your users.  While the examples do provide a simple implementation of this, we highly recommend writing your own secure storage procedure suited to the application you're building.  These are typically best stored in a database (such as one you may already be using for other requirements of your application), as they are replaced on a regular basis as long as the application continues to be used.

Setup
~~~~~

As with token authentication, a few fields are passed into the object on creation to configure your connection to the API:

.. code-block:: php
	:linenos:
	:emphasize-lines: 5-7

	new CheckfrontAPI(
		array(
			'host' => 'your-company.checkfront.com',
			'auth_type' => 'oauth2',
			'consumer_key' => '1d2d5cad60174b5972243693d082e4b4e54979bf',
			'consumer_secret' => '8e3751291c3d0fe090a7d5b18d964407baff96c1028e1e1afb1014d1db85b25a'
		)
	);

Your **consumer_key** and **consumer_secret** should match the values provided when setting up your application.  The **redirect_uri** should match the "Callback URL" value you define on the same page.


Staff Logins
~~~~~~~~~~~~

The SDK includes a simple abstraction process to login staff using OAuth2, easing much of the more complex process of handling logins.  

To review the process of handling staff credentials, your application would:

Handle previous logins
^^^^^^^^^^^^^^^^^^^^^^
Load the previous **access_token** and **refresh_token** into your CheckfrontAPI object, likely from a database or a cookie.  

To do this, you will at the very least want to write a custom CheckfrontAPI->store() function to save & load tokens.  When handling multiple users with tokens stored in your database, remember to account for storing tokens for each.

Whenever a token is prepared for storage by the SDK, it will send an *array* to your **CheckfrontAPI->store($data)** function, containing the following fields for storage:

+------------------+---------------------------------------------------------------+
| **refresh_token**| See :ref:`refresh-token`.                                     |
+------------------+---------------------------------------------------------------+
| **access_token** | See :ref:`access-token`.                                      |
+------------------+---------------------------------------------------------------+
| **expire_token** | The unix timestamp after which the access token will expire.  |
+------------------+---------------------------------------------------------------+
| **updated**      | The current time.                                             |
+------------------+---------------------------------------------------------------+

When **loading** tokens on initialization, the SDK will call the same *store()* function **without any parameters**.  In this case, the function should **return** the previously stored values as an array.

If an **access_token** is expired, the SDK will automatically refresh it on startup.  However, if a **refresh_token** expires, you will need to invalidate the stored tokens and begin the login process for the user.  Based on store() input above, you can generally assume the expiry is **updated** + 14 days, but the tokens can be refreshed at any time before that point.

New logins
^^^^^^^^^^

#. Make a call to **CheckfrontAPI->authorize(boolean $redirect)** to either return the login URL or set a redirect header to it.  From here, the staff member grants permission to your application, and is redirected back to your specified callback URL.
#. On returning to your callback URL, the client will pass an authentication **code** in the query string (that's **$_GET['code']**), which your application then passes into the fetch_token function of the CheckfrontAPI object as follows:

	.. sourcecode:: php

		CheckfrontAPI->fetch_token($_GET['code']);
	
#. On completion, a new authenticated token will be returned, and as above, the token will be sent to your **store()** function.  
#. You're ready to make calls to the API on behalf of the staff member.


Making Calls to the API
-----------------------

The SDK has simple abstractions to common HTTP request methods used with the API -- in particular, **CheckfrontAPI->get($path, $data);** and **CheckfrontAPI->post($path, $data);**

Using these functions, your application would send the base path of the API element to be accessed in **$path**, and any options to be sent as an associative array in **$data**.

For example, instead of manually building a query string in a request such as:

.. sourcecode:: http

	GET /api/3.0/booking/index?start_date=today&status_id=PAID HTTP/1.1
	Host: your-company.checkfront.com
	
You could instead use:

.. code-block:: php
	:linenos:

	$data = array(
		'start_date'=>'today',
		'status_id'=>'PAID'
	);
	Checkfront->get('booking/index',$data);