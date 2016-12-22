Item Event/Discount Edit
^^^^^^^^^^^^^^^^^^^^^^^^

This webhook is triggered whenever any item events or discounts are altered on your account.
Because of their similarities, **Item Events and Discounts are both called "rates"**. When
fields have specific meanings for either Item Events or Discounts, those differences are defined
in the Description column.

A **JSON**, **XML**, or **x-www-form-urlencoded** object containing the following export fields can
be found in directly in the **raw body** of the POST request to your server:

rate
----
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **rate_id**               | *integer*     | A unique code used to refer to this rate             |
+---------------------------+---------------+------------------------------------------------------+
| **name**                  | *string*      | The name of this rate                                |
+---------------------------+---------------+------------------------------------------------------+
| **type**                  | *string*      | Item Events: "SP" for "Special" events, "SE" for     |
|                           |               | "Seasonal" events.                                   |
|                           |               | Discounts: "DC" for "Discount"                       |
+---------------------------+---------------+------------------------------------------------------+
| **start_date**            | *integer*     | The date *(yyyymmdd)* when this rate starts to apply |
+---------------------------+---------------+------------------------------------------------------+
| **end_date**              | *integer*     | The date *(yyyymmdd)* when this rate stops applying  |
|                           |               | (0 if the rate has no end date)                      |
+---------------------------+---------------+------------------------------------------------------+
| **span**                  | *integer*     | The "Force item length to                            |
|                           |               | the above start and end dates" option                |
|                           |               | (1 if selected, 0 if not selected)                   |
+---------------------------+---------------+------------------------------------------------------+
| **price_src**             | *string*      | If applicable, the type of price modification for    |
|                           |               | this rate ("Base Price" is "B",                      |
|                           |               | "Create new Price Point" is "N", "Dynamic" is "D",   |
|                           |               | "Yield" is "Yield")                                  |
+---------------------------+---------------+------------------------------------------------------+
| **dynamic_rate**          | *decimal*     | If this event is a "Dynamic" price rate              |
|                           |               | (*price_src* is "D"), this value holds the           |
|                           |               | rate's percent change or fixed amount price.         |
+---------------------------+---------------+------------------------------------------------------+
| **dynamic_type**          | *string*      | Dynamic Price rates: "P" for percent, "F" for        |
|                           |               | fixed amount                                         |
+---------------------------+---------------+------------------------------------------------------+
| **status**                | *string*      | Item Events: whether this is an available ("A")      |
|                           |               | or unavailable ("U") event.                          |
|                           |               | Discounts: always available ("A")                    |
+---------------------------+---------------+------------------------------------------------------+
| **repeat_id**             | *string*      | If the rate is not recurring, this value is blank.   |
|                           |               | Weekly recurring events are "W", "Always" recurring  |
|                           |               | events are "*".                                      |
+---------------------------+---------------+------------------------------------------------------+
| **enabled**               | *integer*     | If the rate is enabled, 1, otherwise                 |
|                           |               | 0 when disabled.                                     |
+---------------------------+---------------+------------------------------------------------------+
| **rule_set_id**           | *integer*     | The ruleset id applying to this                      |
|                           |               | event. The default ruleset id is 1.                  |
+---------------------------+---------------+------------------------------------------------------+
| **vouchers**              | *integer*     | Discounts: the                                       |
|                           |               | number of vouchers attached to this discount.        |
+---------------------------+---------------+------------------------------------------------------+
| **details**               | *object*      | See :ref:`note-rate-details` below.                  |
+---------------------------+---------------+------------------------------------------------------+
| **repeat**                | *object*      | See :ref:`note-rate-repeat` below.                   |
+---------------------------+---------------+------------------------------------------------------+
| **apply_to**              | *object*      | See :ref:`note-rate-apply-to` below.                 |
+---------------------------+---------------+------------------------------------------------------+

.. _note-rate-details:

rate.details
------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **thresholds**            | *object*      | If this is rate has a "Yield" **price_src**,         |
|                           |               | this element will contain a list of objects          |
|                           |               | containing a level and rate pair for each threshold. |
|                           |               | See :ref:`note-rate-details-thresholds` below        |
+---------------------------+---------------+------------------------------------------------------+

.. _note-rate-details-thresholds:

rate.details.thresholds
-----------------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **threshold**             | *object*      | This contains a pair of level and rate values for a  |
|                           |               | threshold.                                           |
|                           |               | See :ref:`note-rate-details-threshold-pair` below    |
+---------------------------+---------------+------------------------------------------------------+

.. _note-rate-details-threshold-pair:

rate.details.thresholds.threshold
---------------------------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **level**                 | *integer*     | The inventory threshold at which this Yield priced   |
|                           |               | rate applies                                         |
+---------------------------+---------------+------------------------------------------------------+
| **rate**                  | *decimal*     | The percentage price multiplier for this threshold   |
+---------------------------+---------------+------------------------------------------------------+

.. _note-rate-repeat:

rate.repeat
-----------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **days**                  | *object*      | If set, this rate repeats on specific days of the    |
|                           |               | week. See :ref:`note-rate-repeat-days` below.        |
+---------------------------+---------------+------------------------------------------------------+

.. _note-rate-repeat-days:

rate.repeat.days
----------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **<day of week            | *integer*     | The rate repeats for this day of the week.           |
| abbreviation>**           |               |                                                      |
| (e.g., mon, tue,...)      |               |                                                      |
+---------------------------+---------------+------------------------------------------------------+

.. _note-rate-apply-to:

rate.apply_to
-------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **items** / **categories**| *object*      | This object contains a list of the items or          |
|                           |               | categories which this rate applies to.               |
|                           |               | See :ref:`note-rate-apply-to-values` below.          |
+---------------------------+---------------+------------------------------------------------------+

.. _note-rate-apply-to-values:

rate.apply_to.items
-------------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **id**                    | *integer*     | An item_id which this rate applies to                |
+---------------------------+---------------+------------------------------------------------------+

rate.apply_to.categories
------------------------
+---------------------------+---------------+------------------------------------------------------+
| Field                     | Type          | Description                                          |
+===========================+===============+======================================================+
| **id**                    | *integer*     | This contains a category_id which this rate has      |
|                           |               | completely selected. **This rate will apply to any   |
|                           |               | new items that are added to this category.**         |
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
