Checkfront API
===

The Checkfront API allows developers to expand and build on the Checkfront platform. The API makes it easy to create web, desktop & mobile applications that integrate and with your Checkfront account.

Our API is built around open, standard and secure technologies to streamline development and maintain integrity of your data.

The Checkfront API extends the following functionality:
Query inventory availability.
Get date based rate and pricing information.
Create a new booking.
Update an existing booking.
Retrieve customer information.
Update and create events, blackout dates and discounts.
Interface with existing Checkfront modules including payment gateways.
Prerequisites:
This document assumes you have some knowledge of programming, and API implementations -- if not, please see our list of existing plug-ins and extensions or contact us to for in introduction to a qualified Checkfront developer in your area.

Use of the API is strictly bound by the terms as specified in our terms of use.
Developer accounts can be used to test and build applications, but real-world use of the API requires an active account in good standing.

Some functionality documented here may not be available to you based on your plan, or access level of your account.

REST Interface
==

The Checkfront API uses a REST interface. This means that method calls are made over the Internet by sending standard HTTPs GET or POST requests to the Checkfront API REST server.

Nearly any computer language can be used to communicate over HTTP with the REST server including remote web sites, mobile devices and desktop applications.

Authentication and Encryption (OAuth2)
== 

Checkfront makes use of the open standard OAuth2 to provide secure and transparent authentication with the API. OAuth allows you to make your Checkfront account available to external applications without needing to provide your login and password.

All queries to the API are required to be made over a SSL authenticated OAuth2 session. Checkfront currently supports Draft 20 of the OAuth2 spec. For those switching from OAuth1, you'll notice it's significantly easier to work with, and generally performs better.

If your app isn't going to be distributed outside of your organization, you can generate oAuth2 access keys within the app to by-pass the initial authentication routine.

Please see our SDK's or support libraries for OAuth2 in your preferred environment.

Endpoints
===

Every Checkfront account operates in their own segregated environment, secure by a unique domain. In most cases, this is : https://your-company.checkfront.com. In this document this will be referred to as your Checkfront URL or your-company.checkfront.com (this may differ depending on your country).

https://your-company.checkfront.com/api/2.1/
https://your-company.checkfront.com/oauth/

Response Formatting (JSON)
===

All response is formatted in JSON (JavaScript Object Notation). To simplify the API, we no longer support XML response. All modern languages are able to quickly parse JSON. See: PHP: json_decode, Ruby: JSON.parse, .Net Json.NET, Javascript / jQuery: jQuery.getJSON.

Representation
===
All JSON should be UTF-8 encoded.
Date and time values ISO 8601 formatted, eg: YYYY-MM-DD HH:MM:SS.
Booleans are either 1 (true) or 0 (false).

General Housekeeping
===

API throttle limit: We reserve the right to tune the limitations, but they are always set high enough to allow a well-behaving interactive program to do its job.

When the rate limit is exceeded Checkfront will send an HTTP 503 status code. The number of seconds until the throttle is lifted is sent via the "Retry-After" HTTP header, as specified in RFC 2616.

API Request

Once authenticated, a basic request to the API will return some general information about the account you are connecting to. This header information is included in all successful calls to the API, but may be left out of examples in this document.

GET: http://demo.checkfront.com/api/2/

{
    "version":"2",
    "id":"demo.checkfront.com",
    "name":"Demo",
    "currency_id":"USD",
    "currency_symbol":"$",
    "session_id":"rmvm4jf7kh02n6dde8s9f20me1"
}

Error Messages
{
    "error":"invalid_request",
    "error_description":"The access token was not found."
}

API Notifications
API notifications provide the ability to send an automated notification when a new booking is created or updated. You can configure API notifications in your account under Manage / API / Notifications.


Sample Code


Our SDKs (software development kit) handles most of the complex authentication (OAuth2) issues involved with consuming the Checkfront API. They also include sample code and additional documentation and up and running with the API in no time.

All of our SDKs are open source. If you wish to contribute please find us on Github.

Current SDKs include: PHP SDK.

Check back often for additional SDKs, sample code and documentation.

Terms of Use
Checkfront API Terms of Service





