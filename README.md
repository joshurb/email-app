##email-app

#Description
<p>An api driven Laravel app that will receive a JSON payload, generate, and send an email.</p>

# Endpoints
POST /api/send-email will receive a Json payload structured like:
<pre>{
    "email_address": "example@test.dev",
    "message": "Its a new message!",
    "attachment": {
        "file": {
            "mime": "@file/plain",
            "data": "dGhpcyBpcyBhIHRlc3QgZmlsZQo="
        }
    },
    "attachment_filename": "testFile.txt"
}</pre>
where 
- email_address is the recipient address (required field)
- message is the email message (required field)
- attachment is a base64 encoded file (option field)
- attachment_filename is the name of the file being uploaded (option field)

The endpoint receives the payload and validates the contents. If everything 
checks out, the file is decoded and saved to the server, then an email object is created and stored in the database. Then the email is
queued. Once the Queue picks up the email, the email object gets updated as sent.

GET /api/get-all-emails will return an array of all emails that have been created.

GET /api/get-sent-emails will return an array of all emails that have been sent.

# Challenges
Setting up the endpoints was pretty simple because that is definitely where
Laravel excels. It is pretty much ready to go, api-wise, after it's running. 
Setting up the endpoint logic was pretty straightforward, the 2 get endpoints 
are nearly identical, with a little different eloquent searching. 
This portion probably took about 30 minutes to do. 

Setting up the endpoint that accepts a file and generates a queue email
took me a bit longer. The projects I have worked on have pretty much had
all the configuration for e-mails and Queues already set up. This was something 
that I had to do a little bit of research. Accepting the file was not bad, because
you just had to decode it and save it, but retrieving it also suffered from some new 
project configuration research. I found that I needed to run the linking command and make a
symlink but then that worked perfectly. I also needed to do some setup to get emails working. 
I decided to go with Mailtrap because it was a new way of testing emails for me. It worked really well 
I will probably go that route in the future if I can. 
The queue email endpoint is definitely where most of the time went due to some research. I would probably guess that
it took me about 2-3 hours.

Setting up the unit tests and factory didn't take too long (~30 min). 
