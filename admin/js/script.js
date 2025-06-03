const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i => {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});


// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');

// Restore sidebar state from localStorage on page load
document.addEventListener('DOMContentLoaded', function () {
	const isSidebarHidden = localStorage.getItem('sidebarHide') === 'true';
	sidebar.classList.toggle('hide', isSidebarHidden);
});

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
	// Save sidebar state to localStorage
	localStorage.setItem('sidebarHide', sidebar.classList.contains('hide'));
});


if (window.innerWidth < 768) {
	sidebar.classList.add('hide');
}

window.addEventListener('resize', function () {
	if (this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})

const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if (this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})