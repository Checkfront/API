booking/notes
--------------
This is a call to your Checkfront account that pulls all the notes from all of your bookings. This defaults to pulling all the notes from your bookings for the past thirty days. 

.. http:post:: /api/3.0/booking/notes

	:query string/timestamp date: Specify a date to show the notes from. Still testing the full extent of this. This can be a month and will show all notes from that month. This can be in the format "YYYY-MM-DDtHH:MM:SS-07:00" without quotes. It can be in the format "YYYY-MM-DD"

	:>jsonarr integer note_ID: the ID of the note on that booking.
	:>jsonarr integer account_ID: The ID of the account that made the note. Customer booking notes appear as account ID 0.
	:>jsonarr string date: The date the note was created. It appears in the format "YYYY-MM-DDtHH:MM:SS-07:00"
	:>jsonarr string body: The body of the note.
	:>jsonarr bool private: Whether this note is seen on the invoice or not. True is not shown on the invoice, false is shown on the invoice.
	:>jsonarr string booking_id: The booking ID the note is found on.
	
	.. literalinclude:: ../../examples/response/booking-notes.json
		:language: json
		:linenos:
		:emphasize-lines: 23-40
