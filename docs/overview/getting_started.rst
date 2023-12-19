Getting Started
===============

.. note::

	Use of the API requires an active Checkfront subscription.  `Sign up for a Checkfront account here <https://www.checkfront.com/start?cfcp=api>`_.

Prerequisites
-------------
This documentation assumes you have some knowledge of web programming and API implementations -- if not, please see our list of `existing integrations and extensions <https://www.checkfront.com/integrations/?cfcp=api>`_.


Where to Start
--------------
Depending on your familiarity with API implementations, your technical skill level, and your language/environment of choice, there may be a number of places for you to get started.

In most cases, you will likely want to start by downloading our :ref:`sample-code` and running the included examples.  You could then go through this documentation to and reference the example code to find out exactly how it works.

If you are comfortable working in your own environment or are working in a language not covered by our SDKs, you may want to begin by experimenting using :doc:`../guide/dev_console` to get a feel for the system, then review :doc:`auth` to begin building your application.


.. _sample-code:

Sample Code
-----------
Our SDKs (software development kit) handles most of the complex authentication (OAuth2) issues involved with consuming the Checkfront API. They also include sample code and additional documentation and up and running with the API in no time.

All of our SDKs are open source and are `available on Github <https://github.com/Checkfront>`_.  If you have a module to contribute, please let us know.


Finding Help
------------
If you're looking for help figuring out how to get your application working, or just have something you want to ask about, there are a few places you can get in touch with us:

* Contact us directly through the support link in your Checkfront account.
* Talk with other developers on `our forums <https://support.checkfront.com/hc/en-us/community/topics/360001709814-API-Developers>`_.
* Fork us (and contribute!) on `github.com/Checkfront <https://github.com/Checkfront>`_.


Rate Limits
-----------
API throttle limit: We reserve the right to tune the limitations, but they are always set high enough to allow a well-behaving interactive program to do its job.

When the rate limit is exceeded Checkfront will send an HTTP 429 status code.  The number of seconds until the throttle is lifted is sent via the "Retry-After" HTTP header, as specified in RFC 2616.


The Public API
--------------
Checkfront provides a public API feature that allows unauthenticated users to pull information about items and availability. This data is an alternate version of what you can obtain using the authenticated API, and only provides already public information that could otherwise be accessed from the `Customer Booking Page <https://support.checkfront.com/hc/en-us/articles/115004917593-Hosted-Booking-Page>`_.

The public API can be enabled in your Checkfront account under *Manage > Developer > API*. By default this API option is disabled, but can be enabled manually by any Admin account. This option will be enabled automatically if `Site Builder <https://support.checkfront.com/hc/en-us/categories/115000337433-Site-Builder>`_ is activated on the account and can not be turned back off until `Site Builder <https://support.checkfront.com/hc/en-us/categories/115000337433-Site-Builder>`_ is disabled.

The public API can be tested in the Checkfront console (*Manage > Developer > Console*) by toggling the *Access* Username in the top, left-hand corner. If you're testing the API using an external tool, you can test the public API by setting the *X-On-Behalf* header to *Off*.

The endpoints that can be accessed using the public API are as follows:

- :doc:`/ref/category`
- :doc:`/ref/company`
- :doc:`/ref/help`
- :doc:`/ref/item/`
- :doc:`/ref/booking/session`
- :doc:`/ref/booking/form`
- :doc:`/ref/booking/create`
- :doc:`/ref/ping`

Terms of Service
----------------
Use of this API is strictly bound by the terms as specified in `Checkfront API Terms of Service <https://www.checkfront.com/terms/#_api?cfcp=api>`_.

Some functionality documented here may not be available to you based on your plan, or access level of your account.
