

const form = document.getElementById("votacionForm");

form.addEventListener("submit", function (e) {
  e.preventDefault();
  

  async function postJSON(data) {
    try {
      const response = await fetch(
        "http://localhost:8000/sistema_votacion.php",
        {
          method: "POST", // or 'PUT'
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        }
      );
      console.log("aqui response", response);
      const result = await response.json();

      console.log("Success:", result);
    } catch (error) {
      console.error("Error:", error);
    }
  }

  const name = document.getElementById("name").value;
  const alias = document.getElementById("alias").value;
  const rut = document.getElementById("rut").value;
  const email = document.getElementById("email").value;
  const region = document.getElementById("region").value;
  const comuna = document.getElementById("comuna").value;
  const candidate = document.getElementById("candidate").value;

  // valor del radio button seleccionado
  const radios = document.querySelectorAll('input[name="checkboxGroup"]');
  let selectedInformation = null;

  radios.forEach((radio) => {
    if (radio.checked) {
      selectedInformation = radio.value;
    }
  });

  const data = {
    name: name,
    alias: alias,
    rut: rut,
    email: email,
    region: region,
    comuna: comuna,
    candidate: candidate,
    information: selectedInformation,
  };
  postJSON(data);
  console.log("aqui la data", data);
});
