<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
     initial-scale=1.0">
    <title>Animated Website HTML CSS</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>@import url('https://fonts.googleapis.com/css2?family=poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'poppins', sans-serif;

}

body {
    background: #eaeaea;

}

.header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 30px 8%;
    background: transparent;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 100;
}

.logo {
    font-size: 25;
    color: #222;
    text-decoration: none;
    font-weight: 600;
    opacity: 0;
    animation: slideRight 1s ease forwards;
}

.navbar a {
    display: inline-block;
    font-size: 18px;
    color: #222;
    text-decoration: none;
    font-weight: 500;
    margin: 0 20px;
    transition: .3s;
    opacity: 0;
    animation: slideTop .5s ease forwards;
    animation-delay: calc(.2s * var(--1));
}

.navbar a:hover,
.navbar a.active {
    color: #1743e3;
}

.social-media {
    display: flex;
    justify-content: space-between;
    width: 150px;
    height: 40px;
}

.social-media a {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    background: transparent;
    border: 2px solid transparent;
    text-decoration: none;
    transform: rotate(45deg);
    transition: .5s;
    opacity: 0;
    animation: slideSci .5s ease forwards;
    animation-delay: calc(.2s * var(--1));
}

.social-media a:hover {
    border-color: #eaeaea;

}

.social-media a i {
    font-size: 24px;
    color: #eaeaea;
    transform: rotate(-45deg);

}

.home {
    position: relative;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 50px 8% 0;
    overflow: hidden;
}

.home-content {
    max-width: 630px;

}

.home-content h1 {
    font-size: 50px;
    line-height: 1.2;
    opacity: 0;
    animation: slideBottom 1s ease forwards;
    animation-delay: 1s;

}

.home-content h3 {
    font-size: 40px;
    color: #1743e3;
    opacity: 0;
    animation: slideRight 1s ease forwards;
    animation-delay: 1.3s;

}

.home-content p {
    font-size: 16px;
    margin: 15px 0 30px;
    opacity: 0;
    animation: slideLeft 1s ease forwards;
    animation-delay: 1.6s;

}

.btn {
    display: inline-block;
    padding: 10px 28px;
    background: #1743e3;
    border: 2px solid #1743e3;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 1);
    font-size: 16px;
    color: #eaeaea;
    letter-spacing: 1px;
    text-decoration: none;
    font-weight: 600;
    transition: .5s;
    opacity: 0;
    animation: slideTop 1s ease forwards;
    animation-delay: 2s;
    
}

.btn:hover {
    background: transparent;
    color: #1743e3;


}

.home-img {
    position: relative;
    right: -7%;
    width: 450px;
    height: 450px;
    transform: rotate(45deg);


}

.home-img .rhombus {
    position: absolute;
    width: 100%;
    height: 100%;
    background: #eaeaea;
    border: 25px solid #1743e3;
    box-shadow: -15px 15px 15px rgba(0, 0, 0, .2);
    opacity: 0;
    animation: zoomOut 1s ease forwards;
    animation-delay: 1.6s;

}

.home-img .rhombus img {

    position: absolute;
    top: 110px;
    left: -250px;
    max-width: 750px;
    transform: rotate(-45deg);
    opacity: 0;
    animation: car 1s ease forwards;
    animation-delay: 2s;




}

.home .rhombus2 {
    position: absolute;
    top: -25%;
    right: -25%;
    width: 700px;
    height: 700px;
    background: #1743e3;
    transform: rotate(45deg);
    z-index: -1;
    opacity: 0;
    animation: rhombus2 1s ease forwards;
    animation-delay: 1.6s;



}

/* KEYFRAMES ANIMATION */
@keyframes slideRight {
    0% {
        transform: translateX(-100px);
        opacity: 0;
    }

    100% {
        transform: translateX(0);
        opacity: 1;
   }
}


@keyframes slideTop {
    0% {
        transform: translateY(-100px);
        opacity: 0;
    }

    100% {
        transform: translateY(0);
        opacity: 1;
   }
}
@keyframes rhombus2 {
    0% {
        right:-40%;
        opacity: 0;
    }

    100% {
        right:-25%;;
        opacity: 1;
   }
}

@keyframes slideLeft {
    0% {
        transform: translateY(100px);
        opacity: 0;
    }

    100% {
        transform: translateY(0);
        opacity: 1;
   }
}
@keyframes slideBottom {
    0% {
        transform: translateY(-100px);
        opacity: 0;
    }

    100% {
        transform: translateY(0);
        opacity: 1;
   }
}
@keyframes slideSci {
    0% {
        transform: translateX(100px) rotate(45deg);
        opacity: 0;
    }

    100% {
        transform: translateX(0)  rotate(45deg);
        opacity: 1;
   }
}

