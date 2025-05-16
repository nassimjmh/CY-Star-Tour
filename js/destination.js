/////////////////
/////////////////
//NAVIGUER DANS LES JOURS
/////////////////
/////////////////
document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.nav-item');
    const dayTitle = document.getElementById('day-title');
    const title1 = document.getElementById('title1');
    const description1 = document.getElementById('description1');
    const title2 = document.getElementById('title2');
    const description2 = document.getElementById('description2');
    const map = document.getElementById('map');

    function updateDisplay(item) {
        const dayNumber = item.textContent;
        title1.innerHTML = `<h3>${item.getAttribute('data-title1')}</h3>`;
        description1.innerHTML = `<p>${item.getAttribute('data-description1')}</p>`;
        title2.innerHTML = `<h3>${item.getAttribute('data-title2')}</h3>`;
        description2.innerHTML = `<p>${item.getAttribute('data-description2')}</p>`;
        map.innerHTML = `<img src="${item.getAttribute('data-map')}" alt="Map image">`;
    }

    navItems.forEach(item => {
        item.addEventListener('click', function() {
            // Retire la classe active de tous les items
            navItems.forEach(i => i.classList.remove('active'));

            // Ajoute la classe active à l'item cliqué
            this.classList.add('active');

            // Met à jour le texte affiché
            updateDisplay(this);
        });
    });

    // Active le premier item par défaut et affiche ses données
    if (navItems.length > 0) {
        navItems[0].classList.add('active');
        updateDisplay(navItems[0]);
    }
})


////////////////////
////////////////////
////NAVIUER DANS LE FORM/////
////////////////////
////////////////////
document.addEventListener('DOMContentLoaded', function () {
    const groups = document.querySelectorAll('.group');
    let currentGroup = 0;
    const nextButton = document.getElementById('suivantBtn');
    const prevButton = document.getElementById('prevButton');
    const submitButton = document.querySelector('button[type="submit"]');
    const errorMessage = document.getElementById('error-message');

    function showGroup(index) {
        groups.forEach((group, i) => {
            group.classList.remove('active');
            if (i === index) {
                group.classList.add('active');
            }
        });
        if (index === groups.length - 1) {
            nextButton.style.display = 'none';
            submitButton.style.display = 'inline-block';
        } else {
            nextButton.style.display = 'inline-block';
            submitButton.style.display = 'none';
        }
        if (index === 0) {
            prevButton.style.display = 'none';
        } else {
            prevButton.style.display = 'inline-block';
        }
    }

    function nextGroup() {
        const currentGroupElement = groups[currentGroup];
        const isSecondGroup = currentGroup === 1;
        if (!isSecondGroup) {
            const currentInputs = currentGroupElement.querySelectorAll('input[type="radio"], input[type="checkbox"]');
            const isChecked = Array.from(currentInputs).some(input => input.checked);
            if (isChecked) {
                errorMessage.style.display = 'none';
                if (currentGroup < groups.length - 1) {
                    currentGroup++;
                    showGroup(currentGroup);
                }
            } else {
                errorMessage.textContent = 'Please select at least one option to continue your space journey.';
                errorMessage.style.display = 'block';
            }
        } else {
            if (currentGroup < groups.length - 1) {
                currentGroup++;
                showGroup(currentGroup);
            }
        }
    }

    function prevGroup() {
        if (currentGroup > 0) {
            currentGroup--;
            showGroup(currentGroup);
            errorMessage.style.display = 'none';
        }
    }

    nextButton.addEventListener('click', nextGroup);
    prevButton.addEventListener('click', prevGroup);

    showGroup(currentGroup);
});
///////////////
///CAROUSEL//
///////////////////
