# Checkfront API Objects

API Objects provide read and write access to Checkfront data sets. You can access Checkfront objects through standard the REST interface.

API Objects currently include: Inventory, Booking and Customer.

# Inventory

The inventory object provides access to your master inventory. This allows you to query items, determine availability and pricing for a given period. The information returned can be used to create a booking in the system.

##Categories

Items are organized by categories in the system.  A full list of available categories can be retrived via the category object. 

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


## Items

You can query a list of available items based on search critera supplied in the API call.

When no dates are passed in the API call, a full list of enabled items in the inventory.  When a date is passed, the API will return a "**rated**" response that includes pricing and availablity. 

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Query items, optionally return pricing and availability.</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/item/</td>
</tr>
<th>Path:</th>
<td>/api/2.1/item/<b>item_id</b> (single item)</td>
</tr>
<tr>
<th>Methods:</th>
<td>GET</td>
</tr>
<tr>
<td><var>start_date</var></td>
<td>Date: Start date.</td>
</tr>
<tr>
<td><var>end_date</var></td>
<td>Date: End date.</td>
</tr>
<tr>
<td><var>start_time</var></td>
<td>Time: Start time (used in hourly bookings).</td>
</tr>
<tr>
<td><var>end_time</var></td>
<td>Time: End time (used in hourly bookings).</td>
</tr>
<tr>
<td><var>category_id</var></td>
<td>Integer: Filter items by category.</td>
</tr>
<tr>
<td><var>discount_code</var></td>
<td>String: discount or voucher code to be used.</td>
</tr>
<tr>
<td><var>rules</var></td>
<td>String: supply 'soft' to not trigger date based rule errors.</td>
</tr>
<tr>
<td><var>param</var></td>
<td>Array: See - Booking parameters below.</td>
</tr>
</tbody>
</table> 

###Booking Paramaters

Booking parameters are defined globally in your system, and can also be configured per item.  Your parameters specify the number of items to book, for example Child and Adult.  These are completely configurable in your account under Manage / Settings / Configure.

To query specific pricing an availability you need to pass the appropriate parameters in your api call, using the ID's specified in your system configuration.

Let's say for instance you have 2 parameters configured.  Adults (id: adults), Children (id: children).  To get pricing for 2 a adults and one child you would pass: **param[adults]=2&param[children]=1** in your API call.

```html
https://demo.checkfront.com/api/2.1/item/19/?start_date=20131230&end_date=20131230&end_date=20131230&param[adults]=2&param[children]=1
```


Booking parameters have many options, and can be configured to control inventory in very specific ways.  See the Checkfront support centre for more information.

### Item details

To get detailed pricing and availbility on a specific item, supply the item_id in the API call **path** along with any of the filter paramaters.  For example, to get item 19:

```html
https://demo.checkfront.com/api/2.1/item/19/?start_date=20131230&end_date=20131230&end_date=20131230
``` 

## SLIP

The item SLIP is a string returned when making a rated query to a specific item.  The slip contains the information needed to make a booking.  Do not attempt to reverse engineer this as the format changes.  It must be optioned vi a rated API call.

# Booking

The booking object can be used in conduction with the item object to create a new booking on the system.

##Sessions

When creating a booking, the details of the booking are stored in an API session.  This allows you to add multiple items to a booking, remove items and also updates the server with your intent to book the item(s) to prevent over bookings.  

To start a new session, you must have the booking SLIP returned when querying item to be booked.

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Set or update a booking session.</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/booking/session</td>
</tr>
<tr>
<th>Methods:</th>
<td>GET, POST</td>
</tr>
<tr>
<td><var>session_id</var></td>
<td>String: system generated session id.</td>
</tr>
<td>
<var>slip</var></td>
<td>String:n system generated SLIP from rated Item query.</td>
</tr>
</tbody>
</table> 

### Create a new session
```html
POST https://demo.checkfront.com/session?slip=3.20130303X1-guests.1
```

```json
{
"version": "2.1",
"host_id": "jdemo.checkfront.com",
"name": "My Company",
"request": {
"obj": "booking/session",
"status": "SUCCESS",
"results": 0
},
"booking": {
"session": {
"id": "rtdv4osethqurlmqgi55mcrkm4",
"slip": {
"1": "3.20130303X1-guests.1",
}
},
```

### Getting session details

You can fetch the details of the pro-posed booking by accessing the session object.  The item details will be returned with any request to the booking session.

 
```html
/api/2.1/session?&slip=3.20130303X1-guests.1
```

If you wish to add multiple items at once, you can supply the SLIP in the form of an array.
 
```html
/api/2.1/session?&slip=[]3.20130303X1-guests.1&slip[]=2.20130303X1-guests.2
```

### Add more items to a session

Depending on your platform or SDK, the session can be passed in the form of a cookie or in the query string.  For the sake of documenation we'll pass it in the query string.  
 
```html
https://demo.checkfront.com/session?slip=3.20130303X1-guests.1&slip=rtdv4osethqurlmqgi55mcrkm4
```


## Creating A Booking

