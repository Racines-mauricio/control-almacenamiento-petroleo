document.addEventListener('DOMContentLoaded', () => {
    const registerInput = document.getElementById('register-input');
    const registerList = document.getElementById('register-list');
    const fuelList = document.getElementById('fuel-list');

    let registers = [];
    let isEditing = false;
    let editingId = null;
    
    function renderRegisters() {
        console.log("Runing");
        fetch('server/user/session_info.php')
            .then(res => res.json())
            .then(data => {
                if (data.user_id) {
                    console.log('Sesión activa para usuario:', data.id_user);
                    fetch('server/register/index.php?id_user=' + data.id_user)
                        .then(response => response.json())
                        .then(rgt => {
                            console.log(rgt);
                            rgt.forEach(
                                register => {
                                    console.log(register);

                                    const li = document.createElement('li');
                                    if (register.completed) {
                                        li.className = 'register-ready';
                                        li.innerHTML =
                                            '<span>' + register.due_date + '</span>';
                                    }
                                    else {
                                        li.innerHTML =
                                            '<span>' + register.due_date + '</span>' +
                                            '<div>' +
                                            '<button class="complete-btn" onclick="completeRegister(' + register.id + ')">' +
                                            'Completar </button>' +
                                            '<button class="edit-btn" onclick="editRegister(' + register.id + ')">' +
                                            'Editar </button>' +
                                            '<button class="delete-btn" onclick="deleteRegister(' + register.id + ')">' +
                                            'Eliminar </button>' +
                                            '</div>';
                                    }
                                    registerList.appendChild(li);
                                }
                            );
                        });
                } else {
                    console.warn(data.error);
                    window.location.href = 'login.php';
                }
            });





        registerList.innerHTML = '';
        registers.forEach(
            register => {
                console.log(register);

                const li = document.createElement('li');
                if (register.complete) {
                    li.className = 'register-ready';
                    li.innerHTML =
                        '<span>' + register.text + '</span>';
                }
                else {
                    li.innerHTML =
                        '<span>' + register.text + '</span>' +
                        '<div>' +
                        '<button class="complete-btn" onclick="completeRegister(' + register.id + ')">' +
                        'Completar </button>' +
                        '<button class="edit-btn" onclick="editRegister(' + register.id + ')">' +
                        'Editar </button>' +
                        '<button class="delete-btn" onclick="deleteRegister(' + register.id + ')">' +
                        'Eliminar </button>' +
                        '</div>';
                }
                registerList.appendChild(li);
            }

        );
    }

    function loadFuels() {

        console.log("Runing");
        fetch('server/user/session_info.php')
            .then(res => res.json())
            .then(data => {
                if (data.user_id) {
                    console.log('Sesión activa para usuario:', data.id_user);
                    fetch('server/fuel/filter_by_user.php?user_id=' + data.id_user)
                        .then(response => response.json())
                        .then(fl => {
                            console.log(fl);
                            fl.forEach(
                                fuel => {
                                    console.log(fuel);

                                    const opt = document.createElement('option');

                                    opt.innerHTML = fuel.type;
                                    opt.value = fuel.id;

                                    fuelList.appendChild(opt);
                                }
                            );
                        });
                } else {
                    console.warn(data.error);
                    window.location.href = 'login.php';
                }
            });
    }

    window.deleteRegister = function (id) {
        registers = registers.filter(register => register.id !== id);
        renderRegisters();
    }

    window.editRegister = function (id) {
        console.log(id);
        const et = registers.find(t => t.id === id);
        if (et) {
            registerInput.value = et.text;
            registerForm.innerText = "Guardar";
            isEditing = true;
            editingId = et.id;
        }
    }

    window.completeRegister = function (id) {
        registers = registers.map(register =>
            register.id === id ? {
                ...register, complete: true
            } : register);
        renderRegisters();
    }

    renderRegisters();
    loadFuels();
});
