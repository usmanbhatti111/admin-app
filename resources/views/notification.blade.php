<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Table UI Design</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
	<section class="main-content">
		<div class="container">
			<h1 style="background:green; text-align:center;">NOTIFICATIONS</h1>
			<br>
			<br>

			<table class="table">
				<thead>
					<tr>
						<th>USER</th>
						<th>Periority</th>
						<th>TICKET</th>
						
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
                    @foreach ($notifications as $notify) 

					<tr>

						<td>
							<div class="user-info">
								<div class="user-info__img">
									<img src="img/user1.jpg" alt="User Img">
								</div>
								<div class="user-info__basic">
									<h5 class="mb-0">Kiran Acharya</h5>
								</div>
							</div>
						</td>
						<td>
							<span class="btn btn-success">{{$notify->data['priority']}}</span>
						</td>
						<td>
                            <a href="{{ url('tickets/'. $notify->data['ticket_id']) }}"> #{{ $notify->data['ticket_id'] }} - {{ $notify->data['name'] }}
                            </a>							
                            <small>2 Feb 2021</small>
						</td>
						
						<td>
							<h6 class="mb-0">             <a href="#" class=" mark-as-read" data-id="{{ $notify->id }}"> Mark as read </a>
                            </h6>
						</td>
						<td>
							<div class="dropdown open">
								<a href="#!" class="px-2" id="triggerId1" data-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
											<i class="fa fa-ellipsis-v"></i>
								</a>
								<div class="dropdown-menu" aria-labelledby="triggerId1">
									<a class="dropdown-item" href="#"><i class="fa fa-pencil mr-1"></i> Edit</a>
									<a class="dropdown-item text-danger" href="#"><i class="fa fa-trash mr-1"></i> Delete</a>
								</div>
							</div>
						</td>
					</tr>
                    @endforeach

				</tbody>
			</table>
		</div>
	</section>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>