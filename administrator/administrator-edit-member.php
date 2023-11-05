<h1>Edit Member</h1>
<hr>
<div class="select-member">
    <div class="search-section">
        <input class="search-input" type="text" class="search-input" placeholder="Search here">
        <select class="options select-input">
            <option value="id" name="id" class="option" selectedt>ID</option>
            <option value="name" name="name" class="option">Name</option>
        </select> 
    </div>
    <div class="result" id="select-member">
        <table class="result-table">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Age</th> 
                    <th>Edit</th> 
                    <th>Delete</th> 
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="profile-img"><img src="./img/profile-1.png" alt="img"></td>
                    <td>001</td>
                    <td>Juan Dela Cruz</td>
                    <td>Male</td>
                    <td>40</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
                <tr>
                    <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                    <td>001</td>
                    <td>Juan Dela Cruz</td>
                    <td>Male</td>
                    <td>40</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                    
                </tr>
                <tr>
                    <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                    <td>001</td>
                    <td>Juan Dela Cruz</td>
                    <td>Male</td>
                    <td>40</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
                <tr>
                    <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                    <td>001</td>
                    <td>Juan Dela Cruz</td>
                    <td>Male</td>
                    <td>40</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
                <tr>
                    <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                    <td>001</td>
                    <td>Juan Dela Cruz</td>
                    <td>Male</td>
                    <td>40</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
                <tr>
                    <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                    <td>001</td>
                    <td>Juan Dela Cruz</td>
                    <td>Male</td>
                    <td>40</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="edit-member p-1rem">
    <h3 class="title">Edit Here</h3>
    <hr>
    <form action="" method="POST">
        <div class="info">
            <label for="input-fname">Name: <span class="required">*</span></label>
            <div class="input-name-container">
                <input type="text" id="input-fname" name="fname" placeholder="First" required>
                <input type="text" id="input-lname" name="lname" placeholder="Last" required>
            </div>
        </div>
        <div class="info">
            <label for="radio-sex">Sex: <span class="required">*</span></label>
            <div class="sex-radio-container">
                <label for="radio-male"><input id="radio-male" type="radio" name="sex" value="Male" required> Male</label>
                <label for="radio-female"><input id="radio-female" type="radio" name="sex" value="Female" required> Female</label>
            </div>
        </div>
        <div class="info">
            <label for="input-birthdate">Birthdate: <span class="required">*</span></label>
            <input type="date" id="input-birthdate" required>
        </div>
        <div class="info">
            <label for="input-address">Address:</label>
            <input type="text" id="input-address" placeholder="Enter Address">
        </div>
        <div class="info">
            <label for="input-contact">Contact:</label>
            <input type="text" id="input-contact" placeholder="Enter Contact">
        </div>
        <div class="info">
            <label for="input-username">Username: <span class="required">*</span></label>
            <input type="text" id="input-username" name="username" placeholder="Enter username" required>
        </div>
        <div class="info">
            <label for="input-password">Password: <span class="required">*</span></label>
            <input type="text" id="input-password" name="password" placeholder="Enter password" required>
        </div>
        <div class="info">
            <label for="upload-img">Profile:</label>
            <input type="file" accept=".jpg, .jpeg, .png" name="user-profile">
        </div>
        <button id="edit-btn" type="submit" name="edit-btn" value="submit" >Apply</button>
    </form>
</div>