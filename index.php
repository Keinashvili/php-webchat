<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime chat app</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime chat app</header>
            <form action="#">
                <div class="error-text">This is an error message!</div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" placeholder="First name">
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" placeholder="Last Name">
                    </div>
                </div>
                    <div class="field input">
                        <label>Email</label>
                        <input type="text" placeholder="Enter yourEmail">
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input id="pwd" type="password" placeholder="Enter yourPassword">
                        <i id="eye" class="fas fa-eye"></i>
                    </div>
                    <div class="field image">
                        <label>Select an Image</label>
                        <input type="file" placeholder="Email">
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continue to Chat">
                    </div>
            </form>
            <div class="link">Already signed up? <a href="#">Login now</a></div>
        </section>
    </div>
    <script src="js\password-show-hide.js"></script>
</body>
</html>