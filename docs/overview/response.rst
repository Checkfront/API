Response Formatting
===================

All responses from the API are formatted as **JSON** (JavaScript Object Notation) objects containing information related to the request, and any status. Every modern language should have libraries capable of quickly parsing JSON objects. See `json.org <https://json.org/>`_ for more information.

.. seealso::

	For JSON decoding libraries in common environments, see: 

	- PHP: `json_decode <https://secure.php.net/json_decode>`_
	- Python: `json.JSONDecoder <https://docs.python.org/3/library/json.html#json.JSONDecoder>`_
	- Ruby: `JSON.parse <https://ruby-doc.org/stdlib-2.5.1/libdoc/json/rdoc/JSON.html>`_
	- .Net: `Json.NET <https://www.newtonsoft.com/json/>`_
	- JavaScript: `JSON.parse <https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/JSON/parse>`_


All responses from the API will include some information related to the processing of the request, such as the following:
	
+---------------------------+------------------+--------------------------------------------------------------+
| Field                     | Type             | Description                                                  |
+===========================+==================+==============================================================+
| **version**               | *string*         | Current API version used to process the request.             |
+---------------------------+------------------+--------------------------------------------------------------+
| **account_id**            | *integer*        | The staff account that the request was made on behalf of.    |
+---------------------------+------------------+--------------------------------------------------------------+
| **host_id**               | *string*         | Checkfront host account to which the request was made.       |
+---------------------------+------------------+--------------------------------------------------------------+
| **name**                  | *string*         | Display name of the company the account belongs to.          |
+---------------------------+------------------+--------------------------------------------------------------+
| **locale**                | *array*          | *Contains the following fields:*                             |
+---------------------------+------------------+--------------------------------------------------------------+
| locale -> **id**          | *string*         | Selected locale for the account (eg. **en_US**)              |
+---------------------------+------------------+--------------------------------------------------------------+
| locale -> **lang**        | *string*         | Selected language for the account (eg. **en**)               |
+---------------------------+------------------+--------------------------------------------------------------+
| locale -> **currency**    | *string*         | Selected currency for the account (eg. **CAD**)              |
+---------------------------+------------------+--------------------------------------------------------------+
| **request**               | *array*          | *Contains the following fields:*                             |
+---------------------------+------------------+--------------------------------------------------------------+
| request -> **status**     | *string*         | Status of the request. WIll be "**OK**" on success.          |
+---------------------------+------------------+--------------------------------------------------------------+
| request -> **resource**   | *string*         | Resource accessed by the request.                            |
+---------------------------+------------------+--------------------------------------------------------------+
| request -> **records**    | *integer*        | Number of records returned by the request.                   |
+---------------------------+------------------+--------------------------------------------------------------+
| request -> **limit**      | *integer*        | The limit on number of records returned (where applicable).  |
+---------------------------+------------------+--------------------------------------------------------------+
| request -> **page**       | *integer*        | The current page returned for multi-page requests.           |
+---------------------------+------------------+--------------------------------------------------------------+
| request -> **pages**      | *integer*        | Number of pages of response records available.               |
+---------------------------+------------------+--------------------------------------------------------------+
| request -> **time**       | *float*          | The time taken (in ms) to generate the response.             |
+---------------------------+------------------+--------------------------------------------------------------+
| request -> **method**     | *string*         | HTTP request method used in the API request.                 |
+---------------------------+------------------+--------------------------------------------------------------+

If any **critical errors** (e.g. failed credentials) occur, the API will not return any of these fields, but will instead return an object containing any available error information.
