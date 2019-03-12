
<?php
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result = 
			'
				<table class="table table-hover table-bordered table-responsive">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Image</th>
					  <th>'.anchor("friends/friend_name/".$order_method, "Friend Name").'</th>
					  <th>'.anchor("friends/friend_age/".$order_method, "Age").'</th>
					  <th>'.anchor("friends/friend_gender/".$order_method, "Gender").'</th>
					  <th>'.anchor("friends/friend_hobby/".$order_method, "Hobby").'</th>
					  <th>Date Created</th>
					  <th colspan="3">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			
			foreach ($query->result() as $row)
			{
				$friend_id = $row->friend_id;
				$friend_name = $row->friend_name;
				$friend_age = $row->friend_age;
				$friend_gender = $row->friend_gender;
				$friend_hobby = $row->friend_hobby;
				$friend_image = $row->friend_image;
				$friend_thumb = $row->friend_thumb;
                $created = $row->created;
                
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td><img src="'.$upload_location.$friend_thumb.'" class="img-fluid"/></td>
						<td>'.$friend_name.'</td>
						<td>'.$friend_age.'</td>
						<td>'.$friend_gender.'</td>
						<td>'.$friend_hobby.'</td>
						<td>'.date('jS M Y H:i a',strtotime($created)).'</td>
						<td><a href="'.site_url().'friends/edit-friend/'.$friend_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td><a href="'.site_url().'delete-blog-category/'.$friend_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$friend_name.'?\');">Delete</a></td>
					</tr> 
				';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result = "You have no friends";
		}
		
		echo $result;
		
		if(isset($links)){echo $links;}
?>