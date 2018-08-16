Item Update
^^^^^^^^^^^

This webhook is triggered whenever any items are altered on your account.

A **JSON**, **XML**, or **x-www-form-urlencoded** object containing the following export fields can
be found in directly in the **raw body** of the POST request to your server:

Item
----
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **unit**                  | *string*      | The allocation type for the item.                    |
+---------------------------+---------------+------------------------------------------------------+
| **sku**                   | *string*      | The item's SKU                                       |
+---------------------------+---------------+------------------------------------------------------+
| **url**                   | *string*      | The Item's "More Info URL"                           |
+---------------------------+---------------+------------------------------------------------------+
| **lock**                  | *integer*     | If the item has Date Based Inventory control active. |
|                           |               |                                                      |
|                           |               | 0 means that Date-based inventory is disabled.       |
+---------------------------+---------------+------------------------------------------------------+
| **visibility**            | *string*      | The visibility of this item on the booking page.     |
|                           |               |                                                      |
|                           |               | - \* for Everyone                                    |
|                           |               |                                                      | 
|                           |               | - S for Staff                                        |
|                           |               |                                                      |
|                           |               | - P for Packages Only                                |
+---------------------------+---------------+------------------------------------------------------+
| **name**                  | *string*      | The name of the item.                                |
+---------------------------+---------------+------------------------------------------------------+
| **pos**                   | *integer*     | The sort order integer.                              |
+---------------------------+---------------+------------------------------------------------------+
| **meta**                  | *object*      | Contains meta details for the item. This changes     |
|                           |               | based on the add-ons and data for the item.          |
+---------------------------+---------------+------------------------------------------------------+
| **stock**                 | *integer*     | The item's inventory.                                |
+---------------------------+---------------+------------------------------------------------------+
| **unlimited**             | *integer*     | This returns if the item's inventory is unlimited or |
|                           |               | not.                                                 |
|                           |               |                                                      |
|                           |               | 0 means the inventory is limited.                    |
+---------------------------+---------------+------------------------------------------------------+
| **video**                 | *object*      | See :ref:`note-item-video` below.                    |
+---------------------------+---------------+------------------------------------------------------+
| **image**                 | *object*      | See :ref:`note-item-image` below.                    |
+---------------------------+---------------+------------------------------------------------------+
| **category_id**           | *integer*     | The id of the category this item is in.              |
+---------------------------+---------------+------------------------------------------------------+
| **rated**                 | *integer*     | If this item is simple or not.                       |
|                           |               |                                                      |
|                           |               | 0 means the item is simple.                          |
+---------------------------+---------------+------------------------------------------------------+
| **product_group_type**    | *string*      | The type of item this is in a Product Group.         |
|                           |               |                                                      |
|                           |               | P is for Parent, C is child,                         |
+---------------------------+---------------+------------------------------------------------------+
| **product_group_children**| *object*      | Contains the Item object of the items that are       |
|                           |               | children of the main item.                           |
+---------------------------+---------------+------------------------------------------------------+
| **type**                  | *string*      | Determines if this is an Item or a Gift Certificate. |
+---------------------------+---------------+------------------------------------------------------+
| **status**                | *string*      | This is the availability status for the item.        |
+---------------------------+---------------+------------------------------------------------------+
| **alias_id**              | *integer*     | The ID of the item this is aliased too. This will not|
|                           |               | show the ID of items aliased to this item.           |
+---------------------------+---------------+------------------------------------------------------+
| **len**                   | *integer*     | The fixed length of the item.                        |
+---------------------------+---------------+------------------------------------------------------+
| **rules**                 | *object*      | Contains the item's parameters, fixed length,        |
|                           |               | and attribute specific rules such as default length  |
|                           |               | start time, etc.                                     |
+---------------------------+---------------+------------------------------------------------------+
| **category**              | *string*      | The name of the category this item is in.            |
+---------------------------+---------------+------------------------------------------------------+

.. _note-item-video:

item.video
--------------------------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **id**                    | *string*      | This is the identifying string for the Youtube URL.  |
+---------------------------+---------------+------------------------------------------------------+
| **start**                 | *integer*     | How many seconds into the video to start.            |
+---------------------------+---------------+------------------------------------------------------+


.. _note-item-image:

item.image
---------------------------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **#**                     | *integer*     | The number of the image on the item. The images are  |
|                           |               | numbered in the order they were uploaded, but ordered|
|                           |               | in the order they display on the item.               |
+---------------------------+---------------+------------------------------------------------------+

.. _note-item-image-images:

item.image.images
--------------------------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **src**                   | *string*      | The identifying string for the image.                |
+---------------------------+---------------+------------------------------------------------------+
| **path**                  | *string*      | The identifying path to where the image is found     |
|                           |               | relative to your Checkfront Account URL.             |
+---------------------------+---------------+------------------------------------------------------+
| **url**                   | *string*      | The identifying path to where the image is found     |
|                           |               | on the server.                                       |
+---------------------------+---------------+------------------------------------------------------+
| **url_medium**            | *string*      | The identifying path to where a medium version of the|
|                           |               | image is found on the server.                        |
+---------------------------+---------------+------------------------------------------------------+
| **url_small**             | *string*      | The identifying path to where a small version of the |
|                           |               | image is found on the server.                        |
+---------------------------+---------------+------------------------------------------------------+


Sample Rate Notification
------------------------

JSON
~~~~
.. literalinclude:: ../../examples/response/webhook-item-update.json
	:language: json
	:linenos:

XML
~~~
.. literalinclude:: ../../examples/response/webhook-item-update.xml
	:language: xml
	:linenos:
