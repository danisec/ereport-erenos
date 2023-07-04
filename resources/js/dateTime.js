function datetime() {
    const dateInput = document.getElementById("datetime");
    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth() + 1;
    const day = date.getDate();
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const seconds = date.getSeconds();

    const currentDate = `${year}-${month < 10 ? `0${month}` : month}-${
        day < 10 ? `0${day}` : day
    }T${hours < 10 ? `0${hours}` : hours}:${
        minutes < 10 ? `0${minutes}` : minutes
    }`;

    dateInput.value = currentDate;
}

datetime();
