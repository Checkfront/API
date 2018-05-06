booking/notes
--------------
This is a call to your Checkfront account that pulls all the notes from all of your bookings. This defaults to pulling all the notes from your bookings for the past thirty days. 

.. http:post:: /api/3.0/booking/notes

	:query string/timestamp date: Specify a date to show the notes from. This can be in ISO-8601 or "YYYY-MM-DD" format. This can also be a month and will show all notes from that month. 

	:>jsonarr integer note_ID: the ID of the note on that booking.
	:>jsonarr integer account_ID: The ID of the account that made the note. Customer booking notes appear as account ID 0.
	:>jsonarr string date: The date the note was created. It appears in ISO-8601 format.
	:>jsonarr string body: The body of the note.
	:>jsonarr bool private: Whether this note is seen on the invoice or not. True it is hidden from the invoice, false means it shows.
	:>jsonarr string booking_id: The booking ID the note is found on.
	
	.. literalinclude:: ../../examples/response/booking-notes.json
		:language: json
		:linenos:
		:emphasize-lines: 23-40
