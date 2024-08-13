
async function terminacion(e) {
    try {
        const res = await fetch("../../getTerminacionPlacas?id=" + (e.match(/[0-9]/g)?.at(-1)??0)).then(
            async (res) => {
                if (res.ok) return res.json();
                throw await res.json();
            }
        );
        document.getElementById("terminacion_placas").value=res.descripcion;
        document.getElementById("primer_semestre").value=res.primer_semestre;
        document.getElementById("segundo_semestre").value=res.segundo_semestre;
    } catch (error) {
        console.log(error);
    }
    return;
}