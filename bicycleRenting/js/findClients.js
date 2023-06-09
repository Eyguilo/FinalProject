function findClients() {

    const input = document.getElementById("clientName");
    const sel = document.getElementById("clientList");

    const fullName = input.value.trim();

    let name = "";
    let lastName = "";

    const nameParts = fullName.split(" ");
    if (nameParts.length > 0) {
        name = nameParts[0];
        lastName = nameParts.slice(1).join(" ");
    }

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            let label = document.getElementsByTagName("label")[1];
            label.textContent = "Client:";

            sel.textContent = "";

            let arrayClients = JSON.parse(this.responseText);

            let opt = document.createElement("option");
            opt.textContent = "Select a client";
            opt.selected = true;
            opt.disabled = true;
            sel.appendChild(opt);

            for (let i = 0; i < arrayClients.length; i++) {
                let opt = document.createElement("option");
                opt.textContent = arrayClients[i]["name"] + " " +arrayClients[i]["last_name"];
                opt.setAttribute("value", arrayClients[i]["id_client"]);
                sel.appendChild(opt);
            }
        }
    };

    xmlhttp.open(
        "GET", `../infraestructure/other/FindClientsDataAccess.php?name=${name}&lastName=${lastName}`, true
    );
    xmlhttp.send();
}


window.onload = function () {
    let clientName = document.getElementById("clientName");
    clientName.addEventListener("keyup", findClients);
};