// Režim vzhledu: běží v hlavičce, aby stránka neproblikla. Volba zůstává jen v prohlížeči (localStorage.rezim).
// „light“ a „dark“ nastaví data-theme; chybějící hodnota, „auto“ i cokoli jiného znamená podle systému – bez atributu.
(function () {
	try {
		var rezim = localStorage.getItem('rezim');
		if (rezim === 'dark' || rezim === 'light') {
			document.documentElement.setAttribute('data-theme', rezim);
		} else {
			document.documentElement.removeAttribute('data-theme');
		}
	} catch (e) { /* bez úložiště platí nastavení systému */ }
})();