When the required items are added to your booking session, you can create the booking.  


### Booking Fields
New bookings require customer information, and other fields as defined by your system configuration.

You can dynamically fetch the fields required to complete the booking by calling the booking/form object along with the session, before calling booking/create.

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Fetch Booking Fields.</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/booking/form</td>
</tr>
</tbody>
</table>

This returns an array of fields and their properties that need to be used when creating the booking.

### Booking Create

To create a booking, submit the fields from the booking/form object along with the session id.  

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Create a booking.</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/booking/create</td>
</tr>
<tr>
<th>Methods:</th>
<td>POST</td>
</tr>
<tr>
<td><var>session_id</var></td><td>String: system generate session_id</td></tr>
</tr>
<tr>
<td><var>fields</var></td><td>Array: populated fields in a name value pair array from the booking/fields call.</td></tr>
</tr>
</tbody>
</table>

If a booking is successfully created, you will be returned a completion url.  If payment is required, this will be the payment page, otherwise it will be the receipt page.

There is currently no way to complete a payment via the API.


##Check-in & Check-out

You can check-in, and checkout a booking.  By default, a note is created under the name of the account when a booking is checked in, or checked out.  VOID, and CANCELLED bookings can not be checked-in or out.

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Check-in a booking.</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/booking/<b>booking_id</b>/checkin</td>
</tr>
<tr>
<th>Methods:</th>
<td>POST</td>
</tr>
</tbody>
</table> 

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Check-out a booking.</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/booking/<b>booking_id</b>/checkout</td>
</tr>
<tr>
<th>Methods:</th>
<td>POST</td>
</tr>
</tbody>
</table> 

```html
https://demo.checkfront.com/api/2.1/booking/JHLL-20131230/checkin
```

##Bookmark
Bookmarks are made available in the Checkfront mobile apps, and are listed under bookings while logged into the platform.  You can add or remove a bookmark to a specific booking for a specific account.

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Check-out a booking.</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/booking/<b>booking_id</b>/checkout</td>
</tr>
<tr>
<th>Methods:</th>
<td>POST</td>
</tr>
</tbody>
</table> 

## Notes
Notes can be added to bookings.  By default the authenticated account will be used. 

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Check-out a booking.</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/booking/<b>booking_id</b>/note</td>
</tr>
<tr>
<th>Methods:</th>
<td>POST</td>
</tr>
<tr>
<td><var>body</var></td>
<td>String: body of the note.  Upto 3000 chars.</td>
</tr>
</tbody>
</table> 

## Status
The status of an existing booking can be modified using the booking/status object.

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Change booking status.</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/booking/<b>booking_id</b>/status</td>
</tr>
<tr>
<th>Methods:</th>
<td>POST</td>
</tr>
<tr>
<td><var>status_id</var></td>
<td>String: new booking status.</td>
</tr>
</tbody>
</table> 

## Journal

The booking journal provides access to existing bookings in the system.  You can query bookings by customer id, or individually by id.

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Fetch details on a booking.</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/booking/journal/
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/booking/journal/UJII-20131230 (single item)
</tr>
<tr>
<th>Methods:</th>
<td>GET</td>
</tr>
<tr>
<td><var>customer_id</var></td>
<td>String: customer id filter.</td>
</tr>
<tr>
<td><var>start_date</var></td>
<td>Date: start date range.</td>
</tr>
<tr>
<td><var>end_date</var></td>
<td>Date: end date.</td>
</tr>
<tr>
<td><var>options</var></td>
<td>Array: transactions, notes - options[transactions]=1.</td>
</tr>
</tbody>
</table> 

You can filter bookings based on the available arguments, or fetch a single booking by supplying the booking_id in the path of the API call.  If a single booking is requested, the response is returned in a single "booking" array.  If multiple items are requested, the response is in a "bookings" array.

### Date Range
If selecting bookings based on a date range, both the start date and end dates are required.  The dates are specific to the start and end date of items in the booking. A booking contain items in the invoice not in the time range if other items match.

# Customers

The customer object provides access to customers in the system. Customers are created when a booking is made.  There is currently no way to create customers via the API, outside of creating a booking. 

### Search customers

You can query customers based on indexed fields, including email address, name and customer id.

<table>
<tbody>
<tr>
<th>Description:</th>
<td>Query customer records</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/customer/</td>
</tr>
<tr>
<th>Path:</th>
<td>/api/2.1/customer/XX5-037-755 (single record)</td>
</tr>
<tr>
<th>Methods:</th>
<td>GET</td>
</tr>
<tr>
<td><var>customer_email</var></td>
<td>String: a unique customer e-mail address.</td>
</tr>
<tr>
<td><var>customer_id</var></td><td>String: a unique customer id.</td></tr>
<tr>
<td><var>options</var></td><td>Array: optional return formatting.  Currently: bookings=1 also includes bookings made by the customer.</td></tr>

</tbody>
</table>

```html
http://demo.checkfront.com/api/2.1/customer/?customer_email=test@checkfront.com&options[bookings]=1
```

