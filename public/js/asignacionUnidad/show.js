function modal(id, etapa) {
    const options = [...document.getElementById("id_estado").options].filter(
        (i) => i.value != ""
    );
    for (const option of options) {
        option.hidden = false;
        if (etapa == 4 && option.innerHTML == "Desasignar")
            option.hidden = true;
        else if (etapa !== 4 && option.innerHTML !== "Desasignar")
            option.hidden = true;
    }

    const form = document.getElementById("modalEstado");
    const url = form.action.split("/");
    url.pop();
    url.push(id);
    form.action = url.join("/");
}
