<?php echo form_open_multipart($this->uri->uri_string());?>

    <div>
        <label for="first_name">First Name</label>
        <input type="text" name="first_name"/>
    </div>

    <div>
        <label for="age">Age</label>
        <input type="number" name="age"/>
    </div>
    
    <div>
        <label for="gender">Gender</label>
        <input type="radio" name="gender" value="Male"/> Male
        <input type="radio" name="gender" value="Female"/> Female
    </div>

    <div>
        <label for="hobby">Hobby</label>
        <input type="text" name="hobby"/>
    </div>
    
    <div>
        <label for="friend_image">Profile Image</label>
        <input type="file" name="friend_image" id="friend_image">
    </div>

    <div class="submit_button">
        <input type="submit" value="Welcome Friend"/>
    </div>
<?php echo form_close();?>