// переименовываем ряды
let confStepRow = Array.from(document.querySelectorAll('.conf-step__row'));
confStepRow.forEach(element => {
    element.className = 'buying-scheme__row';
});

// переименовываем места
let chairStandart = Array.from(document.getElementsByClassName('conf-step__chair conf-step__chair_standart'));
let chairDisabled = Array.from(document.getElementsByClassName('conf-step__chair conf-step__chair_disabled'));
let chairVip = Array.from(document.getElementsByClassName('conf-step__chair conf-step__chair_vip'));
chairStandart.forEach(element => {
    element.className = 'buying-scheme__chair buying-scheme__chair_standart';
});
chairDisabled.forEach(element => {
    element.className = 'buying-scheme__chair buying-scheme__chair_disabled';
});
chairVip.forEach(element => {
    element.className = 'buying-scheme__chair buying-scheme__chair_vip';
});

//выбор мест
function changeSeats() {
    let seats = Array.from(document.querySelectorAll('.buying-scheme__row .buying-scheme__chair'));
    seats.forEach(seat => seat.addEventListener('click', function () {
        if (seat.classList.contains('buying-scheme__chair_taken')) {
            return;
        }
        seat.classList.toggle('buying-scheme__chair_selected');
    }))
}
changeSeats();

//отправка обновленной конфигурации зала и забронированых мест на сервер
let size = document.querySelector('.buying-scheme__wrapper');
$(document).ready(function () {
    $('#acceptin-button').click(function () {
        let orders = Array();
        let rows = Array.from(document.querySelectorAll('.buying-scheme__row'));
        for (let i = 0; i < rows.length; i++) {
            let seats = Array.from(rows[i].querySelectorAll('.buying-scheme__chair'));
            for (let j = 0; j < seats.length; j++) {
                if (seats[j].classList.contains('buying-scheme__chair_selected')) {
                    let standartPrice = document.querySelector('.standart').textContent;
                    let vipPrice = document.querySelector('.vip').textContent;
                    let price = seats[j].classList.contains('buying-scheme__chair_standart') ? standartPrice : vipPrice;
                    orders.push({
                        'row': i + 1,
                        'seat': j + 1,
                        'price': price
                    })
                }
            }
        }
        let chairSelected = [...document.querySelectorAll('.buying-scheme__row .buying-scheme__chair_selected')];
        chairSelected.forEach(element => {
            element.className = 'buying-scheme__chair buying-scheme__chair_taken';
        });
        let config = size.innerHTML;
        let id = document.querySelector('.buying__info-description').id;
        $.ajax({
            url: '/payment/update',
            type: 'POST',
            data: {
              id: id,
              orders: orders,
              config: config
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
              window.location.href = data;
            },
            error: function () {
            }
          })
    });    
 })
