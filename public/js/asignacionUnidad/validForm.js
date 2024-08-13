function validateForm(e) {
    if (!e.checkValidity())
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Valida tus campos",
        });
}
