booking/notes
--------------
This is a call to your Checkfront account that pulls all the notes from all of your bookings. This defaults to pulling all of the notes from your bookings for the past thirty days. 

.. http:post:: /api/3.0/booking/notes

	:query string/timestamp date: Filter the booking notes by a date. This can be in ISO-8601 or "YYYY-MM-DD" format. This can also be a month and will show all notes from that month. 

	:>jsonarr integer note_id: the ID of the note on that booking.
	:>jsonarr integer account_id: If made by a staff or partner account, this represents their unique identifier, otherwise it represents a customer booking with the value of 0.
	:>jsonarr string date: The date the note was created. It appears in ISO-8601 format.
	:>jsonarr string body: The body of the note.
	:>jsonarr bool private: The visibility of the note on the invoice. True means it is hidden from the invoice, false means it shows.
	:>jsonarr string booking_id: The unique identifier for the booking that contains the note.
	
	.. literalinclude:: ../../examples/response/booking-notes.json
		:language: json
		:linenos:
		:emphasize-lines: 23-40
