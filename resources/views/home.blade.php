<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
        	<h1>Image Resizer</h1>

			@if(Session::has('success'))
				<div class="alert alert-success">
        			<h4>Success</h4>
					<p>{!! Session::get('success') !!}</p>
				</div>
			@endif

			@if(Session::has('error'))
				<div class="alert alert-danger">
        			<h4>Error</h4>
					<p>{!! Session::get('error') !!}</p>
				</div>
			@endif

        	@if ($errors->any())
        		<div class="alert alert-danger">
        			<h4>Error</h4>
        			<p>{!! implode('<br />', $errors->all(':message')) !!}</p>
        		</div>
			@endif

           	<form class="form-horizontal" action="/upload" method="POST" enctype="multipart/form-data">
			    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

			    <div class="form-group">
			        <label for="inputEmail3" class="col-sm-2 control-label">Select Image</label>
			        <div class="col-sm-10">
			            <input type="file" name="image"  />
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="_width" class="col-sm-2 control-label">Width</label>
			        <div class="col-sm-2">
			            <input name="width" type="text" class="form-control" id="_width" placeholder="Width">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="_height" class="col-sm-2 control-label">Height</label>
			        <div class="col-sm-2">
			            <input name="height" type="text" class="form-control" id="_height" placeholder="Height">
			        </div>
			    </div>
			    <div class="form-group">
			        <div class="col-sm-offset-2 col-sm-10">
			            <button type="submit" class="btn btn-primary">Upload & Resize</button>
			        </div>
			    </div>
			</form>
        </div>
    </body>
</html>
