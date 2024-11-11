const disableTimeButtons = () => {
  const date = document.getElementById("date").value;
  if (customers && customers.length) {
    customers
      .filter((customer) => customer.date === date)
      .forEach((customer) => {
        document.getElementById(`time-btn-${customer.time}`).disabled = true;
      });
  }
};

const params = new URLSearchParams(window.location.search);

if (params.get("event") === "edit") {
  const editButtons = [
    ...document.querySelectorAll("button[name='edit']"),
  ].filter((button) => button.innerText == "EDIT");

  editButtons.forEach((button) => (button.disabled = true));
  disableTimeButtons();
  document.getElementById("submitButton").disabled = false;
  document.querySelector("input[name='time']:checked").disabled = false;
}

document.getElementById("date").addEventListener("change", (event) => {
  disableTimeButtons(event);
});

const form = document.getElementById("customer-form");
const submitButton = document.getElementById("submitButton");
form.addEventListener("input", () => {
  const fields = [
    document.querySelector("input[type='radio']:checked"),
    document.getElementById("date"),
    document.getElementById("name"),
  ];

  isFormFilled = fields.every((input) => input && input.value.trim() !== "");
  submitButton.disabled = !isFormFilled;
});
