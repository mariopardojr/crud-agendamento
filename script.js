document.getElementById("submitButton").addEventListener("click", () => {
  const time = document.querySelector('input[name="time"]:checked').value;
  const date = document.getElementById("date").value;

  if (date && time) {
    !localStorage.getItem("disabledButtons") &&
      localStorage.setItem("disabledButtons", JSON.stringify([]));

    const disabledOptions = [
      ...JSON.parse(localStorage.getItem("disabledButtons")),
    ];
    const time = document.querySelector('input[name="time"]:checked').value;
    const date = document.getElementById("date").value;

    disabledOptions.push({ date, time });
    localStorage.setItem("disabledButtons", JSON.stringify(disabledOptions));
  }
});

document.getElementById("date").addEventListener("change", (event) => {
  const disabledButtons = localStorage.getItem("disabledButtons");

  if (disabledButtons) {
    const parsedDisabledButtons = JSON.parse(disabledButtons);
    if (parsedDisabledButtons.length) {
      const timeOptions = parsedDisabledButtons.filter(
        (option) => option.date == event.target.value
      );
      timeOptions.forEach((option) => {
        document.getElementById(`time-btn-${option.time}`).disabled = true;
      });
    }
  }
});

document.querySelectorAll('button[name="delete"]').forEach((button) => {
  button.addEventListener("click", () => {
    const disabledButtons = localStorage.getItem("disabledButtons");
    const date = button.dataset.date;
    const time = button.dataset.time;

    if (disabledButtons) {
      const parsedDisabledButtons = JSON.parse(disabledButtons);
      const filteredOptions = parsedDisabledButtons.filter(
        (option) => option.date != date && option.time != time
      );
      localStorage.setItem("disabledButtons", JSON.stringify(filteredOptions));
      document.getElementById(`time-btn-${time}`).disabled = false;
    }
  });
});
