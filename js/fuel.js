document.addEventListener('DOMContentLoaded', () => {
    const fuelList = document.getElementById('fuel_list');
    const fuelForm = document.getElementById('fuel-form');
    const typeInput = document.getElementById('type');
    const userIdInput = document.getElementById('user_id');
    const message = document.getElementById('message');

    let isEditing = false;
    let editingId = null;

    function loadFuels() {
        fuelList.innerHTML = '';
        fetch('/control-almacenamiento-petroleo/server/user/session_info.php')
            .then(res => res.json())
            .then(data => {
                if (data.user_id) {
                    fetch(`/control-almacenamiento-petroleo/server/fuel/filter_by_user.php?user_id=${data.user_id}`)
                        .then(response => response.json())
                        .then(fuels => {
                            fuels.forEach(fuel => {
                                const row = document.createElement('tr');

                                row.innerHTML = `
                                    <td>${fuel.id}</td>
                                    <td>${fuel.type}</td>
                                    <td>${fuel.create_at}</td>
                                    <td>
                                        <button class="edit-btn" onclick="editFuel(${fuel.id}, '${fuel.type}')">Editar</button>
                                        <button class="delete-btn" onclick="deleteFuel(${fuel.id}, ${data.user_id})">Eliminar</button>
                                    </td>
                                `;
                                fuelList.appendChild(row);
                            });
                        });
                } else {
                    window.location.href = '../login.php';
                }
            });
    }

    window.editFuel = function (id, type) {
        typeInput.value = type;
        isEditing = true;
        editingId = id;
    };

    window.deleteFuel = function (id, userId) {
        if (!confirm('¿Seguro que quieres eliminar este combustible?')) return;

        const formData = new URLSearchParams();
        formData.append('id', id);
        formData.append('user_id', userId);

        fetch('/control-almacenamiento-petroleo/server/fuel/delete.php', {
            method: 'POST',
            body: formData
        })
            .then(resp => resp.json())
            .then(data => {
                if (data.success) {
                    message.textContent = data.message;
                    message.style.color = 'yellow';
                    loadFuels();
                } else {
                    message.textContent = data.message;
                    message.style.color = 'red';
                }
            })
            .catch(err => {
                message.textContent = "Error de red: " + err.message;
                message.style.color = 'red';
            });
    };

    fuelForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(fuelForm);
        let url = '/control-almacenamiento-petroleo/server/fuel/create.php';

        if (isEditing && editingId) {
            formData.append('id', editingId);
            url = '/control-almacenamiento-petroleo/server/fuel/update.php';
        }

        fetch(url, {
            method: 'POST',
            body: formData
        })
            .then(resp => resp.json())
            .then(data => {
                if (data.success) {
                    message.textContent = data.message;
                    message.style.color = 'yellow';
                    fuelForm.reset();
                    isEditing = false;
                    editingId = null;
                    loadFuels();
                } else {
                    message.textContent = data.message;
                    message.style.color = 'orange';
                }
            })
            .catch(err => {
                message.textContent = "Error de red: " + err.message;
                message.style.color = 'red';
            });
    });

    loadFuels();
});
