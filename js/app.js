document.addEventListener('DOMContentLoaded', () => {
    const registerList = document.getElementById('register-list');
    const fuelList = document.getElementById('fuel_list');

    let registers = [];
    let isEditing = false;
    let editingId = null;

    function renderRegisters() {
        registerList.innerHTML = '';

        fetch('server/user/session_info.php')
            .then(res => res.json())
            .then(data => {
                if (!data.user_id) {
                    window.location.href = 'login.php';
                    return;
                }

                fetch('server/register/index.php?user_id=' + data.user_id)
                    .then(response => response.json())
                    .then(rgt => {
                        registers = rgt;

                        rgt.forEach(register => {
                            const li = document.createElement('li');

                            if (register.completed) {
                                li.className = 'register-ready';
                            }
                            li.innerHTML = `
                                <span>
                                    <h3>ID: ${register.id_fuel}</h3>
                                    <h3>CANTIDAD BARRILES: ${register.quantity_barrel}</h3>
                                    <h3>FECHA: ${register.due_date}</h3>
                                </span>
                                <div>
                                    <button class="edit-btn" onclick="editRegister(${register.id})">Editar</button>
                                    <button class="delete-btn" onclick="deleteRegister(${register.id})">Eliminar</button>
                                </div>
                            `;

                            registerList.appendChild(li);
                        });
                    });
            });
    }

    function loadFuels() {
        fuelList.innerHTML = '';

        fetch('server/user/session_info.php')
            .then(res => res.json())
            .then(data => {
                if (!data.user_id) {
                    window.location.href = 'login.php';
                    return;
                }

                fetch('server/fuel/filter_by_user.php?user_id=' + data.user_id)
                    .then(response => response.json())
                    .then(fuels => {
                        fuels.forEach(fuel => {
                            const opt = document.createElement('option');
                            opt.value = fuel.id;
                            opt.textContent = fuel.type;
                            fuelList.appendChild(opt);
                        });
                    });
            });
    }

    window.deleteRegister = function (id) {
        if (!confirm('¿Estás seguro de que deseas eliminar este registro?')) return;

        fetch('server/register/delete.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${encodeURIComponent(id)}`
        })
        .then(res => res.json())
        .then(resp => {
            if (resp.success) {
                alert('Registro eliminado con éxito');
                renderRegisters();
            } else {
                alert('Error al eliminar: ' + (resp.error || 'Desconocido'));
            }
        })
        .catch(err => alert('Error en la conexión: ' + err.message));
    };

    window.editRegister = function (id) {
        const reg = registers.find(r => r.id === id);
        if (reg) {
            document.getElementById('due_date').value = reg.due_date;
            document.getElementById('quantity_barrel').value = reg.quantity_barrel;
            document.getElementById('fuel_list').value = reg.id_fuel;

            isEditing = true;
            editingId = reg.id;

            document.getElementById('submit-btn').textContent = 'Actualizar';
            document.getElementById('cancel-edit-btn').style.display = 'inline-block';
        }
    };

    document.getElementById('cancel-edit-btn').addEventListener('click', () => {
        isEditing = false;
        editingId = null;
        document.getElementById('register-form').reset();
        document.getElementById('submit-btn').textContent = 'Enviar';
        document.getElementById('cancel-edit-btn').style.display = 'none';
    });

    document.getElementById('register-form').addEventListener('submit', (e) => {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        let url = 'server/register/create.php';
        if (isEditing && editingId) {
            url = `server/register/update.php?id=${editingId}`;
        }

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                form.reset();
                isEditing = false;
                editingId = null;
                document.getElementById('submit-btn').textContent = 'Enviar';
                document.getElementById('cancel-edit-btn').style.display = 'none';
                renderRegisters();
            } else {
                alert(data.message || 'Error desconocido');
            }
        })
        .catch(err => alert('Error en la conexión: ' + err.message));
    });

    renderRegisters();
    loadFuels();
});
