function showSection(sectionID){
    const sections = document.querySelectorAll('.content');
    const homesection = document.getElementById('home');

    sections.forEach(section => { section.style.display = 'none'; });
    if (homesection) { homesection.style.display = 'none'; }

    const activeSection = document.getElementById(sectionID);
    if(activeSection){ activeSection.style.display = 'block'; }
}

document.addEventListener("DOMContentLoaded", () => {
    const logo = document.getElementById('logo');
    if (logo) {
        logo.addEventListener('click', () => {
            document.querySelectorAll('.content').forEach(s => s.style.display = 'none');
            const homesection = document.getElementById('home');
            if (homesection) homesection.style.display = 'block';
        });
    }

    const clearButton = document.getElementById('clrbtn');
    if (clearButton) {
        clearButton.addEventListener('click', () => {
            document.querySelectorAll('input[type="text"], input[type="number"]').forEach(i => i.value = '');
        });
    }
});

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        const toast = document.getElementById('success-toast');
        if (toast) {
            toast.classList.remove('toast-hidden');
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.classList.add('toast-hidden'), 500);
            }, 3000);
        }
        window.history.replaceState({}, document.title, window.location.pathname);
    }
}