event
=====

Events are used to modify the price or availability of your inventory items based on date. The **event** endpoint allows you to retrieve information on events in the system, and see which items they are applied to.

.. http:get:: /api/3.0/event

	Retrieve a list of all events in the system.

	:>jsonarr array events: A list of all events in the system. See :ref:`note-event` below.

.. http:get:: /api/3.0/event/{id}

	Retrieve data on a specific event.

	:>jsonarr object event: Information about the requested event. See :ref:`note-event` below.

.. _note-event:

Event Object Structure
---------------------------

+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **rate_id**               | *integer*     | A unique code used to refer to this event            |
+---------------------------+---------------+------------------------------------------------------+
| **name**                  | *string*      | The name of this event                               |
+---------------------------+---------------+------------------------------------------------------+
| **type**                  | *string*      | Item Events: "SP" for "Special" events, "SE" for     |
|                           |               | "Seasonal" events.                                   |
|                           |               | Discounts: "DC" for "Discount"                       |
+---------------------------+---------------+------------------------------------------------------+
| **start_date**            | *integer*     | The date *(yyyymmdd)* when this event starts to apply|
+---------------------------+---------------+------------------------------------------------------+
| **end_date**              | *integer*     | The date *(yyyymmdd)* when this event stops applying |
|                           |               | (0 if the event has no end date)                     |
+---------------------------+---------------+------------------------------------------------------+
| **span**                  | *integer*     | The "Force item length to                            |
|                           |               | the above start and end dates" option                |
|                           |               | (1 if selected, 0 if not selected)                   |
+---------------------------+---------------+------------------------------------------------------+
| **price_src**             | *string*      | If applicable, the type of price modification for    |
|                           |               | this event ("Base Price" is "B",                     |
|                           |               | "Create new Price Point" is "N", "Dynamic" is "D",   |
|                           |               | "Yield" is "Yield")                                  |
+---------------------------+---------------+------------------------------------------------------+
| **dynamic_rate**          | *decimal*     | If this event is a "Dynamic" price event             |
|                           |               | (*price_src* is "D"), this value holds the           |
|                           |               | event's percent change or fixed amount price.        |
+---------------------------+---------------+------------------------------------------------------+
| **dynamic_type**          | *string*      | Dynamic Price events: "P" for percent, "F" for       |
|                           |               | fixed amount                                         |
+---------------------------+---------------+------------------------------------------------------+
| **status**                | *string*      | Item Events: whether this is an available ("A")      |
|                           |               | or unavailable ("U") event.                          |
|                           |               | Discounts: always available ("A")                    |
+---------------------------+---------------+------------------------------------------------------+
| **repeat_id**             | *string*      | If the event is not recurring, this value is blank.  |
|                           |               | Weekly recurring events are "W", "Always" recurring  |
|                           |               | events are "*".                                      |
+---------------------------+---------------+------------------------------------------------------+
| **enabled**               | *integer*     | If the event is enabled, 1, otherwise                |
|                           |               | 0 when disabled.                                     |
+---------------------------+---------------+------------------------------------------------------+
| **rule_set_id**           | *integer*     | The ruleset id applying to this                      |
|                           |               | event. The default ruleset id is 1.                  |
+---------------------------+---------------+------------------------------------------------------+
| **vouchers**              | *integer*     | Discounts: the                                       |
|                           |               | number of vouchers attached to this discount.        |
+---------------------------+---------------+------------------------------------------------------+
| **details**               | *array*       | If this is event has a "Yield" **price_src**,        |
|                           |               | this element will contain a list of objects          |
|                           |               | containing a level and rate pair for each threshold. |
|                           |               | See :ref:`note-event-details-threshold` below        |
+---------------------------+---------------+------------------------------------------------------+
| **repeat**                | *array*       | A list of days (mon, tue, ...) for which this event  |
|                           |               | repeats.                                             |
+---------------------------+---------------+------------------------------------------------------+
| **apply_to**              | *object*      | See :ref:`note-event-apply-to` below.                |
+---------------------------+---------------+------------------------------------------------------+

.. _note-event-details-threshold:

event.details objects
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **level**                 | *integer*     | The inventory threshold at which this Yield priced   |
|                           |               | event applies                                        |
+---------------------------+---------------+------------------------------------------------------+
| **rate**                  | *decimal*     | The percentage price multiplier for this threshold   |
+---------------------------+---------------+------------------------------------------------------+

.. _note-event-apply-to:

event.apply_to
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **item_id**               | *array*       | This array contains the list of item IDs             |
|                           |               | which this event applies to.                         |
|                           |               |                                                      |
+---------------------------+---------------+------------------------------------------------------+
| **category_id**           | *array*       | This array contains the list of category IDs         |
|                           |               | which this event applies to. **This event will apply |
|                           |               | to any new items that are added to this category.**  |
+---------------------------+---------------+------------------------------------------------------+

Sample Event Object
--------------------

.. literalinclude:: ../examples/response/event.json
	:language: json
	:linenos: