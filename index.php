<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: l.php");
    exit;
}

$user = $_SESSION['username'];
ini_set('log_errors', 'On');
ini_set('display_errors', 'Off');

?>


<?php require 'partials/_nav.php' ?>



<style>
.player {
    position: absolute;
    height: 4vmin;
    width: 4vmin;
    border-radius: 50%;
    opacity: 0.7;
    transition-duration: 0.4s;
    transition-property: margin;
    background-color: red;
}

.game {
    width: 100%;
    height: 100%;
}

.canva {
    position: absolute;
    margin: auto;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    text-align: center;
    height: 34vmin;
    width: 43vmin
}
</style>

<div class="Welcome text-center">
    <h4 class="alert-heading " style="padding: 12px; ">Welcome - <?php echo $user ?></h4>
    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id='start'
        class=" btn btn-outline-dark " style="  border-radius: 22px;">Start Game</button>
</div>

<div class="canva">
    <div class="player" id="coin"></div>
    <img class='game' src="/quiz/partials/game.png" alt="game" srcset="">
</div>


<div style='text-align: center'>
    <a href="http://imknightrider.github.io/SnakeGame" class='btn btn-success '>Want To Play Other Stuff</a>
    <a href="/quiz/log.php" class='btn btn-danger '>Log Out</a>
</div>



<!-- Button trigger modal -->
<button type="button" id='dialogBtn' class="btn btn-primary" style='display: none;' data-bs-toggle="modal"
    data-bs-target="#dialog">
    Launch static backdrop modal
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
<!-- questions -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="questionBox" id="staticBackdropLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <div class="col box">
                    <input name="option" type="radio" id="first" value="a" required>
                    <label for="first">Testing 1</label>
                </div>
                <div class="col box">
                    <input name="option" type="radio" id="second" value="b" required>
                    <label for="second">Testing 2</label>
                </div>
                <div class="col box">
                    <input name="option" type="radio" id="third" value="c" required>
                    <label for="third">Testing 3</label>
                </div>
                <div class="col box">
                    <input name="option" type="radio" id="fourth" value="d" required>
                    <label for="fourth">Testing 4</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit" class="btn btn-primary" data-bs-dismiss="modal">Ya</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Your Score Card</h5>
            </div>
            <div class="modal-body" id='dialog-text'>
                ...
            </div>
            <div class="modal-footer">
                <form action="index.php" method="get">
                    <input type="text" id='score' style='display: none;' name='data'>
                    <button type="submit" id='end' class="btn btn-primary">Understood</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
const quizData = [{
        question: "Which of these items can be composted, or turned into natural fertilizer, for your garden?",
        a: "Egg Shells",
        b: "Golf Balls",
        c: "Aluminium Foil",
        d: "All of The Above",
        correct: "a",

    },
    {
        question: "Who was the architect for Red Fort in Delhi?",
        a: "Aditya Nath Jha",
        b: " Anil Baijal.",
        c: "Ustad Ahmad Lahori.",
        d: "Shah Jahan.",
        correct: "c",

    },
    {
        question: "Which of the following is the state bird of Rajasthan? ",
        a: "Great Indian Bustard ",
        b: "Emerald Dove ",
        c: "Indian roller.",
        d: "Black francolin ",
        correct: "a",

    },
    {
        question: "Fish have no lungs. Instead, they breathe and pull air through which part? ",
        a: "Dorsal fins ",
        b: "Scales",
        c: "Hearth",
        d: "Gills",
        correct: "d",

    },
    {
        question: "Which planet looks reddish in the night sky?",
        a: "Saturn ",
        b: "Jupiter",
        c: "Mars",
        d: "Mercury",
        correct: "c",

    },
    {
        question: "Jonas E. Salk developed the which Vaccine",
        a: "Typhus",
        b: "Polio",
        c: "Rabies",
        d: "TB",
        correct: "a",

    },
    {
        question: "In India, distribution of electricity for domestic purpose is done in the form of",
        a: "220 V; 60 Hz",
        b: "220 V; 50 Hz",
        c: "110 V; 50 Hz",
        d: "None of these",
        correct: "b",

    },
    {
        question: "In which of the following places Steppe Grassland is found?",
        a: "Central Asia",
        b: "North America",
        c: "Australia",
        d: "South Africa",
        correct: "a",

    },
    {
        question: "Which of the following is known for  the World’s largest Wetland System?",
        a: "Everglades (USA)",
        b: "Chilka (India)",
        c: "Everglades (USA)",
        d: "Pantanal (South America)",
        correct: "b",

    },
    {
        question: "How many rings are there in the Audi logo?",
        a: "5",
        b: "6",
        c: "4",
        d: "3",
        correct: "a",

    },
]

// Question Apperance
let index = 0;
let correct = 0,
    incorrect = 0,
    total = quizData.length;
let questionBox = document.getElementById("questionBox");
let allInputs = document.querySelectorAll("input[type='radio']")
let button = document.getElementById('start')
let player = document.getElementById(`coin`)
let dialog = document.getElementById('dialogBtn')
let dialogtxt = document.getElementById('dialog-text')
let score = document.getElementById('score')
let end = document.getElementById('end')

const loadQuestion = () => {
    if (total === index) {
        return quizEnd()
    }
    reset()
    const data = quizData[index]
    questionBox.innerHTML = `${index + 1}) ${data.question}`
    allInputs[0].nextElementSibling.innerText = data.a
    allInputs[1].nextElementSibling.innerText = data.b
    allInputs[2].nextElementSibling.innerText = data.c
    allInputs[3].nextElementSibling.innerText = data.d
}

document.querySelector("#submit").addEventListener(
    "click",
    function() {
        const data = quizData[index]
        const ans = getAnswer()

        if (ans === data.correct) {
            correct++;

        } else {
            incorrect++;
        }
        index++;
        button.innerText = 'Next Question'
        loadQuestion()

    }
)

const getAnswer = () => {
    let ans;
    allInputs.forEach(
        (inputEl) => {
            if (inputEl.checked) {
                ans = inputEl.value;
            }
        }
    )
    button.click()
    return ans;
}

const reset = () => {
    allInputs.forEach(
        (inputEl) => {
            inputEl.checked = false;
        }
    )
}

const quizEnd = () => {
    // console.log(document.getElementsByClassName("container"));
    button.classList.add("disabled");
    // console.log(correct)


    dialog.click()
    dialogtxt.innerHTML = `Hi You Have Scored: ${correct} We will Reached at You If You Have earned Something`

    score.value = correct

}
loadQuestion(index);



// Player Movement


button.addEventListener('click', async (e) => {
    if (!(index === total)) {
        await move(direction())
    }
})


function direction() {
    if (marginTop() >= 10) {
        return 'backward'
    } else if (marginLeft() >= 40) {
        return 'top';
    } else {
        return 'forward';
    }
}

function move(direction) {
    if (direction == 'top') {
        player.style.marginTop = String(marginTop() + 10) + 'vmin'
    }
    if (direction == 'forward') {
        player.style.marginLeft = String(marginLeft() + 4) + 'vmin'
    }
    if (direction == 'backward') {
        player.style.marginLeft = String(marginLeft() - 4) + 'vmin'
    }

}


function marginLeft() {
    return Number(player.style.marginLeft.split('v')[0])
}

function marginTop() {
    return Number(player.style.marginTop.split('v')[0])

}
</script>
<?php
// Include file which makes the
// Database Connection.
include 'dbconnect.php';
$result = $_GET['data'];

$sql = "UPDATE `users` SET `score`='$result' WHERE `username`='$user'";
$result = mysqli_query($conn, $sql);
header("location: log.php");


?>