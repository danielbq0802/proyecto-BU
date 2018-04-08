<script type="text/javascript">
	@if (Session::has('msj-info'))
 	toastr.info("{{ Session::get('msj-info') }}","",{
 		"timeOut":10000,
 		"progressBar": true,
 		"showMethod": "fadeIn",
			"hideMethod": "fadeOut"

 	})
 	@endif	
 	@if (Session::has('msj-success'))
 	toastr.success("{{ Session::get('msj-success') }}","",{
 		"timeOut":10000,
 		"progressBar": true,
 		"showMethod": "fadeIn",
			"hideMethod": "fadeOut"

 	})
 	@endif	
 	@if (Session::has('msj-warning'))
 	toastr.warning("{{ Session::get('msj-warning') }}","",{
 		"timeOut":10000,
 		"progressBar": true,
 		"showMethod": "fadeIn",
			"hideMethod": "fadeOut"

 	})
 	@endif	
 	@if (Session::has('msj-error'))
 	toastr.error("{{ Session::get('msj-error') }}","",{
 		"timeOut":10000,
 		"progressBar": true,
 		"showMethod": "fadeIn",
			"hideMethod": "fadeOut"

 	})
 	@endif	
</script>
