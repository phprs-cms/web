// Světlý / tmavý režim: běží v hlavičce, aby stránka neproblikla. Volba zůstává jen v prohlížeči.
(function () {
	try {
		var rezim = localStorage.getItem('rezim');
		if (rezim === 'dark' || rezim === 'light') {
			document.documentElement.setAttribute('data-theme', rezim);
		}
	} catch (e) { /* bez úložiště platí nastavení systému */ }
})();
