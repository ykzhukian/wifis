<!--form used to post reviews-->
<form id="post-form" action="php/insert_review_to_database.php" method="POST">
    <!--table header-->
    <th><a name="postReview">Post a review</a></th>
    <tr>
        <td class="align-right"><label for="name">Name</label></td>
        <td><input name="name" id="name" type="text" required/></td>
        <input name="spotName" type="hidden" value="<?php echo $spotName; ?>"/>
        <input name="time" type="hidden" value="<?php echo date("d/m/Y"); ?>" />
    </tr>
    <tr>
        <td class="align-right"><label for="post-email">Email</label></td>
        <!--email will automatically shows up when the user has loged in-->
        <td id="post-email"><?php echo $_SESSION['email']; ?></td>
        <input name="email" type="hidden" value="<?php echo $_SESSION['email']; ?>">
    </tr>
    <tr>
        <td class="align-right"><label for="post-email">Rating</label></td>
        <td>
            <!--different divs for the rating effect, the effect is accomplished by hidding and showing the background image of these divs-->
            <div class="postRating" id="rate-6">
                <div class="postRating" id="rate-5" onclick="rating5()"></div>
                <div class="postRating" id="rate-4" onclick="rating4()"></div>
                <div class="postRating" id="rate-3" onclick="rating3()"></div>
                <div class="postRating" id="rate-2" onclick="rating2()"></div>
                <div class="postRating" id="rate-1" onclick="rating1()"></div>
            </div>
            <input id="rating" name="rating" type="hidden" value="0"/>
        </td>
    </tr>

    <tr>
        <td class="align-right"><label for="comment">Review</label></td>
        <td><textarea name="comment" id="comment" rows="10" cols="50" required></textarea></td>
    </tr>
    <tr>
        <td></td>
        <!--submit button for checking the validation-->
        <td>
            <?php
                // check the status of user, if the user has not loged in, hide the post button and show the message
                if ($_SESSION['email'] == 'Please login') {
                    $log = 'out';
                } else {
                    $log = 'in';
                }
                if ($log == 'out'){
                    echo "<h3>Please login before post</h3>";
                } else {
                    echo '<input type="submit" value="Post" class="post_button" />';

                }
            ?>
        </td>
    </tr>
</form>