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
    ...document.querySelectorAll("input[name='time']"),
    document.getElementById("date"),
    document.getElementById("name"),
  ];

  isFormFilled = fields.every((input) => input.value.trim() !== "");
  submitButton.disabled = !isFormFilled;
});
