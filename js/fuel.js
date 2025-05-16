document.addEventListener('DOMContentLoaded', () => {

    const fuelList = document.getElementById('fuel_list');

    function loadfuels() {

        fuelList.innerHTML = '';
        console.log("Runing");
        fetch('/control-almacenamiento-petroleo/server/user/session_info.php')
            .then(res => res.json())
            .then(data => {
                if (data.id_user) {
                    console.log('Sesión activa para usuario:', data.id_user);
                    fetch('/control-almacenamiento-petroleo/server/category/filter_by_user.php?user_id=' + data.id_user)
                        .then(response => response.json())
                        .then(fl => {
                            console.log(fl);
                            fl.forEach(
                                fuel => {
                                    console.log(fuel);

                                    const row = document.createElement('tr');

                                    row.innerHTML =
                                        '<td>' + fuel.id + '</td>' +
                                        '<td>' + fuel.type + '</td>' +
                                        '<td>' + fuel.id_user + '</td>' +
                                        '<td>' + fuel.create_at + '</td>';

                                    fuelListList.appendChild(row);
                                }
                            );
                        });
                } else {
                    console.warn(data.error);
                    window.location.href = '../login.php';
                }
            });
    }


    loadfuels();

    document.getElementById('fuel-form').addEventListener('submit',
        function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const message = document.getElementById('message');

            fetch('/control-almacenamiento-petroleo/server/fuel/create.php',
                {
                    method: 'POST',
                    body: formData
                })
                .then(resp => resp.json())
                .then(data => {
                    if (data.success) {
                        message.textContent = data.message;
                        message.style.color = 'green';
                        this.reset();
                        loadfuels();
                    }
                    else {
                        message.textContent = data.message;
                        message.style.color = 'orange';
                    }
                })
                .catch(err => {
                    message.textContent = err.message;
                    message.style.color = 'red';
                })
        });

});
