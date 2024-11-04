function rotate() {

    const formContainer = document.querySelector('.form-container');
    const goToRegister = document.getElementById('goToRegister');
    const goToLogin = document.getElementById('goToLogin');

    goToRegister.addEventListener('click', () => {
        formContainer.style.transform = 'rotateY(180deg)';
    });

    goToLogin.addEventListener('click', () => {
        formContainer.style.transform = 'rotateY(0deg)';
    });
}
function showError(message) {
    const errorMessage = document.createElement('div');
    if (message == "Registrace úspěšná! Můžete se přihlásit") {
        errorMessage.classList.add('succes-message');
    } else {
        errorMessage.classList.add('error-message');
    }
    errorMessage.innerText = message;

    document.body.appendChild(errorMessage);

    // Zobrazíme hlášku
    errorMessage.style.display = 'block';

    // Po 3 vteřinách spustíme fade-out efekt
    setTimeout(() => {
        errorMessage.classList.add('fade-out');
    }, 3000); // 3000ms = 3 vteřiny

    // Po další 1 vteřině úplně skryjeme a odstraníme hlášku
    setTimeout(() => {

        errorMessage.style.display = 'none';
        document.body.removeChild(errorMessage);
    }, 4000); // 1 teřina na fade-out (3000ms + 1000ms = 4000ms)
}

function clockTime() {
    var currentTime = new Date(),
        month = currentTime.getMonth() + 1,
        day = currentTime.getDate(),
        year = currentTime.getFullYear(),
        hour = currentTime.getHours(),
        minutes = currentTime.getMinutes(),
        seconds = currentTime.getSeconds();
    if (month < 10) {
        month = "0" + month;
    }
    if (day < 10) {
        day = "0" + day;
    }
    if (hour < 10) {
        hour = "0" + hour;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    if (seconds < 10) {
        seconds = "0" + seconds;
    }
    text = (day + "." + month + "." + year + " " + hour + ":" + minutes + ":" + seconds);
    document.getElementById('date').innerHTML = text;
}
setInterval(clockTime, 1000) //Každou vteřinu refresuje clockTime funkci. Aby byl čas furt aktuální

function printFormDate() {
    var currentTime = new Date(),
        year = currentTime.getFullYear();
    document.getElementById("formDate").min = (year - 10) + "-01-01";
    document.getElementById("formDate").max = (year + 30) + "-12-31";
}

function printTodayDate() {
    var currentTime = new Date(),
        year = currentTime.getFullYear();
    month = currentTime.getMonth() + 1,
        day = currentTime.getDate()
    if (month < 10) {
        month = "0" + month;
    }
    if (day < 10) {
        day = "0" + day;
    }
    document.getElementById("formDate").value = + year + "-" + month + "-" + day;
    document.getElementById("formDate").min = + year + "-" + month + "-" + day;
    document.getElementById("formDate").max = (year + 30) + "-12-31";
}


function onlyOneCheck() {
    let boxes = document.querySelectorAll("input[type=checkbox]");
    boxes.forEach(b => b.addEventListener("change", tick));
    tick();
    function tick(e) {
        let state = e.target.checked; // save state of changed checkbox
        boxes.forEach(b => b.checked = false); // clear all checkboxes
        e.target.checked = state; // restore state of changed checkbox
    }
}

var lastTop = 0;
function scrollFunction() {
    console.log(lastTop);
    if (document.documentElement.scrollTop > lastTop) {
        document.getElementById("filter-container").style.marginTop = (document.documentElement.scrollTop + 100) + "px";
    } else if (document.documentElement.scrollTop < lastTop) {
        if (document.documentElement.scrollTop == 0) {
            document.getElementById("filter-container").style.marginTop = (45) + "px";
        } else {
            document.getElementById("filter-container").style.marginTop = (document.documentElement.scrollTop - 100) + "px";
        }
    }
    lastTop = document.documentElement.scrollTop;
}
setInterval(scrollFunction, 100);