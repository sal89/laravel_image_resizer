<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
        	<h1>Admin List</h1>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th width="40%">Filename</th>
						<th width="20%">Width</th>
						<th width="20%">Height</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($items as $item)
						<tr>
							<td>{!! $item->id !!}</td>
							<td>{!! $item->filename !!}</td>
							<td>{!! $item->width !!} px</td>
							<td>{!! $item->height !!} px</td>
							<td>{!! date('d M, Y h:i A', strtotime($item->created_at)) !!}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
        </div>

        <script src="/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/datatables/js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
        	$('table').dataTable({
        		paginate: false,
        		searching: false,
        		"order": [[ 0, 'desc']]
        	});
        });
        </script>
    </body>
</html>
