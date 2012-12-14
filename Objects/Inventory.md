# Inventory

The inventory object provides access to your master inventory. This allows you to query your inventory, determine availability, pricing for a given time. The information returned can be used to create a booking in the system.


##Category


## Items
Description:	Fetch inventory items
Path:	/api/2/item/
Methods:	GET
Parameter:	start_date start date to query.
Parameter:	end_date end date to query.
Paramater:	category_id category id(s) to filter.
Paramater:	params booking paramaters.
GET http://demo.checkfront.com/api/2.1/item/?start_date=2013-05-18&amp;end_date=2013-05-19
Fetching multiple items
You can query multiple items at once.

GET http://demo.checkfront.com/api/2.1/item/?start_date=2013-05-18&amp;end_date=2013-05-20&amp;category_id=4

### Filtering

By default, inventory request use the default parameters as defined in your Checkfront account. If no date parameters are set, todays date will be used, with the end date being your default length. These settings can be adjusted under Manage / System in your account.

Parameters are passed as a query-string to the endpoint:

Get a list of items, and check availably / pricing by date

### Single item
<table>
<tbody>
<tr>
<th>Description:</th>
<td>Fetch list of categories</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2/category/</td>
</tr>
<tr>
<th>Methods:</th>
<td>GET</td>
</tr>
<tr>
<th>Parameter:</th>
<td><var>category_id</var> optional category to return.</td>
</tr>
</tbody>
</table>

You can fetch the details of a single item on the system by passing the sku or system generated Item ID in the url.

http://demo.checkfront.com/api/2.1/item/8/?start_date=2013-05-20&amp;end_date=2013-05-21
Available Parameters

Parameters

You can request multiple items and categories by passing them as an array:

GET: http://demo.checkfront.com/api/2.1/inventory?item_id[]=1&amp;item_id[]=3&amp;start_date=2013-05-20&amp;end_date=2013-05-21


