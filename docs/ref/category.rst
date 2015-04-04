category
========
.. http:get:: /api/3.0/category

 	Retrieve a list of the available categories in the system.

	:>jsonarr integer category_id: The unique ID of the category.
	:>jsonarr string name: The display name of the category.
	:>jsonarr integer pos: The order in which the category will display.

.. literalinclude:: ../examples/response/category.json
	:language: json
	:linenos:
