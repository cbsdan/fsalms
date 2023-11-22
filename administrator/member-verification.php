<?php
    $authentication_path = '../functions/user-authenticate.php';
    $authentication_path_index = './functions/user-authenticate.php';
    if (file_exists($authentication_path)) {
        include_once("$authentication_path");
    } elseif (file_exists($authentication_path_index)) {
        include_once("$authentication_path_index");
    }

    $database_path = '../database/config.php';
    $database_path_index = './database/config.php';

    if (file_exists($database_path)) {
        include_once($database_path);
    } else {
        include_once($database_path_index);
    }

    $fetchVerifyingMembers = "SELECT *, CONCAT(m.fname, ' ', m.lname) AS name, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age FROM members m INNER JOIN verification_images vi ON vi.mem_id = m.mem_id INNER JOIN accounts a ON a.mem_id = vi.mem_id WHERE vi.verification_status = 'Unverified' ORDER BY vi.date_submitted";
    $verifyingMembers = $conn->query($fetchVerifyingMembers);

    $fetchVerifiedMembers = "SELECT *, CONCAT(m.fname, ' ', m.lname) AS name, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age FROM members m INNER JOIN verification_images vi ON vi.mem_id = m.mem_id INNER JOIN accounts a ON a.mem_id = vi.mem_id WHERE vi.verification_status = 'Verified' ORDER BY vi.date_submitted";
    $verifiedMembers = $conn->query($fetchVerifiedMembers);
?>

<h1>Member Verification</h1>
<hr>

<h4 class='my-3'>Total: <?php echo $verifyingMembers->num_rows?></h4>
<div class='result member-verification-section'>
    <table class='result-table'>
        <thead>
            <tr>
                <th>Profile</th>
                <th>Member ID</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Age</th> 
                <th>Valid ID</th>
                <th>Selfie Picture</th>
                <th>Selfie With ID</th>
                <th>Date Submitted</th>
                <th>Approve</th> 
                <th>Decline</th> 
            </tr>
        </thead>
        <tbody>
            <?php 
                if ($verifyingMembers->num_rows > 0) {
                    while($verifyingMember = $verifyingMembers->fetch_assoc()) {
                        $validIdSrc = getImageSrc($verifyingMember['valid_id']);
                        $selfieSrc = getImageSrc($verifyingMember['selfie']);
                        $selfieWithIdSrc = getImageSrc($verifyingMember['selfie_with_id']);
                        $mem_id= $verifyingMember['mem_id'];
                        if (!empty($verifyingMember["profile"])) {
                            $profileSrc = getImageSrc($verifyingMember['profile']);
                        } else {
                            $profileSrc = './img/default-profile.png';
                            
                        }
                       

                        echo "
                                <td class='profile-img'><img src='$profileSrc'></td>
                                <td> " . $verifyingMember['mem_id'] . "</td>
                                <td> " . $verifyingMember['name'] . "</td>
                                <td> " . $verifyingMember['sex'] . "</td>
                                <td> " . $verifyingMember['age'] . "</td>
                                <td class='text-center'> " . 
                                    "<a class='validId imageContainer c-blue'><span class='altText'>[Valid ID]</span><img class='hidden' src='$validIdSrc' alt='Valid ID'></a>" . 
                                "</td>
                                <td class='text-center'> " . 
                                    "<a class='selfiePic imageContainer c-blue'><span class='altText'>[Selfie Picture]</span><img class='hidden' src='$selfieSrc' alt='Selfie Pic'></a>" . 
                                "</td>
                                <td class='text-center'> " . 
                                    "<a class='selfieWithId imageContainer c-blue'><span class='altText'>[Selfie with ID]</span><img class='hidden' src=' $selfieWithIdSrc' alt='Selfie with ID'></a>" . 
                                "</td>
                                <td class='text-center'> " . $verifyingMember['date_submitted'] . "</td>
                                <td class='text-center'>
                                <form action='database/admin-verify.php' method='POST'>
                                    <input type='hidden' name='memId' value='$mem_id'>
                                    <button type='submit' name='submit' value='verified' class='bg-green m-auto'>Approve</button>
                                </form>
                            </td>
                            <td class='text-center'>
                                    <form action='database/admin-verify.php' method='POST'>
                                    <input type='hidden' name='memId' value='$mem_id'>
                                    <button type='submit' name='submit' value='unverified' class='bg-red m-auto'>Decline</button>
                                </form>
                            </td>
                        </tr>
                    ";
                    }
                } else {
                    echo "<tr><td class='no-result-label text-center my-3' colspan='11'>No Verifying Members Found!</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<h1 class='my-5 mt-8 <?php echo ($verifiedMembers->num_rows <= 0) ? 'hidden' : '' ?>'>Verified Members</h1>
<hr class='<?php echo ($verifiedMembers->num_rows <= 0) ? 'hidden' : '' ?>'>

<h4 class='my-3 <?php echo ($verifiedMembers->num_rows <= 0) ? 'hidden' : '' ?>'>Total: <?php echo $verifiedMembers->num_rows?></h4>
<div class='result member-verification-section <?php echo ($verifiedMembers->num_rows <= 0) ? 'hidden' : '' ?>'>
    <table class='result-table'>
        <thead>
            <tr>
                <th>Profile</th>
                <th>Member ID</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Age</th> 
                <th>Valid ID</th>
                <th>Selfie Picture</th>
                <th>Selfie With ID</th>
                <th>Status</th> 
            </tr>
        </thead>
        <tbody>
            <?php 
                if ($verifiedMembers->num_rows > 0) {
                    while($verifiedMember = $verifiedMembers->fetch_assoc()) {
                        $validIdSrc = getImageSrc($verifiedMember['valid_id']);
                        $selfieSrc = getImageSrc($verifiedMember['selfie']);
                        $selfieWithIdSrc = getImageSrc($verifiedMember['selfie_with_id']);
                        
                        if (empty($verifiedMember["profile"])) {
                            $profileSrc = './img/default-profile.png';
                        } else {
                            $profileSrc = getImageSrc($verifiedMember['profile']);
                        }

                        echo "
                            <tr>
                                <td class='profile-img'><img src='$profileSrc'></td>
                                <td> " . $verifiedMember['mem_id'] . "</td>
                                <td> " . $verifiedMember['name'] . "</td>
                                <td> " . $verifiedMember['sex'] . "</td>
                                <td> " . $verifiedMember['age'] . "</td>
                                <td class='text-center'> " . 
                                    "<a class='validId imageContainer c-blue'><span class='altText'>[Valid ID]</span><img class='hidden' src='$validIdSrc' alt='Valid ID'></a>" . 
                                "</td>
                                <td class='text-center'> " . 
                                    "<a class='selfiePic imageContainer c-blue'><span class='altText'>[Selfie Picture]</span><img class='hidden' src='$selfieSrc' alt='Selfie Pic'></a>" . 
                                "</td>
                                <td class='text-center'> " . 
                                    "<a class='selfieWithId imageContainer c-blue'><span class='altText'>[Selfie with ID]</span><img class='hidden' src=' $selfieWithIdSrc' alt='Selfie with ID'></a>" . 
                                "</td>
                                <td class='text-center ". (($verifiedMember['verification_status'] == 'Verified') ? 'c-green' : 'c-red') ."'>". $verifiedMember['verification_status']. "</td>
                            </tr>
                        ";
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<script>
    let imageContainers = document.querySelectorAll('td .imageContainer')
    imageContainers.forEach((imageContainer)=>{
        let altText = imageContainer.querySelector('.altText');
        let image = imageContainer.querySelector('img');

        imageContainer.addEventListener('click', ()=>{
            if (altText.classList.contains('hidden')) {
                altText.classList.remove('hidden');
                imageContainer.classList.remove('active');
                image.classList.add('hidden');
            } else {
                altText.classList.add('hidden');
                imageContainer.classList.add('active');
                image.classList.remove('hidden');
            }
        })
    })

</script>