<!--header inc for every page-->
<header>
    <div id="header" >
        <!--import the logo image-->
        <div id="image"><a href="index.php"><img src="../wifis/images/logo_1.png" alt="Logo" width="200" /></a></div>
        <!--form for the searching-->
        <form id="form_search" action="results.php" method="POST" >
            <!--input for searching keywords-->
            <input name="search" id="search" type="search"  placeholder="Position: Library, Park, Road"/>
            <!--input for suburbs, when something input, the populated window will show-->
            <input name="suburb" id="suburb" type="search"  placeholder="Suburb" onkeyup="detectInput();"/>
            <div id="populated-result" ></div>
            <input id="go" type="submit" value="Go"/>
        </form>
        <nav>
            <!--Navigation-->
            <ul>
                <li><a href="index.php" id="home">Home</a></li>
                <li><a href="about.php">About</a></li>
                <?php
                    // check the status of user to show relative information, if it's in, show welcome message, if not show sign up
                    if($_SESSION['user'] == 'in'){
                        echo "
                            <li><a id='signUp'>Welcome to WiFis!</p></li>
                            <li><a id='logIn'><a href='logout.php' name='logout'>Log out</a></p></li>
                            ";
                    } else {
                        // Link to the registration page
                        echo"
                            <li><a href='registration.php' name='sign up'>Sign up</a></li>
                            <li><a href='logIn.php' name='log in'>Log in</a></li>
                            ";
                    }
                ?>
                <!--link to the admin page-->
                <li><a href="admin.php">Upload csv</a></li>
            </ul>
        </nav>
    </div>
    <!--create meta-data for every page-->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@zhanmu_k" />
    <meta name="twitter:creator" content="@zhanmu_k" />
    <meta property="og:url" content="http://fastapps04.qut.edu.au/n9253921/wifis/index.php" />
    <meta property="og:title" content="Wi-Fis: Find a Wi-Fi Spot" />
    <meta property="og:description" content="WiFis makes the way easier for you to find a wi-fi hot spot. You can sign up for an account and post your reviews to share the experience and give feedback." />
    <meta property="og:image" content="http://fastapps04.qut.edu.au/n9253921/wifis/images/logo.png" />
</header>