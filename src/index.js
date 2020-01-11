import './main.scss';
import App from "./js/components/app";

const app = new App();


window.onload = app.run;
//     function () {
//
//
//
//     const state =
//         {
//             'position': 0, //Каждая сегенерированная тройка пар морд имеет порядковые комера в рамках своей группы от 0 до 2 включительно
//             'arr': generate_content(),//Массив содержащий все тройки пар. Именно к нему обращаемся для того чтобы вытащить картинки
//             'right_ans': 0,//Счётчик правильных ответов
//             'flag_ans': 0,//Флаг защищающий от повторных нажатий на пробел пока не поменяются картинки  (0-когда не угадали иначе 1)
//         };
//     //Привязка контекста к функции для смены картинок
//     // var f = swipe.bind(state);
//     //Привязка контекста для функции, вызывающуюся при нажатии на пробел
//     // var f2 = click_space.bind(state);
//     //Регистрация события на нажатие клавиши через  jquery
//     const images = [document.getElementById("img_1"), document.getElementById("img_2")];
//     document.querySelector(".aspect-ratio-container").innerHTML =
//         "\t\t\t\t<div class=\"aspect-ratio-pictures\">\n" +
//         "\t\t\t\t\t<img id=\"img_1\" class=\"img\">\n" +
//         "\t\t\t\t\t<img id=\"img_2\" class=\"img\">\n" +
//         "\t\t\t\t</div>";
//     const swipe = function () {
//         //Проверяем недостигли ли мы ограничения по пыткам
//         // if (this.total_count == 5) {
//         //     //Удаляем обработчик вызывающий анимацию
//         //     clearInterval(this.time_id);
//         //     //Вывожу текст с помощью jquery созданием текстовых блоков
//         //     document.querySelector('#header').append("<p> Правильное количество ответов: " + this.right_ans);
//         //     //Нахожу среднее время и вывожу его
//         //     $('#header').append("<p>Среднее время: " + this.time.reduce(
//         //         function (prev, next) {
//         //             return prev + next;
//         //         }) / 5
//         //     );
//         //     return;
//         // }
//         //Если пары в тройках кончились, то увеличиваем счётчики для показа следующей тройки и обнуляем position
//         // if (this.position == 3) {
//         //Засекаем время если пользователь так и не выбрад правильную морду
//         //     this.time[this.total_count] = performance.now() - this.time[this.total_count];
//         //     ++this.total_count;//Переход к следующей тройке
//         //     this.position = 0;//Показываем сначала тройки
//         // }
//         //Меняем содержимое картинок используя DOM из JS
//         console.log(state);
//         images [0].src = "images/" + state.arr[state.total_count].first;
//         images [1].src = "images/" + state.arr[state.total_count].second;
//
//         // //Если тройку только начали показывать инициализируем стартовое значение времени
//         // if (this.position == 0) this.time.push(performance.now());
//         // //Иначе переписываем стартовое значение для следующей пары
//         // else if (this.position != 0 && this.flag_ans == 0) this.time[this.total_count] = performance.now();
//         //
//         // this.flag_ans = 0;//Сбрасываем счётчик для правильного ответа, чтобы можно было его дать
//         // this.cposition = this.position;//Записываем текущее значение позиции картинок
//         // this.ctotal_count = this.total_count;//Записываем текущее значение позиции картинок
//         //
//         // if (this.position != 3) ++this.position;//Если не достигли предела, то переходим к следующей паре
//     };
//
//     // document.addEventListener('keyup', function (event) {
//     //     if (event.defaultPrevented) {
//     //         return;
//     //     }
//     //
//     //     var key = event.key || event.keyCode;
//     //
//     //     if (key === ' ' || key === 32 || key === "Spacebar") {
//     //         f2();
//     //     }
//     // });
//
//
//     //Строчка вызывающее анимацию на странице, вызывая функцию f с интервалом 2 секунды
//     // state.time_id = setInterval(
//     //     function(){
//     //         f(images);
//     //     }
//     // }, 2000);
//     state.time_id = setInterval(swipe, 2000);
// }
//
// //Функция для генерации массива троек(попыток), где расположены все картинки, которые будем показывать
// function generate_content() {
//     var arr = [];
//     for (var i = 0; i != 10; ++i) arr.push(generate_face(i));
//     return arr;
// }
//
//
// function generate_face(numberPair) {
//     return {
//         "first": "" + numberPair+""+randomInteger(1,5)+".png",
//         "second":  "" + numberPair+""+randomInteger(1,5)+".png"
//     }
// }
//
// function swipe(imgages) {
//
// }
//
//
// //Функция вызываемая при нажатии на пробел
// function click_space() {
//     //Условие принимающее решение о правильности ответа (для второго задания)
//     //     if (this.arr[this.ctotal_count][this.cposition].first === '1.png' || this.arr[this.ctotal_count][this.cposition].seconds === '1.png') {
//     if (this.arr[this.ctotal_count][this.cposition].first === this.arr[this.ctotal_count][this.cposition].seconds) {
//         //Если морду не угадывали раньше, то засекаем время первой попытки
//         if (this.flag_ans == 0) {
//             this.time[this.total_count] = performance.now() - this.time[this.total_count];//Считаем  время как текущее минус стартовое
//             this.flag_ans = 1;//Флаг устанавливаем на 1, чтобы защитить от повторных нажатий и затираний данных о первой попытки
//             ++this.right_ans;//Увеличиваем счётчик правильных ответов
//             ++this.total_count;//Переходим к следующей тройке
//             this.position = 0;//Показываем тройку сначала
//         }
//     }
// }
//
// /**
//  Helper method
//  **/
// function randomInteger(min, max) {
//     // случайное число от min до (max+1)
//     let rand = min + Math.random() * (max + 1 - min);
//     return Math.floor(rand);
// }