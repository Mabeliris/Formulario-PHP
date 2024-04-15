
const form = document.getElementById("votacionForm");
  
  

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    console.log("me diste un click");


    const formData = new FormData(form);
    console.log(formData);
    console.log(formData.get("name"));
   

    fetch("sistema_votacion.php", {
      method: "POST",
      body: formData
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
      });
      
  });

