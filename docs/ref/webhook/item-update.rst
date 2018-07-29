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
|                           |               |                                                      |
|                           |               | - D is for Daily.                                    |
|                           |               |                                                      |
|                           |               | - N is for Nightly.                                  |
|                           |               |                                                      |
|                           |               | - ##M is for sub-hourly, with #                      |
|                           |               |   representing the number of minutes.                |
|                           |               |                                                      |
|                           |               | - H is Hourly.                                       |
|                           |               |                                                      |
|                           |               | - TS is Timeslots.                                   |
|                           |               |                                                      |
+---------------------------+---------------+------------------------------------------------------+
| **sku**                   | *string*      | The item's SKU                                       |
+---------------------------+---------------+------------------------------------------------------+
| **url**                   | *string*      | The Item's "More Info URL"                           |
+---------------------------+---------------+------------------------------------------------------+
| **lock**                  | *integer*     | If the item has Date Based Inventory control active. |
|                           |               |                                                      |
|                           |               | - 0 Date-based inventory is disabled.                |
|                           |               |                                                      |
|                           |               | - 1 Date-based inventory is enabled.                 |
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
| **Meta**                  | *object*      | See :ref:`note-item-meta` below.                     |
+---------------------------+---------------+------------------------------------------------------+
| **stock**                 | *integer*     | The item's inventory.                                |
+---------------------------+---------------+------------------------------------------------------+
| **unlimited**             | *integer*     | This returns if the item's inventory is unlimited or |
|                           |               | not.                                                 |
|                           |               |                                                      |
|                           |               | - 0 for limited inventory                            |
|                           |               |                                                      |
|                           |               | - 1 for unlimited inventory                          |
+---------------------------+---------------+------------------------------------------------------+
| **video**                 | *object*      | See :ref:`note-item-video` below.                    |
+---------------------------+---------------+------------------------------------------------------+
| **image**                 | *object*      | See :ref:`note-item-image` below.                    |
+---------------------------+---------------+------------------------------------------------------+
| **category_id**           | *integer*     | The id of the category this item is in.              |
+---------------------------+---------------+------------------------------------------------------+
| **rated**                 | *integer*     | If this item is simple or not.                       |
|                           |               |                                                      |
|                           |               | - 0 if the item is simple.                           |
|                           |               |                                                      |
|                           |               | - 1 if it is regular.                                |
+---------------------------+---------------+------------------------------------------------------+
| **product_group_type**    | *string*      | The type of item this is in a Product Group.         |
|                           |               |                                                      |
|                           |               | - P for Parent.                                      |
+---------------------------+---------------+------------------------------------------------------+
| **product_group_children**| *object*      | Contains the Item object of the items that are       |
|                           |               | children of the main item.                           |
+---------------------------+---------------+------------------------------------------------------+
| **type**                  | *string*      |                                                      |
+---------------------------+---------------+------------------------------------------------------+
| **status**                | *string*      | This is the availability status for the item.        |
|                           |               |                                                      |
|                           |               | - A for Available.                                   |
|                           |               |                                                      |
|                           |               | - U for Unavailable.                                 |
+---------------------------+---------------+------------------------------------------------------+
| **alias_id**              | *integer*     | The ID of the item this is aliased too. This will not|
|                           |               | show the ID of items aliased to this item.           |
+---------------------------+---------------+------------------------------------------------------+
| **len**                   | *integer*     | The fixed length of the item.                        |
+---------------------------+---------------+------------------------------------------------------+
| **rules**                 | *object*      | See :ref:`note-item-rules` below.                    |
+---------------------------+---------------+------------------------------------------------------+
| **category**              | *string*      | The name of the category this item is in.            |
+---------------------------+---------------+------------------------------------------------------+

.. _note-item-meta:

item.meta
------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **display_mode**          | *string*      | The display mode for time slots and hourly selectors.|
|                           |               | Default is "Dropdown".                               |
+---------------------------+---------------+------------------------------------------------------+
| **display_mode**          | *string*      | If this is rate has a "Yield" **price_src**,         |
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

.. _note-item-rules:

item.rules
-------------------------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **<day of week            | *integer*     | The rate repeats for this day of the week.           |
| abbreviation>**           |               |                                                      |
| (e.g., mon, tue,...)      |               |                                                      |
+---------------------------+---------------+------------------------------------------------------+

Sample Rate Notification
------------------------

JSON
~~~~
.. literalinclude:: ../../examples/response/webhook-item-event-edit.json
	:language: json
	:linenos:

XML
~~~
.. literalinclude:: ../../examples/response/webhook-item-event-edit.xml
	:language: xml
	:linenos:
