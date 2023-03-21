
<!-- MailChimp API Integrade use NewsLater -->


<!-- web.php -->
Route::post('/send-mail', [FrontendPageController::class, 'addsubscriber'])->name('newsletter_mailchimp');


<!-- Html Form Submit Via AJax -->
<form action="{{route('newsletter_mailchimp')}}" method="post">
    @csrf
    <div class="newsletterInput">
        <input type="email" name="email" class="email-news" placeholder="Enter valid email ID">
        <button class="submit">Submit</button>
    </div>
</form> 



<!-- JavaScript -->

<script>
	$(document).ready(function() {
		$('form').submit(function(e) {
		  e.preventDefault(); 

		  var email = $('.email-news').val();
		  if (!/\S+@\S+\.\S+/.test(email)) {
      // show SweetAlert error message
		Swal.fire({
			icon: 'error',
			title: 'Invalid email',
			text: 'Please enter a valid email address.',
			})
		return false; // stop the form submission
		}

		  var formData = $(this).serialize(); 
		  $.ajax({
			type: 'POST',
			url: '{{route('newsletter_mailchimp')}}',
			data: formData,
			dataType: 'json',
			success: function (res) {
					if(res.status==1)
					{
						Swal.fire({
							icon: 'success',
							title: res.message,
					})
					}else if(res.status==2){
					Swal.fire({
							icon: 'error',
							title: res.message,
					})
					}else{
					Swal.fire({
							icon: 'error',
							title: 'Some Thing Went Wrong',
						})
					}
				}
			});



		});
	  });

	</script>

<!-- Controller -->

public function addSubscriber(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $listId = config('app.mailchimp_list_id');
        $apiKey = config('app.mailchimp_api_key');

        $client =  new \MailchimpMarketing\ApiClient();
        $client->setConfig([
            'apiKey' => $apiKey,
            'server' => 'us21' // replace with your server code
        ]);

        $data = [
            'email_address' => $request->input('email'),
            'status' => 'subscribed',
            'merge_fields' => [
                'FNAME' => 'test',
                'LNAME' => 'test User'
            ]
        ];

        try {
            $response = $client->lists->addListMember($listId, $data);
            return response()->json(['status' => 1  , 'message' => 'Subscribed Successfully']);
        } catch (ClientException  $e) {
            $responseBody = $e->getResponse()->getBody();
            $errorData = json_decode($responseBody);
    
            return response()->json(['status' => 2 , 'message' => $errorData->detail]);
        }
    }