@keyframes zoomOut {
    0% {
        transform: scale(1.1);
        opacity: 0;
    }

    100% {
        transform: scale(1)  ;
        opacity: 1;
   }
}
@keyframes car {
    0% {
        transform: translate(300px, -300px) scale(0)
        rotate(-45deg);
        opacity: 0;
    }

    100% {
        transform: translateX(0, 0) scale(1)
        rotate(-45deg);
        opacity: 1;
   }
}

    .logout-btn {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 12px 20px;
        background-color: #f44336;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .logout-btn:hover {
        background-color: #e53935;
        transform: scale(1.05);
    }
    .home-img .rhombus img {
    opacity: 1;
    display: block;
}
/* @keyframes carDrift {
    0% {
        transform: translateX(300px) rotate(-20deg);
        opacity: 0;
    }
    50% {
        transform: translateX(0) rotate(0deg);
        opacity: 1;
    }
    100% {
        transform: translateX(-300px) rotate(20deg);
        opacity: 0;
    }
}
.home-img .rhombus img {
    animation: carDrift 3s ease-in-out infinite;
} */
/* @keyframes carDrift {
    0% {
        transform: translateX(-300px) rotate(-10deg);
        opacity: 0;
    }
    50% {
        transform: translateX(0) rotate(0deg);
        opacity: 1;
    }
    100% {
        transform: translateX(300px) rotate(10deg);
        opacity: 0;
    }
}

.home-img .rhombus img {
    animation: carDrift 4s ease-in-out infinite;
} */

@keyframes carExtremeDrift {
    0% {
        transform: translateX(-500px) rotate(-10deg) scale(0.5);
        filter: drop-shadow(0 0 10px rgba(255, 0, 0, 0.8));
        opacity: 0;
    }
    25% {
        transform: translateX(0px) rotate(0deg) scale(1);
        filter: drop-shadow(0 0 20px rgba(0, 255, 0, 1));
        opacity: 1;
    }
    50% {
        transform: translateX(300px) rotate(10deg) scale(1.2);
        filter: drop-shadow(0 0 25px rgba(0, 0, 255, 1));
        opacity: 1;
    }
    75% {
        transform: translateX(-200px) rotate(-10deg) scale(1);
        filter: drop-shadow(0 0 20px rgba(255, 255, 0, 1));
        opacity: 1;
    }
    100% {
        transform: translateX(500px) rotate(20deg) scale(0.5);
        filter: drop-shadow(0 0 10px rgba(255, 0, 255, 0.8));
        opacity: 0;
    }
}

.home-img .rhombus img {
    animation: carExtremeDrift 4s ease-in-out infinite alternate;
}


</style>
</head>

<body>
<header class="header">
    <a href="#" class="logo">Cars.</a>

    <nav class="navbar">
        <a href="#" style="--1:1;" class="active">Home</a>
        <a href="#" style="--1:2;">About</a>
        <a href="#" style="--1:3;">Review</a>
        <a href="#" style="--1:4;">Featured</a>
        <a href="#" style="--1:5;">Contact</a>
    </nav>
    
    <!-- Social Media Icons -->
    <div class="social-media">
        <a href="#" style="--1:1;"><i class='bx bxl-twitter'></i></a>
        <a href="#" style="--1:2;"><i class='bx bxl-facebook'></i></a>
        <a href="#" style="--1:3;"><i class='bx bxl-instagram-alt'></i></a>
    </div>

    <!-- Logout Button -->
    <a href="logout.php" class="logout-btn">Logout</a>
</header>


    <section class="home">
        <div class="home-content">
            <h1>Car Dealing Experience.</h1>
            <h3>Redefined!</h3><br>
            <p>Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Commodi et est incidunt doloribus.
                Consectetur, sint nihil facilis fuga asperiores
                earum nobis reiciendis voluptatum amet eligendi
                iste, animi nam, quos dignissimos.</p>
                <a href="#" class="btn">Explore Cars</a>
        </div>
<div class="home-img">
<div class="rhombus">
<img src="car-removebg-preview.png" alt="Car Image">

</div>
</div>
<div class="rhombus2"></div>
    </section>
    <audio id="driftSound">
    <source src="car-drift.mp3" type="audio/mpeg">
</audio>


</body>

</html>