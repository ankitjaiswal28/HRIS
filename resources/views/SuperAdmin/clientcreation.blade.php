@extends('Layout.app')
@section('content')

<div class="container">
  <form action="#" name="client_form" id="client_form" class="form_class" data-parsley-validate>
  <div class="form-group">
      <label for="companyname">Company Name:</label>
      <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name" data-parsley-trigger="blur" required="">
    </div>
    <div class="form-group">
      <label for="adminname">Admin Name:</label>
      <input type="text" class="form-control" id="adminname" name="adminname" placeholder="Admin Name" data-parsley-trigger="blur" required="">
    </div>
    <div class="form-group">
      <label for="mobileno">Mobile Number:</label>
      <input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="Mobile Number" data-parsley-trigger="blur" required="">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required data-parsley-type="email"  data-parsley-trigger="blur" required="">
    </div>
    <div class="form-group">
      <label for="prefix">Prefix:</label>
      <input type="text" class="form-control" id="prefix" placeholder="Client Prefix" name="prefix" data-parsley-trigger="blur" required="">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" data-parsley-trigger="blur" required="">
    </div>
    <center>
    <button type="button" name="submit_id" id="btn_id"  class="twoToneButton">Submit</button>
    <img src="../asset/images/pageloader.gif" id="loading-image" style="display:none; width: 40px;">
    </center>
    {{-- <button type="submit" class="btn btn-default">Submit</button> --}}
  </form>
</div>
@endsection
@section('scriptcontent')
<script>
 $(document).ready(function() {
     $('#loading-image').bind('ajaxStart', function() {
         $(this).show();
	}).bind('ajaxStop', function() {
		$(this).hide();
	});
    $('input').parsley();
    $('#btn_id').click(function(event) {
        event.preventDefault();
        // Validate all input fields.
        var isValid = true;
        $('input').each( function() {
            if ($(this).parsley().validate() !== true) isValid = false;
        });
        if (isValid) {
            alert("OK and Processed!");
            $('#loading-image').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/createclient',
                type: 'POST',
                data: {
                    companyname: $('#companyname').val(),
                    adminname: $('#adminname').val(),
                    mobileno: $('#mobileno').val(),
                    email: $('#email').val(),
                    prefix: $('#prefix').val(),
                    pwd: $('#pwd').val(),
                    },
                    success: function(data) {
                        console.log('Data', data)
                    },
                    complete: function() {
						$('#loading-image').hide();
					}
            })
      }
    })
 });
</script>
@endsection

