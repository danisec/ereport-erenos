function date() {
    const dateInput = document.getElementById("date");
    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth() + 1;
    const day = date.getDate();

    const currentDate = `${year}-${month < 10 ? `0${month}` : month}-${
        day < 10 ? `0${day}` : day
    }`;

    dateInput.value = currentDate;
}

date();
