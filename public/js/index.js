const csrf = document.head.querySelector("meta[name=csrf-token]").content;

const toast = () => {
    setTimeout(() => {
        const toastContainer = document.querySelector("#toast-container");
        if (toastContainer !== null) {
            toastContainer.classList.remove("hidden");
            toastContainer.classList.add("flex");
            setTimeout(() => {
                toastContainer.classList.remove("flex");
                toastContainer.classList.add("hidden");
                sessionStorage.removeItem("deleted");
            }, 1500);
        }
    }, 100);
};

const deleteModal = (btnDelete, endpoint, message) => {
    btnDelete.addEventListener("click", () => {
        Swal.fire({
            title: "Apakah anda yakin?",
            text: message,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yakin",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`${endpoint}/${btnDelete.dataset.id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrf,
                    },
                })
                    .then((response) => {
                        return response.json();
                    })
                    .then((result) => {
                        if (result.message) {
                            location.reload();
                        }
                    });
            }
        });
    });
};

window.onload = toast();

// delete data with ajax
document.querySelectorAll(".btn-delete-category").forEach((btnDelete) => {
    deleteModal(
        btnDelete,
        "/hapus-kategori",
        "data yang telah dihapus tidak bisa dikembalikan"
    );
});

document.querySelectorAll(".btn-delete-product").forEach((btnDelete) => {
    deleteModal(
        btnDelete,
        "/hapus-produk",
        "data yang telah dihapus tidak bisa dikembalikan"
    );
});

document.querySelectorAll(".btn-delete-admin").forEach((btnDelete) => {
    deleteModal(
        btnDelete,
        "/hapus-admin",
        "data yang telah dihapus tidak bisa dikembalikan"
    );
});

document.querySelectorAll(".btn-delete-user").forEach((btnDelete) => {
    deleteModal(
        btnDelete,
        "/hapus-user",
        "data yang telah dihapus tidak bisa dikembalikan"
    );
});

document.querySelectorAll(".btn-delete-product-income").forEach((btnDelete) => {
    deleteModal(
        btnDelete,
        "/hapus-barang-masuk",
        "Menghapus data barang masuk juga akan menghapus jumlah data barang yang sebelumnya ditambahkan"
    );
});

document.querySelectorAll(".btn-delete-product-outcome").forEach((btnDelete) => {
    deleteModal(
        btnDelete,
        "/hapus-barang-keluar",
        "Menghapus data barang keluar juga akan mempengaruhi jumlah data barang terkait"
    );
});

document
    .querySelectorAll(".btn-delete-order-user")
    .forEach((btnDelete) => {
        deleteModal(
            btnDelete,
            "/order",
            "Anda yakin ingin menghapus data?"
        );
    });
