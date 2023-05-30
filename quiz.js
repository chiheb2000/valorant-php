const questions = [{
        question: "1. What is the 30-50m Phantom headshot damage?",
        answers: [
            { text: "156", correct: false },
            { text: "133", correct: false },
            { text: "124", correct: true },
            { text: "156", correct: false },
        ]

    },
    {
        question: "2. Which of the characters below peeks the most aggressively?",
        answers: [
            { text: "Raze", correct: true },
            { text: "Phoenix", correct: false },
            { text: "Reyna", correct: false },
            { text: "Jett", correct: false },
        ]
    },
    {
        question: "3. How much damage does the Vandal do in the body",
        answers: [
            { text: "40", correct: true },
            { text: "31", correct: false },
            { text: "42", correct: false },
            { text: "56", correct: false },
        ]
    },
    {
        question: "4. Killing all 5 members of a team in 1v5 is called",
        answers: [
            { text: "triple", correct: false },
            { text: "An extermination", correct: false },
            { text: "PENTAKILL", correct: false },
            { text: "ACE", correct: true },
        ]
    },
    {
        question: "5. How much damage the Judge puts from 0 to 10m in the head",
        answers: [
            { text: "45", correct: false },
            { text: "35", correct: true },
            { text: "115", correct: false },
            { text: "76", correct: false },
        ]
    },
    {
        question: "6. How many Rounds are needed to win the game?",
        answers: [
            { text: "9", correct: false },
            { text: "12", correct: false },
            { text: "15", correct: false },
            { text: "13", correct: true },
        ]
    },
    {
        question: "7. Who is the oldest Valorant agent?",
        answers: [
            { text: "Yoru", correct: false },
            { text: "Brimstone", correct: true },
            { text: "Killjoy", correct: false },
            { text: "Neon", correct: false },
        ]
    },
    {
        question: "8. How many maps are there in the game ?",
        answers: [
            { text: "10", correct: false },
            { text: "5", correct: false },
            { text: "8", correct: false },
            { text: "9", correct: true },
        ]
    }
];
const questionElement = document.getElementById("question");
const answerBtn = document.getElementById("answer");
const nextBtn = document.getElementById("next");

let currentQuestionIndex = 0;
let score = 0;


function startQuiz() {
    currentQuestionIndex = 0;
    score = 0;
    nextBtn.innerHTML = "Next";
    showQuestion();
}

function showQuestion() {
    resetState();
    let currentQuestion = questions[currentQuestionIndex];
    questionElement.innerHTML = currentQuestion.question;
    currentQuestion.answers.forEach(answer => {
        const button = document.createElement("button");
        button.innerHTML = answer.text;
        button.classList.add("btn");
        answerBtn.appendChild(button);
        if (answer.correct) {
            button.dataset.correct = answer.correct;
        }
        button.addEventListener("click", selectAnswer);
    });
}

function resetState() {
    nextBtn.style.display = "none";
    while (answerBtn.firstChild) {
        answerBtn.removeChild(answerBtn.firstChild);
    }
}



function selectAnswer(e) {
    const selectedBtn = e.target;
    const isCorrect = selectedBtn.dataset.correct === "true";
    if (isCorrect) {
        selectedBtn.classList.add("correct");
        score++;
    } else {
        selectedBtn.classList.add("incorrect");
    }
    Array.from(answerBtn.children).forEach(button => {
        if (button.dataset.correct === "true") {
            button.classList.add("correct");
        }
        button.disabled = true;
    });
    nextBtn.style.display = "block";
}

function showScore() {
    resetState();
    questionElement.innerHTML = `You scored ${score} out of ${questions.length}!`;

    nextBtn.innerHTML = "Play Again";
    nextBtn.style.display = "block";

}

function handleNextButton() {

    currentQuestionIndex++;

    if (currentQuestionIndex < questions.length) {
        showQuestion()
    } else {
        showScore();
    }
}
nextBtn.addEventListener("click", () => {
    if (currentQuestionIndex < questions.length) {
        handleNextButton()
    } else {
        startQuiz();
    }
});
startQuiz();