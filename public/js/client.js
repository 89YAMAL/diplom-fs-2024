const navDays = Array.from(document.querySelectorAll('.page-nav__day'));
const mains = Array.from(document.querySelectorAll('.hidden'));
navDays[0].classList.add('page-nav__day_chosen');
mains[0].style.display = 'block';
for (let i = 0; i < navDays.length; i++) {
  navDays[i].addEventListener('click', function () {
    mains.forEach(main => {
      main.style.display = 'none';
    });
    mains[i].style.display = 'block';
    navDays.forEach(day => {
      if (day.classList.contains('page-nav__day_chosen')) {
        return day.classList.remove('page-nav__day_chosen');
    }})
    navDays[i].classList.add('page-nav__day_chosen');
  })
}
const dayWeeks = Array.from(document.querySelectorAll('.page-nav__day-week'));
for (let i = 0; i < dayWeeks.length; i++) {
 if (dayWeeks[i].textContent === 'сб') {
  let parent = dayWeeks[i].parentElement;
  parent.classList.add('page-nav__day_weekend')
 }
 if (dayWeeks[i].textContent === 'вс') {
  let parent = dayWeeks[i].parentElement;
  parent.classList.add('page-nav__day_weekend')
 }
}
