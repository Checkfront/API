category
========
.. http:method:: GET /api/3.0/category

.. http:response:: Retrieve a list of the available categories in the system.

	:data integer category_id: The unique ID of the category.
	:data string name: The display name of the category.
	:data integer pos: The order in which the category will display.

.. literalinclude:: ../examples/response/category.json
	:language: js
	:linenos: