document.addEventListener('DOMContentLoaded', () => {

    const fuelList = document.getElementById('fuel_list');

    function loadFuels() {

        fuelList.innerHTML = '';
        console.log("Runing");
        fetch('/control-almacenamiento-petroleo/server/user/session_info.php')
            .then(res => res.json())
            .then(data => {
                if (data.user_id) {
                    console.log('Sesión activa para usuario:', data.user_id);
                    fetch('/control-almacenamiento-petroleo/server/fuel/filter_by_user.php?user_id=' + data.user_id)
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
                                        '<td>' + fuel.create_at + '</td>';

                                    fuelList.appendChild(row);
                                }
                            );
                        });
                } else {
                    console.warn(data.error);
                    window.location.href = '../login.php';
                }
            });
    }


    loadFuels();

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
                        loadFuels();
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
